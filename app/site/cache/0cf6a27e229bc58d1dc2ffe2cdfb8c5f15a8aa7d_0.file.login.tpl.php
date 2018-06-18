<?php
/* Smarty version 3.1.30, created on 2018-06-18 13:36:53
  from "D:\DocumentRoot24\~mtd\htaccess\app\site\view\layouts\login.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b27530522afb3_53941299',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0cf6a27e229bc58d1dc2ffe2cdfb8c5f15a8aa7d' => 
    array (
      0 => 'D:\\DocumentRoot24\\~mtd\\htaccess\\app\\site\\view\\layouts\\login.tpl',
      1 => 1528691475,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b27530522afb3_53941299 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $_smarty_tpl->tpl_vars['seo']->value['title'];?>
</title>
        <base href="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
">
        <meta name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['seo']->value['keyword'];?>
" />
        <meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['seo']->value['description'];?>
" />
        <meta name="robots" content="noodp,index,follow" />
        <meta name='revisit-after' content='1 days' />

        <meta name="viewport" content="width=device-width,initial-sacle=1">

        <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
css/login.css" >
        <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
css/mobile.css" >
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/font-awesome-4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/bootstrap/css/bootstrap-theme.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/jquery.bxslider/jquery.bxslider.css">

        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/jquery-2.1.3.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/jquery.bxslider/plugins/jquery.fitvids.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/jquery.bxslider/jquery.bxslider.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/bootstrap/js/bootstrap.min.js"><?php echo '</script'; ?>
>

        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/main.js"><?php echo '</script'; ?>
>
    </head>
    <body>

    <div class="container">
        <div class="login_box" style="margin-top: 70px;">
            <?php $_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['tpl_file']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

            <div class="log_footer">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['errors']->value, 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
                <p ><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</p>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>


                <p class="text-center"><a href="./">Trở về trang chủ</a></p>
            </div>
        </div>
    </div>

</html><?php }
}
