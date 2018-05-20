<?php

class ImportHelper extends HelpAbstract
{

    function __construct()
    {
        parent::__construct();
        $this->code_prefix = "IMP";
    }

    public function get_import_code()
    {
        return $this->code_prefix . time();
    }


    public function get_select_from_array($index)
    {
        $result = '';
        foreach ($this->select_export AS $k => $item) {
            if ($k == $index)
            {
                $result .= "<option value='$k' selected>" . $item . "</option>";
            }
            else
            {
                $result .= "<option value='$k'>" . $item . "</option>";
            }
        }
        return $result;
    }
}