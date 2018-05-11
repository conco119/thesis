<?php

class Supplier extends Main
{
    function __construct()
    {
        parent::__construct();
        $this->SupplierHelper = new SupplierHelper();
        $this->table = "suppliers";
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
        $suppliers = $this->pdo->fetch_all($sql);
        foreach($suppliers as $key => $supplier)
        {
            $suppliers[$key]['status'] = $this->helper->help_get_status($supplier['status'], $this->table, $supplier['id']);
            $suppliers[$key]['updated_at'] = gmdate('d.m.Y', $supplier['updated_at'] + 7 * 3600);
            $suppliers[$key]['created_at'] = gmdate('d.m.Y', $supplier['created_at'] + 7 * 3600);
            $suppliers[$key]['group'] = $this->CustomerHelper->help_get_group($supplier['group_id']);
            $suppliers[$key]['creator'] = $this->CustomerHelper->help_get_creator($supplier['creator']);
        }

        //query customer group
        $sql = "SELECT * FROM customer_groups";
        $customer_groups = $this->pdo->fetch_all($sql);
        $customer_groups = $this->CustomerHelper->help_get_customer_category_option($customer_groups);
        // pre($customers);
        // return;
        //smarty
        $this->smarty->assign('paging', $paging);
        $this->smarty->assign('customers', $customers);
        $this->smarty->assign('customer_groups', $customer_groups);
        $this->smarty->display(DEFAULT_LAYOUT);
    }
    //not using view from here

    public function create()
    {
        if( isset($_POST['submit']) && $_POST['id'] == 0 )
        {
          $data['code'] = $_POST['code'];
          $data['name'] = $_POST['name'];
          $data['group_id'] = $_POST['group_id'];
          $data['gender'] = $_POST['gender'];
          $data['creator'] = $this->currentUser['id'];
          $data["birthday"] = $_POST["year"] . "-" . $_POST["month"] . "-" . $_POST["day"];
          $data['phone'] = $_POST['phone'];
          $data['address'] = $_POST['address'];
          $data['email'] = $_POST['email'];
          $data['status'] = isset($_POST['status']) ? 1 : 0;
          $data['created_at'] = time();
          $data['updated_at'] = time();
          $isSucceed = $this->pdo->insert($this->table, $data);
          if($isSucceed)
            {
                $notification = [
                    'status' => 'success',
                    'title'  => 'Thêm thành công',
                    'text'   => "Thêm khách hàng thành công"
                ];
                $this->smarty->assign('notification', $notification );
            }
          else
            {
                $notification = [
                    'status' => 'error',
                    'title'  => 'Thêm không thành công',
                    'text'   => "Thêm khách hàng không thành công"
                ];
                $this->smarty->assign('notification', $notification);
            }

        }
    }
    public function edit()
    {
        if( isset($_POST['submit']) && $_POST['id'] != 0)
        {
            $data['code'] = $_POST['code'];
            $data['name'] = $_POST['name'];
            $data['phone'] = $_POST['phone'];
            $data['gender'] = $_POST['gender'];
            $data["birthday"] = $_POST["year"] . "-" . $_POST["month"] . "-" . $_POST["day"];
            $data['address'] = $_POST['address'];
            $data['email'] = $_POST['email'];
            $data['group_id'] = $_POST['group_id'];
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
                    'text'   => "Sửa khách hàng thành công"
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
              $item['code'] = $this->CustomerHelper->get_customer_code();
          }
          $item['birthday'] = $this->helper->get_user_birthday_select($item['birthday']);
          $item['gender'] = $this->helper->get_user_gender_select($item['gender']);
          $item['group'] = $this->CustomerHelper->help_get_group_option($item['group_id']);
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
}