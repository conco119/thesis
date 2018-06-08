<?php
/* Smarty version 3.1.30, created on 2018-06-08 00:14:10
  from "/Users/mtd/Sites/htaccess/app/site/view/layouts/includes/sidebar.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b1967e2259293_61929481',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '36855f5da0ae07d5dbdabec8e3b1d2458843004d' => 
    array (
      0 => '/Users/mtd/Sites/htaccess/app/site/view/layouts/includes/sidebar.tpl',
      1 => 1478317492,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b1967e2259293_61929481 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="sidebar_title bg_34495e">
    <h3><i class="fa fa-tasks"></i> Danh Mục</h3>
</div>
<div class="category bg_white mar-btm">
    <ul>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['output']->value['category'], 'list');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['list']->value) {
?> 
            <li><a href="<?php echo $_smarty_tpl->tpl_vars['list']->value['link'];?>
"> <?php echo $_smarty_tpl->tpl_vars['list']->value['name'];?>
 <?php if ($_smarty_tpl->tpl_vars['list']->value['sub'] != NULL) {?><i class="fa fa-caret-right"></i><?php }?></a>
                    <?php if ($_smarty_tpl->tpl_vars['list']->value['sub'] != NULL) {?>
                    <ul>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list']->value['sub'], 'subList');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['subList']->value) {
?>
                            <li><a href="<?php echo $_smarty_tpl->tpl_vars['subList']->value['link'];?>
"><?php echo $_smarty_tpl->tpl_vars['subList']->value['name'];?>
</a></li>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                    </ul>
                <?php }?>
            </li>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

    </ul>
</div>

<br>

<div class="bestseller bg_white mar-btm">
    <div class="sidebar_title bg_e84c3d">
        <h3><i class="fa fa-tasks"></i> Bán chạy nhất</h3>
    </div>
    <ul>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['output']->value['product_highlight'], 'list');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['list']->value) {
?>
            <li>
                <div class="col-md-4 col-sm-4 col-xs-12 col-df text-center">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['list']->value['link'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['list']->value['name'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['list']->value['img'];?>
" width="100%;"></a>
                </div>
                <div class="col-md-8 col-sm-8 col-xs-12 col-df">
                    <div class="info_prd">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['list']->value['link'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['list']->value['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['list']->value['name'];?>
</a>
                    </div>
                    <div class="price"><?php echo $_smarty_tpl->tpl_vars['list']->value['price_sale'];?>
</div>
                </div>
            </li>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>


    </ul>
    <div class="clear"></div>
</div>

<div class="sidebar_title bg_e84c3d">
    <h3><i class="fa fa-tasks"></i> So sảnh sản phẩm</h3>
</div>
<div class="compare_product bg_white mar-btm">
    <ul>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['output']->value['compare_product'], 'data');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
?>
            <li id="compare<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
">
                <div class="img">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['data']->value['avatar'];?>
">
                </div>
                <div class="prd_compare">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['data']->value['url'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['data']->value['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['data']->value['name'];?>
</a>
                </div>

                <i class="fa fa-times close" onclick="removeCompareProduct(<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
);"></i>
            </li>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

    </ul>

    <div class="compareItem">
        <a href="./so-sanh/" >
            <i class="fa fa-files-o"></i> So sánh <span><?php echo $_smarty_tpl->tpl_vars['arg']->value['number_compare'];?>
 sản phẩm</span>
        </a>
    </div> 
    <div class="clear"></div>
</div>

<div class="slider bg_white mar-btm">
    <ul class="sidebar_slider">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['output']->value['gallery_p6'], 'list');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['list']->value) {
?>
            <li><a href="<?php echo $_smarty_tpl->tpl_vars['list']->value['link'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['list']->value['name'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['list']->value['img'];?>
" width="100%;"></a></li>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

    </ul>
</div>


<?php }
}
