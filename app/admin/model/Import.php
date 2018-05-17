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


            // Luu data hoa don nhap import

            $data['code'] = $this->ImportHelper->get_import_code();
            $data['supplier_id'] = $import['supplier_id'];
            $data['date'] = gmdate("Y-m-d", strtotime($import['date']) + 7 * 3600);
            $data['money_first'] = $import['total'];
            $data['discount'] = $import['discount'];
            $data['discount_type'] = $import['discount_type'];
            $data['money'] = $import['must_pay'];

            #$data['debt'] = ($import['debt'] < 0) ? 0 : $import['debt'];
              /*change -> $data['debt']=$import['debt']*/
            $data['debt']=$import['debt'];
            $data['description'] = $import['description'];
            $data['creator'] = $this->currentUser['id'];
            $data['updater'] = $this->currentUser['id'];
            $data['created_at'] = time();
            $data['updated_at'] = time();



             if ($import_id = $this->pdo->insert($this->table, $data))
             {
                 // luu hoa don vao table import
                 $money['date'] = $data['date'];
                 if( $import['debt'] <= 0 )
                    $money['money'] = $import['payment'];
                 else
                    $money['money'] = $import['must_pay'];

                 $money['object_id'] = $import['supplier_id'];
                 $money['object'] = "sup";
                 $money['from_type'] = "imp";
                 $money['from_id'] = $import_id;
                 $money['is_import'] = 0;
                 $money['category_id'] = 2;
                 $money['description'] = "";
                 $money['creator'] = $this->currentUser['id'];
                 $money['is_auto'] = 0;
                 $money['created_at'] = time();
                 $money['updated_at'] = time();

                 $insertStatement = $this->slim_pdo->insert(array('date', 'money', 'object_id', "object", "from_type", "from_id", "is_import", "category_id", "description", "creator", "is_auto", "created_at", "updated_at" ))
                       ->into('money')
                       ->values(array($money['date'], $money['money'], $money['object_id'], $money['object'], $money['from_type'], $money['from_id'], $money['is_import'], $money['category_id'], $money['description'], $money['creator'], $money['is_auto'], $money['created_at'], $money['updated_at']));
                $insertId = $insertStatement->execute(false);
                //  $this->pdo->insert('money', $money); // Lưu lại phiếu thu chi

                 // cập nhât tài khoản nợ/dư cho khách hàng
                 if ($import['debt'] != 0)
                 {
                     $this->pdo->query("UPDATE suppliers SET money=money+" . $import['debt'] . " WHERE id=" . $import['supplier_id']);
                     if ($import['debt'] < 0)
                     {
                         $money['description'] = "Tiền nợ nhập hàng - chuyển vào công nợ NCC";
                         $money['money'] = -$import['debt'];
                         $money['category_id'] = 3;
                     }
                     else
                     {
                         $money['description'] = "Tiền dư nhập hàng - chuyển vào công nợ NCC";
                         $money['money'] = $import['debt'];
                         $money['category_id'] = 4;
                     }

                     $money['is_auto'] = 1;
                    $insertStatement = $this->slim_pdo->insert(array('date', 'money', 'object_id', "object", "from_type", "from_id", "is_import", "category_id", "description", "creator", "is_auto", "created_at", "updated_at" ))
                        ->into('money')
                        ->values(array($money['date'], $money['money'], $money['object_id'], $money['object'], $money['from_type'], $money['from_id'], $money['is_import'], $money['category_id'], $money['description'], $money['creator'], $money['is_auto'], $money['created_at'], $money['updated_at']));
                    $insertId = $insertStatement->execute(false);
                 }

                 unset($money);
                 unset($data);

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

                 $this->ajax_refresh();
                 lib_alert("Lap hoa don thanh cong");
                 lib_redirect("./admin?mc=import&site=index");
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

    public function statistics()
    {

        $date_export = isset($_GET['date']) ? intval($_GET["date"]) : 0;
        $out['select_export'] = $this->ImportHelper->get_select_from_array($date_export);
        $key = isset($_GET['key']) ? $_GET["key"] : "";
        $out['key'] = $key;
        $sql_where = "";
        $sql_where_p = "1=1";
        if ($key != "")
        {
            $sql_where .= " AND  (a.code LIKE '%$key%' OR b.name LIKE '%$key%')";
        }

        $sql = "SELECT a.id, a.date, a.code, a.money, a.money_first, a.debt, b.name AS supplier, c.name AS user FROM imports AS a
					LEFT JOIN suppliers b ON a.supplier_id=b.id
					LEFT JOIN users c ON a.creator=c.id
				WHERE 1=1 $sql_where
				ORDER BY id DESC";
        $paging = $this->paging->get_content($this->pdo->count_rows($sql), 10);
        $sql .= $paging['sql_add'];

        $imports = $this->pdo->fetch_all($sql);

        //filter this day, this week, this month
        if ($date_export != 0)
        {
            switch($date_export)
            {
                case 1:
                    $date = date("Y-m-d");
                    foreach($imports as $key => $import)
                    {
                        if($import['date'] != $date)
                            unset($imports[$key]);
                    }
                    break;
                case 2:
                    $current_week = gmdate("W");
                    $current_year = gmdate("Y");
                    foreach($imports as $key => $import)
                    {
                        $week = gmdate("W", strtotime($import['date']) + 7 *3600);
                        $year = gmdate("Y", strtotime($import['date']) + 7 *3600);
                        if($current_week != $week && $current_year == $year)
                            unset($imports[$key]);
                    }
                    break;
                case 3:
                    $current_month = gmdate("m");
                    $current_year = gmdate("Y");
                    foreach($imports as $key => $import)
                    {
                        $month = gmdate("m", strtotime($import['date']) + 7 *3600);
                        $year = gmdate("Y", strtotime($import['date']) + 7 *3600);
                        if($current_month != $month && $current_year == $year)
                            unset($imports[$key]);
                    }
                    break;
            }
        }
        ///
        foreach ($imports as $key => $import)
        {
            $imports[$key]['date'] = gmdate('d.m.Y', strtotime($import['date']) + 7 * 3600);
            $imports[$key]['discount'] = $this->dstring->get_price($import['money_first'] - $import['money']);
        }



        $this->smarty->assign('paging', $paging);
        $this->smarty->assign('result', $imports);
        $this->smarty->assign('out', $out);
        $this->smarty->display(DEFAULT_LAYOUT);
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

        $product_query = $this->pdo->fetch_all($product_sql);
        if($cate != 0)
        {
            if($key != '')
                $product_query = $this->ImportHelper->get_child_products($cate, $product_query, $str_id, $key);
            else
                $product_query = $this->ImportHelper->get_child_products($cate, $product_query, $str_id, "");
        }


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

    function ajax_get_import_info()
    {
        if (isset($_POST['id']))
        {
            $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

            $import = $this->pdo->fetch_one("SELECT a.id, a.code, a.created_at ,a.money_first ,a.date, a.money, a.debt, u.name AS creator, s.name AS supplier
					FROM imports a
					LEFT JOIN users u ON a.creator=u.id
					LEFT JOIN suppliers s ON a.supplier_id=s.id
					WHERE a.id=$id");
            if (!$import) exit();

            $str = "";
            $str .= "<h1 class=\"text-center\">Hóa đơn nhập hàng</h1>";
            $str .= "<h2 class=\"text-center\">[Mã: " . $import['code'] . "]</h2>";
            $str .= "<p><span>Nhà cung cấp:</span> " . $import ['supplier'] . "</p>";
            $str .= "<p><span>Nhân viên:</span> " . $import['creator'] . "</p>";
            $str .= "<p><span>Thời gian:</span> " . gmdate("H:i A d.m.Y", $import['created_at'] + 7 * 3600) . "</p>";

            $str .= "<table class=\"table table-striped table-bordered table-bor-btm\">";
            $str .= "<thead>";
            $str .= "<tr>";
            $str .= "<th>Sản phẩm</th>";
            $str .= "<th class=\"text-right\">Đơn vị</th>";
            $str .= "<th class=\"text-right\">Giá nhập</th>";
            // $str .= "<th class=\"text-right\">Giá bán</th>";
            $str .= "<th class=\"text-right\">SL</th>";
            $str .= "<th class=\"text-right\">Thành tiền</th>";
            $str .= "</tr>";
            $str .= "</thead>";
            $str .= "<tbody>";

            $products = $this->pdo->fetch_all("SELECT (a.price_import * a.number_count) AS total, a.price_import, a.price, a.number_count, b.name, u.name AS unit_name
					FROM import_products a
					LEFT JOIN products b ON a.product_id = b.id
					LEFT JOIN product_units u ON u.id = b.unit_id
					WHERE a.import_id = $id
					");
             foreach($products as $key => $item)
             {
                $item['total'] = $this->dstring->get_price($item['total']);
                $str .= "<tr>";
                $str .= "<td>" . $item['name'] . "</td>";
                $str .= "<td class=\"text-right\">" . $item['unit_name'] . "</td>";
                $str .= "<td class=\"text-right\">" . $this->dstring->get_price($item['price_import']) . "</td>";
                // $str .= "<td class=\"text-right\">" . $this->dstring->get_price($item['price']) . "</td>";
                $str .= "<td class=\"text-right\">" . $item['number_count'] . "</td>";
                $str .= "<td class=\"text-right\">" . $item['total'] . "</td>";
                $str .= "</tr>";
            }

            $str .= "</tbody>";
            $str .= "</table>";
            $str .= "<div class=\"bold text-right\"><h4>Tổng tiền: " . $this->dstring->get_price($import['money_first']) . "</h4></div>";
            $str .= "<div class=\"bold text-right\"><h4>Phải trả " . $this->dstring->get_price($import['money']) . "</h4></div>";
            if ($import['debt'] < 0)
                $str .= "<div class=\"bold text-right\"><h4>Tiền nợ: " . $this->dstring->get_price(-$import['debt']) . "</h4></div>";
            else if($import['debt'] > 0)
                $str .= "<div class=\"bold text-right\"><h4>Tiền dư: " . $this->dstring->get_price($import['debt']) . "</h4></div>";
            // $str .= "<hr class='line'>";

            $str .= "<h3 class='text-right'>Chiết khấu: " . $this->dstring->get_price($import['money_first'] - $import['money']) . "</h3>";

            $str .= "<div class=\"bold text-right\"><h3>Đã trả: " . $this->dstring->get_price($import['money'] + $import['debt']) . "</h3></div>";


            echo $str;
            exit();
        }
    }

}