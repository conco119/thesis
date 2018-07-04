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
        INNER JOIN  media_product mp ON m.id = mp.media_id WHERE mp.product_id = p.id AND mp.is_showed = 1) as image_name,
        (SELECT m.path FROM media m
        INNER JOIN  media_product mp ON m.id = mp.media_id WHERE mp.product_id = p.id AND mp.is_showed = 1) as image_path,
        (SELECT count(id) FROM product_rates pr WHERE p.id=pr.product_id ) as number_user_rate,
        (SELECT sum(rate) FROM product_rates pr WHERE p.id=pr.product_id ) as total_rate
        FROM products p
        WHERE p.status = 1
        ORDER BY p.id DESC";
        $paging = $this->paging->get_content($this->pdo->count_rows($sql), 15);
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
        $product_count = $this->pdo->count_rows("SELECT * FROM products WHERE status = 1");
        if($product_count > 0)
            $this->smarty->assign('paging', $paging);
        $this->smarty->assign('number_product', $product_count);
        $this->smarty->assign('products', $products);
        $this->smarty->display('home.tpl');
    }

    function detail()
    {
        //find product id
        $c = isset($_GET['n']) ? $_GET['n'] : "";
        $all_product = $this->pdo->fetch_all("SELECT id, name FROM products");
        foreach($all_product as $k => $p)
        {
            if( $this->dstring->str_convert($p['name']) == $c)
            {
                $product_id = $p['id'];

                $sql = "SELECT p.*, pt.name as trademark_name, pc.name as category_name , po.content as content
                ,(SELECT SUM(number_count) FROM import_products im WHERE p.id=im.product_id) imported,
                (SELECT SUM(number_count) FROM export_products ex WHERE p.id=ex.product_id) exported,
                (SELECT count(id) FROM product_rates pr WHERE p.id=pr.product_id ) as number_user_rate,
                (SELECT sum(rate) FROM product_rates pr WHERE p.id=pr.product_id ) as total_rate
                FROM products p
                LEFT JOIN product_trademarks pt ON pt.id = p.trademark_id
                LEFT JOIN product_categories pc ON pc.id = p.category_id
                LEFT JOIN posts po ON po.product_id = p.id
                WHERE p.id = $product_id AND p.status=1";
                $product = $this->pdo->fetch_one($sql);
                //check status
                if($product['status'] == 0)
                {
                    lib_redirect(DOMAIN . './?mc=product&site=not_found');
                }
                //cập nhật lượt xems
                $this->pdo->update('products', ['views' => $product['views'] + 1], "id=".$product['id']);
                //select lại product
                $product = $this->pdo->fetch_one($sql);
                $sql ="SELECT m.name, mp.is_showed, m.path FROM media m
                LEFT JOIN media_product mp ON m.id = mp.media_id
                WHERE mp.product_id = {$product['id']} ORDER BY mp.is_showed DESC";

                $product['images'] = $this->pdo->fetch_all($sql);
                $product['link_name'] = $this->dstring->str_convert($product['name']);
                if( $product['is_discount'] == 1)
                {
                    switch($product['discount_type'])
                    {
                        case 1:
                            $product['sale_price'] = $product['price'] - (($product['price'] * $product['discount'])/100);
                            $product['sale_price'] = number_format($product['sale_price']);
                            break;
                        case 2:
                            $product['sale_price'] = $product['price'] -  $product['discount'];
                            $product['sale_price'] = number_format($product['sale_price']);
                            break;
                    }
                }
                $product['price'] = number_format($product['price']);

            }
        }
        // sản phẩm liên quan
        $sql = "SELECT p.*,
        (SELECT m.name FROM media m
        INNER JOIN  media_product mp ON m.id = mp.media_id WHERE mp.product_id = p.id AND mp.is_showed = 1) as image_name,
        (SELECT m.path FROM media m
        INNER JOIN  media_product mp ON m.id = mp.media_id WHERE mp.product_id = p.id AND mp.is_showed = 1) as image_path,
        (SELECT count(id) FROM product_rates pr WHERE p.id=pr.product_id ) as number_user_rate,
        (SELECT sum(rate) FROM product_rates pr WHERE p.id=pr.product_id ) as total_rate,
        (SELECT count(id) FROM product_rates pr WHERE p.id=pr.product_id ) as number_user_rate,
        (SELECT sum(rate) FROM product_rates pr WHERE p.id=pr.product_id ) as total_rate
        FROM products p
        LEFT JOIN product_categories pc ON p.category_id = pc.id
        WHERE p.category_id = {$product['category_id']} AND p.id <> {$product['id']} AND p.status =1
        ORDER BY id
        DESC LIMIT 10";
        $relate_product = $this->pdo->fetch_all($sql);
        foreach($relate_product as $k => $item)
        {
            $relate_product[$k]['price'] = number_format($item['price']);
            $relate_product[$k]['link_name'] = $this->dstring->str_convert($item['name']);
            if( $item['is_discount'] == 1)
            {
                switch($item['discount_type'])
                {
                    case 1:
                        $relate_product[$k]['sale_price'] = $item['price'] - (($item['price'] * $item['discount'])/100);
                        $relate_product[$k]['sale_price'] = number_format($relate_product[$k]['sale_price']);
                        break;
                    case 2:
                        $relate_product[$k]['sale_price'] = $item['price'] -  $item['discount'];
                        $relate_product[$k]['sale_price'] = number_format($relate_product[$k]['sale_price']);
                        break;
                }
            }
        }
        $this->smarty->assign('value', $product);
        $this->smarty->assign('relate_product', $relate_product);
        $this->smarty->display('home.tpl');
    }

    function set_star()
    {
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $point = isset($_POST['point']) ? intval($_POST['point']) : 0;
        $user_id = $this->currentUser['id'];
        if(!$this->currentUser['id'])
        {
            echo 0;
            exit();
        }
        if( $this->pdo->count_rows("SELECT * FROM product_rates WHERE user_id = $user_id AND product_id = $id") )
        {
            $data['rate'] = $_POST['point'];
            $this->pdo->update('product_rates', $data, " user_id = $user_id AND product_id = $id ");
            echo 1;
            exit();
        }

        $data['user_id'] = $this->currentUser['id'];
        $data['product_id'] = $id;
        $data['rate'] = $point;
        $this->pdo->insert('product_rates', $data);
        echo 1;
    }

    function search()
    {
        $key = isset($_GET['key']) ? trim($_GET['key']) : '';
        if ($key != "")
        {
            $sql_where .= " AND  (p.code LIKE '%$key%' OR p.name LIKE '%$key%')";
        }
        $sql = "SELECT p.* ,
        (SELECT m.name FROM media m
        INNER JOIN  media_product mp ON m.id = mp.media_id WHERE mp.product_id = p.id AND mp.is_showed = 1) as image_name,
        (SELECT m.path FROM media m
        INNER JOIN  media_product mp ON m.id = mp.media_id WHERE mp.product_id = p.id AND mp.is_showed = 1) as image_path,
        (SELECT count(id) FROM product_rates pr WHERE p.id=pr.product_id ) as number_user_rate,
        (SELECT sum(rate) FROM product_rates pr WHERE p.id=pr.product_id ) as total_rate
        FROM products p
        WHERE 1=1 $sql_where
        ORDER BY p.id DESC ";
        $number_count = $this->pdo->count_rows($sql);
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
        $this->smarty->assign('number_product', $number_count);
        $this->smarty->assign('products', $products);
        $this->smarty->assign('paging', $paging);
        $this->smarty->display('home.tpl');
    }

    function not_found()
    {
        $this->smarty->display('home.tpl');
    }

}