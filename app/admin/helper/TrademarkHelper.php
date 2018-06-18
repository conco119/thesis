<?php

class TrademarkHelper extends HelpAbstract
{

    function __construct()
    {
        parent::__construct();
        $this->code_prefix =  "TRM";
    }
    public function get_trademark_code()
    {
        $rows = $this->pdo->fetch_one("SELECT max(id) as id FROM product_trademarks");
        return $this->code_prefix . ($rows['id']+1);
    }
}