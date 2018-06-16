<?php

class ProductUnit extends Main
{
    function __construct()
    {
        parent::__construct();
        $this->ProductUnitHelper = new ProductUnitHelper();
        $this->table = 'product_units';
    }

    public function index()
    {
        //permission checking
        $this->redirectIfEmployee();
        //add or edit
        $this->create();
        $this->edit();
        //query
        $sql = "SELECT * FROM product_units";
        $paging = $this->paging->get_content($this->pdo->count_rows($sql), 10);
        $sql .= $paging['sql_add'];
        $units = $this->pdo->fetch_all($sql);
        foreach($units as $key => $unit)
        {
            $units[$key]['status'] = $this->helper->help_get_status($unit['status'], 'product_units', $unit['id']);
            $units[$key]['updated_at'] = gmdate('d.m.Y', $cat['updated_at'] + 7 * 3600);
            $units[$key]['created_at'] = gmdate('d.m.Y', $cat['created_at'] + 7 * 3600);
        }

        // pre($units);
        // return;
        //smarty
        $this->smarty->assign('isSucceed', 'Xóa thành công r');
        $this->smarty->assign('paging', $paging);
        $this->smarty->assign('units', $units);
        $this->smarty->display(DEFAULT_LAYOUT);
    }
    //not using view from here

    public function create()
    {
        if( isset($_POST['submit']) && $_POST['id'] == 0 )
        {
          $data['code'] = $_POST['code'];
          $data['name'] = $_POST['name'];
          $data['status'] = isset($_POST['status']) ? 1 : 0;
          $data['created_at'] = time();
          $data['updated_at'] = time();
          $isSucceed = $this->pdo->insert('product_units', $data);
          if($isSucceed)
            {
                $notification = [
                    'status' => 'success',
                    'title'  => 'Thêm thành công',
                    'text'   => "Thêm đơn vị sản phẩm thành công"
                ];
                $this->smarty->assign('notification', $notification );
            }
          else
            {
                $notification = [
                    'status' => 'error',
                    'title'  => 'Thêm không thành công',
                    'text'   => "Thêm đơn vị sản phẩm không thành công"
                ];
                $this->smarty->assign('notification', $notification);
            }

        }
    }
    public function edit()
    {
        //$unit = $this->pdo->fetch_one("SELECT * from product_units where id=" . $_POST['id']);
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
                    'text'   => "Sửa đơn vị sản phẩm thành công"
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
        $user = $this->pdo->fetch_one("SELECT status FROM " . $_POST['table'] . " WHERE id=" . $_POST['id']);
        $status = $user['status'] == 1 ? 0 : 1;
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
          $unit = $this->pdo->fetch_one("SELECT * FROM product_units WHERE id = " . $_POST['id']);
          if(!$unit) {
            $unit['code'] = $this->ProductUnitHelper->get_unit_code();
          }
          echo json_encode($unit);
        }
    }

    public function ajax_delete()
    {
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        if($id == 0){
            echo 0;
            exit();
        }
        if(($this->currentUser['permission'] == 1 || $this->currentUser['permission'] == 2) && $this->pdo->query("DELETE FROM product_units WHERE id=$id"))
        {
            echo 1;
            exit();
        }
        echo 0;
        exit;
    }
}