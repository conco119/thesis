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

    public function get_child_products($id, $products = "" , $key)
    {
        $all_child = $this->pdo->fetch_all("SELECT * FROM product_categories WHERE parent_id = {$id}");
        // $cc = [];
        if( !empty($all_child) )
        {
            foreach($all_child as $k => $value)
            {
                $sql_filter = '';
                if($key != '')
                    $sql_filter .= " AND (a.code LIKE  '%$key%' OR a.name LIKE '%$key%' )";
                $sql = "SELECT a.*,
                    (SELECT sum(number_count) FROM import_products i WHERE i.product_id = a.id) AS imported,
                    (SELECT sum(number_count) FROM export_products e WHERE e.product_id = a.id ) AS exported
                    FROM products a  WHERE a.category_id = {$value['id']} $sql_filter";

                $products = array_merge($products, $this->pdo->fetch_all($sql));
                if($value['parent_id'] != 0)
                {
                        $products = $this->get_child_products($value['id'], $products, $key);
                }
            }
        }
        return $products;
    }



}