<?php
class Pub extends Main
{
    public function denied()
    {
      $this->smarty->display( "error.tpl" );
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
              $this->smarty->assign('status', 1);
              $this->smarty->display('login.tpl');
              return;
          }
          $_SESSION["LOGIN_MEMBER"] = $user['id'];
          lib_redirect(HOME_PAGE);
      }

      // redirect if logged in -
      $user = $this->pdo->fetch_one("SELECT status FROM users WHERE id=$login_id");
      if($login_id != 0 && $user['status'] == 1)
      {
          lib_redirect(HOME_PAGE);
      }
      $this->smarty->display('login.tpl');
    }

    public function check_user()
    {
      return 1;
    }

}
 ?>
