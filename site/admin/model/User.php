<?php

class User extends Main
{
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
    if($login_id != 0)
      lib_redirect(HOME_PAGE);
    if(isset($_POST['submit']))
    {
      $username = trim($_POST['username']);
      $password = trim($_POST['password']);
      $user = $this->pdo->fetch_one("SELECT * FROM users WHERE username ='$username' and password ='$password' ");
      $_SESSION[LOGIN_MEMBER] = $user['id'];
      lib_redirect(HOME_PAGE);
    }
    $this->smarty->display('login.tpl');
  }

  public function logout()
  {
    unset($_SESSION[LOGIN_MEMBER]);
    lib_redirect('?mc=user&site=login');
  }
}

 ?>
