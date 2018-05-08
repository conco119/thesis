<?php

class ProductCatHelper extends HelpAbstract
{

    function __construct()
    {
        parent::__construct();

        $this->code_prefix =  "CID";
    }


    public function help_get_parent_name($cats, $cat, $fullName, $count)
    {
        if( $cat['parent_id'] != 0)
        {
            if($count == 0) {
                $fullName = "<li><a style='color:red' href='#'>". $cat['name'] . "</a></li>" . $fullName;
                $count++;
            }
            else
                $fullName = "<li><a href='#'>". $cat['name'] . "</a></li>" . $fullName;
            foreach($cats as $key => $value)
                if( $cat['parent_id'] == $value['id'] ) {
                    return $this->help_get_parent_name($cats, $value, $fullName, $count);
                }

        }
        else
        {
            if ($fullName == '')
                return $fullName = "<li class='active'><a style='color:red' href='#'>" .  $cat['name'] . "</a></li>";
            else
                return  "<li class='active'><a href='#'>". $cat['name'] .$fullName;
        }
    }

    public function get_product_cat_parent_select($cat_id, $parent_id)
    {
        $cats = $this->pdo->fetch_all("SELECT * FROM product_categories WHERE id <> '$cat_id'");
        $result = '<option value=0> Danh mục sản phẩm </option>';
        foreach($cats as $key => $value)
        {
            if($value['id'] == $parent_id)
                $result .= "<option value=" .$value['id'] . " selected>" . $value['name'] . "</option>";
            else
            $result .= "<option value=" .$value['id'] . ">" . $value['name'] . "</option>";
        }
        return $result;
    }

    public function get_cat_code()
    {
        $rows = $this->pdo->fetch_one("SELECT max(id) as id FROM product_categories");
        return $this->code_prefix . ($rows['id'] +1);
    }
}