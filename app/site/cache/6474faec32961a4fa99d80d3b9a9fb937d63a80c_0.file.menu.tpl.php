<?php
/* Smarty version 3.1.30, created on 2018-06-08 00:14:10
  from "/Users/mtd/Sites/htaccess/app/site/view/layouts/includes/menu.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b1967e2203133_71266870',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6474faec32961a4fa99d80d3b9a9fb937d63a80c' => 
    array (
      0 => '/Users/mtd/Sites/htaccess/app/site/view/layouts/includes/menu.tpl',
      1 => 1481712310,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b1967e2203133_71266870 (Smarty_Internal_Template $_smarty_tpl) {
?>

<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">MÁY TÍNH ĐÔNG TÂY</a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menubar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id="menubar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['output']->value['menu_main'], 'list');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['list']->value) {
?>
                    <li><a href="<?php echo $_smarty_tpl->tpl_vars['list']->value['url'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['list']->value['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['list']->value['name'];?>
</a></li>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

            </ul>
        </div>
    </div>
</nav><?php }
}
