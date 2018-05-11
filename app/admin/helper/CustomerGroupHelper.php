<?php

class CustomerGroupHelper extends HelpAbstract
{

    function __construct()
    {
        parent::__construct();
        $this->code_prefix = "CGID";
    }

    public function get_customer_group_code()
    {
        $rows = $this->pdo->fetch_one("SELECT max(id) as id FROM customer_groups");
        return $this->code_prefix . ($rows['id'] +1);
    }
}