<?php

class Home extends Main {

    function __construct()
    {
        parent::__construct();
        $this->HomeHelper = new HomeHelper();
    }

    function index()
    {
        //random product
        $sql = "SELECT p.* ,
        (SELECT m.name FROM media m
        RIGHT JOIN  media_product mp ON m.id = mp.media_id WHERE mp.product_id = p.id AND mp.is_showed = 1) as image_name
        FROM products p ORDER BY RAND() LIMIT 10";
        $random_product = $this->pdo->fetch_all($sql);

        // pre($random_product);



        // sản phẩm bán chạy
        $sql = "SELECT p.*, sum(ex.number_count) as exported,
        (SELECT m.name FROM media m
        RIGHT JOIN  media_product mp ON m.id = mp.media_id WHERE mp.product_id = p.id AND mp.is_showed = 1) as image_name,
        (SELECT count(id) FROM product_rates pr WHERE p.id=pr.product_id ) as number_user_rate,
        (SELECT sum(rate) FROM product_rates pr WHERE p.id=pr.product_id ) as total_rate
        FROM products p RIGHT JOIN export_products ex ON p.id = ex.product_id
        GROUP BY ex.product_id
        ORDER BY exported
        DESC LIMIT 10";
        $best_seller = $this->pdo->fetch_all($sql);

        foreach($best_seller as $k => $item)
        {
            $best_seller[$k]['price'] = number_format($item['price']);
            if( $item['is_discount'] == 1)
            {
                switch($item['discount_type'])
                {
                    case 1:
                        $best_seller[$k]['sale_price'] = $item['price'] - (($item['price'] * $item['discount'])/100);
                        $best_seller[$k]['sale_price'] = number_format($best_seller[$k]['sale_price']);
                        break;
                    case 2:
                        $best_seller[$k]['sale_price'] = $item['price'] -  $item['discount'];
                        $best_seller[$k]['sale_price'] = number_format($best_seller[$k]['sale_price']);
                        break;
                }
            }
        }

        //sản phẩm mới nhất
        $sql = "SELECT p.*,
        (SELECT m.name FROM media m
        RIGHT JOIN  media_product mp ON m.id = mp.media_id WHERE mp.product_id = p.id AND mp.is_showed = 1) as image_name,
        (SELECT count(id) FROM product_rates pr WHERE p.id=pr.product_id ) as number_user_rate,
        (SELECT sum(rate) FROM product_rates pr WHERE p.id=pr.product_id ) as total_rate
        FROM products p
        ORDER BY created_at
        DESC LIMIT 10";
        $latest_products = $this->pdo->fetch_all($sql);
        foreach($latest_products as $k => $item)
        {
            $latest_products[$k]['price'] = number_format($item['price']);
            if( $item['is_discount'] == 1)
            {
                switch($item['discount_type'])
                {
                    case 1:
                        $latest_products[$k]['sale_price'] = $item['price'] - (($item['price'] * $item['discount'])/100);
                        $latest_products[$k]['sale_price'] = number_format($latest_products[$k]['sale_price']);
                        break;
                    case 2:
                        $latest_products[$k]['sale_price'] = $item['price'] -  $item['discount'];
                        $latest_products[$k]['sale_price'] = number_format($latest_products[$k]['sale_price']);
                        break;
                }
            }
        }

        //sản phẩm khuyến mãi
        $sql = "SELECT p.*,
        (SELECT m.name FROM media m
        RIGHT JOIN  media_product mp ON m.id = mp.media_id WHERE mp.product_id = p.id AND mp.is_showed = 1) as image_name,
        (SELECT count(id) FROM product_rates pr WHERE p.id=pr.product_id ) as number_user_rate,
        (SELECT sum(rate) FROM product_rates pr WHERE p.id=pr.product_id ) as total_rate
        FROM products p
        WHERE p.is_discount = 1
        ORDER BY id
        DESC LIMIT 10";
        $sale_products = $this->pdo->fetch_all($sql);
        foreach($sale_products as $k => $item)
        {
            $sale_products[$k]['price'] = number_format($item['price']);
            if( $item['is_discount'] == 1)
            {
                switch($item['discount_type'])
                {
                    case 1:
                        $sale_products[$k]['sale_price'] = $item['price'] - (($item['price'] * $item['discount'])/100);
                        $sale_products[$k]['sale_price'] = number_format($sale_products[$k]['sale_price']);
                        break;
                    case 2:
                        $sale_products[$k]['sale_price'] = $item['price'] -  $item['discount'];
                        $sale_products[$k]['sale_price'] = number_format($sale_products[$k]['sale_price']);
                        break;
                }
            }
        }

        //đèn thông minh
        $sql = "SELECT p.*,
        (SELECT m.name FROM media m
        RIGHT JOIN  media_product mp ON m.id = mp.media_id WHERE mp.product_id = p.id AND mp.is_showed = 1) as image_name,
        (SELECT count(id) FROM product_rates pr WHERE p.id=pr.product_id ) as number_user_rate,
        (SELECT sum(rate) FROM product_rates pr WHERE p.id=pr.product_id ) as total_rate
        FROM products p
        LEFT JOIN product_categories pc ON p.category_id = pc.id
        WHERE p.category_id = 1
        ORDER BY id
        DESC LIMIT 10";
        $smart_light = $this->pdo->fetch_all($sql);
        $smart_light = $this->HomeHelper->get_child_products(1, $smart_light);
        foreach($smart_light as $k => $item)
        {
            $smart_light[$k]['price'] = number_format($item['price']);
            if( $item['is_discount'] == 1)
            {
                switch($item['discount_type'])
                {
                    case 1:
                        $smart_light[$k]['sale_price'] = $item['price'] - (($item['price'] * $item['discount'])/100);
                        $smart_light[$k]['sale_price'] = number_format($smart_light[$k]['sale_price']);
                        break;
                    case 2:
                        $smart_light[$k]['sale_price'] = $item['price'] -  $item['discount'];
                        $smart_light[$k]['sale_price'] = number_format($smart_light[$k]['sale_price']);
                        break;
                }
            }
        }

        //ổ cắm thông minh
        $sql = "SELECT p.*,
        (SELECT m.name FROM media m
        RIGHT JOIN  media_product mp ON m.id = mp.media_id WHERE mp.product_id = p.id AND mp.is_showed = 1) as image_name,
        (SELECT count(id) FROM product_rates pr WHERE p.id=pr.product_id ) as number_user_rate,
        (SELECT sum(rate) FROM product_rates pr WHERE p.id=pr.product_id ) as total_rate
        FROM products p
        LEFT JOIN product_categories pc ON p.category_id = pc.id
        WHERE p.category_id = 33
        ORDER BY id
        DESC LIMIT 10";
        $plugin = $this->pdo->fetch_all($sql);
        $plugin = $this->HomeHelper->get_child_products(33, $plugin);
        foreach($plugin as $k => $item)
        {
            $plugin[$k]['price'] = number_format($item['price']);
            if( $item['is_discount'] == 1)
            {
                switch($item['discount_type'])
                {
                    case 1:
                        $plugin[$k]['sale_price'] = $item['price'] - (($item['price'] * $item['discount'])/100);
                        $plugin[$k]['sale_price'] = number_format($plugin[$k]['sale_price']);
                        break;
                    case 2:
                        $plugin[$k]['sale_price'] = $item['price'] -  $item['discount'];
                        $plugin[$k]['sale_price'] = number_format($plugin[$k]['sale_price']);
                        break;
                }
            }
        }


        //info cửa hàng
        $info = array();
        if (file_exists($this->file_setting))
        {
            $info = parse_ini_file($this->file_setting, true);
        }


        //ổ cắm thông minh

        $this->smarty->assign('random_product', $random_product);
        $this->smarty->assign('latest_products', $latest_products);
        $this->smarty->assign('smart_light', $smart_light);
        $this->smarty->assign('plugin', $plugin);
        $this->smarty->assign('sale_products', $sale_products);
        $this->smarty->assign('best_seller', $best_seller);
        $this->smarty->assign('info', $info);
        $this->smarty->display('home.tpl');
    }
}