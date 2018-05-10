<?php

class UserHelper extends HelpAbstract
{
    function __construct()
    {
        parent::__construct();
        $this->gender = [
            1 => "Nam",
            2 => "Nữ",
            3 => "Khác"
        ];
        $this->code = [
            0 => "US",
            1 => "AD",
            2 => "MN",
            3 => "EM"
        ];
        $this->prefix_img_name = 'mtd-avatar';
        $this->true_type = array("image/gif", "image/jpg", "image/jpeg", "image/png");
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

    public function get_user_gender_select($gender)
    {
        $result = '';
        foreach($this->gender as $key => $value)
        {
            if($key == $gender)
                $result .= "<option value='$key' selected>$value</option>";
            else
                $result .= "<option value='$key'>$value</option>";
        }
        return $result;
    }

    function get_user_birthday_select($birthday="1990-01-01")
    {
		$active['day'] = date("d", strtotime($birthday));
		$active['month'] = date("m", strtotime($birthday));
		$active['year'] = date("Y", strtotime($birthday));

		$result['day'] = "";
		for($i=1; $i<=31; $i++){
			if($i == $active['day']){
				$result['day'] .= "<option value='$i' selected>" . $i . "</option>";
			}
			else {
				$result['day'] .= "<option value='$i'>" . $i . "</option>";
			}
		}
		unset($i);

		$result['month'] = "";
		for($i=1; $i<=12; $i++){
			if($i == $active['month']){
				$result['month'] .= "<option value='$i' selected>" . $i . "</option>";
			}
			else {
				$result['month'] .= "<option value='$i'>" . $i . "</option>";
			}
		}
		unset($i);

		$result['year'] = "";
		for($i=2010; $i>=1950; $i--){
			if($i == $active['year']){
				$result['year'] .= "<option value='$i' selected>" . $i . "</option>";
			}
			else {
				$result['year'] .= "<option value='$i'>" . $i . "</option>";
			}
		}
		unset($i);

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

    function check_type($type)
    {
        return in_array($type, $this->true_type);
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