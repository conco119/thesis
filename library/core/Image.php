<?php

class Image {

	private $prifix_name = "hls";
	private $true_type;
	private $_dir;
	
	function __construct(){
		$this->true_type = array("image/gif", "image/jpg", "image/jpeg", "image/png");
		$this->_dir = "../upload/";
	}
	
	
	public function image_get($dir, $image = NULL) {
        $result = NO_IMG;
        $path = "../upload/";
        
        if (is_file($path . $dir . $image)) {
            $result = URL_UPLOAD . $dir . $image;
        }
        return $result;
    }
    
    public function get_image($dir, $imgname, $return_null=0){
    	$result = NO_IMG;
    	$dir = $this->_dir . $dir;
    
    	$convert_arr_dir = explode("/", $dir);
    	if($convert_arr_dir[0]==".."){
    		$dir_get = implode("/", $convert_arr_dir);
    		unset($convert_arr_dir[0]);
    		unset($convert_arr_dir[1]);
    		$dir_show = implode("/", $convert_arr_dir);
    	}
    	else {
    		$dir_get = "../" . implode("/", $convert_arr_dir);
    		unset($convert_arr_dir[1]);
    		$dir_show = implode("/", $convert_arr_dir);
    	}
    
    	if(is_file($dir_get . $imgname)){
    		$result = URL_UPLOAD . $dir_show . $imgname;
    	}
    	else {
    		if($return_null==1)
    			return false;
    	}
    
    	return $result;
    }
    
    function check_image($img, $w = 200, $h = 200) {
        list($width, $height) = getimagesize($img['tmp_name']);
        $true_type = array("image/gif", "image/jpg", "image/jpeg", "image/png");
        if ($img["error"] > 0) {
            lib_alert("Image correct !");
            return false;
        } elseif (!in_array($img["type"], $true_type)) {
            lib_alert("Image correct !");
            return false;
        } elseif (($img["size"] / 1024) > 5000) {
            lib_alert("Invalid: Size of image > 5Mb !");
            return false;
        } elseif ($height < $h || $width < $w) {
            lib_alert("Invalid: Size of image is so small !");
            return false;
        } else {
            return true;
        }
    }

    function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale) {
        list($imagewidth, $imageheight, $imageType) = getimagesize($image);
        $imageType = image_type_to_mime_type($imageType);

        $newImageWidth = ceil($width * $scale);
        $newImageHeight = ceil($height * $scale);
        $newImage = imagecreatetruecolor($newImageWidth, $newImageHeight);
        switch ($imageType) {
            case "image/gif":
                $source = imagecreatefromgif($image);
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                $source = imagecreatefromjpeg($image);
                break;
            case "image/png":
            case "image/x-png":
                $source = imagecreatefrompng($image);
                imagesavealpha($newImage, true);
                $color = imagecolorallocatealpha($newImage, 0, 0, 0, 127);
                imagefill($newImage, 0, 0, $color);
                break;
        }
        imagecopyresampled($newImage, $source, 0, 0, $start_width, $start_height, $newImageWidth, $newImageHeight, $width, $height);
        switch ($imageType) {
            case "image/gif":
                imagegif($newImage, $thumb_image_name);
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                imagejpeg($newImage, $thumb_image_name, 90);
                break;
            case "image/png":
            case "image/x-png":
                imagepng($newImage, $thumb_image_name);
                break;
        }
        chmod($thumb_image_name, 0777);
        return $thumb_image_name;
    }

    function resize_image($image, $w = 600, $h = 600, $crop = FALSE) {
        list($width, $height, $imageType) = getimagesize($image);
        if ($width <= $w && $height <= $h) {
            return false;
        }
        $imageType = image_type_to_mime_type($imageType);
        $r = $width / $height;
        if ($crop) {
            if ($width > $height) {
                $width = ceil($width - ($width * abs($r - $w / $h)));
            } else {
                $height = ceil($height - ($height * abs($r - $w / $h)));
            }
            $newwidth = $w;
            $newheight = $h;
        } else {
            if ($w / $h > $r) {
                $newwidth = $h * $r;
                $newheight = $h;
            } else {
                $newheight = $w / $r;
                $newwidth = $w;
            }
        }
        $newImage = imagecreatetruecolor($newwidth, $newheight);
        switch ($imageType) {
            case "image/gif":
                $source = imagecreatefromgif($image);
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                $source = imagecreatefromjpeg($image);
                break;
            case "image/png":
            case "image/x-png":
                $source = imagecreatefrompng($image);
                imagesavealpha($newImage, true);
                $color = imagecolorallocatealpha($newImage, 0, 0, 0, 127);
                imagefill($newImage, 0, 0, $color);
                break;
        }
        imagecopyresampled($newImage, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

        switch ($imageType) {
            case "image/gif":
                imagegif($newImage, $image);
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                imagejpeg($newImage, $image, 90);
                break;
            case "image/png":
            case "image/x-png":
                imagepng($newImage, $image);
                break;
        }

        chmod($image, 0777);
        return $image;
    }

    function upload_avatar($dir, $img, $name) {
        $type = @explode("/", $img["type"]);
        $type = end($type);

        $this->create_parent_folder($dir);
        if (!is_dir($dir)) {
            @mkdir($dir, 0777);
            @chmod($dir, 0777);
        }
        //var_dump($img['tmp_name'], $dir . $name);
        if (move_uploaded_file($img['tmp_name'], $dir . $name . "." . $type)) {
            @chmod($dir . $name . "." . $type, 0755);
            return $name . "." . $type;
        }
        return false;
    }

    function create_parent_folder($dir) {
        $exp_folder = @explode("/", $dir);

        array_pop($exp_folder);
        array_pop($exp_folder);

        $parent_dir = @implode("/", $exp_folder) . "/";

        if (!is_dir($parent_dir)) {
            @mkdir($parent_dir, 0777);
            @chmod($parent_dir, 0777);
        }
    }

}
