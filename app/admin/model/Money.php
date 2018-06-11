<?php

class Money extends Main
{
    function __construct()
    {
        parent::__construct();
        $this->MoneyHelper = new MoneyHelper();
        $this->table = 'money';
        $this->prefix_code = "MN";
        $this->from_type = array(
            'imp' => 'Thanh toán hóa đơn nhập',
            'exp' => 'Thanh toán hóa đơn bán',
            'reimp' => 'Khách trả hàng',
            'srv' => 'Trả hàng nhà cung cấp'
        );
    }

    public function index()
    {
        $this->create();
        $this->edit();
        $date_export = isset($_GET['date']) ? intval($_GET["date"]) : 0;
        $out['select_export'] = $this->helper->get_option(0, 'select_export', $date_export);
        if($date_export != 0)
        {
            switch($date_export)
            {
            case 1:
                $sql_where .= " AND a.date = CURDATE()";
                break;
            case 2:
                $sql_where .= " AND WEEK(a.date) = WEEK(CURDATE()) AND YEAR(a.date) = YEAR(CURDATE())";
                break;
            case 3:
                $sql_where .= " AND MONTH(a.date) = MONTH(CURDATE()) AND YEAR(a.date) = YEAR(CURDATE())";
                break;
            }
        }

        $sql = "SELECT a.*, c.name AS category,
            CASE a.object
                WHEN 'cus' THEN (SELECT name FROM customers WHERE id = a.object_id)
                WHEN 'sup' THEN (SELECT name FROM suppliers WHERE id = a.object_id)
                WHEN 'usr' THEN (SELECT name FROM users WHERE id = a.object_id)
                ELSE ''
            END as object_name
            FROM money AS a
            LEFT JOIN money_categories c ON a.category_id = c.id
            WHERE 1=1 $sql_where
            ORDER BY id DESC
        ";


        $paging = $this->paging->get_content($this->pdo->count_rows($sql), 20);
        $sql .= $paging['sql_add'];
        // pre($sql);
        // die();
        $money_statistic = $this->pdo->fetch_all($sql);
        // pre($money_statistic);
        foreach($money_statistic as $k =>$item)
        {
            if( $item['from_type'] != '')
            $money_statistic[$k]['category'] = $this->from_type[$item['from_type']];
            $money_statistic[$k]['money_type'] = $item['is_import'] == 1 ? "<i class=\"fa fa-plus\"/></i> Phiếu thu" : "<i class=\"fa fa-mail-reply-all\"/></i> Phiếu chi";
            $money_statistic[$k]['updated_at'] = gmdate('H:i d/m/Y', $item['updated_at']+7*3600);
            $money_statistic[$k]['btn'] = $this->MoneyHelper->get_money_btn($item['id'], $item['is_import'], $item['from_type'], $item['from_id']);
        }
        $this->smarty->assign('result', $money_statistic);
        //
        $out['object'] = $this->helper->get_option(0, 'object', 0 , 1, 'Lựa chọn đối tượng');
        $this->smarty->assign('out', $out);
        // tong tien
        $sql = "SELECT sum(money) AS import,
                (SELECT sum(money) FROM money a WHERE a.is_import = 0) AS export
                FROM money a WHERE a.is_import =1
        ";
        $money = $this->pdo->fetch_all($sql);
        $money['import'] = isset($money[0]['import']) ? intval($money[0]['import']) : 0;
        $money['export'] = isset($money[0]['export']) ? intval($money[0]['export']) : 0;
        $money['total'] = $money['import'] - $money['export'];
        $this->smarty->assign('money', $money);
        $this->smarty->assign('paging', $paging);
        $this->smarty->display(DEFAULT_LAYOUT);
    }

    public function create()
    {
        if( isset($_POST['submit']) && $_POST['id'] == 0)
        {
            echo "here";
            $data['code'] = $this->prefix_code . time();
            $data['description'] = $_POST['description'];
            $data['money'] = $this->dstring->convert_price_to_int($_POST['money']);
            $data['category_id'] = $_POST['category_id'];
            $data['date'] = gmdate('Y-m-d', strtotime($_POST['date']) + 7 *3600);
            $data['is_import'] = $_POST['is_import'] == 'import' ? 1 : 0;
            $data['object'] = $this->MoneyHelper->get_object_name($_POST['object']);
            $data['object_id'] = $_POST['object_id'];
            $data['creator'] = $this->currentUser['id'];
            $data['type'] = isset($_POST['type']) ? 1 : 0;
            $data['is_auto'] = 0;
            $data['created_at'] = time();
            $data['updated_at'] = time();
            // pre($data);
            // pre($_POST);
            // die();
            $this->pdo->insert($this->table, $data);
            lib_redirect();
        }
    }


    public function edit()
    {
        if( isset($_POST['submit']) && $_POST['id'] != 0 )
        {

            $data['date'] = gmdate('Y-m-d', strtotime($_POST['date']) + 7 *3600);
            $data['object'] = $this->MoneyHelper->get_object_name($_POST['object']);
            $data['object_id'] = $_POST['object_id'];
            $data['category_id'] = $_POST['category_id'];
            $data['money'] = $this->dstring->convert_price_to_int($_POST['money']);
            $data['description'] = $_POST['description'];
            $data['type'] = isset($_POST['type']) ? 1 : 0;
            $data['updated_at'] = time();
            $this->pdo->update($this->table, $data, 'id='. $_POST['id']);
            lib_redirect();
        }
    }
    public function ajax_load_all_money_cat()
    {
        $money_cats = $this->pdo->fetch_all("SELECT * FROM money_categories WHERE id NOT IN (1,2)");
        foreach ($money_cats as $key => $value)
        {
            $money_cats[$key]['is_import'] = $value['is_import'] == 1 ? "Thu" : "Chi";
            $money_cats[$key]['status'] = $this->helper->help_get_status($value['status'], 'money_categories', $value['id']);
        }
        echo json_encode($money_cats);
        exit();
    }

    public function ajax_load_money_cat()
    {
        if(isset($_POST['id']))
        {
            $money_cat = $this->pdo->fetch_all("SELECT * FROM money_categories WHERE id = {$_POST['id']}");
        }
        echo json_encode($money_cat);
        exit();
    }
    public function ajax_update_money_cat()
    {
        $data['name'] = $_POST['name'];
        $data['code'] = $_POST['code'];
        $data['description'] = $_POST['description'];
        $data['status'] = $_POST['status'] == "true" ?  1 : 0 ;
        pre($_POST);
        pre($data);
        $this->pdo->update("money_categories", $data, "id=". $_POST['id']);
        exit();
    }
    public function ajax_add_money_cat()
    {

        $data['name'] = $_POST['name'];
        $data['code'] = $_POST['code'];
        $data['description'] = $_POST['description'];
        $data['status'] = $_POST['status'] == "true" ?  1 : 0 ;
        $data['is_import'] = $_POST['type'] == 'import' ? 1 : 0;

        $id = $this->pdo->insert("money_categories", $data);
        if($id)
        {
            echo 1;
        }
        $this->pdo->close();
        exit();
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
    public function ajax_delete_cat()
    {
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        if($id == 0){
            echo 0;
            exit();
        }
        if(($this->currentUser['permission'] == 1 || $this->currentUser['permission'] == 2) && $this->pdo->query("DELETE FROM money_categories WHERE id=$id"))
        {
            echo 1;
            exit();
        }
        echo 0;
        exit;
    }
    public function ajax_delete()
    {
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        if($id == 0){
            echo 0;
            exit();
        }
        if(($this->currentUser['permission'] == 1 || $this->currentUser['permission'] == 2) && $this->pdo->query("DELETE FROM money WHERE id=$id"))
        {
            echo 1;
            exit();
        }
        echo 0;
        exit;
    }

    public function ajax_get_code()
    {
        echo $this->MoneyHelper->get_code();
    }

    public function ajax_load_data_for_adding()
    {
        if( $_POST['is_import'] == 1)
            $data['category'] = $this->MoneyHelper->get_option_money_type(1);
        else
            $data['category'] = $this->MoneyHelper->get_option_money_type(0);
        $data['date'] =  gmdate("d-m-Y", time() + 7 * 3600);
        echo json_encode($data);
        $this->pdo->close();
        exit();
    }

    public function ajax_load_select_object()
    {
        $out = '';
        if( isset($_POST['type']) )
        {
            switch($_POST['type'])
            {
                case 1:
                    $out = $this->helper->get_option(1, 'customer_groups', 0 ,1, "Lựa chọn nhóm khách hàng");
                    break;

                case 2:
                    $out = $this->helper->get_option(1, 'suppliers', 0 ,1, "Lựa chọn nhà cung cấp");
                    break;

                case 3:
                    $out = $this->helper->get_option(1, 'users', 0 ,1, "Lựa chọn nhân viên");
                    break;
            }
        echo $out;
        }
    }

    public function ajax_load_customer()
    {
        if( isset($_POST['type']) )
        {
            $customers = $this->pdo->fetch_all("SELECT * FROM customers WHERE group_id = {$_POST['type']}");
            $customers = $this->MoneyHelper->get_customer_option($customers);
        }
        echo $customers;
    }



    public function ajax_load_info_money_cat()
    {
        if( isset($_POST['id']) )
        {
            $money_cat = $this->pdo->fetch_one("SELECT * FROM money_categories WHERE id = {$_POST['id']}");
            echo json_encode($money_cat);
            exit();
        }
    }

    function ajax_load_money()
    {
        if (isset($_POST['id']))
        {
          $money = $this->pdo->fetch_one("SELECT * FROM money WHERE id=" . $_POST['id']);
          $data['category'] = $this->MoneyHelper->get_option_money_type($_POST['is_import'], $money['category_id']);
          switch($money['object'])
          {
            case "cus":
                $data['object'] = $this->helper->get_option(0, 'object', 1);
                $data['object_id'] = $this->helper->get_option(1, 'customers', $money['object_id']);
                break;
            case "sup":
                $data['object'] = $this->helper->get_option(0, 'object', 2);
                $data['object_id'] = $this->helper->get_option(1, 'suppliers', $money['object_id']);
                break;
            case "usr":
                $data['object'] = $this->helper->get_option(0, 'object', 3);
                $data['object_id'] = $this->helper->get_option(1, 'users', $money['object_id']);
                break;
          }
            $data['date'] = gmdate('d-m-Y', strtotime($money['date']) +7 *3600);
            $data['money'] = number_format($money['money']);
            $data['description'] = $money['description'];
            $data['type'] = $money['type'];
            echo json_encode($data);
            $this->pdo->close();
            exit();
		}
        echo 0;
        $this->pdo->close();
		exit();
    }



}
