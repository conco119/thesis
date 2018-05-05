<?php

class Helper extends HelpAbstract
{
    public function help_get_status($status, $table, $id, $custom_function="activeItem")
    {
        $status = $status == 1 ? 1 : 0;
        $result = "<button type=\"button\" class=\"btn ";
        if ($status == 1)
            $result .= "btn-success ";
        else
            $result .= "btn-danger ";
        $result .= "btn-xs btn-status\" onclick=\"$custom_function('$table', '$id');\">";
        if ($status == 1)
            $result .= "<i class=\"fa fa-check\"></i>";
        else
            $result .= "<i class=\"fa fa-close\"></i>";
        $result .= "</button>";

        return $result;
    }
}
