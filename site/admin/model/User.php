<?php

class User extends Main
{

  function __construct()
  {
    global $user_group;
    $this->user_group = $user_group;
    parent::__construct();
  }
  public function index()
  {
    //query
    $users = $this->pdo->fetch_all('SELECT * FROM users WHERE permission <> 0');
    foreach($users as $key => $user)
    {
      $users[$key]['status'] = $this->helper->help_get_status($user['status'], 'users', $user['id'], 'activeUser');
      $users[$key]['username'] = strtoupper($user['username']);
    }
    //smarty
    $this->smarty->assign('user_group', $this->user_group);
    $this->smarty->assign('users', $users);
    $this->smarty->display(DEFAULT_LAYOUT);
  }

  public function get_all()
  {
    echo "this is user";
  }

  public function add_user()
  {
    $data = $this->pdo->fetch_all('SELECT * from users a');
    pre($data);
    $this->smarty->display(DEFAULT_LAYOUT);
  }

  public function login()
  {
    global $login_id;

    if(isset($_POST['submit']))
    {
      $username = trim($_POST['username']);
      $password = trim($_POST['password']);
      $user = $this->pdo->fetch_one("SELECT * FROM users WHERE username ='$username' and password ='$password' ");
      if(!$user)
      {
        $this->smarty->assign('wrong', 1);
        $this->smarty->display('login.tpl');
        return;
      }
      if($user['status'] == 0)
      {
        $this->smarty->assign('status', $user['status']);
        $this->smarty->display('login.tpl');
        return;
      }
        $_SESSION[LOGIN_MEMBER] = $user['id'];
        lib_redirect(HOME_PAGE);
    }

    if($login_id != 0)
    {
      lib_redirect(HOME_PAGE);
    }
    $this->smarty->display('login.tpl');

  }

  public function logout()
  {
    unset($_SESSION[LOGIN_MEMBER]);
    lib_redirect('?mc=user&site=login');
  }
  // not using view
  public function ajax_active_user()
  {
    if(isset($_POST['table']) && isset($_POST['id']) && $this->currentUser['permission'] == 1)
    {
      $user = $this->pdo->fetch_one("SELECT status FROM users WHERE id=" . $_POST['id']);
      $status = $user['status'] == 1 ? 0 : 1;
      $this->pdo->query("UPDATE users SET status = '$status' WHERE id=" . $_POST['id']);
      echo $this->helper->help_get_status($status, $_POST['table'], $_POST['id'], 'activeUser');
      exit();
    }
    else
    {
      echo 0;
      exit();
    }
  }
}

 ?>
