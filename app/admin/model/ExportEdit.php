<?php

class ExportEdit extends Main
{
    function __construct()
    {
        parent::__construct();
    }

    public function modify()
    {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        $this->edit();
        // $this->edit();
        //import
        $export = $this->pdo->fetch_one("SELECT * FROM exports WHERE id = $id");
        $export['date'] = gmdate('d-m-Y', strtotime($export['date'])+7 *3600);
        $_SESSION['edit_export_session'] = $export;


        //sản phẩm
        $sql = "SELECT a.*, b.name, b.code, c.id as unit_id, c.name as unit_name, (a.price * a.number_count) as total
                ,(SELECT SUM(number_count) FROM import_products WHERE b.id=product_id) imported,
                (SELECT SUM(number_count) FROM export_products WHERE b.id=product_id) exported
                FROM export_products a
                LEFT JOIN products b ON a.product_id = b.id
                LEFT JOIN product_units c ON b.unit_id = c.id
                WHERE export_id = $id";
        $products = $this->pdo->fetch_all($sql);

        if(count($products) >0 )
        {
            foreach ($products as $key => $value)
            {
                $products[$key]['max_number'] = $value['number_count'] + ($value['imported'] - $value['exported']);
            }
            foreach ($products as $key => $value)
            {
                $products2[$value['product_id']] = $value;
            }
            $products = $products2;
            $_SESSION['edit_export_products_session'] = $products;
        }
        else
        {
            $_SESSION['edit_export_products_session'] = [];
        }


        // dịch vụ
        $sql = "SELECT a.*, s.name, s.code
        FROM export_services a
        LEFT JOIN services s ON a.service_id = s.id
        WHERE export_id = $id";
        $services = $this->pdo->fetch_all($sql);
        if(count($services) > 0)
        {
            foreach ($services as $key => $value)
            {
                $services2[$value['service_id']] = $value;
            }
            $services = $services2;
            $_SESSION['edit_export_services_session'] = $services;
        }
        else
        {
            $_SESSION['edit_export_services_session'] = [];
        }

        $this->smarty->assign('export', $export);
        $this->smarty->assign('products', $products);
        $this->smarty->assign('services', $services);

        // return;
        //set cac gia tri dau ra

        $out['categories'] = $this->helper->get_option(1, 'product_categories', 0, 1, "Danh mục sản phẩm");
        $out['customers'] = $this->helper->get_option(1, 'customers', $export['customer_id']);
        $out['trademarks'] = $this->helper->get_option(1, 'product_trademarks', 0, 1, "Thương hiệu");
        // $out['origins'] = $this->product->get_select_origins($this->dbo);
        // $out['afprint'] = "?mod=import&site=afprint&id=";
        $out['discount'] = $this->helper->get_option(0, 'discount_type', $export['discount_type']);
        // $out['print'] = "?mod=import&site=c" . $this->set->print_type[$this->arg['setting']['imprint']];
        $this->smarty->assign('out', $out);

        //smarty



        $this->smarty->display('form.tpl');
    }


    public function edit()
    {
        if (isset($_POST['submit']))
        {
            $export = $_SESSION['edit_export_session'];
            $products = $_SESSION['edit_export_products_session'] ;
            $services = $_SESSION['edit_export_services_session'] ;
            if (count($products) == 0 && count($services == 0))
            {
                lib_alert("Vui lòng nhập sản phẩm hoặc dịch vụ");
                lib_redirect();
            }
            if ($export['customer_id'] == 0)
            {
                lib_alert("Vui lòng nhập nhà cung cấp");
                lib_redirect();
            }

            // Luu data hoa don nhap imports
            $data['customer_id'] = $export['customer_id'];
            $data['date'] = gmdate("Y-m-d", strtotime($export['date']) + 7 * 3600);
            $data['total_money'] = $export['total'];
            $data['discount'] = $export['discount'];
            $data['discount_type'] = $export['discount_type'];
            $data['must_pay'] = $export['must_pay'];
            $data['payment']=$export['payment'];
            $data['description'] = $export['description'];
            $data['updater'] = $this->currentUser['id'];
            $data['updated_at'] = time();
            $this->pdo->update('exports', $data, 'id=' . $export['id']);

            $this->pdo->query("DELETE FROM export_products WHERE export_id=". $export['id']);
            $this->pdo->query("DELETE FROM export_services WHERE export_id=". $export['id']);


            unset($data);
            if(count($products) > 0)
            {
                foreach ($products as $key => $product)
                {
                    $data['product_id'] = $key;
                    $data['export_id'] = $export['id'];
                    $data['number_count'] = $product['number_count'];
                    $data['price'] = $product['price'];
                    $data['price_import'] = $product['price_import'];
                    $this->pdo->insert('export_products', $data);
                }
            }
            unset($data);
            if(count($services) > 0)
            {
                foreach ($services as $key => $service)
                {
                    $data['service_id'] = $key;
                    $data['export_id'] = $export['id'];
                    $data['number_count'] = $service['number_count'];
                    $data['price'] = $service['price'];
                    $this->pdo->insert('export_services', $data);
                }
            }


            //cập nhật lại money
            if( $export['payment'] > 0 )
            {
               $sql = "SELECT id FROM money WHERE from_type='exp' AND from_id='{$export['id']}' ";
               $money_export = $this->pdo->fetch_one($sql);
               $money['money'] = $export['payment'];
               $money['object_id'] = $export['customer_id'];
               $money['updated_at'] = time();
               $this->pdo->update("money", $money, "id=" . $money_export['id']);
            }


                unset($_SESSION['edit_export_session']);
                unset($_SESSION['edit_export_products_session']);
                unset($_SESSION['edit_export_services_session']);
                lib_alert("Sửa hóa đơn thành công");
                lib_redirect("./admin?mc=export&site=statistics");
            }
    }
        // thiết lập thông tin cho hóa đơn nhập
    function ajax_set_export_value()
    {
        if (isset($_POST['item'])) {
            $value = $_POST['value'];
            if ($_POST['item'] == 'payment')
                $value = $this->dstring->convert_price_to_int($_POST['value']);
            $_SESSION['edit_export_session'][$_POST['item']] = $value;

            echo $_POST['item'];
            if($_POST['item'] == 'date')
            {
                echo $_POST['value'];
                pre($_SESSION['edit_export_session']);
                pre($_SESSION['edit_export_products_session']);
                pre($_SESSION['edit_export_services_session']);
            }
            exit();
        }
        echo 0;
        exit();
    }

    function ajax_get_total_session()
    {

        $export = $_SESSION['edit_export_session'];
        $products = $_SESSION['edit_export_products_session'];
        $services = $_SESSION['edit_export_services_session'];
        // tong tien
        $total = 0;
        if(count($products) > 0)
        {
            foreach ($products AS $k => $item)
            {
                $total += $item['price'] * $item['number_count'];
            }

        }
        if(count($services) > 0)
        {
            foreach ($services AS $k => $item)
            {
                $total += $item['price'] * $item['number_count'];
            }
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
            // case 3:
            //     $import['must_pay'] = $total + ($total * $import['discount'])/100;
            //     break;
            // case 4:
            //     $import['must_pay'] = $total + $import['discount'];
            //     break;
        }


        if ($_POST['is_payment'] != 1)
            $export['payment'] = $export['must_pay'];
        $export['debt'] = $export['must_pay'] - $export['payment'];
        $export['total'] = $total;
        $_SESSION['edit_export_session']  = $export;

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
        $trade = isset($_POST['trade']) ? intval($_POST['trade']) : 0;
        $key = isset($_POST['key']) ? $_POST['key'] : '';


        $session = isset($_SESSION['edit_export_products_session']) ? $_SESSION['edit_export_products_session'] : array();
        $str_id = count($session) > 0 ? implode(",", array_keys($session)) : "0";

        $result = "";
        $result .= '<tr>';
        $result .= '<th>Mã</th>';
        $result .= '<th>Sản phẩm</th>';
        $result .= '<th class="text-right">Giá</th>';
        $result .= '<th class="text-right">Còn</th>';
        $result .= '<th></th>';
        $result .= '</tr>';



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


        foreach($product_query as $key => $item)
        {
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
            $result .= '<td class="text-right">' . $item['price'] . '</td>';
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

    function ajax_update_product_number()
    {
        if (isset($_POST['id']))
        {

            $number = intval($_POST['number']);
            $products = $_SESSION['edit_export_products_session'];

            $products[$_POST['id']]['number_count'] = $number;
            $data['number_count'] = $number;
            $data['total_item_money'] = $this->dstring->get_price($products[$_POST['id']]['number_count'] * $products[$_POST['id']]['price']);
            $_SESSION['edit_export_products_session'] = $products;
            echo json_encode($data);
        }
    }
    function ajax_service_update_number()
    {
        if (isset($_POST['service_id']))
        {

            $number = intval($_POST['number']);
            $services = $_SESSION['edit_export_services_session'];

            $services[$_POST['service_id']]['number_count'] = $number;
            $data['number_count'] = $number;
            $data['total_item_money'] = $this->dstring->get_price($services[$_POST['service_id']]['number_count'] * $services[$_POST['service_id']]['price']);
            $_SESSION['edit_export_services_session'] = $services;
            echo json_encode($data);
        }
    }

    function ajax_add_product_session()
    {

        if (isset($_POST['id']))
        {
            $products = isset($_SESSION['edit_export_products_session']) ? $_SESSION['edit_export_products_session'] : array();

            $id = intval($_POST['id']);
            $prod = $this->pdo->fetch_one("SELECT a.id, a.code, a.name, a.price, a.price_import, a.warranty, a.unit_id, a.is_discount, a.discount_type, a.discount, b.name AS unit_name,
                      (SELECT sum(number_count) FROM import_products WHERE product_id = a.id ) AS imported,
                      (SELECT sum(number_count) FROM export_products WHERE product_id = a.id ) AS exported
                    FROM products a
                    LEFT JOIN product_units b ON a.unit_id = b.id
                    WHERE a.id=" . $_POST['id']);


            // max sản phẩm trong kho
            $prod['number'] = $prod['imported'] - $prod['exported'];

            $products[$_POST['id']]['id'] = $prod['id'];
            $products[$_POST['id']]['product_id'] = $prod['id'];
            $products[$_POST['id']]['number_count'] = 1;
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
            $products[$_POST['id']]['price_import'] = $prod['price_import'];
            $products[$_POST['id']]['unit_id'] = $prod['unit_id'];
            $products[$_POST['id']]['unit_name'] = $prod['unit_name'];
            $products[$_POST['id']]['max_number'] = $prod['number'];

            $_SESSION['edit_export_products_session'] = $products;

            //out
            $result['id'] = $prod['id'];
            $result['code'] = $prod['code'];
            $result['name'] = $prod['name'];
            $result['price'] = number_format($products[$_POST['id']]['price']);
            $result['unit_name'] = $prod['unit_name'];
            $result['max_number'] = $prod['number'];
            $result['product_id'] = $prod['id'];
            $this->pdo->close();
            echo json_encode($result);
            exit();
        }
    }


    function delete_product_bill()
    {
      $products = isset($_SESSION['edit_export_products_session']) ? $_SESSION['edit_export_products_session'] : array();
      if ( isset($_POST['id']) )
      {
          unset( $products[$_POST['id']] );
          $_SESSION['edit_export_products_session'] = $products;
      }
    }
    function delete_service_bill()
    {
      $services = isset($_SESSION['edit_export_services_session']) ? $_SESSION['edit_export_services_session'] : array();
      if ( isset($_POST['service_id']) )
      {
          unset( $services[$_POST['service_id']] );
          $_SESSION['edit_export_services_session'] = $services;
      }
    }

    function ajax_load_services()
    {
        $services = isset($_SESSION['edit_export_services_session']) ? $_SESSION['edit_export_services_session'] : array();
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
            $services = isset($_SESSION['edit_export_services_session']) ? $_SESSION['edit_export_services_session'] : array();

            $ser = $this->pdo->fetch_one("SELECT id, name, price FROM services WHERE id=" . $_POST['id']);

            $services[$_POST['id']]['id'] = $_POST['id'];
            $services[$_POST['id']]['number_count'] = 1;
            $services[$_POST['id']]['service_id'] = $_POST['id'];
            $services[$_POST['id']]['name'] = $ser['name'];
            $services[$_POST['id']]['price'] = $ser['price'];
            $_SESSION['edit_export_services_session'] = $services;

            //out info
            $result['id'] = $ser['id'];
            $result['name'] = $ser['name'];
            $result['price'] = $this->dstring->get_price($ser['price']);
            $result['service_id'] = $_POST['id'];

            echo json_encode($result);
            exit();
        }
    }
}