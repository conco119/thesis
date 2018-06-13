<?php
/* Smarty version 3.1.30, created on 2018-06-13 23:05:33
  from "/Users/mtd/Sites/htaccess/app/site/view/customer/detail.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b2140cd24b855_61631416',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '343989baa51c266f9470e4a82f12a6def81126f0' => 
    array (
      0 => '/Users/mtd/Sites/htaccess/app/site/view/customer/detail.tpl',
      1 => 1528905932,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b2140cd24b855_61631416 (Smarty_Internal_Template $_smarty_tpl) {
?>

<div class="sidebar_title bg_34495e">
        <h3> THÔNG TIN TÀI KHOẢN </h3>
    </div>
<div class="row col-default">

    <div class="col-md-12 col-sm-12 col-default ">
        <div class="account_info full bg_white pad-15" >
            <form class="form-inline"  method="post">

                    <div class="form-group">
                        <label for="email">Họ Tên:</label>
                        <input type="text" class="form-control form-inline" name="name" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['name'];?>
"  width="100px">
                    </div>
                    <div class="form-group">
                        <label for="email">Tài khoản:</label>
                        <input type="email" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['username'];?>
" disabled="">
                    </div>

                    <div class="form-group">
                        <label for="email">Số điện thoại:</label>
                        <input type="text" class="form-control" name="phone" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['phone'];?>
" >
                    </div>
                    <div class="form-group">
                        <label for="email">Địa chỉ:</label>
                        <input type="text" class="form-control" name="address" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['address'];?>
" style='width:70%'>
                    </div>
                    <!-- <div class="form-group">
                        <label for="email">Ngày sinh:</label>
                        <select class="form-control">
                            <option>1</option>
                        </select>
                        <select class="form-control">
                            <option>4</option>
                        </select>
                        <select class="form-control">
                            <option>1993</option>
                        </select>
                    </div> -->

                    <div class="form-full" >
                        <button class='btn btn-default' name='submit' type='submit' style='margin-right:20px'>
                            <i class="fa fa-save"></i>
                            
                            Lưu thông tin
                        </button>
                        <a class='btn btn-primary' href='./?mc=customer&site=pass'>
                            <i class="fa fa-exchange"></i>
                                Đổi mật khẩu
                        </a>
                    </div>
            </form>
        </div>
    </div>
</div><?php }
}
