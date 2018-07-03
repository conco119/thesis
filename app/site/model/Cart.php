<?php

class Cart extends Main {

    function __construct()
    {
        parent::__construct();
        $this->CartHelper = new CartHelper();
    }

    function add()
    {
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
        foreach ($cart['products'] as $key => $value)
        {
            if($value['id'] == $id)
            {
                $number['product'] =  count($_SESSION['cart']['products']);
                $number['service'] =  count($_SESSION['cart']['services']);
                echo json_encode($number);
                die();
            }

        }
        $sql = "SELECT p.*,
        (SELECT m.name FROM media m
        INNER JOIN  media_product mp ON m.id = mp.media_id WHERE mp.product_id = p.id AND mp.is_showed = 1) as image_name,
        (SELECT m.path FROM media m
        INNER JOIN  media_product mp ON m.id = mp.media_id WHERE mp.product_id = p.id AND mp.is_showed = 1) as image_path
        ,((SELECT SUM(number_count) FROM import_products WHERE p.id=product_id) -
        (SELECT SUM(number_count) FROM export_products WHERE p.id=product_id)) max_number
        FROM products p
        WHERE p.id = $id";
        $product = $this->pdo->fetch_one($sql);
        if($product['is_discount'] == 1)
        {
            switch($product['discount_type'])
            {
                case 1:
                    $product['price_sale'] = $product['price'] - (($product['price'] * $product['discount'])/100);
                    break;
                case 2:
                    $product['price_sale'] = $product['price'] -  $product['discount'];
                    break;
            }
        }
        $product['number_count'] = 1;
        $cart['products'][] = $product;
        $_SESSION['cart'] = $cart;
        $number['product'] =  count($_SESSION['cart']['products']);
        $number['service'] =  count($_SESSION['cart']['services']);
        echo json_encode($number);
    }

    function update()
    {
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $number = isset($_POST['value']) ? intval($_POST['value']) : 0;
        $cart = $_SESSION['cart'];
        foreach($cart['products'] as $k => $value)
        {
            if($value['id'] == $id)
                $cart['products'][$k]['number_count'] = $number;
        }
        $_SESSION['cart'] = $cart;
    }
    function delete()
    {
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $cart = $_SESSION['cart'];
        foreach ($cart['products'] as $key => $value) {
            if($value['id'] == $id)
                unset($cart['products'][$key]);
        }
        $_SESSION['cart'] = $cart;
    }

    function delete_all()
    {
        unset($_SESSION['cart']);
    }
    function index()
    {
        $total = 0;

        $cart = $_SESSION['cart'];
        foreach ($cart['products'] as $key => $value)
        {
            if($value['is_discount'] == 1)
                $total += $value['price_sale'] * $value['number_count'];
            else
                $total += $value['price'] * $value['number_count'];
        }

        foreach ($cart['services'] as $key => $value)
        {
            $total += $value['price'] * $value['number_count'];
        }
        $this->smarty->assign('cart', $cart);
        $this->smarty->assign('total', $total);
        $this->smarty->display("cart.tpl");
    }

    function payment()
    {
        $total = 0;
        $cart = $_SESSION['cart'];
        if(count($cart['products']) == 0 && count($cart['services']) == 0 )
        {
            lib_alert("Không có sản phẩm nào trong giỏ hàng");
            lib_redirect("./");
            exit();
        }
        foreach ($cart['products'] as $key => $value)
        {
            if($value['is_discount'] == 1)
                $total += $value['price_sale'] * $value['number_count'];
            else
                $total += $value['price'] * $value['number_count'];
        }

        foreach ($cart['services'] as $key => $value)
        {
            $total += $value['price'] * $value['number_count'];
        }
        $this->smarty->assign('cart', $cart);
        $this->smarty->assign('total', $total);
        $this->smarty->display('cart.tpl');
    }

    function order()
    {
        if(isset($_POST['FrmSubmit']))
        {
            $data['name'] = $_POST['cus_name'];
            $data['phone'] = $_POST['cus_phone'];
            $data['email'] = $_POST['cus_email'];
            $data['address'] = $_POST['cus_address'];
            $data['description'] = $_POST['content'];
            $data['status'] = 0;
            $data['type'] = $_POST['type'];
            $data['created_at'] = time();
            $order_id = $this->pdo->insert('orders', $data);
            unset($data);
            //thêm sản phẩm
            $products = $_SESSION['cart']['products'];
            foreach ($products as $key => $value) {
                $data['order_id'] = $order_id;
                $data['product_id'] = $value['id'];
                $data['number_count'] = $value['number_count'];
                $this->pdo->insert('order_products', $data);
            }
            unset($data);
            $services = $_SESSION['cart']['services'];
            foreach ($services as $key => $value) {
                $data['order_id'] = $order_id;
                $data['service_id'] = $value['id'];
                $data['number_count'] = $value['number_count'];
                $this->pdo->insert('order_services', $data);
            }
            unset($_SESSION['cart']);
            lib_alert("Gửi đơn đặt hàng thành công");
            lib_redirect("./");
        }
    }


    /// service
    function addService()
    {
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
        foreach ($cart['services'] as $key => $value)
        {
            if($value['id'] == $id)
            {
                $number['product'] =  count($_SESSION['cart']['products']);
                $number['service'] =  count($_SESSION['cart']['services']);
                echo json_encode($number);
                die();
            }
        }
        $sql = "SELECT * FROM services WHERE id =$id";
        $service = $this->pdo->fetch_one($sql);
        $service['number_count'] = 1;
        $cart['services'][] = $service;
        $_SESSION['cart'] = $cart;
        $number['product'] =  count($_SESSION['cart']['products']);
        $number['service'] =  count($_SESSION['cart']['services']);
        echo json_encode($number);
    }

    function updateService()
    {
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $number = isset($_POST['value']) ? intval($_POST['value']) : 0;
        $cart = $_SESSION['cart'];
        foreach($cart['services'] as $k => $value)
        {
            if($value['id'] == $id)
                $cart['services'][$k]['number_count'] = $number;
        }
        $_SESSION['cart'] = $cart;
    }

    function deleteService()
    {
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $cart = $_SESSION['cart'];
        foreach ($cart['services'] as $key => $value) {
            if($value['id'] == $id)
                unset($cart['services'][$key]);
        }
        $_SESSION['cart'] = $cart;
    }
}