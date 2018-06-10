<?php

class Servicee extends Main {

    function __construct()
    {
        parent::__construct();
        $this->ServiceeHelper = new ServiceeHelper();
    }
    function index()
    {
        $sql = "SELECT * FROM services WHERE status=1";
        $services  = $this->pdo->fetch_all($sql);
        $this->smarty->assign('services', $services);
        $this->smarty->display("home.tpl");
    }
}