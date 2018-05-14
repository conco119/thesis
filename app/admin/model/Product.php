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
        $sql = "SELECT * FROM {$this->table}";
        $paging = $this->paging->get_content($this->pdo->count_rows($sql), 10);
        $sql .= $paging['sql_add'];
        $products = $this->pdo->fetch_all($sql);
        foreach($products as $key => $product)
        {
            $products[$key]['status'] = $this->helper->help_get_status($product['status'], $this->table, $product['id']);
            $products[$key]['price'] = $this->dstring->get_price($product['price']);
            $products[$key]['category_id'] = $this->ProductHelper->help_get_category($product['category_id']);
            $products[$key]['updated_at'] = gmdate('d.m.Y', $product['updated_at'] + 7 * 3600);
            $products[$key]['created_at'] = gmdate('d.m.Y', $product['created_at'] + 7 * 3600);
            // $products[$key]['group'] = $this->CustomerHelper->help_get_group($customer['group_id']);
            // $products[$key]['creator'] = $this->CustomerHelper->help_get_creator($customer['creator']);
        }

        //query customer group
        // $sql = "SELECT * FROM customer_groups";
        // $customer_groups = $this->pdo->fetch_all($sql);
        // $customer_groups = $this->CustomerHelper->help_get_customer_category_option($customer_groups);
        // pre($customers);
        // return;
        //smarty
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
            $data['manufacturer_id'] = $_POST['manufacturer_id'];
            $data['unit_id'] = $_POST['unit_id'];
            $data['discount_type'] = $_POST['discount_type'];
            $data['discount'] = $_POST['discount'];
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
            $data['manufacturer_id'] = $_POST['manufacturer_id'];
            $data['unit_id'] = $_POST['unit_id'];
            $data['discount_type'] = $_POST['discount_type'];
            $data['discount'] = $_POST['discount'];
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
          $item['category_id'] = $this->helper->get_option(1, 'product_categories',$item['category_id']);
          $item['price'] = number_format($item['price']);
          $item['price_sale'] = number_format($item['price_sale']);
          $item['price_import'] = number_format($item['price_import']);
          $item['unit_id'] = $this->helper->get_option(1, 'product_units',$item['unit_id']);
          $item['manufacturer_id'] = $this->helper->get_option(1, 'manufacturers',$item['manufacturer_id']);
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
}
