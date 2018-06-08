<?php
/* Smarty version 3.1.30, created on 2018-06-08 22:32:22
  from "C:\xampp\htdocs\~mtd\htaccess\app\admin\view\layouts\includes\header.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b1aa186daef90_71921083',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '324eb754bffa1e5a451bf1f969f245f81ebf640b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\~mtd\\htaccess\\app\\admin\\view\\layouts\\includes\\header.tpl',
      1 => 1528469385,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b1aa186daef90_71921083 (Smarty_Internal_Template $_smarty_tpl) {
?>

<div class="top_nav">

	<div class="nav_menu">
		<nav class="">
			<div class="nav toggle">
				<a id="menu_toggle"><i class="fa fa-bars"></i></a>
			</div>

			<ul class="nav navbar-nav navbar-right">
				<li class="">
					<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown">
						<img src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['avatar_link'];?>
" alt=""><?php echo $_smarty_tpl->tpl_vars['arg']->value['user']['username'];?>
 <span class=" fa fa-angle-down"></span>
					</a>
					<ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
						<li><a href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['prefix_admin'];?>
mc=user&site=profile"> Tài khoản</a></li>
						<li><a href="?mod=install&site=index"> Thông tin sử dụng</a></li>
            <li><a href="?mod=upgrade&site=index"> Phiên bản</a></li>
						<li><a href="admin?mc=user&site=logout"><i class="fa fa-sign-out pull-right"></i> Đăng xuất</a></li>
					</ul>
				</li>
			</ul>
		</nav>
	</div>

</div>
<?php }
}
