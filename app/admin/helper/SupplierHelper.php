<?php

class SuppplierHelper extends HelpAbstract
{

    function __construct()
    {
        parent::__construct();
        $this->code_prefix = "SPID";
    }

    public function help_get_customer_category_option($customer_groups)
    {
        $result = '';
        foreach($customer_groups as $key => $value)
        {
                $result .= "<option value='{$value['id']}'>{$value['name']}</option>";
        }
        return $result;
    }

    public function help_get_group_option($group_id)
    {
        $groups = $this->pdo->fetch_all("SELECT * FROM customer_groups WHERE status <> 0");
        $result = '';
        foreach($groups as $key => $value)
        {
            if($value['id'] == $group_id)
                $result .= "<option value='{$value['id']}' selected>{$value['name']}</option>";
            else
                $result .= "<option value='{$value['id']}'>{$value['name']}</option>";
        }
        return $result;
    }

    public function help_get_group($group_id)
    {
        $group = $this->pdo->fetch_one("SELECT * FROM customer_groups WHERE id = {$group_id}");
        return $group;
    }

    public function get_customer_code()
    {
        $rows = $this->pdo->fetch_one("SELECT max(id) as id FROM customers");
        return $this->code_prefix . ($rows['id'] +1);
    }

    public function help_get_creator($user_id)
    {
        $user = $this->pdo->fetch_one("SELECT * FROM users where id = {$user_id}");
        return $user;
    }
}