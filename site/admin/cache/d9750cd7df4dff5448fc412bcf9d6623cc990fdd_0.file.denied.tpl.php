<?php
/* Smarty version 3.1.30, created on 2018-04-28 13:17:40
  from "/Users/mtd/Sites/htaccess/site/admin/view/home/denied.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5ae41204b44311_38608278',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd9750cd7df4dff5448fc412bcf9d6623cc990fdd' => 
    array (
      0 => '/Users/mtd/Sites/htaccess/site/admin/view/home/denied.tpl',
      1 => 1524896256,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ae41204b44311_38608278 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="error-container text-center">
	<br><br><br>
	<h1>Access Denied</h1>

	<h2>Sorry, You can not access to this function.</h2>

	<div class="error-details">
		This function was deleted or your permissions was not enought!
	</div> <!-- /error-details -->
	<br><br>
	<div class="error-actions">
		<a href="./admin" class="btn btn-large btn-primary">
			<i class="icon-chevron-left"></i>
			&nbsp;
			Back to Dashboard
		</a>



	</div> <!-- /error-actions -->

</div> <!-- /error-container -->
<?php }
}
