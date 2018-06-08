<?php

class Product extends Main {

    function __construct()
    {
        parent::__construct();
        $this->ProductHelper = new ProductHelper();
    }

    function index()
    {
        
        $sql = "SELECT p.* ,
        (SELECT m.name FROM media m
        RIGHT JOIN  media_product mp ON m.id = mp.media_id WHERE mp.product_id = p.id AND mp.is_showed = 1) as image_name,
        (SELECT count(id) FROM product_rates pr WHERE p.id=pr.product_id ) as number_user_rate,
        (SELECT sum(rate) FROM product_rates pr WHERE p.id=pr.product_id ) as total_rate
        FROM products p 
        ORDER BY p.id DESC";
        $paging = $this->paging->get_content($this->pdo->count_rows($sql), 5);
        $sql .= $paging['sql_add'];
        $products = $this->pdo->fetch_all($sql);
        foreach($products as $k => $item)
        {
            $products[$k]['price'] = number_format($item['price']);
            $products[$k]['link_name'] = $this->dstring->str_convert($item['name']);
            if( $item['is_discount'] == 1)
            {
                switch($item['discount_type'])
                {
                    case 1:
                        $products[$k]['sale_price'] = $item['price'] - (($item['price'] * $item['discount'])/100);
                        $products[$k]['sale_price'] = number_format($products[$k]['sale_price']);
                        break;
                    case 2:
                        $products[$k]['sale_price'] = $item['price'] -  $item['discount'];
                        $products[$k]['sale_price'] = number_format($products[$k]['sale_price']);
                        break;
                }
            }
        }
        $this->smarty->assign('number_product',$this->pdo->count_rows("SELECT * FROM products"));
        $this->smarty->assign('products', $products);
        $this->smarty->assign('paging', $paging);
        $this->smarty->display('home.tpl');
    }

    function detail()
    {
        $this->smarty->display('home.tpl');
    }
}