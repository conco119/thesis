<?php

class ProductHelper extends HelpAbstract
{

    function __construct()
    {
        parent::__construct();
        $this->code_prefix = "PDID";
    }

    function help_get_category($category_id)
    {
        return $this->pdo->fetch_one("SELECT * FROM product_categories WHERE id = {$category_id}");
    }

}