<?php

class ProductDetail extends Main {

    function __construct()
    {
        parent::__construct();
        $this->ProductDetailHelper = new ProductDetailHelper();
    }

    function index()
    {
        $n = isset($_GET['n']) ? $_GET['n'] : "";
        $products = $this->pdo->fetch_all("SELECT id, name FROM products");
        foreach($products as $k => $product)
        {
            if( $this->dstring->str_convert($product['name']) == $n)
            {
                $product_id = $product['id'];
            }
        }
        $sql = "SELECT p.* FROM products p WHERE p.id=$product_id";
        $product = $this->pdo->fetch_one($sql);
        $sql = "SELECT m.name, mp.is_showed
                FROM media_product mp
                RIGHT JOIN media m ON m.id = mp.media_id
                RIGHT JOIN products p ON p.id = mp.product_id
                WHERE mp.product_id = $product_id
                ";


        $product['images'] = $this->pdo->fetch_all($sql);
        pre($product);
        $this->smarty->assign('product', $product);
        $this->smarty->display('product-detail.tpl');
    }
}