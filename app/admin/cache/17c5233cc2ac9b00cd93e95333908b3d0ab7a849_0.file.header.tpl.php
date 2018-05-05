<?php
/* Smarty version 3.1.30, created on 2018-05-03 20:00:49
  from "/Users/mtd/Sites/htaccess/site/admin/view/layouts/includes/header.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5aeb0801794764_22096089',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '17c5233cc2ac9b00cd93e95333908b3d0ab7a849' => 
    array (
      0 => '/Users/mtd/Sites/htaccess/site/admin/view/layouts/includes/header.tpl',
      1 => 1524912320,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5aeb0801794764_22096089 (Smarty_Internal_Template $_smarty_tpl) {
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
						<img src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
images/img.jpg" alt=""><?php echo $_smarty_tpl->tpl_vars['arg']->value['user']['username'];?>
 <span class=" fa fa-angle-down"></span>
					</a>
					<ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
						<li><a href="?mod=account&site=profile"> Tài khoản</a></li>
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
