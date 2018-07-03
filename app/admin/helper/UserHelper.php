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

    function get_image_name_upload_from_dollar_files($type)
    {
		$ext_arr = explode("/", $type);
		$ext = end($ext_arr);
		return $this->prefix_img_name . time() . "." . $ext;
    }

}