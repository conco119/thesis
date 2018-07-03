<?php

class Trademark extends Main
{
    function __construct()
    {
        parent::__construct();
        $this->table = "product_trademarks";
        $this->TrademarkHelper = new TrademarkHelper();
    }

    public function index()
    {
        $this->redirectIfEmployee();

        //add or edit
        $this->create();
        $this->edit();
        //query
        $sql = "SELECT * FROM product_trademarks";
        $paging = $this->paging->get_content($this->pdo->count_rows($sql), 10);
        $sql .= $paging['sql_add'];
        $trademarks = $this->pdo->fetch_all($sql);
        foreach($trademarks as $key => $trademark)
        {
            $trademarks[$key]['status'] = $this->helper->help_get_status($trademark['status'], 'product_trademarks', $trademark['id']);
            $trademarks[$key]['updated_at'] = gmdate('d.m.Y', $trademark['updated_at'] + 7 * 3600);
            $trademarks[$key]['created_at'] = gmdate('d.m.Y', $trademark['created_at'] + 7 * 3600);
        }

        // pre($units);
        // return;
        //smarty
        $this->smarty->assign('paging', $paging);
        $this->smarty->assign('trademarks', $trademarks);
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
          $isSucceed = $this->pdo->insert('product_trademarks', $data);
          if($isSucceed)
            {
                $notification = [
                    'status' => 'success',
                    'title'  => 'Thêm thành công',
                    'text'   => "Thêm thương hiệu thành công"
                ];
                $this->smarty->assign('notification', $notification );
            }
          else
            {
                $notification = [
                    'status' => 'error',
                    'title'  => 'Thêm không thành công',
                    'text'   => "Thêm thương hiệu không thành công"
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
                    'text'   => "Sửa thương hiệu thành công"
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
          $trademark = $this->pdo->fetch_one("SELECT * FROM product_trademarks WHERE id = " . $_POST['id']);
          if(!$trademark) {
            $trademark['code'] = $this->TrademarkHelper->get_trademark_code();
          }
          echo json_encode($trademark);
        }
    }

    public function ajax_delete()
    {
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        if($id == 0){
            echo 0;
            exit();
        }
        if(($this->currentUser['permission'] == 1 || $this->currentUser['permission'] == 2) && $this->pdo->query("DELETE FROM product_trademarks WHERE id=$id"))
        {
            echo 1;
            exit();
        }
        echo 0;
        exit;
    }
}