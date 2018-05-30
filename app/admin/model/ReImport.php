<?php

class ReImport extends Main
{
    function __construct()
    {
        parent::__construct();
        $this->ReImportHelper = new ReImportHelper();
    }
    function reimport()
    {

        // pre($this->arg);
        // unset($_SESSION['reimport_session']);
        $this->create();
        $import = isset($_SESSION['reimport_session']) ? $_SESSION['reimport_session'] : array();
        $products = isset($import['products']) ? $import['products'] : array();
        if (count($import) == 0)
        {
            $import['code'] = $this->ReImportHelper->get_import_code();
            $import['date'] = $this->arg['today'];
            $import['total_money'] = 0;
            $import['must_pay'] = 0;
            $import['customer_id'] = 0;
            $import['customer_name'] = "";
            $import['payment'] = 0;
            $import['export_id'] = 0;
            $import['description'] = "";
            $import['products'] = array();
            $_SESSION['reimport_session'] = $import;
        }
        $this->smarty->assign('import', $import);

        // Lay danh sach san pham nhap vao don hang
        if(count($products > 0))
        {
            foreach ($products AS $k => $item)
            {
                $products[$k]['total_product_money'] = intval($item['price'] * $item['number_count']);
            }
        }

        $this->smarty->assign('products', $products);
        $this->smarty->display('form.tpl');
    }


    function create()
    {

        if (isset($_POST['submit']))
        {

            $import = isset($_SESSION['reimport_session']) ? $_SESSION['reimport_session'] : array();
            $products = isset($import['products']) ? $import['products'] : array();
            if (count($products) == 0)
            {
                lib_alert("Vui lòng nhập sản phẩm");
                lib_redirect();
            }

            // Luu data hoa don nhap imports
            $data['creator'] = $this->currentUser['id'];
            $data['code'] = $import['code'];
            $data['date'] = gmdate("Y-m-d", strtotime($import['date']) + 7 * 3600);
            $data['total_money'] = $import['total_money'];
            $data['payment'] = $import['payment'];
            $data['must_pay'] = $import['must_pay'];
            $data['discount_type'] = 1;
            $data['discount'] = 0;
            $data['description'] = $import['description'];
            $data['export_id'] = $import['export_id'];
            $data['created_at'] = time();

            $import_id = $this->pdo->insert('imports', $data);
            unset($data);

            // lưu sản phẩm
            foreach($products as $k => $product)
            {
                $data['import_id'] = $import_id;
                $data['product_id'] = $product['product_id'];
                $data['number_count'] = $product['number_count'];
                $data['price'] = $product['price'];
                $data['price_import'] = $product['price_import'];
                $this->pdo->insert('import_products', $data);
            }
            unset($data);
            //lưu tiền
            if($import['payment'] > 0)
            {
                $money['money'] = $import['payment'];
                $money['date'] = gmdate("Y-m-d", strtotime($import['date']) + 7 * 3600);
                $money['object'] = 'cus';
                $money['description'] = $import['description'];
                $money['object_id'] = $import['customer_id'];
                $money['creator'] = $this->currentUser['id'];
                $money['from_type'] = 'reimp';
                $money['from_id'] = $import_id;
                $money['created_at'] = time();
                $money['code'] = "MN" . time();
                $money['type'] = 0;
                if($_POST['check_money'] == 0)
                {
                    $money['is_import'] = 0;
                }

                if($_POST['check_money'] == 1)
                {
                    $money['is_import'] = 1;
                }

                $insertStatement = $this->slim_pdo->insert(array('money', 'date', 'object', 'description', "object_id", "creator", "created_at", "code", "type", "is_import", 'from_type', 'from_id'))
                ->into('money')
                ->values(array($money['money'], $money['date'], $money['object'], $money['description'], $money['object_id'], $money['creator'], $money['created_at'], $money['code'], $money['type'], $money['is_import'], $money['from_type'], $money['from_id']));
                // $this->pdo->insert('money', $money);
                 $insertStatement->execute();
            }



            unset($_SESSION['reimport_session']);
            lib_alert("Tạo hóa đơn thành công");
            lib_redirect("./admin?mc=reimport&site=reimport");
        }

    }
    function ajax_load_product()
    {
    	$code = trim($_POST['code']);


    	$import = isset($_SESSION['reimport_session']) ? $_SESSION['reimport_session'] : array();
    	$products = isset($import['products']) ? $import['products'] : array();
        $str_id = count($products) > 0 ? implode(",", array_keys($products)) : "0";


        $result = "";
        $result .= '<tr>';
        $result .= '<th>Mã</th>';
        $result .= '<th>Sản phẩm</th>';
        $result .= '<th class="text-right">Giá mua</th>';
        $result .= '<th class="text-right">Số lượng</th>';
        $result .= '<th></th>';
        $result .= '</tr>';

        // $sql = "SELECT p.id, p.code, p.name, p.price, u.name as unit_name
        //         (SELECT SUM(number_unit) FROM warehouse_import_products
        //         LEFT JOIN warehouse_import im ON import_id = im.id
        //         WHERE im.export_id = i.export_id AND product_id=i.product_id
        //         ) AS number_unit_re
        //         FROM export_products i LEFT JOIN products p ON p.id=i.product_id
        //         WHERE i.export_id=$code AND i.number_unit>0 AND i.product_id NOT IN ($str_id)";
        $sql = "SELECT p.id, e.number_count, e.price, p.name, p.code, u.name as unit_name,
                (SELECT sum(ip.number_count) FROM imports i LEFT JOIN import_products ip ON  i.id = ip.import_id WHERE i.export_id = x.id AND p.id = ip.product_id) as number_reimport
        FROM export_products e
        LEFT JOIN products p ON p.id = e.product_id
        LEFT JOIN product_units u ON u.id = p.category_id
        LEFT JOIN exports x ON x.id = e.export_id
        WHERE x.code = '{$code}' AND e.product_id NOT in ($str_id)";
        $items = $this->pdo->fetch_all($sql);

        foreach($items as $item)
        {
            $item['price'] = number_format($item['price']);
            $result .= '<tr id="prd' . $item['id'] . '">';
            $result .= '<td>' . $item['code'] . '</td>';
            $result .= '<td>' . $item['name'] . '</td>';
            $result .= '<td class="text-right">' . $item['price'] . '</td>';
            $result .= '<td class="text-right">' .($item['number_count'] - $item['number_reimport']). '</td>';
            $result .= '<td class="text-right">';
            if(($item['number_count'] - $item['number_reimport'])>0)
            {
                $result .= '<a href="javascript:void(0);" class="btn btn-success" onclick="AddProduct(' . $item['id'] . ');" title="Đưa vào đơn hàng">';
                $result .= '<i class="fa fa-check"> </i>';
            }
            $result .= '</a>';
            $result .= '</td>';
            $result .= '</tr>';
        }



        echo $result;

        exit();
    }

    function ajax_add_product_session()
    {

        if (isset($_POST['id']))
        {

            $import = isset($_SESSION['reimport_session']) ? $_SESSION['reimport_session'] : array();
            $products = isset($import['products']) ? $import['products'] : array();

            $id = intval($_POST['id']);
            $sql = "SELECT e.*, p.id as product_id, p.code as product_code,  p.name as product_name, u.name as unit_name,
                    (SELECT sum(ip.number_count)
                    FROM import_products ip
                    LEFT JOIN imports i ON  i.id = ip.import_id
                    LEFT JOIN exports expo ON expo.id = i.export_id = expo.id
                    WHERE ip.product_id = {$id} AND i.export_id = {$import['export_id']}) as number_reimport
            FROM export_products e
            LEFT JOIN products p ON p.id = e.product_id
            LEFT JOIN product_units u ON u.id = p.unit_id
            LEFT JOIN exports expo ON expo.id = e.export_id
            WHERE e.product_id = {$id} AND expo.id = {$import['export_id']}";

            $product_selected = $this->pdo->fetch_one($sql);

            $products[$id]['id'] = $product_selected['id']; // $product_selected['id'] là id của export product
            $products[$id]['product_id'] = $product_selected['product_id']; // $product_selected['id'] là id của export product
            $products[$id]['product_code'] = $product_selected['product_code']; // $product_selected['id'] là id của export product
            $products[$id]['product_name'] = $product_selected['product_name']; // $product_selected['id'] là id của export product
            $products[$id]['unit_name'] = $product_selected['unit_name']; // $product_selected['id'] là id của export product
            $products[$id]['max_number'] = $product_selected['number_count'] - $product_selected['number_reimport'];
            $products[$id]['price'] = $product_selected['price'];
            $products[$id]['price_import'] = $product_selected['price_import'];
            $products[$id]['number_count'] = 1;

            $_SESSION['reimport_session']['products'] = $products;



            //out
            $result['product_id'] = $product_selected['product_id'];
            $result['code'] = $product_selected['product_code'];
            $result['product_name'] = $product_selected['product_name'];
            $result['price'] = number_format($product_selected['price']);
            $result['unit_name'] = $product_selected['unit_name'];
            $result['max_number'] = $product_selected['number_count'] - $product_selected['number_reimport'];

           $this->pdo->close();
            echo json_encode($result);
            exit();
        }
    }
    function ajax_set_export_value()
    {
        if (isset($_POST['item']))
        {
            $value = $_POST['value'];
            if ($_POST['item'] == 'payment')
                $value = $this->dstring->convert_price_to_int($_POST['value']);
            $_SESSION['reimport_session'][$_POST['item']] = $value;

            echo $_POST['item'];
            if($_POST['item'] == 'date')
            {
                echo $_POST['value'];
                pre($_SESSION);
            }
            exit();
        }
        echo 0;
        exit();
    }

    function delete_product_bill()
    {
        $import = isset($_SESSION['reimport_session']) ? $_SESSION['reimport_session'] : array();
        $products = isset($import['products']) ? $import['products'] : array();
        if ( isset($_POST['id']) )
        {
            unset( $products[$_POST['id']] );
            $import['products'] = $products;
            $_SESSION['reimport_session'] = $import;
        }
    }

      function ajax_update_product_number()
      {
          if (isset($_POST['id']))
          {
              $number = intval($_POST['number']);
              $import = isset($_SESSION['reimport_session']) ? $_SESSION['reimport_session'] : array();
              $products = isset($import['products']) ? $import['products'] : array();
              $products[$_POST['id']]['number_count'] = $number;

              $data['number'] = $products[$_POST['id']]['number_count'];
              $data['total_item_money'] = $this->dstring->get_price($products[$_POST['id']]['number_count'] * $products[$_POST['id']]['price']);

              $import['products'] = $products;
              $_SESSION['reimport_session'] = $import;
              echo json_encode($data);
          }

      }
      function ajax_get_total_session()
      {
        $import = isset($_SESSION['reimport_session']) ? $_SESSION['reimport_session'] : array();
        $products = isset($import['products']) ? $import['products'] : array();

        // tong tien
        $total = 0;
        foreach ($products AS  $item)
        {
            $total += $item['price'] * $item['number_count'];
        }

        $import['must_pay'] = $total;
        if (@$_POST['is_payment'] != 1)
            $import['payment'] = $import['must_pay'];
        $import['debt'] = $import['must_pay'] - $import['payment'];
        $import['total_money'] = $total;

        $_SESSION['reimport_session'] = $import;

        $value['total'] = number_format($total);
        $value['debt'] = number_format($import['debt']);
        $value['payment'] = number_format($import['payment']);
        $value['total_must_pay'] = number_format($import['must_pay']);
        echo json_encode($value);
        exit();

      }

      function ajax_update_id_export()
      {
          if(isset($_POST['value']))
          {
              $code=trim($_POST['value']);
              $export = $this->pdo->fetch_one("SELECT id,customer_id FROM exports WHERE code='{$code}' ");
              $import = isset($_SESSION['reimport_session']) ? $_SESSION['reimport_session'] : array();
              $import['products'] = array();
              $import['export_id'] = $export['id'];
              $customer = $this->pdo->fetch_one("SELECT name FROM customers WHERE id=".$export['customer_id']);
              $import['customer_id']=$export['customer_id'];
              $import['customer_name']=$customer['name'];
              echo($customer['name']);
              $_SESSION['reimport_session']=$import;
          }
      }
}
