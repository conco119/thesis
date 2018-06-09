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
            $data['birthday'] = "2018/01/01";
            $data['status'] = 0;
            $data['permission'] = 0;
            $data['created_at'] = time();
            $data['avatar'] = '';
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
                $_SESSION['LOGIN_MEMBER'] = $user['id'];
                lib_redirect('./');
                exit();
            }
            else
            {
                $errors['err_login'] = 'Tài khoản hoặc mật khẩu không hợp lệ';
                $this->smarty->assign('errors', $errors);
            }
        }
        $this->smarty->display('login.tpl');
    }
}