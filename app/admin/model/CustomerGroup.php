<?php

class CustomerGroup extends Main
{
    function __construct()
    {
        parent::__construct();
        $this->CustomerGroupHelper = new CustomerGroupHelper();
        $this->table = "customer_groups";
    }

    public function index()
    {
        //testing

        //add or edit
        $this->create();
        $this->edit();
        //query
        $sql = "SELECT * FROM {$this->table}";
        $paging = $this->paging->get_content($this->pdo->count_rows($sql), 10);
        $sql .= $paging['sql_add'];
        $customergroups = $this->pdo->fetch_all($sql);
        foreach($customergroups as $key => $customer)
        {
            $customergroups[$key]['status'] = $this->helper->help_get_status($customer['status'], $this->table, $customer['id']);
            $customergroups[$key]['updated_at'] = gmdate('d.m.Y', $customer['updated_at'] + 7 * 3600);
            $customergroups[$key]['created_at'] = gmdate('d.m.Y', $customer['created_at'] + 7 * 3600);
        }

        // pre($this->arg);
        // return;
        //smarty
        $this->smarty->assign('paging', $paging);
        $this->smarty->assign('customergroups', $customergroups);
        $this->smarty->display(DEFAULT_LAYOUT);
    }
    //not using view from here

    public function create()
    {
        if( isset($_POST['submit']) && $_POST['id'] == 0 )
        {
          $data['code'] = $_POST['code'];
          $data['name'] = $_POST['name'];
          $data['description'] = "";
          $data['status'] = isset($_POST['status']) ? 1 : 0;
          $data['created_at'] = time();
          $data['updated_at'] = time();
          $isSucceed = $this->pdo->insert($this->table, $data);
          if($isSucceed)
            {
                $notification = [
                    'status' => 'success',
                    'title'  => 'Thêm thành công',
                    'text'   => "Thêm nhóm khách hàng thành công"
                ];
                $this->smarty->assign('notification', $notification );
            }
          else
            {
                $notification = [
                    'status' => 'error',
                    'title'  => 'Thêm không thành công',
                    'text'   => "Thêm nhóm khách hàng thành công"
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
                    'text'   => "Sửa nhóm khách hàng thành công"
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
          if(!$item)
            $item['code'] = $this->CustomerGroupHelper->get_customer_group_code();
          $item['discount_type'] = $this->helper->help_get_discount_option($item['discount_type']);
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