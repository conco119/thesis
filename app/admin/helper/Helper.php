<?php

class Helper extends HelpAbstract
{
    function __construct()
    {
        parent::__construct();
    }
    public function help_get_status($status, $table, $id, $custom_function="activeStatus")
    {
        $status = $status == 1 ? 1 : 0;
        $result = "<button type=\"button\" class=\"btn ";
        if ($status == 1)
            $result .= "btn-success ";
        else
            $result .= "btn-danger ";
        $result .= "btn-xs btn-status\" onclick=\"$custom_function('$table', '$id');\">";
        if ($status == 1)
            $result .= "<i class=\"fa fa-check\"></i>";
        else
            $result .= "<i class=\"fa fa-close\"></i>";
        $result .= "</button>";

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

    public function help_get_discount_option($type)
    {
        $result = '';
        foreach($this->discount_type as $key => $value)
        {
            if($key == $type)
                $result .= "<option value='$key' selected>$value</option>";
            else
                $result .= "<option value='$key'>$value</option>";
        }
        return $result;
    }


    //first parm @table
    //second if is table $condition = table name ,else $condition is property
    // $id
    public function get_option($isTable, $condition, $id =0, $is_zero = 0)
    {
        $result = '';
        if($isTable)
        {
            if($is_zero == 1)
            {
                $result = "<option value=0>Chọn danh mục</option>";
                $query_result = $this->pdo->fetch_all("SELECT * FROM {$condition}");
                foreach($query_result as $key => $value)
                {
                    if($value['id'] == $id)
                        $result .= "<option value='{$value['id']}' selected>{$value['name']}</option>";
                    else
                    $result .= "<option value='{$value['id']}'>{$value['name']}</option>";
                }
                return $result;
            }
            else
            {
                $query_result = $this->pdo->fetch_all("SELECT * FROM {$condition}");
                foreach($query_result as $key => $value)
                {
                    if($value['id'] == $id)
                        $result .= "<option value='{$value['id']}' selected>{$value['name']}</option>";
                    else
                    $result .= "<option value='{$value['id']}'>{$value['name']}</option>";
                }
                return $result;

            }

        }
        else
        {
            if($is_zero == 1)
            {
                $result = "<option value=0>Chọn danh mục</option>";
                foreach($this->$condition as $key => $value)
                {
                    if($key == $id)
                        $result .= "<option value='{$key}' selected>{$value}</option>";
                    else
                        $result .= "<option value='{$key}'>{$value}</option>";
                }
                return $result;
            }
            else
            {
                foreach($this->$condition as $key => $value)
                {
                    if($key == $id)
                        $result .= "<option value='{$key}' selected>{$value}</option>";
                    else
                        $result .= "<option value='{$key}'>{$value}</option>";
                }
                return $result;

            }
        }

    }
}
