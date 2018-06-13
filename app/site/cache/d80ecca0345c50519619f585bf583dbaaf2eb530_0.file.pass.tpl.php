<?php
/* Smarty version 3.1.30, created on 2018-06-13 22:59:42
  from "/Users/mtd/Sites/htaccess/app/site/view/customer/pass.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b213f6e886432_82322706',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd80ecca0345c50519619f585bf583dbaaf2eb530' => 
    array (
      0 => '/Users/mtd/Sites/htaccess/app/site/view/customer/pass.tpl',
      1 => 1528905581,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b213f6e886432_82322706 (Smarty_Internal_Template $_smarty_tpl) {
?>

<div class="sidebar_title bg_34495e">
        <h3> ĐỔI MẬT KHẨU </h3>
    </div>
<div class="row col-default">

    <div class="col-md-12 col-sm-12 col-default ">
        <div class="account_info full bg_white pad-15" >
            <form class="form-inline"  method="post">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['error']->value, 'er');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['er']->value) {
?>
                        <p style='padding-left: 20px; color:red;'><?php echo $_smarty_tpl->tpl_vars['er']->value;?>
</p>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                    <div class="form-group">
                        <label for="email">Nhập mật khẩu cũ:</label>
                        <input type="password" class="form-control form-inline" name="old_password"   width="100px" placeholder='Nhập mật khẩu cũ'>
                    </div>
                    <div class="form-group">
                        <label for="email">Mật khẩu mới:</label>
                        <input type="password" class="form-control form-inline" name="password"   width="100px" placeholder='Nhập mật khẩu mới'>
                    </div>
                    <div class="form-group">
                        <label for="email">Nhập lại mật khẩu mới:</label>
                        <input  type="password" class="form-control" name="repassword" placeholder='Nhập lại mật khẩu mới'>
                    </div>
                        <a href='./?mc=customer&site=detail' class='btn btn-primary'  style='margin-left:20px' >
                            <i class="fa fa-arrow-left"></i>
                        </a>
                        <button class='btn btn-default' type='submit' style='margin-left:20px' name='submit'>
                            <i class="fa fa-save"></i>
                            Lưu
                        </button>
                    </div>
            </form>
        </div>
    </div>
</div><?php }
}
