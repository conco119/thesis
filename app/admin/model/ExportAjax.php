<?php

class ExportAjax extends Main
{
  function __construct() {
    parent::__construct();
    $this->ExportAjaxHelper = new ExportAjaxHelper();
    $this->table = "exports";
  }

  public function ajax_set_export_value()
  {

    if (isset($_POST['item']))
    {
        $value = $_POST['value'];
        if ($_POST['item'] == 'payment')
            $value = $this->dstring->convert_price_to_int($_POST['value']);
        $_SESSION['export_session'][$_POST['item']] = $value;

        if($_POST['item'] == 'date')
            pre($_SESSION);
        echo $_POST['item'];
        exit();
    }
    echo 0;
    exit();
  }

  function ajax_get_total_session()
  {
    $export = isset($_SESSION['export_session']) ? $_SESSION['export_session'] : array();
    $products = isset($_SESSION['export_session_products']) ? $_SESSION['export_session_products'] : array();
    $services = isset($_SESSION['export_session_services']) ? $_SESSION['export_session_services'] : array();
    // tong tien
    $total = 0;
    foreach ($products AS  $item)
    {
        $total += $item['price'] * $item['number'];
    }
    foreach ($services AS  $item)
    {
        $total += $item['price'] * $item['number'];
    }

    //must pay
    switch($export['discount_type'])
    {
        case 1:
            $export['must_pay'] = $total - ($total * $export['discount'])/100;
            break;
        case 2:
            $export['must_pay'] = $total - $export['discount'];
            break;
        case 3:
            $export['must_pay'] = $total + ($total * $export['discount'])/100;
            break;
        case 4:
            $export['must_pay'] = $total + $export['discount'];
            break;
        default:
            $discount = 0;
    }


    if (@$_POST['is_payment'] != 1)
        $export['payment'] = $export['must_pay'];
    $export['debt'] = $export['must_pay'] - $export['payment'];
    $export['total'] = $total;

    $_SESSION['export_session'] = $export;

    $value['total'] = number_format($total);
    $value['debt'] = number_format($export['debt']);
    $value['payment'] = number_format($export['payment']);
    $value['total_must_pay'] = number_format($export['must_pay']);
    $value['number_services'] = count($services);
    echo json_encode($value);
    exit();

  }

  function ajax_load_product()
  {
      $cate = isset($_POST['cate']) ? intval($_POST['cate']) : 0;
      // $orig = isset($_POST['orig']) ? intval($_POST['orig']) : 0;
      $trade = isset($_POST['trade']) ? intval($_POST['trade']) : 0;
      $key = isset($_POST['key']) ? $_POST['key'] : '';


      $session = isset($_SESSION['export_session_products']) ? $_SESSION['export_session_products'] : array();
      $str_id = count($session) > 0 ? implode(",", array_keys($session)) : "0";

      $result = "";
      $result .= '<tr>';
      $result .= '<th>Mã</th>';
      $result .= '<th>Sản phẩm</th>';
      $result .= '<th class="text-right">Giá</th>';
      $result .= '<th class="text-right">Còn</th>';
      $result .= '<th></th>';
      $result .= '</tr>';

      // $this->dbo->connect();

      $product_sql = "SELECT a.id, a.code, a.name, a.price_import, a.price, a.is_discount, a.discount_type, a.discount
                      ,(SELECT SUM(number_count) FROM import_products WHERE a.id=product_id) imported,
                      (SELECT SUM(number_count) FROM export_products WHERE a.id=product_id) exported
              FROM products a
              WHERE a.id NOT IN ($str_id) AND a.status=1";
      if ($cate != 0)
          $product_sql .= " AND a.category_id=$cate";
      if ($trade != 0)
          $product_sql .= " AND a.trademark_id=$trade";
      if ($key  != '')
          $product_sql .= " AND (a.code LIKE '%$key%' OR a.name LIKE '%$key%')";

      $product_sql .= " ORDER BY a.name ASC";

      $product_query = $this->pdo->fetch_all($product_sql);
      if($cate != 0)
      {
          $product_query = $this->helper->get_child_products($cate, $product_query, $str_id, $key, $trade);
      }

    //   pre($product_query);
    //   die();
      // pre($product_query);
      // die();
      foreach($product_query as $key => $item)
      {
        //   $item['price'] = number_format($item['price']);
          if($item['is_discount'] == 1)
          {
              switch($item['discount_type'])
              {
                  case 1:
                    $item['price'] = number_format($item['price'] - ( ($item['price'] * $item['discount'])/100) );
                    break;
                  case 2:
                    $item['price'] = number_format($item['price'] - $item['discount'] );
                    break;
              }
          }
          $result .= '<tr id="prd' . $item['id'] . '">';
          $result .= '<td>' . $item['code'] . '</td>';
          $result .= '<td>' . $item['name'] . '</td>';
          $result .= '<td class="text-right">' . number_format($item['price']) . '</td>';
          $result .= '<td class="text-right">' . ($item['imported'] - $item['exported']) . '</td>';

          $result .= '<td class="text-right">';
          if($item['imported'] - $item['exported'] > 0)
          {
            $result .= '<a href="javascript:void(0);" class="btn btn-success" onclick="AddProduct(' . $item['id'] . ');" title="Đưa vào đơn hàng">';
            $result .= '<i class="fa fa-check"> </i>';
            $result .= '</a>';
          }
          $result .= '</td>';

          $result .= '</tr>';
      }

      echo $result;
  }

  //thêm sản phẩm vào session - hóa đơn
  function ajax_add_product_session()
  {

      if (isset($_POST['id']))
      {
          $products = isset($_SESSION['export_session_products']) ? $_SESSION['export_session_products'] : array();

          $id = intval($_POST['id']);
          $prod = $this->pdo->fetch_one("SELECT a.id, a.code, a.name, a.price, a.price_import, a.warranty, a.unit_id, a.is_discount, a.discount_type, a.discount, b.name AS unit_name,
                    (SELECT sum(number_count) FROM import_products WHERE product_id = a.id ) AS imported,
                    (SELECT sum(number_count) FROM export_products WHERE product_id = a.id ) AS exported
                  FROM products a
                  LEFT JOIN product_units b ON a.unit_id = b.id
                  WHERE a.id=" . $_POST['id']);



          $prod['number'] = $prod['imported'] - $prod['exported'];
          $products[$_POST['id']]['id'] = $prod['id'];
          $products[$_POST['id']]['number'] = 1;
          $products[$_POST['id']]['name'] = $prod['name'];
          if( $prod['is_discount'] == 1)
          {
              switch($prod['discount_type'])
              {
                case 1:
                    $products[$_POST['id']]['price'] = $prod['price'] - (($prod['price'] * $prod['discount'])/100);
                    break;
                case 2:
                    $products[$_POST['id']]['price'] = $prod['price'] -  $prod['discount'];
                    break;
              }
          }
          else
          {
                $products[$_POST['id']]['price'] = $prod['price'];
          }

          $products[$_POST['id']]['warranty'] = $prod['warranty'];

          $products[$_POST['id']]['code'] = $prod['code'];
          $products[$_POST['id']]['unit_id'] = $prod['unit_id'];
          $products[$_POST['id']]['unit_name'] = $prod['unit_name'];
          $products[$_POST['id']]['max_number'] = $prod['number'];

          $_SESSION['export_session_products'] = $products;

          //out
          $result['id'] = $prod['id'];
          $result['code'] = $prod['code'];
          $result['name'] = $prod['name'];
          $result['price'] = number_format($products[$_POST['id']]['price']);
          $result['unit_name'] = $prod['unit_name'];
          $result['max_number'] = $prod['number'];

          $this->pdo->close();
          echo json_encode($result);
          exit();
      }
  }

    function ajax_update_product_number()
    {
        if (isset($_POST['id']))
        {
            $number = intval($_POST['number']);
            $products = $_SESSION['export_session_products'];

            if( $number > $products[$_POST['id']]['max_number'] )
            {
                $products[$_POST['id']]['number'] = $products[$_POST['id']]['max_number'];
                $data['number'] = $products[$_POST['id']]['number'];
            }
            else
            {
                $products[$_POST['id']]['number'] = $number;
                $data['number'] = $products[$_POST['id']]['number'];
            }
            $data['total_item_money'] = $this->dstring->get_price($products[$_POST['id']]['number'] * $products[$_POST['id']]['price']);
            $_SESSION['export_session_products'] = $products;
            echo json_encode($data);
        }

    }


  function delete_product_bill()
  {
    $products = isset($_SESSION['export_session_products']) ? $_SESSION['export_session_products'] : array();
    if ( isset($_POST['id']) )
    {
        unset( $products[$_POST['id']] );
        $_SESSION['export_session_products'] = $products;
    }
  }

  function ajax_load_services()
  {
      $services = isset($_SESSION['export_session_services']) ? $_SESSION['export_session_services'] : array();
      $str_service_id = count($services) > 0 ? implode(",", array_keys($services)) : "0";

      $sql = "SELECT id, name, price FROM services WHERE status=1 AND id NOT IN ($str_service_id)";

      $services_query = $this->pdo->fetch_all($sql);
      $str = "";
      $str .= "<thead><tr>";
      $str .= "<th>#</th>";
      $str .= "<th class=\"text-right\">ID</th>";
      $str .= "<th>Dịch vụ</th>";
      $str .= "<th class=\"text-right\">Phí dịch vụ</th>";
      $str .= "<th class=\"text-right\"></th>";
      $str .= "</tr></thead>";
      $str .= "<tbody>";

      foreach($services_query as $item)
      {
        $str .= "<tr id=\"serChoice" . $item['id'] . "\">";
        $str .= "<td>#</td>";
        $str .= "<td class=\"text-right\">" . $item['id'] . "</td>";
        $str .= "<td>" . $item['name'] . "</td>";
        $str .= "<td class=\"text-right\">" . $this->dstring->get_price($item['price']) . "</td>";
        $str .= "<td class=\"text-right\">";
        $str .= "<button type=\"button\" class=\"btn btn-success\" onclick=\"AddServices(" . $item['id'] . ");\"><i class=\"fa fa-check\"></i></button>";
        $str .= "</td>";
        $str .= "</tr>";
      }
      $str .= "</tbody>";

      echo $str;
      exit();
  }

  function ajax_add_service_session()
  {
      if (isset($_POST['id']))
      {
          $services = isset($_SESSION['export_session_services']) ? $_SESSION['export_session_services'] : array();

          $ser = $this->pdo->fetch_one("SELECT id, name, price FROM services WHERE id=" . $_POST['id']);

          $services[$_POST['id']]['id'] = $_POST['id'];
          $services[$_POST['id']]['number'] = 1;
          $services[$_POST['id']]['name'] = $ser['name'];
          $services[$_POST['id']]['price'] = $ser['price'];
          $_SESSION['export_session_services'] = $services;

          //out info
          $result['id'] = $ser['id'];
          $result['name'] = $ser['name'];
          $result['price'] = $this->dstring->get_price($ser['price']);


          echo json_encode($result);
          exit();
      }
  }

  function ajax_delete_service_bill()
  {
    $services = isset($_SESSION['export_session_services']) ? $_SESSION['export_session_services'] : array();
    if ( isset($_POST['id']) )
    {
        unset( $services[$_POST['id']] );
        $_SESSION['export_session_services'] = $services;
        $data['item_number'] = count($services);
        echo json_encode($data);
    }
  }

  function ajax_service_update_number()
  {
    if (isset($_POST['id']))
    {
        $number = intval($_POST['number']);
        $services = $_SESSION['export_session_services'];
        $services[$_POST['id']]['number'] = $number;

        $data['number'] = $number;
        $data['total_money'] = $this->dstring->get_price($services[$_POST['id']]['number'] * $services[$_POST['id']]['price']);
        $_SESSION['export_session_services'] = $services;
        echo json_encode($data);
        exit();
    }
  }

  function ajax_get_export_session_detail()
  {


      $export = isset($_SESSION['export_session']) ? $_SESSION['export_session'] : array();
      $products = isset($_SESSION['export_session_products']) ? $_SESSION['export_session_products'] : array();
      $services = isset($_SESSION['export_session_services']) ? $_SESSION['export_session_services'] : array();

      $customer = $this->pdo->fetch_one( "SELECT id, name, address FROM customers WHERE id=" . intval($export['customer_id']) );


      $out['creator'] = $this->currentUser['name'];
      $out['time'] = gmdate("H:i A d/m/Y", time() + 7 * 3600);
      $out['customer'] = $customer;

      $out['products'] = $products;
      $out['services'] = $services;
      $out['export'] = $export;
      echo json_encode($out);
      exit();
  }

  public function ajax_get_detail_export()
  {
    $id = $_POST['id'];
    $sql = "SELECT a.* , c.name as customer_name, u.name as user_name
    FROM exports a
    LEFT JOIN customers c ON a.customer_id = c.id
    LEFT JOIN users u ON a.creator = u.id
    WHERE a.id = $id
    ";

    $export = $this->pdo->fetch_one($sql);
    $export['date'] = gmdate('d-m-Y', strtotime($export['date']) + 7 * 3600);
    $export['created_at'] = gmdate("H:i A d/m/Y", $export['created_at'] + 7 * 3600);
    $sql = "SELECT a.*, u.name as unit_name, p.name
    FROM export_products a
    LEFT JOIN products p ON a.product_id = p.id
    LEFT JOIN product_units u ON p.unit_id = u.id
    WHERE export_id = $id";
    $export['products'] = $this->pdo->fetch_all($sql);

    $sql = "SELECT a.*, s.name
    FROM export_services a
    LEFT JOIN services s ON a.service_id = s.id
    WHERE export_id = $id";

    $export['services'] = $this->pdo->fetch_all($sql);
    echo json_encode($export);
    die();
  }


}


 ?>
