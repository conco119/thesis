<?php

class Customer extends Main {

    function __construct()
    {
        parent::__construct();
        $this->CustomerHelper = new CustomerHelper();
    }

    function register()
    {
        if(isset($_POST['submit']))
        {
            $errors = [];
            $data['code'] = "CUS" . time();
            $data['username'] = $_POST['email'];
            $data['password'] = $_POST['password'];
            $data['name'] = $_POST['name'];
            $data['phone'] = $_POST['phone'];
            $data['address'] = $_POST['address'];
            $data['gender'] = 1;
            $data['email'] = '';
            $data['birthday'] = "2018/01/01";
            $data['status'] = 1;
            $data['permission'] = 4;
            $data['created_at'] = time();
            $data['updated_at'] = time();
            $data['avatar'] = '';
            // pre($data);
            // die;
            if($_POST['password'] != $_POST['repassword'])
            {
                $errors['err_password'] = 'Mật khẩu không trùng nhau';
                $this->smarty->assign('errors', $errors);
            }
           $user_id =  $this->pdo->insert('users', $data);
           if($user_id)
            {
                $_SESSION['LOGIN_MEMBER'] = $user_id;
                lib_redirect('./');
                exit();
            }
        }
        $this->smarty->display('login.tpl');
    }
    function logout()
    {
        unset($_SESSION['LOGIN_MEMBER']);
        lib_redirect('./');
    }

    function login()
    {
        if(isset($_POST['login_submit']))
        {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $user = $this->pdo->fetch_one("SELECT * FROM users WHERE username='{$username}' and password='{$password}'");
            if($user)
            {
                if($user['status'] == 0)
                {
                    $errors['err_login'] = 'Tài khoản bị vô hiệu hóa';
                    $this->smarty->assign('errors', $errors);
                }
                else
                {
                    $_SESSION['LOGIN_MEMBER'] = $user['id'];
                    lib_redirect(DOMAIN);
                }
            }
            else
            {
                $errors['err_login'] = 'Tài khoản hoặc mật khẩu không hợp lệ';
                $this->smarty->assign('errors', $errors);
            }
        }
        $this->smarty->display('login.tpl');
    }

    function detail()
    {
        if( isset($_POST['submit']) )
        {
            $data['name'] = $_POST['name'];
            $data['phone'] = $_POST['phone'];
            $data['address'] = $_POST['address'];
            $this->pdo->update('users', $data, 'id=' . $this->currentUser['id']);
        }


        $user = $this->pdo->fetch_one("SELECT * FROM users WHERE id=" . $this->currentUser['id']);
        $this->smarty->assign('user', $user);
        $this->smarty->display('home.tpl');
    }

    function pass()
    {
        $error = [];
        if( isset($_POST['submit']) )
        {
            if($this->currentUser['password'] == $_POST['old_password'])
            {
                if($_POST['password'] == $_POST['repassword'])
                {
                    $data['password'] = $_POST['password'];
                    $this->pdo->update('users', $data, 'id=' . $this->currentUser['id']);
                    lib_redirect('./?mc=customer&site=detail');
                }
                else
                {
                    $error['new_pass'] = "Mật khẩu mới không trùng nhau";
                }

            }
            else
            {
                $error['old_pass'] = "Mật khẩu cũ không chính xác";
            }

        }
        $this->smarty->assign('error', $error);
        $this->smarty->display('home.tpl');
    }
}