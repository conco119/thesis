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

  function profile(){
    $this->change_avatar();
    $this->delete_avatar();
    $sql = "SELECT * FROM users where id = {$this->currentUser['id']}";
    $user = $this->pdo->fetch_one($sql);
    $user['avatar'] = $this->userHelper->get_user_avatar($this->arg['image_folder_link'], $user['avatar']);
    $this->smarty->assign('result', $user);
		// $this->dbo->connect();
		// global $smarty, $login;
		// $sql_where = "AND 1=1";

		// $sql = "SELECT a.id,a.username,a.name,a.office_id,a.male,a.level,a.birthday,a.address,a.phone,a.email,a.position,a.group_id,a.image
		// FROM users AS a
		// WHERE a.id=$login";
		// $result = $this->dbo->fetch_one_array($sql);
		// $result['avatar'] = $this->user->get_avatar($result['image']);
		// //echo $result['avatar'];

		// $smarty->assign("result", $result);

		// $date_export = isset($_GET['date']) ? intval($_GET["date"]) : 0;

		// if($date_export != 0)
		// {
		// 	if($date_export ==1)
		// 	{

		// 		$time= time();
		// 		$time = date("Y-m-d");
		// 		$sql_where .= " AND b.date='".$time."'";
		// 	}
		// 	if($date_export ==2)
		// 	{
		// 		$sql_where .= " AND b.week= WEEKOFYEAR(CURDATE()) AND b.year= YEAR(CURDATE()) ";
		// 	}
		// 	if($date_export ==3 )
		// 	{
		// 		$sql_where .= " AND b.month= MONTH(CURDATE()) AND b.year= YEAR(CURDATE()) ";
		// 	}

		// }
		// $out['select_export'] = $this->help->get_select_from_array($this->select_export,$date_export);

		// $sql_export = "SELECT a.id,a.username,a.name,a.office_id,a.male,b.money,b.description as dis,c.name AS customer,a.level,a.birthday,a.address,a.phone,b.code,a.email,a.position,a.group_id,a.image
		// FROM users AS a LEFT JOIN wh_export b ON a.id=b.creator
		// LEFT JOIN customers c ON b.customer_id=c.id
		// WHERE a.id=".$login." ".$sql_where;
		// $paging = $this->paging->get_content($this->dbo->number_result_from_sql($sql), 10);
		// $sql .= $paging['sql_add'];
		// $smarty->assign('paging', $paging);
    //     @$query_export = $this->dbo->query($sql_export);
    //     while ($item = $this->dbo->fetch_array(@$query_export)) {
		// 	$item['code'] = $this->help->get_code($item['id'], 'exp');
    //         $result_export[] = $item;
    //     }
		// $smarty->assign("result_export", @$result_export);


		// $out['gender'] = $this->get_user_gender($result['male']);
		// $out['birthday'] = $this->get_birthday_select($result['birthday']);
		// $smarty->assign('out', $out);



		if(isset($_POST["submit"])){
			$data["name"] = $_POST["name"];
			$data["male"] = $_POST["gender"];
			$data["birthday"] = $_POST["year"] . "-" . $_POST["month"] . "-" . $_POST["day"];
			$data["address"] = $_POST["address"];
			$data["email"] = $_POST["email"];
			$data["phone"] = $_POST["phone"];
			$data['updated'] = time();

			if(!checkdate($_POST['month'], $_POST['day'], $_POST['year'])){
				lib_alert("Ngay sinh khong dung, vui long chon lai !");
				lib_redirect_back();
			}
			else {
				if($this->dbo->query_update("users", $data, "id=$login")){
					lib_alert("Hoan thanh");
					lib_redirect(THIS_LINK);
				}
				else{
					lib_alert("Error !");
					lib_redirect_back();
					exit();
				}
			}
		}

		if(isset($_POST["pass"])){
			$data["password"] = $_POST["password"];
			$pass_old = $_POST["pass_old"];
			if(!$this->dbo->check_exist_fields("SELECT id FROM users WHERE id=$login && password= '$pass_old'")){
				lib_alert("Mat khau cu khong dung vui long nhap lai");
				lib_redirect_back();
			}
			elseif($_POST["password"] != $_POST["Re_password"]) {
				lib_alert("Nhap lai khong trung vui long nhap lai");
				lib_redirect_back();
			}
			else
			{
				if($this->dbo->query_update("users", $data, "id=$login")){
					lib_alert("Hoan thanh");
					lib_redirect(THIS_LINK);
				}
				else{
					lib_alert("Error !");
					lib_redirect_back();
					exit();
				}
			}
		}


		// $this->dbo->close();
		$this->smarty->display(DEFAULT_LAYOUT);
  }
  // end profile function
  public function change_avatar()
  {
    if(isset($_POST['avatar_change']))
    {
			$data = array();
      $avatar = new Zebra();
      if ( isset($_FILES['avatar_file']) && $this->userHelper->check_type($_FILES['avatar_file']['type']) )
      {
        // echo "ok";
        // die();
				$avatar->source_path = $_FILES['avatar_file']['tmp_name'];
				$upload_file_name = $this->userHelper->get_image_name_upload_from_dollar_files($_FILES['avatar_file']['type']);
        $avatar->target_path = $this->arg['image_folder_path'] . $upload_file_name;
        $avatar->jpeg_quality = 100;
        $avatar->preserve_aspect_ratio = true;
        $do = $avatar->crop($_POST['avatar_x'], $_POST['avatar_y'], $_POST['avatar_width']+$_POST['avatar_x'], $_POST['avatar_height']+$_POST['avatar_y']);
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
      $do = $avatar->crop($_POST['avatar_x'], $_POST['avatar_y'], $_POST['avatar_width']+$_POST['avatar_x'], $_POST['avatar_height']+$_POST['avatar_y']);
      // pre($avatar);
      // die();
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

}

 ?>