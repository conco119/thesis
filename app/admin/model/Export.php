<?php

class Export extends Main
{
  function __construct() {
    parent::__construct();
    $this->ExportHelper = new ExportHelper();
    $this->table = "exports";
  }

  public function index()
  {
    $this->create();
    $export = isset($_SESSION['export_session']) ? $_SESSION['export_session'] : array();
    $products = isset($_SESSION['export_session_products']) ? $_SESSION['export_session_products'] : array();
    $services = isset($_SESSION['export_session_services']) ? $_SESSION['export_session_services'] : array();
    if (count($export) == 0)
    {

        $export['creator'] = $this->currentUser['id'];
        $export['customer_id'] = 0;
        $export['date'] = $this->arg['today'];
        $export['total'] = 0;
        $export['discount_type'] = 1;
        $export['discount'] = 0;
        $export['must_pay'] = 0;
        $export['payment'] = 0;
        $export['debt'] = 0;
        $export['description'] = "";
        $export['code'] = $this->ExportHelper->get_export_code();
        $_SESSION['export_session'] = $export;
    }

    $this->smarty->assign('value', $export);
    $this->smarty->assign('services', $services);



    $this->smarty->assign('products', $products);
    // $out['categories'] = $this->product->get_select_categories($this->dbo);
    // $out['eid'] = $id;
    // $out['customers'] = $this->customer->get_select_customers_payment($this->dbo, $export['customer_id'], 0);
      $out['customers'] = $this->helper->get_option_customer_export($export['customer_id']);
    // $out['discount'] = $this->help->get_select_from_array($this->discount_type, @$export['discount_type']);
    // $out['price_sale'] = $this->help->get_select_from_array($this->price_sale, @$export['price_sale'], 0);
    // $out['date'] = gmdate("d-m-Y", time() + 7 * 3600);
      $out['categories'] = $this->helper->get_option(1, 'product_categories', 0, 1, 'Chọn danh mục sản phẩm');
      $out['trademarks'] = $this->helper->get_option(1, 'product_trademarks', 0, 1, "Hãng sản xuất");
      $out['discount'] = $this->helper->get_option(0, 'discount_type', $export['discount_type']);


    $this->smarty->assign('out', $out);
    $this->smarty->display("form.tpl");
  }

  public function create()
  {
    if (isset($_POST['submit']) || isset($_POST['submit_print']))
    {

        $export = $_SESSION['export_session'];

        // Luu data hoa don nhap warehouse_import
        $data['code'] = trim($export['code']);
        $data['customer_id'] = $export['customer_id'];
        $data['discount_type'] = $export['discount_type'];
        $data['discount'] = $export['discount'] != "" ? $export['discount'] : 0;
        $data['description'] = $export['description'];
        $data['must_pay'] = $export['must_pay'];
        $data['payment'] = $export['payment'];
        $data['total_money'] = $export['total'];
        $data['date'] = gmdate("Y-m-d", strtotime($export['date']) + 7 * 3600);
        $data['updater'] = $this->currentUser['id'];
        $data['creator'] = $this->currentUser['id'];
        $data['created_at'] = time();
        $data['updated_at'] = time();

        $insertStatement = $this->slim_pdo->insert(array('creator', 'created_at', 'updated_at', "customer_id", "discount_type", "discount", "code", "must_pay", "date", "total_money", "payment", "description", "updater" ))
        ->into('exports')
        ->values(array($data['creator'], $data['created_at'], $data['updated_at'], $data['customer_id'], $data['discount_type'], $data['discount'], $data['code'], $data['must_pay'], $data['date'], $data['total_money'], $data['payment'], $data['description'], $data['updater']));


        // lưu lại hóa đơn
        if ($export_id = $insertStatement->execute())
        {

            // money
            if( $export['payment'] > 0)
            {
                $money['code'] = "PT" . $export['code'];
                $money['money'] = $export['payment'];
                $money['date'] = gmdate("Y-m-d", strtotime($export['date']) + 7 * 3600);
                $money['category_id'] = 1;
                $money['is_import'] = 1;
                $money['object'] = 'cus';
                $money['object_id'] = $export['customer_id'];
                $money['from_type'] = 'exp';
                $money['from_id'] = $export_id;
                $money['creator'] = $this->currentUser['id'];
                $money['type'] = 0;
                $money['is_auto'] = 1;
                $money['created_at'] = time();
                $money['updated_at'] = time();
                $money['description'] = "";
            }
            // lưu lại sổ thu chi
            $insertStatement = $this->slim_pdo->insert(array('code', 'money', 'date', 'category_id', "is_import", "object", "object_id", "from_type", "from_id", "creator", "type", "is_auto", "created_at", "updated_at", "description" ))
            ->into('money')
            ->values(array($money['code'], $money['money'], $money['date'], $money['category_id'], $money['is_import'], $money['object'], $money['object_id'], $money['from_type'], $money['from_id'], $money['creator'], $money['type'], $money['is_auto'], $money['created_at'], $money['updated_at'], $money['description']));
            // $this->pdo->insert('money', $money);
            $money_id = $insertStatement->execute();

            // lưu sản phẩm hóa đơn
            $products = isset($_SESSION['export_session_products']) ? $_SESSION['export_session_products'] : array();

            if(count($products) > 0)
            {

                foreach($products as $k => $value)
                {
                    $prd  = $this->pdo->fetch_one("SELECT * FROM products WHERE id = {$value['id']}");
                    $product['product_id'] = $value['id'];
                    $product['number_count'] = $value['number'];
                    $product['price'] = $value['price'];
                    $product['price_import'] = $prd['price_import'];
                    $product['export_id'] = $export_id;
                    $this->pdo->insert('export_products', $product);
                }
            }

            $services = isset($_SESSION['export_session_services']) ? $_SESSION['export_session_services'] : array();
            if(count($services) > 0)
            {
                foreach($services as $k => $value)
                {
                    $service['service_id'] = $value['id'];
                    $service['export_id'] = $export_id;
                    $service['number_count'] = $value['number'];
                    $service['price'] = $value['price'];
                    $this->pdo->insert('export_services', $service);
                }
            }

            unset($_SESSION['export_session']);
            unset($_SESSION['export_session_products']);
            unset($_SESSION['export_session_services']);
            lib_alert("Lap hoa don thanh cong");
            lib_redirect("./admin?mc=export&site=index");

        }


    }
  }

  public function statistics()
  {
      $date_export = isset($_GET['date']) ? intval($_GET["date"]) : 0;
      $out['select_export'] = $this->helper->get_option(0, 'select_export', $date_export);
      $key = isset($_GET['key']) ? $_GET["key"] : "";
      $out['key'] = $key;
      $sql_where = "";
      if ($key != "")
      {
          $sql_where .= " AND  (a.code LIKE '%$key%' OR b.name LIKE '%$key%')";
      }

      if($date_export != 0)
      {
          switch($date_export)
          {
          case 1:
              $sql_where .= " AND a.date = CURDATE()";
              break;
          case 2:
              $sql_where .= " AND WEEK(a.date) = WEEK(CURDATE()) AND YEAR(a.date) = YEAR(CURDATE())";
              break;
          case 3:
              $sql_where .= " AND MONTH(a.date) = MONTH(CURDATE()) AND YEAR(a.date) = YEAR(CURDATE())";
              break;
          }
      }

      $sql = "SELECT a.id, a.date, a.code, a.must_pay, a.total_money, a.payment, a.creator, a.updater, a.updated_at, b.name AS customer, c.name AS user FROM exports AS a
                  LEFT JOIN customers b ON a.customer_id=b.id
                  LEFT JOIN users c ON a.creator=c.id
              WHERE 1=1 $sql_where
              ORDER BY id DESC";

      $paging = $this->paging->get_content($this->pdo->count_rows($sql), 10);
      $sql .= $paging['sql_add'];

      $exports = $this->pdo->fetch_all($sql);

      $total = 0;
      foreach ($exports as $key => $export)
      {
          $exports[$key]['date'] = gmdate('d.m.Y', strtotime($export['date']) + 7 * 3600);
          $exports[$key]['discount'] = $this->dstring->get_price($export['total_money'] - $export['must_pay']);
          $total += $export['must_pay'];
          if( $export['creator'] != $export['updater'] )
          {
              $exports[$key]['updater'] = $this->pdo->fetch_one("SELECT name FROM users WHERE id =" . $export['updater'] );
              $exports[$key]['updated_at'] = gmdate('H:i d/m/Y', $export['updated_at']+7*3600);
          }
      }
      $out['total'] = $total;


      $this->smarty->assign('paging', $paging);
      $this->smarty->assign('result', $exports);
      $this->smarty->assign('out', $out);
      $this->smarty->display(DEFAULT_LAYOUT);
  }

  function ajax_delete()
  {
    if( isset($_POST['id']) )
    {
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $this->pdo->query("DELETE FROM export_products WHERE export_id = $id");
        $this->pdo->query("DELETE FROM export_services WHERE export_id = $id");
        $this->pdo->query("DELETE FROM money WHERE from_type='exp' AND from_id=$id AND is_auto=1");
        $this->pdo->query("DELETE FROM exports WHERE id = $id");
        echo 1;
        $this->pdo->close();
        exit();
    }
    echo 0;
    $this->pdo->close();
    exit();

  }


}


 ?>
