<?php

class Productcat extends Main
{
    function __construct()
    {
        parent::__construct();
        $this->ProductCatHelper = new ProductCatHelper();
    }

    public function index()
    {

        $sql = "SELECT * FROM product_categories";
        $paging = $this->paging->get_content($this->pdo->count_rows($sql), 10);
        $sql .= $paging['sql_add'];
        $cats = $this->pdo->fetch_all($sql);
        $cats_loop = $this->pdo->fetch_all("SELECT * from product_categories");
        foreach($cats as $key => $cat)
        {
            $cats[$key]['status'] = $this->helper->help_get_status($cat['status'], 'product_categories', $cat['id'], 'activeCat');
            $cats[$key]['name'] = $this->ProductCatHelper->help_get_parent_name($cats_loop, $cat, '');
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

    public function create_cat()
    {
        if( isset($_POST['submit']) )
        {
          $data['code'] = $_POST['code'];
          $data['name'] = $_POST['name'];
          $data['parent_id'] = $_POST['parent_id'];
          $data['status'] = isset($_POST['status']) ? 1 : 0;
          $data['created_at'] = time();
          $data['updated_at'] = time();
          $this->pdo->insert('product_categories', $data);
          lib_redirect_back();
        }
    }
    public function edit_cat()
    {
        $cat = $this->pdo->fetch_one("SELECT * from product_categories where id=" . $_POST['id']);
        if( isset($_POST['submit']) )
        {
        $data['code'] = $_POST['code'];
        $data['name'] = $_POST['name'];
        $data['parent_id'] = $_POST['parent_id'];
        $data['status'] = isset($_POST['status']) ? 1 : 0;
        $data['updated_at'] = time();
        $this->pdo->update('product_categories', $data, "id=" . $_POST['id']);
        lib_redirect_back();
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