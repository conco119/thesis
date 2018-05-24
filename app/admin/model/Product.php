<?php

class Product extends Main
{
    function __construct()
    {
        parent::__construct();
        $this->ProductHelper = new ProductHelper();
        $this->table = "products";
    }

    public function index()
    {
        //testing
        //add or edit
        $this->create();
        $this->edit();
        //query customer
        $sql = "SELECT a.*,
                (SELECT sum(number_count) FROM import_products i WHERE i.product_id = a.id) AS imported,
                (SELECT sum(number_count) FROM export_products e WHERE e.product_id = a.id ) AS exported
        FROM {$this->table} a";
        $paging = $this->paging->get_content($this->pdo->count_rows($sql), 10);
        $sql .= $paging['sql_add'];
        $products = $this->pdo->fetch_all($sql);
        $number_im = 0;
        $number_ex = 0;
        $total = 0;
        foreach($products as $key => $product)
        {
            $products[$key]['status'] = $this->helper->help_get_status($product['status'], $this->table, $product['id']);
            $products[$key]['price'] = $this->dstring->get_price($product['price']);
            $products[$key]['category_id'] = $this->ProductHelper->help_get_category($product['category_id']);
            $products[$key]['updated_at'] = gmdate('d.m.Y', $product['updated_at'] + 7 * 3600);
            $products[$key]['created_at'] = gmdate('d.m.Y', $product['created_at'] + 7 * 3600);
            $number_im += $product['imported'];
            $number_ex += $product['exported'];
            $total += ($product['imported'] - $product['exported']) * $product['price_import'];
        }
        $out['number_im'] = $number_im;
        $out['number_ex'] = $number_ex;
        $out['total'] = $total;
        //query customer group
        // $sql = "SELECT * FROM customer_groups";
        // $customer_groups = $this->pdo->fetch_all($sql);
        // $customer_groups = $this->CustomerHelper->help_get_customer_category_option($customer_groups);
        // pre($customers);
        // return;
        //smarty
        $this->smarty->assign('out', $out);
        $this->smarty->assign('paging', $paging);
        $this->smarty->assign('result', $products);
        $this->smarty->display(DEFAULT_LAYOUT);
    }
    //not using view from here

    public function create()
    {
        if( isset($_POST['submit']) && $_POST['id'] == 0 )
        {
            $data['name'] = $_POST['name'];
            $data['code'] = $_POST['code'];
            $data['category_id'] = $_POST['category_id'];
            $data['trademark_id'] = $_POST['trademark_id'];
            $data['unit_id'] = $_POST['unit_id'];
            $data['is_discount'] = isset($_POST['is_discount']) ? 1 : 0;
            $data['discount_type'] = isset($_POST['discount_type']) ? $_POST['discount_type'] : 1;
            $data['discount'] = isset($_POST['discount']) ? $_POST['discount'] : 0;
            $data['price_import'] = $this->dstring->convert_price_to_int($_POST['price_import']);
            $data['price'] = $this->dstring->convert_price_to_int($_POST['price']);
            $data['price_sale'] = $this->dstring->convert_price_to_int($_POST['price_sale']);
            $data['description'] = $_POST['description'];
            $data['warranty'] = $_POST['warranty'];
            $data['number_warning'] = $_POST['number_warning'];
            $data['status'] = isset($_POST['status']) ? 1 : 0;
            $data['created_at'] = time();
            $data['updated_at'] = time();
            $isSucceed = $this->pdo->insert($this->table, $data);
            if($isSucceed)
                {
                    $notification = [
                        'status' => 'success',
                        'title'  => 'Thêm thành công',
                        'text'   => "Thêm sản phẩm thành công"
                    ];
                    $this->smarty->assign('notification', $notification );
                }
            else
                {
                    $notification = [
                        'status' => 'error',
                        'title'  => 'Thêm không thành công',
                        'text'   => "Thêm sản phẩm không thành công"
                    ];
                    $this->smarty->assign('notification', $notification);
                }

        }
    }
    public function edit()
    {

        if( isset($_POST['submit']) && $_POST['id'] != 0)
        {
            // pre($_POST);
            // die();
            $data['name'] = $_POST['name'];
            $data['code'] = $_POST['code'];
            $data['category_id'] = $_POST['category_id'];
            $data['trademark_id'] = $_POST['trademark_id'];
            $data['unit_id'] = $_POST['unit_id'];
            $data['is_discount'] = isset($_POST['is_discount']) ? 1 : 0;
            $data['discount_type'] = isset($_POST['discount_type']) ? $_POST['discount_type'] : 1;
            $data['discount'] = isset($_POST['discount']) ? $_POST['discount'] : 0;
            $data['price_import'] = $this->dstring->convert_price_to_int($_POST['price_import']);
            $data['price'] = $this->dstring->convert_price_to_int($_POST['price']);
            $data['price_sale'] = $this->dstring->convert_price_to_int($_POST['price_sale']);
            $data['description'] = $_POST['description'];
            $data['warranty'] = $_POST['warranty'];
            $data['number_warning'] = $_POST['number_warning'];
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
                    'text'   => "Sửa sản phẩm thành công"
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
            $item['code'] = $this->ProductHelper->get_product_code();
          }
          $item['category_id'] = $this->helper->get_option(1, 'product_categories',$item['category_id']);
          $item['price'] = number_format($item['price']);
          $item['price_sale'] = number_format($item['price_sale']);
          $item['price_import'] = number_format($item['price_import']);
          $item['unit_id'] = $this->helper->get_option(1, 'product_units',$item['unit_id']);
          $item['trademark_id'] = $this->helper->get_option(1, 'product_trademarks',$item['trademark_id']);
          $item['discount_type'] = $this->helper->get_option(0, 'discount_type', $item['discount_type']);
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

    public function ajax_check_code()
    {
        $check_code = $this->pdo->check_exist("SELECT id FROM products WHERE id<>" . $_POST['id'] . " AND code='" . trim($_POST['code']) . "'");
        if ($check_code) {
            echo 0;
        } else
            echo 1;
        $this->pdo->close();
        exit();
    }

    //thay đổi giá tiền từ import  load dữ liệu ra modal
    function ajax_load_price_item()
    {
        if (isset($_POST['id']))
        {
            $id = $_POST['id'];
            $product = isset($_SESSION['import_session_product']) ? $_SESSION['import_session_product'] : array();

            $value = $this->pdo->fetch_one("SELECT * FROM products WHERE id = $id");

            $value['price_import'] = $value['price_import'] > 0 ? number_format($value['price_import']) : "";
            $value['price'] = $value['price'] > 0 ? number_format($value['price']) : "";

            echo json_encode($value);
            exit();
        }
        echo 0;
        exit();
    }

    // thay đổi giá bán từ modal
    function ajax_saved_price()
    {
        if (isset($_POST['id']))
        {
            $id = $_POST['id'];
            $data['price'] = $this->dstring->convert_price_to_int($_POST['price']);
            // $updateStatement = $this->slim_pdo->update($data)->table($this->table)->where('id', '=', $_POST['id']);
            // $updateStatement->execute();
            $this->pdo->update($this->table, $data, "id=" . $id);
            $this->pdo->close();
            echo "thanh cong r";
        }
    }

    //chi tiết sản phẩm cho hóa đơn
    function detail()
    {

        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $detail_export = []; //smarty assign
        $detail_import = []; //smarty assign
        $product_info = $this->pdo->fetch_one("SELECT * FROM products WHERE id= $id");

        // detail imports
        $sql = "SELECT a.id, a.code, a.date, b.number_count, b.price_import , u.name as unit_name, p.name as product_name
                FROM imports a
                LEFT JOIN import_products b ON b.import_id = a.id
                LEFT JOIN products p ON p.id = b.product_id
                LEFT JOIN product_units u ON u.id = p.unit_id
                WHERE p.id=$id";
        $detail_import = $this->pdo->fetch_all($sql);
        foreach($detail_import as $k => $item)
        {
            $detail_import[$k]['date'] = gmdate('d-m-Y', strtotime($item['date']) +7 *3600);
            $detail_import[$k]['total'] = $this->dstring->get_price($item['number_count'] * $item['price_import']);
        }
        //detail exports
        $sql = "SELECT a.id, a.code, a.date, b.number_count, b.price , u.name as unit_name, p.name as product_name
                FROM exports a
                LEFT JOIN export_products b ON b.export_id = a.id
                LEFT JOIN products p ON p.id = b.product_id
                LEFT JOIN product_units u ON u.id = p.unit_id
                WHERE p.id=$id";
        $detail_export = $this->pdo->fetch_all($sql);
        foreach($detail_export as $k => $item)
        {
            $detail_export[$k]['date'] = gmdate('d-m-Y', strtotime($item['date']) +7 *3600);
            $detail_export[$k]['total'] = $this->dstring->get_price($item['number_count'] * $item['price']);
        }

        $this->smarty->assign('detail_import', $detail_import);
        $this->smarty->assign('detail_export', $detail_export);
        $this->smarty->assign('product_info', $product_info);
        $this->smarty->display(DEFAULT_LAYOUT);
    }

    function imagepost()
    {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $product_info = $this->pdo->fetch_one("SELECT * FROM products WHERE id= $id");
        $this->smarty->assign('product_info', $product_info);
        $this->smarty->assign('id', $id);
        $this->smarty->display(DEFAULT_LAYOUT);
    }
}
