<?php

class ServiceHelper extends HelpAbstract
{

    function __construct()
    {
        parent::__construct();
        $this->code_prefix =  "SVID";
    }
    public function get_service_code()
    {
        $rows = $this->pdo->fetch_one("SELECT max(id) as id FROM services");
        return $this->code_prefix . ($rows['id']+1);
    }
}