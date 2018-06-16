<?php

class Service extends Main
{
    function __construct()
    {
        parent::__construct();
        $this->ServiceHelper = new ServiceHelper();
        $this->table = "services";
    }

    public function index()
    {
        $this->redirectIfEmployee();

        //add or edit
        $this->create();
        $this->edit();
        //query
        $sql = "SELECT * FROM services";
        $paging = $this->paging->get_content($this->pdo->count_rows($sql), 10);
        $sql .= $paging['sql_add'];
        $services = $this->pdo->fetch_all($sql);
        foreach($services as $key => $service)
        {
            $services[$key]['status'] = $this->helper->help_get_status($service['status'], 'services', $service['id']);
            $services[$key]['price'] = $this->dstring->get_price($service['price']);
            $services[$key]['updated_at'] = gmdate('d.m.Y', $service['updated_at'] + 7 * 3600);
            $services[$key]['created_at'] = gmdate('d.m.Y', $service['created_at'] + 7 * 3600);
        }

        // pre($units);
        // return;
        //smarty
        $this->smarty->assign('paging', $paging);
        $this->smarty->assign('services', $services);
        $this->smarty->display(DEFAULT_LAYOUT);
    }
    //not using view from here

    public function create()
    {
        if( isset($_POST['submit']) && $_POST['id'] == 0 )
        {
          $data['code'] = $_POST['code'];
          $data['name'] = $_POST['name'];
          $data['price'] = $this->dstring->convert_price_to_int($_POST['price']);
          $data['status'] = isset($_POST['status']) ? 1 : 0;
          $data['description'] = "";
          $data['created_at'] = time();
          $data['updated_at'] = time();
          $isSucceed = $this->pdo->insert('services', $data);
          if($isSucceed)
            {
                $notification = [
                    'status' => 'success',
                    'title'  => 'Thêm thành công',
                    'text'   => "Thêm dịch vụ thành công"
                ];
                $this->smarty->assign('notification', $notification );
            }
          else
            {
                $notification = [
                    'status' => 'error',
                    'title'  => 'Thêm không thành công',
                    'text'   => "Thêm dịch vụ không thành công"
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
            $data['price'] = $this->dstring->convert_price_to_int($_POST['price']);
            $data['description'] = $_POST['description'];
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
                    'text'   => "Sửa dịch vụ thành công"
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
          $service = $this->pdo->fetch_one("SELECT * FROM services WHERE id = " . $_POST['id']);
          if(!$service) {
            $service['code'] = $this->ServiceHelper->get_service_code();
          }
          else {
            $service['price'] = $service['price'] > 0 ? number_format($service['price']) : "";
          }
          echo json_encode($service);
        }
    }

    public function ajax_delete()
    {
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        if($id == 0){
            echo 0;
            exit();
        }
        if(($this->currentUser['permission'] == 1 || $this->currentUser['permission'] == 2) && $this->pdo->query("DELETE FROM services WHERE id=$id"))
        {
            echo 1;
            exit();
        }
        echo 0;
        exit;
    }
}