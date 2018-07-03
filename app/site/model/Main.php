<?php

lib_use(CORE_PDO);
lib_use(CORE_STRING);
lib_use(CORE_PAGINATION2);
lib_use(CORE_FILEHANDLE);
lib_use(CORE_TIMES);
lib_use(CORE_ZEBRA);
lib_use(CORE_IMAGE);
class Main
{
  protected $arg, $conf_info;
  function __construct()
  {
    global $smarty, $tpl_file, $mc, $site, $login_id, $pdo;
    $this->currentUser = '';

    $this->login_id = $login_id;
    $this->mc = $mc;
    $this->site = $site;

    $this->slim_pdo = $pdo;
    $this->pdo = new DPDO(DB_INFO);
    $this->paging = new pagination();
    $this->times = new Times();
    $this->dstring = new DString();
    $this->helper = new Helper();

    $this->file_setting = "../../constant/setting.ini";
    $this->smarty = $smarty;
    $this->smarty->assign('tpl_file', $tpl_file);
    // config
    $this->set_value();
  }

   public function set_value()
  {
    $dbo = new DPDO(DB_INFO);
    //content getting
    $content = array();
    if (file_exists($this->file_setting)) {
        $content = parse_ini_file($this->file_setting, true);
    }
    $this->conf_info = $content;
    //end content getting
    $this->currentUser = $this->check_user();
    $this->arg = array(
            'stylesheet' => DOMAIN . "app/webroot/site/",
            // 'common_stylesheet' => DOMAIN . "app/webroot/",
            // 'image_folder_link' => DOMAIN . 'upload/image/',
            // 'image_folder_path' => ROOT_PATH . "/upload/image/",
            // 'product_folder_link' => DOMAIN . 'upload/product',
            // 'product_folder_path' => ROOT_PATH . "/upload/product",
            // 'logo_folder_link' => DOMAIN . "/upload/logo",
            // 'logo_folder_path' => ROOT_PATH . "/upload/logo",
            'logo_path' => 'upload/logo',
            'today' => gmdate("d-m-Y", time() + 7 * 3600),
            'this_month' => gmdate("m", time() + 7 * 3600),
            'this_year' => gmdate("Y", time() + 7 * 3600),
            'domain' => DOMAIN,
            'this_link' => THIS_LINK,
            'mc' => $this->mc,
            'site' => $this->site,
            'user' => $this->currentUser,
            'setting' => $content['info'],
    );
    //user avatar to header view
    // if($this->currentUser['avatar'] != '')
    //   $this->arg['avatar_link'] = $this->arg['image_folder_link'] . $this->currentUser['avatar'];
    // else
    //   $this->arg['avatar_link'] = $this->arg['image_folder_link'] . 'user-default.png';
    $this->smarty->assign('arg', $this->arg);
    $this->set_sidebar();
    $this->set_footer();
    $this->set_cart();
  }


  public function set_sidebar()
  {
    $menu = $this->pdo->fetch_all("SELECT * FROM product_categories WHERE parent_id = 0 AND status = 1");
    foreach ($menu as $key => $value)
    {
        $menu[$key]['menu_link'] = $this->dstring->str_convert($value['name']);
        $menu[$key]['child_menu'] = $this->pdo->fetch_all("SELECT * FROM product_categories WHERE parent_id = {$value['id']} AND status = 1");
        foreach ($menu[$key]['child_menu'] as $k => $v)
        {
          $menu[$key]['child_menu'][$k]['menu_link'] = $this->dstring->str_convert($v['name']);
        }
    }
    $this->smarty->assign('menu',$menu);


    // sản phẩm bán chạy
    $sql = "SELECT p.*, sum(ex.number_count) as exported,
    (SELECT m.name FROM media m
    INNER JOIN  media_product mp ON m.id = mp.media_id WHERE mp.product_id = p.id AND mp.is_showed = 1) as image_name,
    (SELECT m.path FROM media m
    INNER JOIN  media_product mp ON m.id = mp.media_id WHERE mp.product_id = p.id AND mp.is_showed = 1) as image_path,
    (SELECT count(id) FROM product_rates pr WHERE p.id=pr.product_id ) as number_user_rate,
    (SELECT sum(rate) FROM product_rates pr WHERE p.id=pr.product_id ) as total_rate
    FROM products p RIGHT JOIN export_products ex ON p.id = ex.product_id
    WHERE p.status = 1
    GROUP BY ex.product_id
    ORDER BY exported
    DESC LIMIT 10";
    $best_seller = $this->pdo->fetch_all($sql);

    foreach($best_seller as $k => $item)
    {
        $best_seller[$k]['price'] = number_format($item['price']);
        $best_seller[$k]['link_name'] = $this->dstring->str_convert($item['name']);
        if( $item['is_discount'] == 1)
        {
            switch($item['discount_type'])
            {
                case 1:
                    $best_seller[$k]['sale_price'] = $item['price'] - (($item['price'] * $item['discount'])/100);
                    $best_seller[$k]['sale_price'] = number_format($best_seller[$k]['sale_price']);
                    break;
                case 2:
                    $best_seller[$k]['sale_price'] = $item['price'] -  $item['discount'];
                    $best_seller[$k]['sale_price'] = number_format($best_seller[$k]['sale_price']);
                    break;
            }
        }
    }
    $this->smarty->assign('best_seller', $best_seller);

    //sản phẩm khuyến mãi
    $sql = "SELECT p.*,
    (SELECT m.name FROM media m
    INNER JOIN  media_product mp ON m.id = mp.media_id WHERE mp.product_id = p.id AND mp.is_showed = 1) as image_name,
    (SELECT m.path FROM media m
    INNER JOIN  media_product mp ON m.id = mp.media_id WHERE mp.product_id = p.id AND mp.is_showed = 1) as image_path,
    (SELECT count(id) FROM product_rates pr WHERE p.id=pr.product_id ) as number_user_rate,
    (SELECT sum(rate) FROM product_rates pr WHERE p.id=pr.product_id ) as total_rate
    FROM products p
    WHERE p.is_discount = 1 AND p.status = 1
    ORDER BY id
    DESC LIMIT 10";
    $sale_products = $this->pdo->fetch_all($sql);
    foreach($sale_products as $k => $item)
    {
        $sale_products[$k]['price'] = number_format($item['price']);
        $sale_products[$k]['link_name'] = $this->dstring->str_convert($item['name']);
        if( $item['is_discount'] == 1)
        {
            switch($item['discount_type'])
            {
                case 1:
                    $sale_products[$k]['sale_price'] = $item['price'] - (($item['price'] * $item['discount'])/100);
                    $sale_products[$k]['sale_price'] = number_format($sale_products[$k]['sale_price']);
                    break;
                case 2:
                    $sale_products[$k]['sale_price'] = $item['price'] -  $item['discount'];
                    $sale_products[$k]['sale_price'] = number_format($sale_products[$k]['sale_price']);
                    break;
            }
        }
    }
    $this->smarty->assign('sale_products',$sale_products);
  }


  public function set_footer()
  {
    $info = array();
    if (file_exists($this->file_setting))
    {
        $info = parse_ini_file($this->file_setting, true);
    }
    $this->smarty->assign('info', $info);
  }

  public function set_cart()
  {
    $number['product'] = count($_SESSION['cart']['products']);
    $number['service'] = count($_SESSION['cart']['services']);
    $this->smarty->assign('cart_number', $number);
  }

  public function check_user()
  {
    global $login_id;
    if($login_id != 0 )
    {
      $user = $this->pdo->fetch_one( "SELECT * FROM users a where id='$login_id'" );
      return $user;
    }

  }
}

 ?>
