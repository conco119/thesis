<?php

class Customer extends Main
{
    function __construct()
    {
        parent::__construct();
        $this->CustomerHelper = new CustomerHelper();
        $this->table = "customers";
    }

    public function index()
    {
        //testing
        //add or edit
        $this->create();
        $this->edit();
        //query customer

        $group_id = isset($_GET['group_id']) ? intval($_GET["group_id"]) : 0;
        $key = isset($_GET['key']) ? $_GET["key"] : "";
        $out['key'] = $key;
        $sql_where = "";
        if ($key != "")
        {
            $sql_where .= " AND  (a.code LIKE '%$key%' OR a.name LIKE '%$key%')";
        }
        if ($group_id != 0)
        {
            $sql_where .= " AND  cg.id = $group_id";
        }
        $sql = "SELECT a.*,
            ( SELECT sum(must_pay) FROM exports WHERE  customer_id = a.id ) as must_pay,
            ( SELECT sum(payment) FROM exports WHERE customer_id = a.id ) as payment,
            ( SELECT sum(money) FROM money m WHERE m.object = 'cus' AND m.object_id = a.id AND m.is_auto = 0  AND m.is_import = 0) as pay_to_cus,
            ( SELECT sum(money) FROM money m WHERE m.object = 'cus' AND m.object_id = a.id AND m.is_auto = 0  AND m.is_import = 1) as cus_pay_to
            FROM {$this->table} a
            LEFT JOIN customer_groups cg ON cg.id = a.group_id WHERE 1=1 $sql_where";
        $paging = $this->paging->get_content($this->pdo->count_rows($sql), 20);
        $sql .= $paging['sql_add'];
        $customers = $this->pdo->fetch_all($sql);
        $total_money = 0;
        $total_must_pay = 0;
        foreach($customers as $key => $customer)
        {
            $customers[$key]['status'] = $this->helper->help_get_status($customer['status'], $this->table, $customer['id']);
            $customers[$key]['updated_at'] = gmdate('d.m.Y', $customer['updated_at'] + 7 * 3600);
            $customers[$key]['created_at'] = gmdate('d.m.Y', $customer['created_at'] + 7 * 3600);
            $customers[$key]['group'] = $this->CustomerHelper->help_get_group($customer['group_id']);
            $customers[$key]['creator'] = $this->CustomerHelper->help_get_creator($customer['creator']);
            $customers[$key]['money'] = ( $customer['payment'] - $customer['must_pay'] ) + ( $customer['cus_pay_to']  - $customer['pay_to_cus']);
            $total_money += $customers[$key]['money'];
            $total_must_pay += $customer['must_pay'];
        }
        $out['total_money'] = $total_money;
        $out['total_must_pay'] = $total_must_pay;
        //query customer group
        $sql = "SELECT * FROM customer_groups";
        $customer_groups = $this->pdo->fetch_all($sql);
        $customer_groups = $this->CustomerHelper->help_get_customer_category_option($customer_groups, $group_id);
        // pre($customers);
        // return;
        //smarty
        $this->smarty->assign('paging', $paging);
        $this->smarty->assign('out', $out);
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
      if(isset($_POST['table']) && isset($_POST['id']))
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
        if($this->pdo->query("DELETE FROM {$this->table} WHERE id=$id"))
        {
            echo 1;
            exit();
        }
        echo 0;
        exit;
    }

    function ajax_insert_item()
    {
        if (isset($_POST['code']))
        {
            $data['code'] = $_POST['code'];
            $data['name'] = $_POST['name'];
            $data['group_id'] = $_POST['group_id'];
            $data['phone'] = $_POST['phone'];
            $data['address'] = $_POST['address'];
            $data['gender'] = 1;
            $data['email'] = "";
            $data['birthday'] = gmdate("Y.m.d");
            $data['creator'] = $this->currentUser['id'];
            $data['status'] = 1;
            $data['updated_at'] = time();
            $data['created_at'] = time();
            $id = $this->pdo->insert("customers", $data);

            $value['id'] = $id;
            // $value['categories'] = $this->customer->get_select_customers_payment($this->dbo, $id, 0);
            $value['categories'] = $this->helper->get_option_customer_export($id);
            echo json_encode($value);
            $this->pdo->close();
            exit();
        }

    }

}