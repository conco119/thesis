<?php
class Helps extends Main
{
    function __construct() {
        parent::__construct();
    }
    public function ajax_get_number_format() {
        if (isset($_POST['value'])) {
            $value = $this->dstring->convert_price_to_int($_POST['value']);
            echo number_format($value);
        }
    }
}