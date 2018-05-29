<?php

class SettingHelper extends HelpAbstract
{

    function __construct()
    {
        parent::__construct();
    }

    function get_extension($type)
    {
        $ext_arr = explode("/", $type);
        return $ext = end($ext_arr);
    }

}