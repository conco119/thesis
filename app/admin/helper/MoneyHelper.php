<?php

class MoneyHelper extends HelpAbstract
{

    function __construct()
    {
        parent::__construct();
        $this->code_prefix = "CUSID";
    }

    function get_option_money_type($is_import = 0, $money_type = 0 )
    {
        $money_type = $this->pdo->fetch_all("SELECT * FROM money_categories WHERE is_import = $is_import");
        $result = "<option value='0'> Chọn thể loại </option>";
        foreach($money_type as $key => $value)
        {
            if($value['id'] == $money_type)
                $result .= "<option value='{$value['id']}' selected>{$value['name']}</option>";
            else
                $result .= "<option value='{$value['id']}'>{$value['name']}</option>";
        }
        return $result;
    }

}