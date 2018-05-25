<?php

class UserHelper extends HelpAbstract
{
    function __construct()
    {
        parent::__construct();
        $this->code = [
            0 => "US",
            1 => "AD",
            2 => "MN",
            3 => "EM"
        ];
        $this->prefix_img_name = 'mtd-avatar';

        $this->avatar_folder = "../upload/user/avatars/";
        $this->default_avatar = 'user-default.png';
    }
    public function get_user_permission_select($user_permission)
    {
        $result = '';
        foreach($this->permission_type as $key => $value)
        {
            if($key == $user_permission)
                $result .= "<option value='$key' selected>$value</option>";
            else
                $result .= "<option value='$key'>$value</option>";
        }
        return $result;

    }

    public function get_user_code($permission)
    {
        $rows = $this->pdo->count_rows("SELECT * FROM users where permission = $permission");
        return $this->code[$permission] . ($rows + 1);
    }

    public function get_permission_type($index)
    {
        return $this->permission_type[$index];
    }

    public function help_get_user_permission_option($permission)
    {
        $result = '';
        foreach($this->permission_type as $key => $value)
        {
            if($key == $permission)
                $result .= "<option value='$key' selected>$value</option>";
            else
                $result .= "<option value='$key'>$value</option>";
        }
        return $result;
    }

    function get_user_avatar($path, $file)
    {
        if($file == '')
            return $path . $this->default_avatar;
        return $path . $file;
    }

    function get_image_name_upload_from_dollar_files($type)
    {
		$ext_arr = explode("/", $type);
		$ext = end($ext_arr);
		return $this->prefix_img_name . time() . "." . $ext;
    }

    function get_image_name_upload_from_extension($ext)
    {
        return $this->prefix_img_name . time() . "." . $ext;
    }

    function get_avatar_path($image_folder_path, $image=""){
        $result = '';
		if(is_file($image_folder_path . $image)){
			$result = $image_folder_path . $image;
		}
		else{
			$result = $image_folder_path . $this->default_avatar;
		}
		return $result;
	}
}