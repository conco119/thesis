<?php
/* Smarty version 3.1.30, created on 2018-04-16 12:40:14
  from "/Users/mtd/Sites/htaccess/site/admin/view/layouts/login.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5ad4373ee3e035_57495272',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0a4ed5c401f6982f98386d72d43ef48444ef889e' => 
    array (
      0 => '/Users/mtd/Sites/htaccess/site/admin/view/layouts/login.tpl',
      1 => 1523857213,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ad4373ee3e035_57495272 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Đăng nhập hệ thống</title>
<base href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['domain'];?>
">
<link href="./hlstar.ico" rel="shortcut icon">

<!-- Bootstrap core CSS -->

<link href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
css/bootstrap.min.css" rel="stylesheet">

<link href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
fonts/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
css/animate.min.css" rel="stylesheet">

<!-- Custom styling plus plugins -->
<link href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
css/custom.css" rel="stylesheet">
<link href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
css/icheck/flat/green.css" rel="stylesheet">


<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/jquery.min.js"><?php echo '</script'; ?>
>

<!--[if lt IE 9]>
        <?php echo '<script'; ?>
 src="../assets/js/ie8-responsive-file-warning.js"><?php echo '</script'; ?>
>
        <![endif]-->

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
          <?php echo '<script'; ?>
 src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"><?php echo '</script'; ?>
>
          <?php echo '<script'; ?>
 src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"><?php echo '</script'; ?>
>
        <![endif]-->

</head>

<body style="background: #F7F7F7;">

	<!-- site content -->
	<?php $_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['tpl_file']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

	<!-- /site content -->

</body>

</html>
<?php }
}
