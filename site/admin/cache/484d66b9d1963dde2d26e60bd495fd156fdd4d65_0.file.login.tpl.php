<?php
/* Smarty version 3.1.30, created on 2018-05-04 00:28:23
  from "/Users/mtd/Sites/htaccess/site/admin/view/user/login.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5aeb46b7570595_66872897',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '484d66b9d1963dde2d26e60bd495fd156fdd4d65' => 
    array (
      0 => '/Users/mtd/Sites/htaccess/site/admin/view/user/login.tpl',
      1 => 1525368497,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5aeb46b7570595_66872897 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="">
    <a class="hiddenanchor" id="toregister"></a> <a class="hiddenanchor" id="tologin"></a>
    <div id="wrapper">
        <div id="login" class="animate form">
            <section class="login_content">
                <form method="post" action="">
                    <h1>Đăng nhập</h1>
                    <div>
                        <input type="text" autofocus class="form-control text-center" name="username" placeholder="Tên đăng nhập" required />
                    </div>
                    <div>
                        <input type="password" class="form-control text-center" name="password" placeholder="Mật khẩu" required />
                    </div>
                    <div>
                        <input type="submit" class="btn btn-default submit" name="submit" value="Đăng nhập">
                    </div>
                    <div class="clearfix"></div>
                    <div class="separator">
                        <div class="clearfix"></div>
                        <br />
                        <div>
                        <?php if ($_smarty_tpl->tpl_vars['status']->value == 0) {?>
                            <h1 style='color: red'> Tài khoản bị vô hiệu hóa <h1>
                        <?php }?>
                            
                        </div>
                    </div>
                </form>
                <!-- form -->
            </section>
            <!-- content -->
        </div>
        <!-- <div id="register" class="animate form">
            <section class="login_content">
                <form>
                    <h1>Create Account</h1>
                    <div>
                        <input type="text" autofocus class="form-control" placeholder="Username" />
                    </div>
                    <div>
                        <input type="email" class="form-control" placeholder="Email" />
                    </div>
                    <div>
                        <input type="password" class="form-control" placeholder="Password" />
                    </div>
                    <div><a class="btn btn-default submit" href="index.html">Submit</a></div>
                    <div class="clearfix"></div>
                    <div class="separator">
                        <p class="change_link">Already a member ? <a href="#tologin" class="to_register">Log in </a></p>
                        <div class="clearfix"></div>
                        <br />
                        <div>
                            <h1><i class="fa fa-paw" style="font-size: 26px;"></i> HLSELLING</h1>
                            <p>Sales management software
                                <br>HLSTAR ©2016 All Rights Reserved.</p>
                        </div>
                    </div>
                </form> -->
                <!-- form -->
            <!-- </section> -->
            <!-- content -->
        <!-- </div> -->
    </div>
</div>
<?php }
}
