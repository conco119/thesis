<?php
/* Smarty version 3.1.30, created on 2018-06-08 11:56:32
  from "D:\DocumentRoot24\~mtd\htaccess\app\admin\view\layouts\includes\sidebar.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b1a0c80c48158_94767277',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b4800d76018959ac8ce111a765757704e899e9c8' => 
    array (
      0 => 'D:\\DocumentRoot24\\~mtd\\htaccess\\app\\admin\\view\\layouts\\includes\\sidebar.tpl',
      1 => 1528431886,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b1a0c80c48158_94767277 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="left_col scroll-view">

	<div class="navbar nav_title" style="border: 0;">
		<a href="./admin" class="site_title"><i class="fa fa-laptop"></i><span> MTD - Quản lý bán hàng</span></a>
	</div>
	<div class="clearfix"></div>
	<br />

	<!-- sidebar menu -->
	<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

		<div class="menu_section">
			<h3>Chức năng chính</h3>
			<ul class="nav side-menu">
				<li><a><i class="fa fa-desktop"></i> Bàn làm việc <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu" style="display: none">
						<li><a href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['prefix_admin'];?>
mc=export&site=index">Bán hàng</a></li>
						<li><a href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['prefix_admin'];?>
mc=import&site=index">Nhập hàng</a></li>
						<li><a href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['prefix_admin'];?>
mc=reimport&site=reimport">Khách trả hàng</a></li>
					</ul>
				</li>
				<li><a href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['prefix_admin'];?>
mc=money&site=index"><i class="fa fa-dollar"></i> Sổ thu chi</a></li>
				<li><a><i class="fa fa-product-hunt"></i> Sản phẩm<span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu" style="display: none">
						<li class="current-page" id="product_index_li"><a href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['prefix_admin'];?>
mc=product&site=index">Quản lý sản phẩm</a></li>
						<!--<li><a href="?mc=product&site=combo">Quản lý bộ sản phẩm</a></li> -->

						<li><a href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['prefix_admin'];?>
mc=productcat&site=index">Danh mục sản phẩm</a></li>
						<li><a href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['prefix_admin'];?>
mc=productunit&site=index">Đơn vị sản phẩm</a></li>
						<!--<li><a href="?mc=product&site=setup">Báo giá sản phẩm</a></li>-->
					</ul>
				</li>
				<li><a href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['prefix_admin'];?>
mc=service&site=index"><i style="width:26px;" class="glyphicon glyphicon-list-alt"></i>    Quản lý dịch vụ</a></li>
				<li><a><i class="fa fa-user-md"></i> Đối tác <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu" style="display: none">
						<li><a href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['prefix_admin'];?>
mc=customer&site=index">Khách hàng</a></li>
						<li><a href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['prefix_admin'];?>
mc=customergroup&site=index">Nhóm khách hàng</a></li>
						<li><a href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['prefix_admin'];?>
mc=supplier&site=index">Nhà cung cấp</a></li>
					</ul>
				</li>
				<li><a><i class="fa fa-folder-open"></i> Lưu trữ <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu" style="display: none">
						<!--<li><a href="?mc=product&site=warehouse">Kho hàng</a></li>-->
						<li><a href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['prefix_admin'];?>
mc=export&site=statistics">Hóa đơn bán hàng</a></li>
						<li><a href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['prefix_admin'];?>
mc=import&site=statistics">Hóa đơn nhập hàng</a></li>
						<li><a href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['prefix_admin'];?>
mc=reimport&site=statistics">Phiếu khách trả hàng</a></li>
					</ul>
				</li>
				<li><a><i class="fa fa-bar-chart-o"></i> Báo cáo <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu" style="display: none">
						<li><a href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['prefix_admin'];?>
mc=report&site=daily">Ghi sổ ngày</a></li>
						<li><a href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['prefix_admin'];?>
mc=product&site=statistics">Sản phẩm</a></li>
						<li><a href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['prefix_admin'];?>
mc=service&site=statistics">Dịch vụ</a></li>
						<li><a href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['prefix_admin'];?>
mc=report&site=performance">Lợi nhuận</a></li>
						<li><a href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['prefix_admin'];?>
mc=report&site=user">Nhân viên</a></li>
						<!--<li><a href="?mc=cost&site=index"> Tính giá vốn </a></li>-->
					</ul>
				</li>
				<li><a href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['prefix_admin'];?>
mc=user&site=index"><i class="fa fa-user"></i> Quản lý người dùng</a></li>
				<!--<li><a href="?mc=lock&site=index"><i class="fa fa-lock"></i> Khóa sổ </a></li>-->
			</ul>
		</div>
		<div class="menu_section">
			<h3>Cấu hình</h3>
			<ul class="nav side-menu">
				<li><a href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['prefix_admin'];?>
mc=setting&site=info"><i class="fa fa-info"></i>Thiết lập thông tin</a></li>
			</ul>
		</div>

	</div>
	<!-- /sidebar menu -->

	<!-- /menu footer buttons -->
	<div class="sidebar-footer hidden-small">
		
		</a> <a data-toggle="tooltip" data-placement="top" title="Logout"> <span
			class="glyphicon glyphicon-off"></span>
		</a>
	</div>
	<!-- /menu footer buttons -->
</div>
<?php echo '<script'; ?>
>
if($("body.nav-sm").length){
	$(".sidebar-footer.hidden-small").hide();
}
<?php echo '</script'; ?>
>
<?php }
}