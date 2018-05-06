<?php

class ProductUnitHelper extends HelpAbstract
{

    function __construct()
    {
        parent::__construct();
        $this->code_prefix =  "UID";
    }

    public function get_unit_code()
    {
        $rows = $this->pdo->count_rows("SELECT * FROM product_units");
        return $this->code_prefix . ($rows+1);
    }

}