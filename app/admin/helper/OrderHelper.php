<?php

class OrderHelper extends HelpAbstract
{
    public function help_get_status($status, $table, $id, $custom_function="activeStatus")
    {
        $status = $status == 1 ? 1 : 0;
        $result = "<button type=\"button\" class=\"btn order-status ";
        if ($status == 1)
            $result .= "btn-success ";
        else
            $result .= "btn-danger ";
        $result .= "btn-xs order-status\" onclick=\"$custom_function('$table', '$id');\">";
        if ($status == 1)
            $result .= "Duyệt";
        else
            $result .= "Chờ";
        $result .= "</button>";

        return $result;
    }
}