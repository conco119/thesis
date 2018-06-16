<?php

class Order extends Main
{
    function __construct()
    {
        parent::__construct();
        $this->OrderHelper = new OrderHelper();
        $this->table = 'orders';
    }

    public function index()
    {

        $sql = "SELECT * FROM orders";
        $paging = $this->paging->get_content($this->pdo->count_rows($sql), 10);
        $sql .= $paging['sql_add'];
        $orders = $this->pdo->fetch_all($sql);
        foreach($orders as $key => $order)
        {
            $orders[$key]['status'] = $this->helper->help_get_status($order['status'], 'orders', $order['id']);
            $orders[$key]['created_at'] =  gmdate("H:i A d/m/Y", time() + 7 * 3600);
        }

        // $this->smarty->assign('isSucceed', 'Xóa thành công r');
        $this->smarty->assign('paging', $paging);
        $this->smarty->assign('orders', $orders);
        $this->smarty->display(DEFAULT_LAYOUT);
    }

    public function ajax_active()
    {
      if( isset($_POST['table']) && isset($_POST['id']) )
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

    public function ajax_delete()
    {
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

        if($id == 0){
            echo 0;
            exit();
        }
        if($this->currentUser['permission'] == 1 || $this->currentUser['permission'] == 2 )
        {
            if( $this->pdo->query("DELETE * FROM order_products WHERE order_id=$id") && $this->pdo->query("DELETE FROM orders WHERE id=$id"))
            {
                echo 1;
                exit();
            }
        }
        echo 0;
        exit;
    }

    function ajax_get_detail_order()
    {
        $id = $_POST['id'];
        $sql = "SELECT * FROM orders WHERE id = $id";
        $order = $this->pdo->fetch_one($sql);

        $order['date'] = gmdate('d-m-Y', $order['created_at'] + 7 * 3600);
        $order['created_at'] = gmdate("H:i A d/m/Y", $order['created_at'] + 7 * 3600);
        if($order['type'] == 1)
            $order['type'] = "Chuyển khoản ngân hàng";
        else
            $order['type'] = "Thanh toán khi nhận hàng";
        $sql = "SELECT a.*, u.name as unit_name, p.name, p.price, p.is_discount, p.discount_type, p.discount
        FROM order_products a
        LEFT JOIN products p ON a.product_id = p.id
        LEFT JOIN product_units u ON p.unit_id = u.id
        WHERE order_id = $id";
        $order['products'] = $this->pdo->fetch_all($sql);
        foreach ($order['products'] as $key => $value)
        {
            if( $value['is_discount'] == 1)
            {
                switch($value['discount_type'])
                {
                  case 1:
                      $order['products'][$key]['price'] = $value['price'] - (($value['price'] * $value['discount'])/100);
                      break;
                  case 2:
                      $order['products'][$key]['price'] = $value['price'] -  $value['discount'];
                      break;
                }
            }
        }

        $sql = "SELECT a.*, s.name, s.price
        FROM order_services a
        LEFT JOIN services s ON a.service_id = s.id
        WHERE order_id = $id";

        $order['services'] = $this->pdo->fetch_all($sql);
        $total_money = 0;
        foreach ($order['products'] as $key => $value)
        {
           $total_money += $value['price'] * $value['number_count'];
        }
        foreach ($order['services'] as $key => $value)
        {
           $total_money += $value['price'] * $value['number_count'];
        }
        $order['total_money'] = $total_money;
        echo json_encode($order);
        exit();
    }

}