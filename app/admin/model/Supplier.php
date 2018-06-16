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
        $this->redirectIfEmployee();
        //testing
        //add or edit
        $this->create();
        $this->edit();
        //query customer
        $sql = "SELECT a.*,
                ( SELECT sum(payment) FROM imports WHERE supplier_id = a.id ) as payment,
                ( SELECT sum(must_pay) FROM imports WHERE supplier_id = a.id ) as must_pay,
                ( SELECT sum(money) FROM money m WHERE m.object = 'sup' AND m.object_id = a.id AND m.is_import = 0 AND is_auto = 0 ) as pay_to_sup,
                ( SELECT sum(money) FROM money m WHERE m.object = 'sup' AND m.object_id = a.id AND m.is_import = 1 AND is_auto = 0) as sup_pay
        FROM {$this->table} a";
        $paging = $this->paging->get_content($this->pdo->count_rows($sql), 10);
        $sql .= $paging['sql_add'];
        $suppliers = $this->pdo->fetch_all($sql);
        $total = 0;
        $total_must_pay = 0;
        foreach($suppliers as $key => $supplier)
        {
            $suppliers[$key]['status'] = $this->helper->help_get_status($supplier['status'], $this->table, $supplier['id']);
            $suppliers[$key]['updated_at'] = gmdate('d.m.Y', $supplier['updated_at'] + 7 * 3600);
            $suppliers[$key]['created_at'] = gmdate('d.m.Y', $supplier['created_at'] + 7 * 3600);
            // $suppliers[$key]['money'] = ( $supplier['must_pay'] + $supplier['pay_to_sup'] ) - ( $supplier['payment'] + $supplier['sup_pay'] );
            $suppliers[$key]['money'] = ( $supplier['must_pay'] - $supplier['payment'] ) + ( $supplier['sup_pay'] - $supplier['pay_to_sup'] );
            $total += $suppliers[$key]['money'];
            $total_must_pay += $supplier['must_pay'];
        }

        //query customer group
        // pre($customers);
        // return;
        //smarty
        $this->smarty->assign('paging', $paging);
        $this->smarty->assign('suppliers', $suppliers);
        $this->smarty->assign('total', $total);
        $this->smarty->assign('total_must_pay', $total_must_pay);
        $this->smarty->display(DEFAULT_LAYOUT);
    }
    //not using view from here

    public function create()
    {
        if( isset($_POST['submit']) && $_POST['id'] == 0 )
        {
          $data['code'] = $_POST['code'];
          $data['name'] = $_POST['name'];
          $data['manager'] = $_POST['manager'];
          $data['phone'] = $_POST['phone'];
          $data['address'] = $_POST['address'];
          $data['money'] = 0;
          $data['status'] = isset($_POST['status']) ? 1 : 0;
          $data['created_at'] = time();
          $data['updated_at'] = time();
          $isSucceed = $this->pdo->insert($this->table, $data);
          if($isSucceed)
            {
                $notification = [
                    'status' => 'success',
                    'title'  => 'Thêm thành công',
                    'text'   => "Thêm nhà cung cấp thành công"
                ];
                $this->smarty->assign('notification', $notification );
            }
          else
            {
                $notification = [
                    'status' => 'error',
                    'title'  => 'Thêm không thành công',
                    'text'   => "Thêm nhà cung cấp không thành công"
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
}