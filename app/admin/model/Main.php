<?php

lib_use(CORE_PDO);
lib_use(CORE_STRING);
lib_use(CORE_PAGINATION);
lib_use(CORE_FILEHANDLE);
lib_use(CORE_TIMES);
lib_use(CORE_ZEBRA);
class Main implements Init
{
  protected $arg, $conf_info;
  function __construct()
  {
    global $smarty, $tpl_file, $mc, $site, $login_id, $pdo, $manager;

    $this->currentUser = '';

    $this->login_id = $login_id;
    $this->mc = $mc;
    $this->site = $site;

    $this->image = $manager;
    $this->slim_pdo = $pdo;
    $this->pdo = new DPDO();
    $this->paging = new pagination();
    $this->filehanle = new FileHandle();
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
    $dbo = new DPDO();
    //content getting
    $content = array();
    if (file_exists($this->file_setting)) {
        $content = parse_ini_file($this->file_setting, true);
    }
    $this->conf_info = $content;
    //end content getting
    $this->currentUser = $this->check_user();
    $this->arg = array(
            'stylesheet' => DOMAIN . "app/webroot/",
            'image_folder_link' => DOMAIN . 'upload/image/',
            'image_folder_path' => ROOT_PATH . "/upload/image/",
            'today' => gmdate("d-m-Y", time() + 7 * 3600),
            'this_month' => gmdate("m", time() + 7 * 3600),
            'this_year' => gmdate("Y", time() + 7 * 3600),
            'domain' => DOMAIN,
            'this_link' => THIS_LINK,
            'mc' => $this->mc,
            'site' => $this->site,
            'user' => $this->currentUser,
            'setting' => $content['info'],
            'macos' => MACOS,
            'prefix_admin' => "./admin?",
    );
    //user avatar to header view
    if($this->currentUser['avatar'] != '')
      $this->arg['avatar_link'] = $this->arg['image_folder_link'] . $this->currentUser['avatar'];
    else
      $this->arg['avatar_link'] = $this->arg['image_folder_link'] . 'user-default.png';
    $this->smarty->assign('arg', $this->arg);
  }

  public function check_user()
  {
    global $site, $login_id, $mc;
    $user = $this->pdo->fetch_one( "SELECT * FROM users a where id='$login_id'" );
    if($login_id != 0 && $user['status'] == 0)
      $login_id = 0;
    if($login_id == 0 && !in_array($site,['login']) && $user['status'] == 0 )
    {
        lib_redirect(LOGIN_PAGE);
    }
    return $user;
  }
}

 ?>
