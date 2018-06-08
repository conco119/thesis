<?php

class Helper extends HelpAbstract
{
    function __construct()
    {
        parent::__construct();
    }

    function get_child_category($id, $DSTRING)
    {
        $all_child =  $this->pdo->fetch_all("SELECT * FROM product_categories WHERE parent_id = $id");

        foreach ($all_child as $key => $value)
        {
            $all_child[$key]['link'] = $DSTRING->str_convert($value['name']);
        }
        return $all_child;
    }

}
