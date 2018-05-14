<?php

class Import extends Main
{
    function __construct()
    {
        parent::__construct();
        $this->ImportHelper = new ImportHelper();
        $this->table = "imports";
    }

    public function index()
    {
        //testing
        //add or edit
        $this->create();
        $import = isset($_SESSION['import_session']) ? $_SESSION['import_session'] : array();
        $products = isset($_SESSION['import_session_product']) ? $_SESSION['import_session_product'] : array();
        if (count($import) == 0)
        {
            $import['creator'] = $this->currentUser['id'];
            $import['supplier_id'] = 0;
            $import['date'] = $this->arg['today'];
            $import['total'] = 1;
            $import['discount_type'] = 1;
            $import['discount'] = 0;
            $import['must_pay'] = 0;
            $import['payment'] = 0;
            $import['debt'] = 0;
            $import['description'] = "";
            $_SESSION['import_session'] = $import;
        }
        $this->smarty->assign('value', $import);
        $total = 0;
        foreach ($products AS $k => $item) {
            $products[$k]['total'] = intval($item['price'] * $item['number']);
            $total += intval($item['price'] * $item['number']);
        }
        $this->smarty->assign('products', $products);

        // return;
        //set cac gia tri dau ra
        // $out['cprint'] = "?mod=import&site=cprint";
        $out['categories'] = $this->helper->get_option(1, 'product_categories', 0, 1);
        $out['suppliers'] = $this->helper->get_option(1, 'suppliers', $import['supplier_id']);
        // $out['trademarks'] = $this->product->get_select_trademarks($this->dbo);
        // $out['origins'] = $this->product->get_select_origins($this->dbo);
        // $out['afprint'] = "?mod=import&site=afprint&id=";
        $out['discount'] = $this->helper->get_option(0, 'discount_type', $import['discount_type']);
        // $out['print'] = "?mod=import&site=c" . $this->set->print_type[$this->arg['setting']['imprint']];
        $this->smarty->assign('out', $out);

        //smarty



        $this->smarty->display("form.tpl");
    }
    //not using view from here

    public function create()
    {
        if (isset($_POST['submit']) || isset($_POST['submit_print']))
        {
            $import = isset($_SESSION['import_session']) ? $_SESSION['import_session'] : array();
            $products = isset($_SESSION['import_session_product']) ? $_SESSION['import_session_product'] : array();
            if (count($products) == 0)
            {
                lib_alert("Vui long nhap san pham");
                lib_redirect();
            }
            if ($import['supplier_id'] == 0)
            {
                lib_alert("Vui long chon nha cung cap");
                lib_redirect();
            }


            // Luu data hoa don nhap warehouse_import

            $data['code'] = $this->ImportHelper->get_import_code();
            $data['supplier_id'] = $import['supplier_id'];
            $data['date'] = gmdate("Y-m-d", strtotime($import['date']) + 7 * 3600);
            $data['money_first'] = $import['total'];
            $data['discount_type'] = $import['discount_type'];
            $data['import_category_id'] = 1;
            $data['discount'] = $import['discount'];
            $data['money'] = $import['must_pay'];

            #$data['debt'] = ($import['debt'] < 0) ? 0 : $import['debt'];
              /*change -> $data['debt']=$import['debt']*/
            $data['debt']=$import['debt'];
            $data['description'] = $import['description'];
            $data['creator'] = $this->currentUser['id'];
            $data['updater'] = $this->currentUser['id'];
            $data['created_at'] = time();
            $data['updated_at'] = time();

           // echo "Import debt:" . $import['debt'];
            #echo "Data debt: " . $data['debt'];

            /*#$import['debt']=$import['payment'] - $import['must_pay'];
            echo "No:" . $import['debt'] . "<br/>";
            echo "Phai tra: " . $import['must_pay'] . "<br/>";
            echo "Da tra:" . $import['payment'] . "<br/>";
            //echo "Ket qua:" . $tich;
            $tich = 0;
            #$money['money'];
            $money['money'] = $data['money'] - $data['debt'];
            echo "money: " . $data['money'] . "<br/>";
            echo "debt:" . $data['debt'] . "Import debt:" . $import['debt'] . "<br/>";
            echo "so du:" . $money['money'] . "<br/>";
            if ($tich != 0) {
                if ($tich > 0) {
                    echo $tich;
                } else {
                    echo $tich;
                }
            } else {
                echo $tich;
            }
            if ($import['debt'] > 0) {
                //echo $import['debt'];
                //echo "tra thua ncc";
            } else {
                //echo $import['debt']."<br/>";
                //echo $import['must_pay'];
                //echo "tra 1 phan cho ncc";
            }*/


             if ($import_id = $this->pdo->insert($this->table, $data))
             {
                 // luu hoa don vao table import
                //  $money['date'] = $data['date'];
                //  $money['month'] = $data['month'];
                //  $money['year'] = $data['year'];
                //  $money['money'] = $data['money']-$data['debt'];
                //  $money['object_id'] = $data['supplier_id'];
                //  $money['from_id'] = $import_id;
                //  $this->warehouse->insert_money_statistics($this->dbo, $money); // Lưu lại phiếu thu chi


                //  if ($import['debt'] != 0) {
                //      $this->dbo->query("UPDATE suppliers SET money=money+" . $import['debt'] . " WHERE id=" . $data['supplier_id']);
                //      if ($import['debt'] < 0) {
                //          $money['description'] = "Tiền dư nhập hàng - chuyển vào công nợ NCC";
                //      } else {
                //          $money['description'] = "Tiền trả - chuyển vào công nợ NCC";
                //      }
                //      $money['money'] = -$import['debt'];
                //      $money['is_auto'] = 1;
                //      $this->warehouse->insert_money_statistics($this->dbo, $money);
                //  }
                //  unset($money);

                //  $this->warehouse->create_virtual_data_export($this->dbo, gmdate("Y-m-d", strtotime($import['date']) + 7 * 3600));
                //  unset($data);

                 foreach ($products AS $k => $item)
                 {
                     $product_data = $this->pdo->fetch_one("SELECT * FROM products WHERE id={$item['id']}");
                     $data2['product_id'] = $item['id'];
                     $data2['import_id'] = $import_id;
                     $data2['number_count'] = $item['number'];
                     $data2['price'] = $product_data['price'];
                     $data2['price_import'] = $item['price_import'];
                     $this->pdo->insert('import_products', $data2);
                 }
                //  if (isset($_POST['submit_print']))
                //  {
                //      $_SESSION['import_id'] = $import_id;
                //  }

                 $this->ajax_refresh();
                 lib_alert("Lap hoa don thanh cong");
                //  lib_redirect("./admin?mc=import&site=index");
             }
             else
             {
                 lib_alert("Error");
                 lib_redirect();
             }
        }
    }
    public function edit()
    {
        if( isset($_POST['submit']) && $_POST['id'] != 0)
        {
            $data['code'] = $_POST['code'];
            $data['name'] = $_POST['name'];
            $data['manager'] = $_POST['manager'];
            $data['phone'] = $_POST['phone'];
            $data['address'] = $_POST['address'];
            $data['status'] = isset($_POST['status']) ? 1 : 0;
            $data['updated_at'] = time();
            try {
                $updateStatement = $this->slim_pdo->update($data)->table($this->table)->where('id', '=', $_POST['id']);
                $isSucceed = $updateStatement->execute();
            }
            catch(PDOException $e) {
                $text = $e->getMessage();
                $isSucceed = false;
            }

            if($isSucceed)
            {
                $notification = [
                    'status' => 'success',
                    'title'  => 'Sửa thành công',
                    'text'   => "Sửa nhà cung cấp thành công"
                ];
                $this->smarty->assign('notification', $notification );
            }
          else
            {
                $notification = [
                    'status' => 'error',
                    'title'  => 'Sửa không thành công',
                    'text'   => $text
                ];
                $this->smarty->assign('notification', $notification);
            }
        }
    }
    public function ajax_active()
    {
      if(isset($_POST['table']) && isset($_POST['id']) && ($this->currentUser['permission'] == 1 || $this->currentUser['permission'] == 2))
      {
        $item = $this->pdo->fetch_one("SELECT status FROM " . $_POST['table'] . " WHERE id=" . $_POST['id']);
        $status = $item['status'] == 1 ? 0 : 1;
        $this->pdo->query("UPDATE " . $_POST['table'] . " SET status = '$status' WHERE id=" . $_POST['id']);
        echo $this->helper->help_get_status($status, $_POST['table'], $_POST['id']);
        exit();
      }
      else
      {
        echo 0;
        exit();
      }
    }

    public function ajax_load()
    {
        if( isset($_POST['id']) )
        {
          $item = $this->pdo->fetch_one("SELECT * FROM {$this->table} WHERE id = " . $_POST['id']);
          if(!$item) {
              $item['code'] = $this->SupplierHelper->get_sup_code();
          }
          echo json_encode($item);
        }
        $this->pdo->close();
        exit();
    }

    public function ajax_delete()
    {
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        if($id == 0){
            echo 0;
            exit();
        }
        if(($this->currentUser['permission'] == 1 || $this->currentUser['permission'] == 2) && $this->pdo->query("DELETE FROM {$this->table} WHERE id=$id"))
        {
            echo 1;
            exit();
        }
        echo 0;
        exit;
    }

    function ajax_set_export_value()
    {
        if (isset($_POST['item'])) {
            $value = $_POST['value'];
            if ($_POST['item'] == 'payment')
                $value = $this->dstring->convert_price_to_int($_POST['value']);
            $_SESSION['import_session'][$_POST['item']] = $value;

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

    function ajax_load_product()
    {
        $cate = isset($_POST['cate']) ? intval($_POST['cate']) : 0;
        // $orig = isset($_POST['orig']) ? intval($_POST['orig']) : 0;
        // $trade = isset($_POST['trade']) ? intval($_POST['trade']) : 0;
        $key = isset($_POST['key']) ? $_POST['key'] : '';

        $session = isset($_SESSION['import_session_product']) ? $_SESSION['import_session_product'] : array();
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

        $product_sql = "SELECT a.id,a.code,a.name,a.price_import,a.price
                        ,(SELECT SUM(number_count) FROM import_products WHERE a.id=product_id) imported,
        				(SELECT SUM(number_count) FROM export_products WHERE a.id=product_id) exported
				FROM products a
				WHERE a.id NOT IN ($str_id) AND a.status=1";
        if ($cate != 0)
            $product_sql .= " AND a.category_id=$cate";
        // if ($trade != 0)
        //     $product_sql .= " AND a.trademark_id=$trade";
        // if ($orig != 0)
        //    $product_sql .= " AND a.origin_id=$orig";
        if ($key != '')
            $product_sql .= " AND (a.code LIKE '%$key%' OR a.name LIKE '%$key%')";

        $product_sql .= " ORDER BY a.name ASC";
        // pre($product_sql);
        // die();
        $product_query = $this->pdo->fetch_all($product_sql);

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

    function ajax_add_product_session()
    {
        $product = isset($_SESSION['import_session_product']) ? $_SESSION['import_session_product'] : array();
        if (isset($_POST['id']))
        {
            $id = intval($_POST['id']);
            $prod = $this->pdo->fetch_one("SELECT a.id,a.code,a.name,a.price,a.price_import,a.unit_id,u.name AS unit_name
					FROM products a
					LEFT JOIN product_units u ON a.unit_id=u.id
					WHERE a.id=" . $_POST['id']);


            $product[$_POST['id']]['id'] = $prod['id'];
            $product[$_POST['id']]['number'] = 1;
            $product[$_POST['id']]['name'] = $prod['name'];
            $product[$_POST['id']]['price_import'] = $prod['price_import'];
            $product[$_POST['id']]['code'] = $prod['code'];
            $product[$_POST['id']]['unit_id'] = $prod['unit_id'];
            $product[$_POST['id']]['unit_name'] = $prod['unit_name'];
            $_SESSION['import_session_product'] = $product;

            $result = '<tr id="proNo' . $id . '">';
            $result .= '<td>' . $prod['code'] . '</td>';
            $result .= '<td>' . $prod['name'] . '</td>';
            $result .= '<td class="text-right">';
            $result .= '<input type="text" class="prod-price" id="proPrice' . $id . '" onchange="UpdateProductPrice(' . $id . ', this.value);" value="' . number_format($prod['price_import']) . '">';
            $result .= '</td>';
            $result .= '<td class="text-center">';
            $result .= "<input type=\"number\" class=\"prod-number\" id=\"proNumber" . $id . "\" onchange=\"UpdateNumberProduct(" . $id . ", 'update', this.value);\" value=\"1\">";
            $result .= '</td>';
            // $result .= '<td class="align-center">' . $product[$_POST['id']]['select_units'] . '</td>';
            $result .= '<td class="text-right" id="proTotal' . $id . '">' . number_format($prod['price_import']) . ' đ</td>';
            $result .= '<td class="text-right">';
            $result .= "<a href=\"javascript:void(0);\" class=\"btn btn-danger\" onclick=\"UpdateNumberProduct(" . $id . ", 'delete');\">";
            $result .= '<i class="fa fa-times-circle"> </i>';
            $result .= '</a>';
            $result .= '</td>';
            $result .= "</tr>";

            $this->pdo->close();
            echo $result;
            exit();
        }
    }

    function ajax_update_product_number()
    {
        $product = isset($_SESSION['import_session_product']) ? $_SESSION['import_session_product'] : array();
        if (isset($_POST['type']))
        {
            if ($_POST['type'] == 'add')
            {
                $product[$_POST['id']]['number'] += 1;
            }
            if ($_POST['type'] == 'update')
            {
                $product[$_POST['id']]['number'] = $_POST['number'];
            }
            else if ($_POST['type'] == 'delete') {
                unset($product[$_POST['id']]);
            }
        }
        $_SESSION['import_session_product'] = $product;

        $value['id'] = $_POST['id'];
        $value['number'] = $product[$_POST['id']]['number'];
        $value['total_item'] = $this->dstring->get_price($product[$_POST['id']]['number'] * $product[$_POST['id']]['price_import']);

        echo json_encode($value);
        exit();
    }

    function ajax_get_total_session()
    {
        $import = isset($_SESSION['import_session']) ? $_SESSION['import_session'] : array();
        $product = isset($_SESSION['import_session_product']) ? $_SESSION['import_session_product'] : array();
        // tong tien
        $total = 0;
        foreach ($product AS $k => $item)
        {
            $total += $item['price_import'] * $item['number'];
        }

        //must pay
        switch($import['discount_type']) {
            case 1:
                $import['must_pay'] = $total - ($total * $import['discount'])/100;
                break;
            case 2:
                $import['must_pay'] = $total - $import['discount'];
                break;
            case 3:
                $import['must_pay'] = $total + ($total * $import['discount'])/100;
                break;
            case 4:
                $import['must_pay'] = $total + $import['discount'];
                break;
            default:
                $discount = 0;
        }


        if (@$_POST['is_payment'] != 1)
            $import['payment'] = $import['must_pay'];
        $import['debt'] = $import['payment'] - $import['must_pay'];
        $import['total'] = $total;

        $_SESSION['import_session'] = $import;

        $value['total'] = number_format($total);
        $value['debt'] = number_format($import['debt']);
        $value['payment'] = number_format($import['payment']);
        $value['total_must_pay'] = number_format($import['must_pay']);

        echo json_encode($value);
        exit();
    }

    function ajax_change_product_price()
    {
        if (isset($_POST['id']))
        {
            $id = intval($_POST['id']);
            $product = isset($_SESSION['import_session_product']) ? $_SESSION['import_session_product'] : array();
            $price = $this->dstring->convert_price_to_int($_POST['price']);
            $product[$id]['price_import'] = $price;
            $_SESSION['import_session_product'] = $product;

            $data['price_import'] = $price;
            $this->pdo->update("products", $data, "id=" . $_POST['id']);
            $value['price'] = number_format($price);
            $value['total'] = $this->dstring->get_price($product[$id]['price_import'] * $product[$id]['number']);
            $this->pdo->close();
            echo json_encode($value);
        }
    }

    function ajax_refresh()
    {
        $import['creator'] = $this->currentUser['id'];
        $import['supplier_id'] = 0;
        $import['date'] = $this->arg['today'];
        $import['total'] = 0;
        $import['discount_type'] = 1;
        $import['discount'] = 0;
        $import['must_pay'] = 0;
        $import['payment'] = 0;
        $import['debt'] = 0;
        $import['description'] = "";
        $_SESSION['import_session'] = $import;
        $_SESSION['import_session_product'] = array();
    }

}