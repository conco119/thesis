<?php

class Report extends Main
{
    function __construct()
    {
        parent::__construct();
    }

    function performance()
    {
        $this->redirectIfEmployee();
        $this->redirectIfManager();
        // doanh thu sản phẩm, vốn sản phẩm
        $date_export = isset($_GET['date']) ? intval($_GET["date"]) : 0;
        $out['select_export'] = $this->helper->get_option(0, 'select_export', $date_export);
        $sql_filter = '';
        if($date_export != 0)
        {
          switch($date_export)
          {
            case 1:
              $sql_filter = " AND a.date = CURDATE()";
              break;
            case 2:
              $sql_filter = " AND WEEK(a.date) = WEEK(CURDATE()) AND YEAR(a.date) = YEAR(CURDATE())";
              break;
            case 3:
              $sql_filter = " AND MONTH(a.date) = MONTH(CURDATE()) AND YEAR(a.date) = YEAR(CURDATE())";
              break;
          }
        }
        // $sql = "SELECT sum(e.price * e.number_count) as total, sum(e.price_import * e.number_count) as cost FROM export_products e LEFT JOIN exports a ON a.id = e.export_id WHERE 1=1" . $sql_filter;
        $sql = "SELECT sum(price*number_count) as total, sum(price_import*number_count) as cost FROM export_products e LEFT JOIN exports a ON a.id = export_id WHERE 1=1 $sql_filter";
        $total_product = $this->pdo->fetch_one($sql);
        $perform['total_product'] = $total_product['total'];
        $perform['total_cost'] = $total_product['cost'];

        // doanh thu dịch vụ
        $sql = "SELECT sum(price * number_count) as total FROM export_services LEFT JOIN exports  a ON  a.id=export_id WHERE 1=1 $sql_filter";
        $total_service= $this->pdo->fetch_one($sql);
        $perform['total_service'] = $total_service['total'];
        $perform['total'] = $total_product['total'] - $total_product['cost'] + $total_service['total'];

        // chi phí khác

        $sql = "SELECT sum(a.money) as money_exp FROM money a WHERE is_import = 0 and type = 1  $sql_filter";
        $total_exp = $this->pdo->fetch_one($sql);
        $perform['money_exp'] = $total_exp['money_exp'];

        // doanh thu khác
        $sql = "SELECT sum(a.money) as money_imp FROM money  a WHERE is_import = 1 and type = 1  $sql_filter";
        $total_imp = $this->pdo->fetch_one($sql);
        $perform['money_imp'] = $total_imp['money_imp'];

        // lợi nhuận
        $perform['money_get'] = $perform['total'] + $total_imp['money_imp'] - $total_exp['money_exp'];

        $this->smarty->assign('perform', $perform);
        $this->smarty->assign('out', $out);
        $this->smarty->display(DEFAULT_LAYOUT);
    }
}