<?php
/* Smarty version 3.1.30, created on 2018-06-09 21:14:00
  from "C:\xampp\htdocs\~mtd\htaccess\app\site\view\customer\register.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b1be0a872c552_54784821',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '302e1a10721621266b52d5b87077e3a3f4b1aeaf' => 
    array (
      0 => 'C:\\xampp\\htdocs\\~mtd\\htaccess\\app\\site\\view\\customer\\register.tpl',
      1 => 1528553633,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b1be0a872c552_54784821 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="log_title">
  	<h2>
	Đăng ký tài khoản
	</h2>
</div>
	<div class="col-md-12 col-xs-12 col-default">
		<div id="login">
			<form  method="post" id="validate">

				<div class="login-fields">
					<p><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</p>
					<div class="field">
						<label>Tài khoản:</label>
						<input type="text" name="email" value="" placeholder="Email" class="form-control required" />
					</div>
					<!-- /field -->
					<div class="field">
						<label for="password">Mật khẩu:</label>
						<input type="password" name="password" placeholder="Password" class="form-control required" />
					</div>
					<!-- /password -->
					<div class="field">
						<label for="password">Xác nhận mật khẩu:</label>
						<input type="password" name="repassword" value="" placeholder="Password" class="form-control required" />
					</div>
					<!-- /password -->
					<br>

					<div class="field">
						<label>Họ tên:</label>
						<input type="text" name="name" value="" placeholder="Name" class="form-control required" />
					</div>
					<!-- /field -->
					<div class="field">
						<label>Điện thoại:</label>
						<input type="text" name="phone" value="" placeholder="Phone" class="form-control required" />
					</div>
					<!-- /field -->
					<div class="field">
						<label>Địa chỉ:</label>
						<input type="text" name="address" value="" placeholder="Address" class="form-control required" />
					</div>
					<!-- /field -->
				</div>
				<!-- /login-fields -->

				<div class="login-actions">
					<button class="button btn btn-success btn-large" name="submit">Đăng ký</button>
				</div>
				<!-- .actions -->
			</form>
		</div>
	</div>


<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/validate.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
	$("#validate").validate();
<?php echo '</script'; ?>
><?php }
}
