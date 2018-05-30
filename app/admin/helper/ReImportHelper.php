<?php

class ReImportHelper extends HelpAbstract
{

    function __construct()
    {
        parent::__construct();
        $this->code_prefix = "REIMP";
    }
    public function get_import_code()
    {
        return $this->code_prefix . time();
    }

}