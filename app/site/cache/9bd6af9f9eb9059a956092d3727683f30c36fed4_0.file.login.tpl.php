<?php
/* Smarty version 3.1.30, created on 2018-06-18 13:36:53
  from "D:\DocumentRoot24\~mtd\htaccess\app\site\view\customer\login.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b275305310e52_77191754',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9bd6af9f9eb9059a956092d3727683f30c36fed4' => 
    array (
      0 => 'D:\\DocumentRoot24\\~mtd\\htaccess\\app\\site\\view\\customer\\login.tpl',
      1 => 1528691475,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b275305310e52_77191754 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="log_title">
  	<h2>
		Đăng nhập
	</h2>
</div>
<div class="row">

	<div class="col-md-12 col-xs-12 col-df">
		<div id="login">
			<form method="post" id="validate">

				<div class="login-fields">
					<p class="error"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</p>
					<div class="field">
						<label for="username">Tài khoản:</label>
						<input type="text" class="form-control" name="username" value="" placeholder="Username" class="login username-field required">
					</div>
					<!-- /field -->
					<div class="field">
						<label for="password">Mật khẩu:</label>
						<input type="password" class="form-control" name="password" value="" placeholder="Password" class="login password-field required">
					</div>
					<!-- /password -->
				</div>
				<!-- /login-fields -->

				<div class="login-actions">
					<button class="button btn btn-success btn-large" name="login_submit">Đăng nhập</button>
				</div>
				<!-- .actions -->
			</form>
		</div>
	</div>
</div><?php }
}
