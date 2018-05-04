<?php

class User extends Main
{

  function __construct()
  {
    $this->userHelper = new UserHelper();
    parent::__construct();
  }
  public function index()
  {
    //query
    $users = $this->pdo->fetch_all('SELECT * FROM users ');
    foreach($users as $key => $user)
    {
      $users[$key]['status'] = $this->helper->help_get_status($user['status'], 'users', $user['id'], 'activeUser');
      $users[$key]['username'] = strtoupper($user['username']);
      $users[$key]['created_at'] = gmdate('d.m.Y', $user['created_at'] + 7 * 3600);
      $users[$key]['updated_at'] = gmdate('d.m.Y', $user['updated_at'] + 7 * 3600);
      $users[$key]['permission'] = $this->userHelper->get_permission_type($user['permission']);
    }
    //smarty
    $this->smarty->assign('users', $users);
    $this->smarty->display(DEFAULT_LAYOUT);
  }

  public function create_user()
  {
    if( isset($_POST['submit']) )
    {
      $data['code'] = $this->userHelper->get_user_code($this->pdo, $_POST['permission']);
      $data['name'] = $_POST['name'];
      $data['username'] = $_POST['username'];
      $data['password'] = $_POST['year'] . $_POST['month'] . $_POST['day'];
      $data['image'] = "";
			$data['permission'] = $_POST["permission"];
			$data["gender"] = $_POST["gender"];
			$data["birthday"] = $_POST["year"] . "-" . $_POST["month"] . "-" . $_POST["day"];
			$data["address"] = $_POST["address"];
			$data["email"] = $_POST["email"];
			$data["phone"] = $_POST["phone"];
			$data['created_at'] = time();
			$data['updated_at'] = time();
      $data['status'] = isset($_POST['status']) ? 1 : 0;
      $this->pdo->insert('users', $data);
      lib_redirect_back();
    }
  }

  public function edit_user()
  {
    $user = $this->pdo->fetch_one("SELECT * from users where id=" . $_POST['id']);
    if( isset($_POST['submit']) )
    {
      // đổi mã người dùng khi đổi permission
      if($user['permission'] != $_POST["permission"])
        $data['code'] = $this->userHelper->get_user_code($this->pdo, $_POST['permission']);
      $data['name'] = $_POST['name'];
			$data['permission'] = $_POST["permission"];
			$data["gender"] = $_POST["gender"];
			$data["birthday"] = $_POST["year"] . "-" . $_POST["month"] . "-" . $_POST["day"];
			$data["address"] = $_POST["address"];
			$data["email"] = $_POST["email"];
			$data["phone"] = $_POST["phone"];
			$data['updated_at'] = time();
      $data['status'] = isset($_POST['status']) ? 1 : 0;
      $this->pdo->update('users', $data, "id=" . $_POST['id']);
      pre($data);
      pre($_POST);
      lib_redirect_back();
    }

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

  public function ajax_load_user()
  {
    if( isset($_POST['id']) )
    {
      $user = $this->pdo->fetch_one("SELECT * FROM users WHERE id = " . $_POST['id']);
      $user['permission'] = $this->userHelper->get_user_permission_select($this->pdo, $user['permission']);
      $user['gender'] = $this->userHelper->get_user_gender_select($this->pdo, $user['gender']);
      $user['birthday'] = $this->userHelper->get_user_birthday_select($user['birthday']);
      echo json_encode($user);
    }
  }
  public function ajax_delete()
  {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
		if($id == 0){
			exit();
		}
    if($this->currentUser['permission'] == 1 && $this->pdo->query("DELETE FROM users WHERE id=$id"))
    {
			echo 1;
			exit();
		}
		echo 0;
		exit;
  }
}

 ?>
