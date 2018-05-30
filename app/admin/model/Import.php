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
            $import['code'] = $this->ImportHelper->get_import_code();
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

        $out['categories'] = $this->helper->get_option(1, 'product_categories', 0, 1, "Danh mục sản phẩm");
        $out['suppliers'] = $this->helper->get_option(1, 'suppliers', $import['supplier_id']);
        $out['trademarks'] = $this->helper->get_option(1, 'product_trademarks', 0, 1, "Hãng sản xuất");
        // $out['origins'] = $this->product->get_select_origins($this->dbo);
        // $out['afprint'] = "?mod=import&site=afprint&id=";
        $out['discount'] = $this->helper->get_option(0, 'discount_type', $import['discount_type']);
        // $out['print'] = "?mod=import&site=c" . $this->set->print_type[$this->arg['setting']['imprint']];
        $this->smarty->assign('out', $out);

        //smarty



        $this->smarty->display("form.tpl");
    }

    // tạo hóa đơn
    public function create()
    {
        if (isset($_POST['submit']) || isset($_POST['submit_print']))
        {
            $import = isset($_SESSION['import_session']) ? $_SESSION['import_session'] : array();
            $products = isset($_SESSION['import_session_product']) ? $_SESSION['import_session_product'] : array();
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


            // Luu data hoa don nhap import

            $data['code'] = $import['code'];
            $data['supplier_id'] = $import['supplier_id'];
            $data['date'] = gmdate("Y-m-d", strtotime($import['date']) + 7 * 3600);
            $data['total_money'] = $import['total'];
            $data['discount'] = $import['discount'];
            $data['discount_type'] = $import['discount_type'];
            $data['must_pay'] = $import['must_pay'];


            $data['payment']=$import['payment'];
            $data['description'] = $import['description'];
            $data['creator'] = $this->currentUser['id'];
            $data['created_at'] = time();

            // luu hoa don vao table import
             if ($import_id = $this->pdo->insert($this->table, $data))
             {

                 if( $import['payment'] > 0 )
                 {
                    $money['code'] = "MN" . time();
                    $money['money'] = $import['payment'];
                    $money['date'] = gmdate("Y-m-d", strtotime($import['date']) + 7 * 3600);
                    $money['is_import'] = 0;
                    $money['object'] = 'sup';
                    $money['object_id'] = $import['supplier_id'];
                    $money['from_type'] = 'imp';
                    $money['from_id'] = $import_id;
                    $money['creator'] = $this->currentUser['id'];
                    $money['type'] = 0;
                    $money['is_auto'] = 1;
                    $money['created_at'] = time();
                    $money['updated_at'] = time();
                    $money['description'] = "";

                 }

                // lưu lại sổ thu chi
                $insertStatement = $this->slim_pdo->insert(array('code', 'money', 'date', "is_import", "object", "object_id", "from_type", "from_id", "creator", "type", "is_auto", "created_at", "updated_at", "description" ))
                ->into('money')
                ->values(array($money['code'], $money['money'], $money['date'], $money['is_import'], $money['object'], $money['object_id'], $money['from_type'], $money['from_id'], $money['creator'], $money['type'], $money['is_auto'], $money['created_at'], $money['updated_at'], $money['description']));
                $money_id = $insertStatement->execute();

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
                 lib_alert("Lập hóa đơn thành công");
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
    // hóa đơn nhập hàng
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

        $sql = "SELECT a.id, a.date, a.code, a.must_pay, a.total_money, a.payment, a.creator, a.updater, a.updated_at, b.name AS supplier, c.name AS user FROM imports AS a
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
            $imports[$key]['discount'] = $this->dstring->get_price($import['total_money'] - $import['must_pay']);
            if( $import['creator'] != $import['updater'] )
            {
                $imports[$key]['updater'] = $this->pdo->fetch_one("SELECT name FROM users WHERE id =" . $import['updater'] );
                $imports[$key]['updated_at'] = gmdate('H:i d/m/Y', $import['updated_at']+7*3600);
            }

        }



        $this->smarty->assign('paging', $paging);
        $this->smarty->assign('result', $imports);
        $this->smarty->assign('out', $out);
        $this->smarty->display(DEFAULT_LAYOUT);
    }

    public function ajax_delete()
    {
        if( isset($_POST['id']) )
        {
            $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
            $this->pdo->query("DELETE FROM import_products WHERE import_id = $id");
            $this->pdo->query("DELETE FROM money WHERE from_type='imp' AND from_id=$id AND is_auto=1");
            $this->pdo->query("DELETE FROM imports WHERE id = $id");
            echo 1;
            $this->pdo->close();
            exit();
        }
        echo 0;
        $this->pdo->close();
        exit();
    }
    // thiết lập thông tin cho hóa đơn nhập
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
    // load product chọn sản phẩm
    function ajax_load_product()
    {
        $cate = isset($_POST['cate']) ? intval($_POST['cate']) : 0;
        // $orig = isset($_POST['orig']) ? intval($_POST['orig']) : 0;
        $trade = isset($_POST['trade']) ? intval($_POST['trade']) : 0;
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
    // thêm sản phẩm vào session - hóa đơn
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

            $result .= "<td class='text-center'>" . $prod['unit_name']; "</td>";

            $result .= '<td class="text-center">';
            $result .= "<input type=\"number\" class=\"prod-number\" id=\"proNumber" . $id . "\" onchange=\"UpdateNumberProduct(" . $id . ", 'update', this.value);\" value=\"1\">";
            $result .= '</td>';


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
    // cập nhật số lượng sản phẩm
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
    // tính tổng tiền các thứ bla bla
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
    // thay đổi giá tiền sản phẩm
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
    //refresh session
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
        $import['code'] = $this->ImportHelper->get_import_code();
        $_SESSION['import_session'] = $import;
        $_SESSION['import_session_product'] = array();
    }

    function ajax_get_detail_import()
    {
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

        //thông tin hóa đơn
        $sql = "SELECT a.* , s.name as supplier_name, u.name as user_name
        FROM imports a
        LEFT JOIN suppliers s ON a.supplier_id = s.id
        LEFT JOIN users u ON a.creator = u.id
        WHERE a.id = $id";


        $import = $this->pdo->fetch_one($sql);

        $import['date'] = gmdate('d-m-Y', strtotime($import['date']) + 7 * 3600);
        $import['created_at'] = gmdate("H:i A d/m/Y", $import['created_at'] + 7 * 3600);
        //sản phẩm
        $sql = "SELECT a.*, u.name as unit_name, p.name
        FROM import_products a
        LEFT JOIN products p ON a.product_id = p.id
        LEFT JOIN product_units u ON p.unit_id = u.id
        WHERE import_id = $id";
        $import['products'] = $this->pdo->fetch_all($sql);


        echo json_encode($import);
        die();
    }

}