<?php

class Category extends Main {

    function __construct()
    {
        parent::__construct();
        $this->CategoryHelper = new CategoryHelper();
    }

    function index()
    {
        //random product
        // $sql = "SELECT p.* ,
        // (SELECT m.name FROM media m
        // RIGHT JOIN  media_product mp ON m.id = mp.media_id WHERE mp.product_id = p.id AND mp.is_showed = 1) as image_name
        // FROM products p
        // WHERE p.status = 1
        // ORDER BY RAND()
        // LIMIT 10";
        // $random_product = $this->pdo->fetch_all($sql);

        //find product id
        $c = isset($_GET['n']) ? $_GET['n'] : "";
        $all_cat = $this->pdo->fetch_all("SELECT id, name FROM product_categories");
        foreach($all_cat as $k => $cat)
        {
            if( $this->dstring->str_convert($cat['name']) == $c)
            {
                $cat_id = $cat['id'];
                $category = $this->pdo->fetch_one("SELECT * FROM product_categories WHERE id = $cat_id");
            }
        }

        // tìm product có category là $cat_id
        $sql = "SELECT p.* ,
        (SELECT m.name FROM media m
        INNER JOIN  media_product mp ON m.id = mp.media_id WHERE mp.product_id = p.id AND mp.is_showed = 1) as image_name,
        (SELECT m.path FROM media m
        INNER JOIN  media_product mp ON m.id = mp.media_id WHERE mp.product_id = p.id AND mp.is_showed = 1) as image_path,
        (SELECT count(id) FROM product_rates pr WHERE p.id=pr.product_id ) as number_user_rate,
        (SELECT sum(rate) FROM product_rates pr WHERE p.id=pr.product_id ) as total_rate
        FROM products p
        LEFT JOIN product_categories pc ON p.category_id = pc.id
        WHERE (pc.id = $cat_id OR pc.parent_id = $cat_id) AND p.status = 1
        ORDER BY p.id DESC";
        $paging = $this->paging->get_content($this->pdo->count_rows($sql), 10);
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

        $this->smarty->assign('paging', $paging);
        $this->smarty->assign('products', $products);
        // $this->smarty->assign('random_product', $random_product);
        $this->smarty->assign('category', $category);
        $this->smarty->display('home.tpl');
    }
}