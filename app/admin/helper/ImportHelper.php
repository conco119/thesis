<?php

class ImportHelper extends HelpAbstract
{

    function __construct()
    {
        parent::__construct();
        $this->code_prefix = "IMPO";
    }

    public function get_import_code()
    {
        $rows = $this->pdo->fetch_one("SELECT max(id) as id FROM imports");
        if($row < 10)
            return $this->code_prefix . "0" .($rows['id'] +1);
        return $this->code_prefix . ($rows['id'] +1);
    }
}