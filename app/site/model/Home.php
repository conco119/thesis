<?php

class Home extends Main {

    function __construct()
    {
        parent::__construct();
        $this->HomeHelper = new HomeHelper();
    }

    function index()
    {
        //for searching
        $key = isset($_GET['key']) ? trim($_GET['key']) : '';
        if($key)
        {
            lib_redirect('./?mc=product&site=search&key=' . $key);
        }
        $this->set_sidebar();
        $this->set_footer();
        // unset($_SESSION['cart']);
        // pre($_SESSION['cart']);
        //random product
        $sql = "SELECT p.* ,
        (SELECT m.name FROM media m
        INNER JOIN  media_product mp ON m.id = mp.media_id WHERE mp.product_id = p.id AND mp.is_showed = 1) as image_name,
        (SELECT m.path FROM media m
        INNER JOIN  media_product mp ON m.id = mp.media_id WHERE mp.product_id = p.id AND mp.is_showed = 1) as image_path
        FROM products p
        WHERE p.status = 1
        ORDER BY RAND()
        LIMIT 10";
        $random_product = $this->pdo->fetch_all($sql);

        // pre($random_product);

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
        WHERE p.category_id = 1 AND p.status = 1
        ORDER BY id
        DESC LIMIT 10";
        $smart_light = $this->pdo->fetch_all($sql);
        $smart_light = $this->HomeHelper->get_child_products(1, $smart_light);
        // pre($smart_light);
        foreach($smart_light as $k => $item)
        {
            $smart_light[$k]['price'] = number_format($item['price']);
            $smart_light[$k]['link_name'] = $this->dstring->str_convert($item['name']);
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
        INNER JOIN  media_product mp ON m.id = mp.media_id WHERE mp.product_id = p.id AND mp.is_showed = 1) as image_name,
        (SELECT m.path FROM media m
        INNER JOIN  media_product mp ON m.id = mp.media_id WHERE mp.product_id = p.id AND mp.is_showed = 1) as image_path,
        (SELECT count(id) FROM product_rates pr WHERE p.id=pr.product_id ) as number_user_rate,
        (SELECT sum(rate) FROM product_rates pr WHERE p.id=pr.product_id ) as total_rate
        FROM products p
        LEFT JOIN product_categories pc ON p.category_id = pc.id
        WHERE p.category_id = 33 AND p.status = 1
        ORDER BY id
        DESC LIMIT 10";
        $plugin = $this->pdo->fetch_all($sql);
        $plugin = $this->HomeHelper->get_child_products(33, $plugin);
        foreach($plugin as $k => $item)
        {
            $plugin[$k]['price'] = number_format($item['price']);
            $plugin[$k]['link_name'] = $this->dstring->str_convert($item['name']);
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

        //thiết bị an ninh
        $sql = "SELECT p.*,
        (SELECT m.name FROM media m
        INNER JOIN  media_product mp ON m.id = mp.media_id WHERE mp.product_id = p.id AND mp.is_showed = 1) as image_name,
        (SELECT m.path FROM media m
        INNER JOIN  media_product mp ON m.id = mp.media_id WHERE mp.product_id = p.id AND mp.is_showed = 1) as image_path,
        (SELECT count(id) FROM product_rates pr WHERE p.id=pr.product_id ) as number_user_rate,
        (SELECT sum(rate) FROM product_rates pr WHERE p.id=pr.product_id ) as total_rate
        FROM products p
        LEFT JOIN product_categories pc ON p.category_id = pc.id
        WHERE p.category_id = 32 AND p.status = 1
        ORDER BY id
        DESC LIMIT 10";
        $security = $this->pdo->fetch_all($sql);
        $security = $this->HomeHelper->get_child_products(32, $security);
        foreach($security as $k => $item)
        {
            $security[$k]['price'] = number_format($item['price']);
            $security[$k]['link_name'] = $this->dstring->str_convert($item['name']);
            if( $item['is_discount'] == 1)
            {
                switch($item['discount_type'])
                {
                    case 1:
                        $security[$k]['sale_price'] = $item['price'] - (($item['price'] * $item['discount'])/100);
                        $security[$k]['sale_price'] = number_format($security[$k]['sale_price']);
                        break;
                    case 2:
                        $security[$k]['sale_price'] = $item['price'] -  $item['discount'];
                        $security[$k]['sale_price'] = number_format($security[$k]['sale_price']);
                        break;
                }
            }
        }


        $this->smarty->assign('random_product', $random_product);
        $this->smarty->assign('security', $security);
        $this->smarty->assign('smart_light', $smart_light);
        $this->smarty->assign('plugin', $plugin);
        $this->smarty->display('home.tpl');
    }

    function payment()
    {
        $this->smarty->display('home.tpl');
    }

    function contact()
    {
        if(isset($_POST['submit']))
        {
            $data['name'] = $_POST['name'];
            $data['email'] = $_POST['email'];
            $data['phone'] = $_POST['phone'];
            $data['description'] = $_POST['description'];
            $data['status'] = 0;
            $data['created_at'] = time();
            $this->pdo->insert('contacts', $data);
            lib_alert('Gửi thành công');
        }
        $this->smarty->display('contact.tpl');
    }

    function intro()
    {
        $this->smarty->display('home.tpl');
    }


}