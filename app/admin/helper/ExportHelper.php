<?php

class ExportHelper extends HelpAbstract
{

    function __construct()
    {
        parent::__construct();
        $this->code_prefix = "EXP";
    }

    public function get_export_code()
    {
        return $this->code_prefix . time();
    }



    public function get_child_products($id, $products = "", $str_id, $key)
    {
        $all_child = $this->pdo->fetch_all("SELECT * FROM product_categories WHERE parent_id = {$id}");
        // $cc = [];
        if( !empty($all_child) )
        {
            foreach($all_child as $k => $value)
            {
                $sql = "SELECT a.id,a.code,a.name,a.price_import,a.price,
                (SELECT SUM(number_count) FROM import_products WHERE a.id=product_id) imported,
                (SELECT SUM(number_count) FROM export_products WHERE a.id=product_id) exported
                FROM products a
                WHERE a.category_id = {$value['id']} AND a.id NOT IN ($str_id) AND a.status=1";

                if($key != '')
                    $sql .= " AND (a.code LIKE '%$key%' OR a.name LIKE '%$key%')";

                $products = array_merge($products, $this->pdo->fetch_all($sql));
                if($value['parent_id'] != 0)
                {
                        $products = $this->get_child_products($value['id'], $products, $str_id, $key);
                }
            }
        }
        return $products;
    }

    public function get_select_from_array($index)
    {
        $result = '';
        foreach ($this->select_export AS $k => $item) {
            if ($k == $index)
            {
                $result .= "<option value='$k' selected>" . $item . "</option>";
            }
            else
            {
                $result .= "<option value='$k'>" . $item . "</option>";
            }
        }
        return $result;
    }

    public function get_customers_with_status($customer_id)
    {
        $customers = $this->pdo->fetch_all("SELECT * FROM customers WHERE status = 1");
        $result = '';
        foreach($customers as $key => $value)
        {
            $customer_group = $this->pdo->fetch_one("SELECT * FROM customer_groups WHERE id = {$value['group_id']}");
            if($value['id'] == $customer_id)
                $result .= "<option value='{$value['id']}' selected> {$value['name']} - {$value['phone']} - {$customer_group['name']} </option>";
            else
            $result .= "<option value='{$value['id']}'> {$value['name']} - {$value['phone']} - {$customer_group['name']} </option>";
        }
        return $result;
    }
}