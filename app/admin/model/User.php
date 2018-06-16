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

    $this->redirectIfEmployee();
    $this->redirectIfManager();
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
    $paging = $this->paging->get_content($this->pdo->count_rows($sql), 10);
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

      // $img = $_FILES['avatar'];
      // pre($img);
      // if($img['error'] == UPLOAD_ERR_OK) {
      //   $az = explode(".", $img['name']);
			// 	$type = $az[count($az)-1];
			// 	$name = gmdate("Y.m.d.His", time()+7*3600) . "." . $type;
      //   move_uploaded_file($img['tmp_name'], "/Users/mtd/Sites/htaccess/app/upload/image/xxx.jpg");
      //   echo "ok1";
      // }
      $data['code'] = $this->userHelper->get_user_code($_POST['permission']);
      $data['name'] = $_POST['name'];
      $data['username'] = $_POST['username'];
      $data['password'] = $_POST['year'] . $_POST['month'] . $_POST['day'];
      $data['avatar'] = "";
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
        $_SESSION["LOGIN_MEMBER"] = $user['id'];
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
    unset($_SESSION["LOGIN_MEMBER"]);
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
      $user['gender'] = $this->helper->get_user_gender_select($user['gender']);
      $user['birthday'] = $this->helper->get_user_birthday_select($user['birthday']);
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

  function profile(){
    // searching
    $date_export = isset($_GET['date']) ? intval($_GET["date"]) : 0;
    $out['select_export'] = $this->helper->get_option(0, 'select_export', $date_export);

    $this->change_avatar();
    $this->delete_avatar();
    $this->change_info();
    $this->change_pass();
    $sql = "SELECT * FROM users where id = {$this->currentUser['id']}";
    $user = $this->pdo->fetch_one($sql);
    $user['avatar'] = $this->userHelper->get_user_avatar($this->arg['image_folder_link'], $user['avatar']);
    $this->arg['avatar_link'] = $user['avatar'];
    $this->smarty->assign('arg', $this->arg);
    $user['birthday'] = $this->helper->get_user_birthday_select($user['birthday']);
    $user['gender'] = $this->helper->get_user_gender_select($user['gender']);
    $this->smarty->assign('result', $user);
    //exports
    $sql = "SELECT a.code, a.must_pay, a.description, c.name as customer_name
            FROM exports a
            LEFT JOIN customers c ON a.customer_id = c.id
            LEFT JOIN users u ON u.id = a.creator
            WHERE 1=1 AND u.id = {$this->currentUser['id']}";
        if($date_export != 0)
        {
          switch($date_export)
          {
            case 1:
              $sql .= " AND a.date = CURDATE()";
              break;
            case 2:
              $sql .= " AND WEEK(a.date) = WEEK(CURDATE()) AND YEAR(a.date) = YEAR(CURDATE())";
              break;
            case 3:
              $sql .= " AND MONTH(a.date) = MONTH(CURDATE()) AND YEAR(a.date) = YEAR(CURDATE())";
              break;
          }
        }
    $paging = $this->paging->get_content($this->pdo->count_rows($sql), 20);
    $sql .= $paging['sql_add'];
    $exports = $this->pdo->fetch_all($sql);


    $this->smarty->assign('out', $out);
    $this->smarty->assign('paging', $paging);
    $this->smarty->assign('exports', $exports);
		$this->smarty->display(DEFAULT_LAYOUT);
  }
  // end profile function
  public function change_avatar()
  {
    if(isset($_POST['avatar_change']))
    {
			$data = array();
      $avatar = new Zebra();
      if ( isset($_FILES['avatar_file']) && $this->helper->check_type($_FILES['avatar_file']['type']) )
      {
        // echo "ok";
        // die();
				$avatar->source_path = $_FILES['avatar_file']['tmp_name'];
				$upload_file_name = $this->userHelper->get_image_name_upload_from_dollar_files($_FILES['avatar_file']['type']);
        $avatar->target_path = $this->arg['image_folder_path'] . $upload_file_name;
        $avatar->jpeg_quality = 100;
        $avatar->preserve_aspect_ratio = true;
        if($_FILES['avatar_file']['type'] == "image/gif")
          move_uploaded_file($_FILES['avatar_file']['tmp_name'], $avatar->target_path);
        else
          $avatar->crop($_POST['avatar_x'], $_POST['avatar_y'], $_POST['avatar_width']+$_POST['avatar_x'], $_POST['avatar_height']+$_POST['avatar_y']);
        $data['avatar'] = $upload_file_name;
        if($this->currentUser['avatar'] != '' && $this->currentUser['avatar'] != $upload_file_name)
        {
          unlink($this->arg['image_folder_path'] . $this->currentUser['avatar'] );
          // chmod($this->arg['image_folder_path'] . $this->['avatar'], 0777);
        }
        $this->pdo->update('users', $data, 'id='.$this->currentUser['id']);
     }
     else if($this->currentUser['avatar'] != '')
     {
        $avatar->source_path = $this->userHelper->get_avatar_path($this->arg['image_folder_path'], $this->currentUser['avatar']);
        $ext = pathinfo($this->currentUser['avatar'], PATHINFO_EXTENSION);
        $upload_file_name = $this->userHelper->get_image_name_upload_from_extension($ext);
        $avatar->target_path = $this->arg['image_folder_path'] . $upload_file_name;
        $avatar->jpeg_quality = 100;
        $avatar->preserve_aspect_ratio = true;
        if($_FILES['avatar_file']['type'] == "image/gif")
            move_uploaded_file($_FILES['avatar_file']['tmp_name'], $avatar->target_path);
        else
            $avatar->crop($_POST['avatar_x'], $_POST['avatar_y'], $_POST['avatar_width']+$_POST['avatar_x'], $_POST['avatar_height']+$_POST['avatar_y']);
        $data['avatar'] = $upload_file_name;
        if($this->currentUser['avatar'] != '' && $this->currentUser['avatar'] != $upload_file_name)
        {
          unlink($this->arg['image_folder_path'] . $this->currentUser['avatar'] );
          // chmod($this->arg['image_folder_path'] . $this->['avatar'], 0777);
        }
        $this->pdo->update('users', $data, 'id='.$this->currentUser['id']);
     }


		}
  }
  // end of change avatar

  public function delete_avatar()
  {
    if(isset($_POST['delete_avatar']))
    {
			$data['avatar'] = '';
			if($this->currentUser['avatar'] != ''){
        unlink($this->arg['image_folder_path'] . $this->currentUser['avatar'] );
			}
      $this->pdo->update('users', $data, 'id=' . $this->currentUser['id'] );
		}
  }

  public function change_info()
  {
    if( isset($_POST["submit"]) )
    {
    $data['name'] = $_POST['name'];
    $data["birthday"] = $_POST["year"] . "-" . $_POST["month"] . "-" . $_POST["day"];
    $data["gender"] = $_POST["gender"];
    $data["address"] = $_POST["address"];
    $data["email"] = $_POST["email"];
    $data["phone"] = $_POST["phone"];
    $data['updated_at'] = time();
    try {
      $updateStatement = $this->slim_pdo->update($data)->table($this->table)->where('id', '=', $this->currentUser['id']);
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
            'text'   => "Sửa thông tin thành công công"
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

  public function change_pass()
  {

    if(isset($_POST["pass"]))
    {
			$data["password"] = $_POST["password"];
      $pass_old = $_POST["pass_old"];

      if($this->pdo->check_exist("SELECT id FROM users WHERE id={$this->currentUser['id']} && password= '$pass_old'") && $_POST['password'] == $_POST['Re_password'])
        {
          $isSucceed = true;
          $this->pdo->update($this->table, $data, "id=" . $this->currentUser['id']);
        }

      else if($pass_old != $this->currentUser['password'])
        {
          $isSucceed = false;
          $text = "Mật khẩu cũ không chính xác";
        }
        else
        {
          $isSucceed = false;
          $text = "Mật khẩu mới không trùng nhau";
        }

      if($isSucceed)
      {
          $notification = [
              'status' => 'success',
              'title'  => 'Sửa thành công',
              'text'   => "Sửa mật khẩu thành công"
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

}

 ?>
