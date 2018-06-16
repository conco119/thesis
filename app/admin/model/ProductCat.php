<?php

class Productcat extends Main
{
    function __construct()
    {
        parent::__construct();
        $this->ProductCatHelper = new ProductCatHelper();
        $this->table = 'product_categories';
    }

    public function index()
    {
        //permission checking
        $this->redirectIfEmployee();

        //add or edit
        $this->create();
        $this->edit();
        //query
        $sql = "SELECT * FROM product_categories";
        $paging = $this->paging->get_content($this->pdo->count_rows($sql), 10);
        $sql .= $paging['sql_add'];
        $cats = $this->pdo->fetch_all($sql);
        $cats_loop = $this->pdo->fetch_all("SELECT * from product_categories");
        foreach($cats as $key => $cat)
        {
            $cats[$key]['status'] = $this->helper->help_get_status($cat['status'], 'product_categories', $cat['id'], 'activeCat');
            $cats[$key]['name'] = $this->ProductCatHelper->help_get_parent_name($cats_loop, $cat, '', 0);
            $cats[$key]['updated_at'] = gmdate('d.m.Y', $cat['updated_at'] + 7 * 3600);
        }
        // smarty
        // pre($cats);
        // return;
        $this->smarty->assign('paging', $paging);
        $this->smarty->assign('cats', $cats);
        $this->smarty->display(DEFAULT_LAYOUT);
    }
    //not using view from here

    public function create()
    {
        if( isset($_POST['submit']) && $_POST['id'] == 0 )
        {
          $data['code'] = $_POST['code'];
          $data['name'] = $_POST['name'];
          $data['parent_id'] = $_POST['parent_id'];
          $data['status'] = isset($_POST['status']) ? 1 : 0;
          $data['created_at'] = time();
          $data['updated_at'] = time();
          $isSucceed = $this->pdo->insert('product_categories', $data);
          if($isSucceed)
          {
              $notification = [
                  'status' => 'success',
                  'title'  => 'Thêm thành công',
                  'text'   => "Thêm danh mục sản phẩm thành công"
              ];
              $this->smarty->assign('notification', $notification );
          }
        else
          {
              $notification = [
                  'status' => 'error',
                  'title'  => 'Thêm không thành công',
                  'text'   => "Thêm danh mục sản phẩm không thành công"
              ];
              $this->smarty->assign('notification', $notification);
          }

        }
    }
    public function edit()
    {
        if( isset($_POST['submit']) && $_POST['id'] != 0 )
        {
        $data['code'] = $_POST['code'];
        $data['name'] = $_POST['name'];
        $data['parent_id'] = $_POST['parent_id'];
        $data['status'] = isset($_POST['status']) ? 1 : 0;
        $data['updated_at'] = time();
        // $sql = "UPDATE product_categories SET code = " . "{$data["code"]}" . "name = " . $data['name'] . "parent_id = " . $data['parent_id'] . "status = " . $data['status'];
        // $sql = "UPDATE product_categories SET code = '{$data["code"]}' AND name = '{$data["name"]}' AND parent_id = '{$data['parent_id']}' AND status = {$data["status"]} AND updated_at = {$data['updated_at']} WHERE id = {$_POST['id']}";
        // pre($sql);
        // $isSucceed  = $this->pdo->query($sql);
        // $isSucceed = $this->slim_pdo->update('product_categories', $data, "id=" . $_POST['id']);
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
                    'text'   => "Sửa danh mục sản phẩm thành công"
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
    public function ajax_active_cat()
    {
      if(isset($_POST['table']) && isset($_POST['id']) && ($this->currentUser['permission'] == 1 || $this->currentUser['permission'] == 2))
      {
        $user = $this->pdo->fetch_one("SELECT status FROM " . $_POST['table'] . " WHERE id=" . $_POST['id']);
        $status = $user['status'] == 1 ? 0 : 1;
        $this->pdo->query("UPDATE " . $_POST['table'] . " SET status = '$status' WHERE id=" . $_POST['id']);
        echo $this->helper->help_get_status($status, $_POST['table'], $_POST['id'], 'activeCat');
        exit();
      }
      else
      {
        echo 0;
        exit();
      }
    }

    public function ajax_load_category()
    {
        if( isset($_POST['id']) )
        {
          $cat = $this->pdo->fetch_one("SELECT * FROM product_categories WHERE id = " . $_POST['id']);
          if(!$cat) {
            $cat['code'] = $this->ProductCatHelper->get_cat_code();
          }
          $cat['parent_option'] = $this->ProductCatHelper->get_product_cat_parent_select($cat['id'], $cat['parent_id']);
          echo json_encode($cat);
        }
    }

    public function ajax_delete()
    {
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        if($id == 0){
            echo 0;
            exit();
        }
        if(($this->currentUser['permission'] == 1 || $this->currentUser['permission'] == 2) && $this->pdo->query("DELETE FROM product_categories WHERE id=$id"))
        {
            echo 1;
            exit();
        }
        echo 0;
        exit;
    }
}