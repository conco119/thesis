<?php

class MoneyHelper extends HelpAbstract
{

    function __construct()
    {
        parent::__construct();
        $this->code_prefix = "MNCAT";
    }

    function get_option_money_type($is_import = 0, $money_type = 0 )
    {
        $sql = "SELECT * FROM money_categories WHERE is_import = $is_import AND id NOT IN (1, 2) AND status <> 0";
        $money_types = $this->pdo->fetch_all($sql);
        $result = "<option value='0'> Chọn thể loại </option>";
        foreach($money_types as $key => $value)
        {
            if($value['id'] == $money_type)
                $result .= "<option value='{$value['id']}' selected>{$value['name']}</option>";
            else
                $result .= "<option value='{$value['id']}'>{$value['name']}</option>";
        }
        return $result;
    }


    function get_customer_option($customers)
    {
        $result = "<option value='0'> Lựa chọn khách hàng </option> ";

        foreach ($customers as $key => $customer)
        {
            $result .= "<option value='{$customer['id']}'>{$customer['name']}</option>";
        }
        return $result;
    }

    public function get_object_name($id)
    {
        switch($id)
        {
            case 1: return 'cus';
            case 2: return 'sup';
            case 3: return 'usr';
        }
    }

    public function get_code()
    {
        $rows = $this->pdo->fetch_one("SELECT max(id) as id FROM money_categories");
        return $this->code_prefix . ($rows['id']+1);
    }

    function get_money_btn($money_id=0, $is_import=0, $from_type=NULL, $user, $money){
		$str = "";
        if($from_type ==null && $from_type == NULL)
        {
            if( $user['permission'] != 3 )
            {
                $str .= "<button type=\"button\" data-toggle=\"modal\" class=\"btn btn-default\" data-target=\"#Bill\" onclick=\"LoadDataForEdit($money_id, $is_import);\">";
                $str .= "<i class=\"fa fa-pencil\"/></i>";
                $str .= "</button>";
                $str .= "<button type=\"button\" data-toggle=\"modal\" class=\"btn btn-danger\" data-target=\"#DeleteForm\" onclick=\"LoadDeleteItem('money', $money_id, '', 'sổ thu chi', '');\">";
                $str .= "<i class=\"fa fa-trash-o\"/></i>";
                $str .= "</button>";
            }
            if( $user['permission'] == 3 && $money['creator'] == $user['id'])
            {
                $str .= "<button type=\"button\" data-toggle=\"modal\" class=\"btn btn-default\" data-target=\"#Bill\" onclick=\"LoadDataForEdit($money_id, $is_import);\">";
                $str .= "<i class=\"fa fa-pencil\"/></i>";
                $str .= "</button>";
                $str .= "<button type=\"button\" data-toggle=\"modal\" class=\"btn btn-danger\" data-target=\"#DeleteForm\" onclick=\"LoadDeleteItem('money', $money_id, '', 'sổ thu chi', '');\">";
                $str .= "<i class=\"fa fa-trash-o\"/></i>";
                $str .= "</button>";
            }
		}
		return $str;
	}
}