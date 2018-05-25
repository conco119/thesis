<?php

class ProductHelper extends HelpAbstract
{

    function __construct()
    {
        parent::__construct();
        $this->code_prefix = "PDID";
    }

    function help_get_category($category_id)
    {
        return $this->pdo->fetch_one("SELECT * FROM product_categories WHERE id = {$category_id}");
    }

    function get_product_code()
    {
        $rows = $this->pdo->fetch_one("SELECT max(id) as id FROM products");
        if($row < 10)
            return $this->code_prefix . "0" .($rows['id'] +1);
        return $this->code_prefix . ($rows['id'] +1);
    }

    // tên file =  code sản phẩm + mtd + time
    function get_image_name_upload_from_dollar_files($code, $type)
    {
        $ext_arr = explode("/", $type);
		$ext = end($ext_arr);
		return $code . '_mtd' . time() . "." . $ext;
    }


}