<?php

class Money extends Main
{
    function __construct()
    {
        parent::__construct();
        $this->MoneyHelper = new MoneyHelper();
        $this->table = 'money';
    }

    public function index()
    {
        $sql = "SELECT a.*, c.name AS category,
            CASE a.object
                WHEN 'cus' THEN (SELECT name FROM customers WHERE id = a.object_id)
                WHEN 'sup' THEN (SELECT name FROM suppliers WHERE id = a.object_id)
                WHEN 'usr' THEN (SELECT name FROM users WHERE id = a.object_id)
                ELSE ''
            END as object_name
            FROM money AS a
            LEFT JOIN money_categories c ON a.category_id = c.id
            ORDER BY id DESC
        ";


        $paging = $this->paging->get_content($this->pdo->count_rows($sql), 10);
        $sql .= $paging['sql_add'];
        $money_statistic = $this->pdo->fetch_all($sql);
        // pre($money_statistic);
        foreach($money_statistic as $k =>$item)
        {
            $money_statistic[$k]['money_type'] = $item['is_import'] == 1 ? "<i class=\"fa fa-plus\"/></i> Phiếu thu" : "<i class=\"fa fa-mail-reply-all\"/></i> Phiếu chi";
            $money_statistic[$k]['updated_at'] = gmdate('H:i d/m/Y', $item['updated_at']+7*3600);
        }
        $this->smarty->assign('result', $money_statistic);
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
        $this->smarty->display(DEFAULT_LAYOUT);
    }


    public function ajax_load_item()
    {
        if (isset($_POST['id']))
        {


			$value = $this->pdo->fetch_one("SELECT * FROM money WHERE id=" . $_POST['id']);
			$value['money'] = number_format($value['money']);
			$value['date'] = isset($value['date']) ? date("d-m-Y", strtotime($value['date'])) : gmdate("d-m-Y", time() + 7 * 3600);
			$value['category'] = $this->get_select_money_types(@$value['category_id'], $_POST['is_import']);

			if(!isset($value['object']) || @$value['object']=='')
				$value['object_id'] = '';
			elseif (@$value['object']=='usr')
				$value['object_id'] = $this->user->get_select_users($this->dbo, @$value['object_id'], 1);
			elseif (@$value['object']=='cus')
				$value['object_id'] = $this->customer->get_select_customers_payment($this->dbo, @$value['object_id'], 0);
			elseif (@$value['object']=='sup')
				$value['object_id'] = $this->customer->get_select_suppliers($this->dbo, @$value['object_id'], 1);

			$value['object'] = $this->help->get_select_from_array($this->object, @$value['object'], 'Lựa chọn đối tượng');

			echo json_encode($value);
			$this->dbo->close();
			exit();
		}
		echo 0;
		exit();
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

}