<?php
/* Smarty version 3.1.30, created on 2018-06-10 23:25:25
  from "/Users/mtd/Sites/htaccess/app/admin/view/home/denied.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b1d50f5343e61_36912684',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '996cb4ea2d3533f12d6ab098f8627f5d5f503287' => 
    array (
      0 => '/Users/mtd/Sites/htaccess/app/admin/view/home/denied.tpl',
      1 => 1528647202,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b1d50f5343e61_36912684 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="error-container text-center">
	<br><br><br>
	<h1>Không thể truy cập</h1>

	<h2>Không thể sử dụng chức năng này</h2>

	<div class="error-details">
		Quyền hạn không đủ
	</div> <!-- /error-details -->
	<br><br>
	<div class="error-actions">
		<a href="./admin" class="btn btn-large btn-primary">
			<i class="icon-chevron-left"></i>
			&nbsp;
			Trở về trang chủ
		</a>



	</div> <!-- /error-actions -->

</div> <!-- /error-container -->
<?php }
}
