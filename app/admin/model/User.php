<?php

class User extends Main
{
  function __construct()
  {
    parent::__construct();
    $this->userHelper = new UserHelper();
    $this->table = "users";

  }
  public function index()
  {
    // pre($users);
    // return;
    //adding or editing
    $this->create();
    $this->edit();
    //searching
    $key = isset($_GET['key']) ? $_GET['key'] : "";
    $permission = isset($_GET['permission']) ? intval($_GET["permission"]) : 0;
    $sql_where = "WHERE 1 = 1 ";
    if($key != "")
    {
      $key_custom = trim($key);
      $sql_where .= " AND ( code LIKE '%$key_custom%' OR name LIKE '%$key_custom%')";
    }
    if($permission != "")
    {
      $sql_where .= "AND permission=$permission";
    }
    $out = [];
    $out['permission'] =  $this->userHelper->help_get_user_permission_option($permission);
    $out['key'] = $key;
    //query
    $sql = "SELECT * FROM users " . $sql_where;
    $paging = $this->paging->get_content($this->pdo->count_rows($sql), 5);
    $sql .= $paging['sql_add'];
    $users = $this->pdo->fetch_all($sql);
    foreach($users as $key => $user)
    {
      $users[$key]['status'] = $this->helper->help_get_status($user['status'], 'users', $user['id'], 'activeUser');
      $users[$key]['username'] = strtoupper($user['username']);
      $users[$key]['created_at'] = gmdate('d.m.Y', $user['created_at'] + 7 * 3600);
      $users[$key]['updated_at'] = gmdate('d.m.Y', $user['updated_at'] + 7 * 3600);
      $users[$key]['permission'] = $this->userHelper->get_permission_type($user['permission']);
    }
    //smarty
    $this->smarty->assign('out', $out);
    $this->smarty->assign('paging', $paging);
    $this->smarty->assign('users', $users);
    $this->smarty->display(DEFAULT_LAYOUT);
  }

  public function create()
  {
    if( isset($_POST['submit']) && $_POST['id'] == 0)
    {
      $data['code'] = $this->userHelper->get_user_code($_POST['permission']);
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
      $isSucceed = $this->pdo->insert('users', $data);
      if($isSucceed)
      {
          $notification = [
              'status' => 'success',
              'title'  => 'Thêm thành công',
              'text'   => "Thêm người dùng thành công"
          ];
          $this->smarty->assign('notification', $notification );
      }
    else
      {
          $notification = [
              'status' => 'error',
              'title'  => 'Thêm không thành công',
              'text'   => "Thêm người dùng không thành công"
          ];
          $this->smarty->assign('notification', $notification);
      }

    }
  }

  public function edit()
  {
    $user = $this->pdo->fetch_one("SELECT * from users where id=" . $_POST['id']);
    if( isset($_POST['submit']) && $_POST['id'] != 0)
    {
      // đổi mã người dùng khi đổi permission
      if($user['permission'] != $_POST["permission"])
        $data['code'] = $this->userHelper->get_user_code($_POST['permission']);
      $data['name'] = $_POST['name'];
			$data['permission'] = $_POST["permission"];
			$data["gender"] = $_POST["gender"];
			$data["birthday"] = $_POST["year"] . "-" . $_POST["month"] . "-" . $_POST["day"];
			$data["address"] = $_POST["address"];
			$data["email"] = $_POST["email"];
			$data["phone"] = $_POST["phone"];
			$data['updated_at'] = time();
      $data['status'] = isset($_POST['status']) ? 1 : 0;
      try {
        $updateStatement = $this->slim_pdo->update($data)->table($this->table)->where('id', '=', $_POST['id']);
        $isSucceed = $updateStatement->execute();
      }
      catch(PDOException $e) {
          $text = $e->getMessage();
          $isSucceed = false;
      }
      if($isSucceed)
      {
          $notification = [
              'status' => 'success',
              'title'  => 'Sửa thành công',
              'text'   => "Sửa người dùng thành công"
          ];
          $this->smarty->assign('notification', $notification );
      }
    else
      {
          $notification = [
              'status' => 'error',
              'title'  => 'Sửa không thành công',
              'text'   => $text
          ];
          $this->smarty->assign('notification', $notification);
      }

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
      $user['permission'] = $this->userHelper->get_user_permission_select($user['permission']);
      $user['gender'] = $this->userHelper->get_user_gender_select($user['gender']);
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
