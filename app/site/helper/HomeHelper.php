<?php

class HomeHelper extends HelpAbstract
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
            foreach($all_child as $key => $value)
            {
                //đèn thông minh
                $sql = "SELECT p.*,
                (SELECT m.name FROM media m
                INNER JOIN  media_product mp ON m.id = mp.media_id WHERE mp.product_id = p.id AND mp.is_showed = 1) as image_name,
                (SELECT m.path FROM media m
                INNER JOIN  media_product mp ON m.id = mp.media_id WHERE mp.product_id = p.id AND mp.is_showed = 1) as image_path,
                (SELECT count(id) FROM product_rates pr WHERE p.id=pr.product_id ) as number_user_rate,
                (SELECT sum(rate) FROM product_rates pr WHERE p.id=pr.product_id ) as total_rate
                FROM products p
                LEFT JOIN product_categories pc ON p.category_id = pc.id
                WHERE p.category_id = {$value['id']} AND p.status = 1
                ORDER BY id
                DESC LIMIT 10";


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