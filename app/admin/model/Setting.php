<?php

class Setting extends Main
{
    function __construct()
    {
        parent::__construct();
    }


    function info()
    {
        $this->smarty->display(DEFAULT_LAYOUT);
    }
}