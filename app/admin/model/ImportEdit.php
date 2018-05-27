<?php

class ImportEdit extends Main
{
    function __construct()
    {
        parent::__construct();
    }


    public function modify()
    {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;


        $this->edit();
        //import
        $import = $this->pdo->fetch_one("SELECT * FROM imports WHERE id = $id");
        $import['date'] = gmdate('d-m-Y', strtotime($import['date'])+7 *3600);
        $_SESSION['edit_import_session'] = $import;

        $sql = "SELECT a.*, b.name, b.code, c.id as unit_id, c.name as unit_name, (a.price_import * a.number_count) as total
         FROM import_products a
         LEFT JOIN products b ON a.product_id = b.id
         LEFT JOIN product_units c ON b.unit_id = c.id
         WHERE import_id = $id";
        $products = $this->pdo->fetch_all($sql);
        // pre($products);
        // die();
        foreach ($products as $key => $value)
        {
            $products2[$value['product_id']] = $value;
        }
        $products = $products2;
        $_SESSION['edit_import_products_session'] = $products;
        // $str_id = count($session) > 0 ? implode(",", array_keys($session)) : "0";
        // pre($str_id);
        // pre($_SESSION['edit_import_products_session']);


        $this->smarty->assign('import', $import);
        // $total = 0;
        // foreach ($products AS $k => $item) {
        //     $products[$k]['total'] = intval($item['price'] * $item['number']);
        //     $total += intval($item['price'] * $item['number']);
        // }
        $this->smarty->assign('products', $products);

        // return;
        //set cac gia tri dau ra

        $out['categories'] = $this->helper->get_option(1, 'product_categories', 0, 1, "Danh mục sản phẩm");
        $out['suppliers'] = $this->helper->get_option(1, 'suppliers', $import['supplier_id']);
        $out['trademarks'] = $this->helper->get_option(1, 'product_trademarks', 0, 1, "Hãng sản xuất");
        // $out['origins'] = $this->product->get_select_origins($this->dbo);
        // $out['afprint'] = "?mod=import&site=afprint&id=";
        $out['discount'] = $this->helper->get_option(0, 'discount_type', $import['discount_type']);
        // $out['print'] = "?mod=import&site=c" . $this->set->print_type[$this->arg['setting']['imprint']];
        $this->smarty->assign('out', $out);

        //smarty



        $this->smarty->display('form.tpl');
    }


    public function edit()
    {
        if (isset($_POST['submit']))
        {
            $import = $_SESSION['edit_import_session'];
            $products = $_SESSION['edit_import_products_session'] ;

            if (count($products) == 0)
            {
                lib_alert("Vui lòng nhập sản phẩm");
                lib_redirect();
            }
            if ($import['supplier_id'] == 0)
            {
                lib_alert("Vui lòng nhập nhà cung cấp");
                lib_redirect();
            }

            // Luu data hoa don nhap imports
            $data['supplier_id'] = $import['supplier_id'];
            $data['date'] = gmdate("Y-m-d", strtotime($import['date']) + 7 * 3600);
            $data['total_money'] = $import['total'];
            $data['discount'] = $import['discount'];
            $data['discount_type'] = $import['discount_type'];
            $data['must_pay'] = $import['must_pay'];
            $data['payment']=$import['payment'];
            $data['description'] = $import['description'];
            $data['creator'] = $this->currentUser['id'];
            $data['updater'] = $this->currentUser['id'];
            $data['updated_at'] = time();
            $this->pdo->update('imports', $data, 'id=' . $import['id']);

            $this->pdo->query("DELETE FROM import_products WHERE import_id=". $import['id']);

            // xóa sản phẩm từ import products
            unset($data);
            // $data;
            foreach ($products as $key => $product)
            {
                if($product['is_new'] == 1)
                {
                    $product_data = $this->pdo->fetch_one("SELECT * FROM products WHERE id={$product['id']}");
                    $data['price'] = $product_data['price'];
                }
                else
                {
                    $data['price'] = $product['price'];
                }
                $data['product_id'] = $key;
                $data['import_id'] = $import['id'];
                $data['number_count'] = $product['number_count'];
                $data['price_import'] = $product['price_import'];

                $this->pdo->insert('import_products', $data);
            }


            // cập nhật lại money
            if( $import['payment'] > 0 )
            {
               $sql = "SELECT id FROM money WHERE from_type='imp' AND from_id='{$import['id']}' ";
               $money_import = $this->pdo->fetch_one($sql);
               $money['money'] = $import['payment'];
               $money['object_id'] = $import['supplier_id'];
               $money['updated_at'] = time();
               $money['description'] = "";
               $this->pdo->update("money", $money, "id=" . $money_import['id']);
            }


                unset($_SESSION['edit_import_session']);
                unset($_SESSION['edit_import_products_session']);
                lib_alert("Sửa hóa đơn thành công");
                lib_redirect("./admin?mc=import&site=statistics");
            }

        }


    function ajax_load_product()
    {

        $cate = isset($_POST['cate']) ? intval($_POST['cate']) : 0;
        // $orig = isset($_POST['orig']) ? intval($_POST['orig']) : 0;
        $trade = isset($_POST['trade']) ? intval($_POST['trade']) : 0;
        $key = isset($_POST['key']) ? $_POST['key'] : '';


        $session = isset($_SESSION['edit_import_products_session']) ? $_SESSION['edit_import_products_session'] : array();
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

        $product_sql = "SELECT a.id, a.code, a.name, a.price_import, a.price
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

        // $product_sql .= " ORDER BY a.name ASC";

        $product_query = $this->pdo->fetch_all($product_sql);
        if($cate != 0)
        {
            $product_query = $this->helper->get_child_products($cate, $product_query, $str_id, $key, $trade);
        }

        // pre($product_query);
        // die();
        // pre($product_query);
        // die();
        foreach($product_query as $key => $item)
        {
            $item['price'] = number_format($item['price_import']);
            $result .= '<tr id="prd' . $item['id'] . '">';
            $result .= '<td>' . $item['code'] . '</td>';
            $result .= '<td>' . $item['name'] . '</td>';
            $result .= '<td class="text-right">' . $item['price'] . '</td>';
            $result .= '<td class="text-right">' . ($item['imported'] - $item['exported']) . '</td>';
            $result .= '<td class="text-right">';
            $result .= '<a href="javascript:void(0);" class="btn btn-success" onclick="AddProduct(' . $item['id'] . ');" title="Đưa vào đơn hàng">';
            $result .= '<i class="fa fa-check"> </i>';
            $result .= '</a>';
            $result .= '</td>';
            $result .= '</tr>';
        }

        echo $result;
    }


    function ajax_get_total_session()
    {
        $import = $_SESSION['edit_import_session'];
        $products = $_SESSION['edit_import_products_session'];
        // tong tien
        $total = 0;
        foreach ($products AS $k => $item)
        {
            $total += $item['price_import'] * $item['number_count'];
        }

        //must pay
        switch($import['discount_type'])
        {
            case 1:
                $import['must_pay'] = $total - ($total * $import['discount'])/100;
                break;
            case 2:
                $import['must_pay'] = $total - $import['discount'];
                break;
            // case 3:
            //     $import['must_pay'] = $total + ($total * $import['discount'])/100;
            //     break;
            // case 4:
            //     $import['must_pay'] = $total + $import['discount'];
            //     break;

        }


        if ($_POST['is_payment'] != 1)
            $import['payment'] = $import['must_pay'];
        $import['debt'] = $import['payment'] - $import['must_pay'];
        $import['total'] = $total;
        $_SESSION['edit_import_session']  = $import;

        $value['total'] = number_format($total);
        $value['debt'] = number_format($import['debt']);
        $value['payment'] = number_format($import['payment']);
        $value['total_must_pay'] = number_format($import['must_pay']);

        echo json_encode($value);
        exit();
    }

    public function ajax_set_export_value()
    {

      if (isset($_POST['item']))
      {
          $value = $_POST['value'];
          if ($_POST['item'] == 'payment')
              $value = $this->dstring->convert_price_to_int($_POST['value']);
          $_SESSION['edit_import_session'][$_POST['item']] = $value;

          if($_POST['item'] == 'date')
          {
            pre($_SESSION['edit_import_session']);
            pre($_SESSION['edit_import_products_session']);
          }

          echo $_POST['item'];
          exit();
      }
      echo 0;
      exit();
    }

    function delete_product_bill()
    {
      $products = isset($_SESSION['edit_import_products_session']) ? $_SESSION['edit_import_products_session'] : array();
      if ( isset($_POST['id']) )
      {
          unset( $products[$_POST['id']] );
          $_SESSION['edit_import_products_session'] = $products;
      }
    }

    function ajax_add_product_session()
    {
        $product = isset($_SESSION['edit_import_products_session']) ? $_SESSION['edit_import_products_session'] : array();
        if (isset($_POST['id']))
        {
            $id = intval($_POST['id']);
            $prod = $this->pdo->fetch_one("SELECT a.id,a.code,a.name,a.price,a.price_import,a.unit_id,u.name AS unit_name
					FROM products a
					LEFT JOIN product_units u ON a.unit_id=u.id
					WHERE a.id=" . $_POST['id']);

            $product[$_POST['id']]['id'] = $prod['id'];
            $product[$_POST['id']]['number_count'] = 1;
            $product[$_POST['id']]['name'] = $prod['name'];
            $product[$_POST['id']]['price_import'] = $prod['price_import'];
            $product[$_POST['id']]['code'] = $prod['code'];
            $product[$_POST['id']]['unit_id'] = $prod['unit_id'];
            $product[$_POST['id']]['unit_name'] = $prod['unit_name'];
            $product[$_POST['id']]['is_new'] = 1;

            $_SESSION['edit_import_products_session'] = $product;

            $result['id'] = $prod['id'];
            $result['name'] = $prod['name'];
            $result['code'] = $prod['code'];
            $result['unit_name'] = $prod['unit_name'];
            $result['price_import'] = number_format($prod['price_import']);
            $result['number_count'] = 1;


            echo json_encode($result);
            $this->pdo->close();
            exit();
        }
    }

    function ajax_update_product_number()
    {
        $product = isset($_SESSION['edit_import_products_session']) ? $_SESSION['edit_import_products_session'] : array();
        if (isset($_POST['product_id']))
        {
            $product[$_POST['product_id']]['number_count'] = $_POST['number'];
        }
        $_SESSION['edit_import_products_session'] = $product;


        $value['number_count'] = $product[$_POST['product_id']]['number_count'];
        $value['total_item_money'] = $this->dstring->get_price($product[$_POST['product_id']]['number_count'] * $product[$_POST['product_id']]['price_import']);

        echo json_encode($value);
        exit();
    }
}