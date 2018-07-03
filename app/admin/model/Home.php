<?php

class Home extends Main
{

  function __construct() {
    parent::__construct();
  }

  public function index()
  {

    $sql = " SELECT count(id) as exports,
            (SELECT count(id) FROM customers WHERE status = 1) AS customers,
            (SELECT count(id) FROM suppliers WHERE status = 1) AS suppliers,
            (SELECT count(id) FROM products p WHERE p.number_warning >=
            (
              COALESCE((SELECT sum(number_count) FROM import_products  WHERE p.id = product_id), 0)
              -
              COALESCE((SELECT sum(number_count) FROM export_products  WHERE p.id = product_id), 0)
            ) ) as products
             FROM exports
             WHERE MONTH(date) = " . date('m') . " AND YEAR(date) = " . date('Y');
    $statis_1 = $this->pdo->fetch_all($sql);

    //export bill
    $sql = "SELECT a.code, a.must_pay, a.date, a.created_at, c.name as customer_name
            FROM exports a
            LEFT JOIN customers c on a.customer_id = c.id
            ORDER BY a.id DESC LIMIT 5";
    $statis_2 = $this->pdo->fetch_all($sql);
    //import bill
    $sql = "SELECT a.code, a.must_pay, a.date, a.created_at, c.name as supplier_name
            FROM imports a
            LEFT JOIN suppliers c on a.supplier_id = c.id
            WHERE a.export_id is null
            ORDER BY a.id DESC LIMIT 5";
    $statis_3 = $this->pdo->fetch_all($sql);
    $this->smarty->assign('statis_1', $statis_1[0]);
    $this->smarty->assign('statis_2', $statis_2);
    $this->smarty->assign('statis_3', $statis_3);
    $this->smarty->display('home.tpl');
  }
  public function denied()
  {
    $this->smarty->display ( "error.tpl" );
  }
}
 ?>
