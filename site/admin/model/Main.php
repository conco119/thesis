<?php

lib_use(CORE_PDO);
lib_use(CORE_STRING);
lib_use(CORE_PAGINATION);
lib_use(CORE_FILEHANDLE);
lib_use(CORE_TIMES);
class Main implements Init
{
  protected $arg, $conf_info;
  function __construct()
  {
    global $smarty, $tpl_file, $mc, $site, $login_id;

    $this->currentUser = '';

    $this->login_id = $login_id;
    $this->mc = $mc;
    $this->site = $site;

    $this->pdo = new DPDO();
    $this->pagination = new pagination();
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
            'stylesheet' => DOMAIN . "site/admin/webroot/",
            'today' => gmdate("d-m-Y", time() + 7 * 3600),
            'this_month' => gmdate("m", time() + 7 * 3600),
            'this_year' => gmdate("Y", time() + 7 * 3600),
            'domain' => DOMAIN,
            'this_link' => THIS_LINK,
            'mc' => $this->mc,
            'site' => $this->site,
            'user' => $this->currentUser,
            'setting' => $content['info'],
            'macos' => MACOS
    );
    $this->smarty->assign('arg', $this->arg);
  }

  public function check_user()
  {
    global $site, $login_id, $mc;
    if($login_id == 0 && !in_array($site,['login']))
    {
        lib_redirect(LOGIN_PAGE);
    }
    $user = $this->pdo->fetch_one( "SELECT * FROM users a where id='$login_id'" );
    return $user;
  }
}

 ?>
