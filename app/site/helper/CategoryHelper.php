<?php

class CategoryHelper extends HelpAbstract
{
    function __construct()
    {
        parent::__construct();
    }

    public function get_child_products($id, $products = "")
    {
        $all_child = $this->pdo->fetch_all("SELECT * FROM product_categories WHERE parent_id = {$id}");
        // $cc = [];
        if( !empty($all_child) )
        {
            foreach($all_child as $k => $value)
            {
                $sql = "SELECT a.id,a.code,a.name,a.price_import,a.price,
                (SELECT SUM(number_count) FROM import_products WHERE a.id=product_id) imported,
                (SELECT SUM(number_count) FROM export_products WHERE a.id=product_id) exported
                FROM products a
                WHERE a.category_id = {$value['id']} AND a.id NOT IN ($str_id) AND a.status=1";

                $products = array_merge($products, $this->pdo->fetch_all($sql));
                if($value['parent_id'] != 0)
                {
                        $products = $this->get_child_products($value['id'], $products);
                }
            }
        }
        return $products;
    }
}
