<?php
/* Smarty version 3.1.30, created on 2018-06-10 22:56:40
  from "/Users/mtd/Sites/htaccess/app/admin/view/layouts/error.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b1d4a38f285e4_56150075',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0fbfee94262e19870ad644bd727a0852e9e48e22' => 
    array (
      0 => '/Users/mtd/Sites/htaccess/app/admin/view/layouts/error.tpl',
      1 => 1528645640,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b1d4a38f285e4_56150075 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $_smarty_tpl->tpl_vars['arg']->value['setting']['name'];?>
</title>
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<base href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['domain'];?>
">
<link href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
css/style.css" rel="stylesheet">
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <?php echo '<script'; ?>
 src="http://html5shim.googlecode.com/svn/trunk/html5.js"><?php echo '</script'; ?>
>
    <![endif]-->

</head>
<body>

<div class="container">
	<?php $_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['tpl_file']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

</div>

</body>
</html>
<?php }
}
