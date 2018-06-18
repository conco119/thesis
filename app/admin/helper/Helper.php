<?php

class Helper extends HelpAbstract
{
    function __construct()
    {
        parent::__construct();
    }
    public function help_get_status($status, $table, $id, $custom_function="activeStatus")
    {
        $status = $status == 1 ? 1 : 0;
        $result = "<button type=\"button\" class=\"btn ";
        if ($status == 1)
            $result .= "btn-success ";
        else
            $result .= "btn-danger ";
        $result .= "btn-xs btn-status\" onclick=\"$custom_function('$table', '$id');\">";
        if ($status == 1)
            $result .= "<i class=\"fa fa-check\"></i>";
        else
            $result .= "<i class=\"fa fa-close\"></i>";
        $result .= "</button>";

        return $result;
    }

    function get_user_birthday_select($birthday="1990-01-01")
    {
		$active['day'] = date("d", strtotime($birthday));
		$active['month'] = date("m", strtotime($birthday));
		$active['year'] = date("Y", strtotime($birthday));

		$result['day'] = "";
		for($i=1; $i<=31; $i++){
			if($i == $active['day']){
				$result['day'] .= "<option value='$i' selected>" . $i . "</option>";
			}
			else {
				$result['day'] .= "<option value='$i'>" . $i . "</option>";
			}
		}
		unset($i);

		$result['month'] = "";
		for($i=1; $i<=12; $i++){
			if($i == $active['month']){
				$result['month'] .= "<option value='$i' selected>" . $i . "</option>";
			}
			else {
				$result['month'] .= "<option value='$i'>" . $i . "</option>";
			}
		}
		unset($i);

		$result['year'] = "";
		for($i=2010; $i>=1950; $i--){
			if($i == $active['year']){
				$result['year'] .= "<option value='$i' selected>" . $i . "</option>";
			}
			else {
				$result['year'] .= "<option value='$i'>" . $i . "</option>";
			}
		}
		unset($i);

		return $result;
    }

    public function get_user_gender_select($gender)
    {
        $result = '';
        foreach($this->gender as $key => $value)
        {
            if($key == $gender)
                $result .= "<option value='$key' selected>$value</option>";
            else
                $result .= "<option value='$key'>$value</option>";
        }
        return $result;
    }

    public function help_get_discount_option($type)
    {
        $result = '';
        foreach($this->discount_type as $key => $value)
        {
            if($key == $type)
                $result .= "<option value='$key' selected>$value</option>";
            else
                $result .= "<option value='$key'>$value</option>";
        }
        return $result;
    }


    //first parm @table
    //second if is table $condition = table name ,else $condition is property
    // $id
    public function get_option($isTable, $condition, $id =0, $is_zero = 0, $cat_zero_name = "Chọn danh mục")
    {
        $result = '';
        if($isTable)
        {
            if($is_zero == 1)
            {
                $result = "<option value=0>{$cat_zero_name}</option>";
                $query_result = $this->pdo->fetch_all("SELECT * FROM {$condition}");
                foreach($query_result as $key => $value)
                {
                    if($value['id'] == $id)
                        $result .= "<option value='{$value['id']}' selected>{$value['name']}</option>";
                    else
                    $result .= "<option value='{$value['id']}'>{$value['name']}</option>";
                }
                return $result;
            }
            else
            {
                $query_result = $this->pdo->fetch_all("SELECT * FROM {$condition}");
                foreach($query_result as $key => $value)
                {
                    if($value['id'] == $id)
                        $result .= "<option value='{$value['id']}' selected>{$value['name']}</option>";
                    else
                    $result .= "<option value='{$value['id']}'>{$value['name']}</option>";
                }
                return $result;

            }

        }
        else
        {
            if($is_zero == 1)
            {
                $result = "<option value=0>{$cat_zero_name}</option>";
                foreach($this->$condition as $key => $value)
                {
                    if($key == $id)
                        $result .= "<option value='{$key}' selected>{$value}</option>";
                    else
                        $result .= "<option value='{$key}'>{$value}</option>";
                }
                return $result;
            }
            else
            {
                foreach($this->$condition as $key => $value)
                {
                    if($key == $id)
                        $result .= "<option value='{$key}' selected>{$value}</option>";
                    else
                        $result .= "<option value='{$key}'>{$value}</option>";
                }
                return $result;

            }
        }

    }

    public function get_child_products($id, $products, $str_id, $key, $trade)
    {
        $all_child = $this->pdo->fetch_all("SELECT * FROM product_categories WHERE parent_id = {$id}");
        // $cc = [];
        if( $all_child )
        {

            foreach($all_child as $value)
            {

                $sql = "SELECT a.id, a.code, a.name, a.price_import, a.price,
                (SELECT SUM(number_count) FROM import_products WHERE a.id=product_id) imported,
                (SELECT SUM(number_count) FROM export_products WHERE a.id=product_id) exported
                FROM products a
                WHERE a.category_id = {$value['id']} AND a.id NOT IN ($str_id) AND a.status=1";

                if ($trade != 0)
                    $sql .= " AND a.trademark_id = $trade";
                if($key != '')
                    $sql .= " AND (a.code LIKE '%$key%' OR a.name LIKE '%$key%')";

                $products = array_merge($products, $this->pdo->fetch_all($sql) );

                if($value['parent_id'] != 0)
                {
                    $products = $this->get_child_products($value['id'], $products, $str_id, $key, $trade);
                }

            }
        }
        return $products;
    }

    public function get_option_customer_export($id)
    {
        $sql = "SELECT a.id, a.code, a.name, b.name as group_name FROM customers a LEFT JOIN customer_groups b  ON a.group_id = b.id WHERE a.status = 1";
        $customers = $this->pdo->fetch_all($sql);

        $result = "<option value='0'> Chọn khách hàng </option>";
        foreach($customers as $k => $customer)
        {
            if($customer['id'] == $id)
                $result .= "<option value='{$customer['id']}' selected>{$customer['code']}-{$customer['name']}-{$customer['group_name']}</option>";
            else
                $result .= "<option value='{$customer['id']}'>{$customer['code']}-{$customer['name']}-{$customer['group_name']}</option>";
        }
        return $result;
    }
    function check_type($type)
    {
        return in_array($type, $this->true_type);
    }
    // lọc tuần, tháng , năm
    function get_select_from_array($index)
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

    public function get_option_with_status($table, $match_id = 0)
    {
        $query_result = $this->pdo->fetch_all("SELECT * FROM $table WHERE status = 1");
        foreach($query_result as $key => $value)
        {
            if($value['id'] == $match_id)
                $result .= "<option value='{$value['id']}' selected>{$value['name']}</option>";
            else
            $result .= "<option value='{$value['id']}'>{$value['name']}</option>";
        }
        return $result;
    }

    public function get_option_properties($property, $match_id = 0)
    {
        $result = '';
        foreach($this->$property as $key => $value)
        {
            if($key == $match_id)
                $result .= "<option value='{$key}' selected>{$value}</option>";
            else
                $result .= "<option value='{$key}'>{$value}</option>";
        }
        return $result;
    }
}
