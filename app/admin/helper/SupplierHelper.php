<?php

class SupplierHelper extends HelpAbstract
{

    function __construct()
    {
        parent::__construct();
        $this->code_prefix = "SPID";
    }

    public function get_sup_code()
    {
        $rows = $this->pdo->fetch_one("SELECT max(id) as id FROM suppliers");
        if($row < 10)
            return $this->code_prefix . "0" .($rows['id'] +1);
        return $this->code_prefix . ($rows['id'] +1);
    }
}