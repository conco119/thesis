<?php
/* Smarty version 3.1.30, created on 2018-06-09 16:04:31
  from "C:\xampp\htdocs\~mtd\htaccess\app\site\view\layouts\includes\sidebar.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b1b981f95b830_13807631',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4183304a9730bc35083fb09fc1a1a23bb3847b81' => 
    array (
      0 => 'C:\\xampp\\htdocs\\~mtd\\htaccess\\app\\site\\view\\layouts\\includes\\sidebar.tpl',
      1 => 1528535068,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b1b981f95b830_13807631 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="sidebar_title bg_34495e">
    <h3><i class="fa fa-tasks"></i> Danh Mục</h3>
</div>
<div class="category bg_white mar-btm">
    <ul>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['menu']->value, 'list');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['list']->value) {
?>
            <li><a href="./?mc=category&n=<?php echo $_smarty_tpl->tpl_vars['list']->value['menu_link'];?>
"> <?php echo $_smarty_tpl->tpl_vars['list']->value['name'];?>
 <?php if ($_smarty_tpl->tpl_vars['list']->value['child_menu'] != NULL) {?><i class="fa fa-caret-right"></i><?php }?></a>
                <?php if ($_smarty_tpl->tpl_vars['list']->value['child_menu'] != NULL) {?>
                    <ul>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list']->value['child_menu'], 'subList');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['subList']->value) {
?>
                            <li><a href="./?mc=category&n=<?php echo $_smarty_tpl->tpl_vars['subList']->value['menu_link'];?>
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
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['best_seller']->value, 'list');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['list']->value) {
?>
            <li>
                <div class="col-md-4 col-sm-4 col-xs-12 col-df text-center">
                    <a href="./?mc=product&site=detail&n=<?php echo $_smarty_tpl->tpl_vars['list']->value['link_name'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['list']->value['name'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['product_folder_link'];?>
/<?php echo $_smarty_tpl->tpl_vars['list']->value['image_name'];?>
" width="100%;"></a>
                </div>
                <div class="col-md-8 col-sm-8 col-xs-12 col-df">
                    <div class="info_prd">
                        <a href="./?mc=product&site=detail&n=<?php echo $_smarty_tpl->tpl_vars['list']->value['link_name'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['list']->value['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['list']->value['name'];?>
</a>
                    </div>
                    <div class="price">
                        <?php if ($_smarty_tpl->tpl_vars['list']->value['is_discount'] == 1) {?>
                            <?php echo $_smarty_tpl->tpl_vars['list']->value['sale_price'];?>
đ
                            <span><?php echo $_smarty_tpl->tpl_vars['list']->value['price'];?>
đ </span>
                        <?php } else { ?>
                            <?php echo $_smarty_tpl->tpl_vars['list']->value['price'];?>
đ
                        <?php }?>
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


<div class="bestseller bg_white mar-btm">
    <div class="sidebar_title bg_e84c3d">
        <h3><i class="fa fa-tasks"></i> Sản phẩm khuyến mãi</h3>
    </div>
    <ul>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sale_products']->value, 'list');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['list']->value) {
?>
            <li>
                <div class="col-md-4 col-sm-4 col-xs-12 col-df text-center">
                    <a href="./?mc=product&site=detail&n=<?php echo $_smarty_tpl->tpl_vars['list']->value['link_name'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['list']->value['name'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['product_folder_link'];?>
/<?php echo $_smarty_tpl->tpl_vars['list']->value['image_name'];?>
" width="100%;"></a>
                </div>
                <div class="col-md-8 col-sm-8 col-xs-12 col-df">
                    <div class="info_prd">
                        <a href="./?mc=product&site=detail&n=<?php echo $_smarty_tpl->tpl_vars['list']->value['link_name'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['list']->value['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['list']->value['name'];?>
</a>
                    </div>
                    <div class="price">
                        <?php if ($_smarty_tpl->tpl_vars['list']->value['is_discount'] == 1) {?>
                            <?php echo $_smarty_tpl->tpl_vars['list']->value['sale_price'];?>
đ
                            <span><?php echo $_smarty_tpl->tpl_vars['list']->value['price'];?>
đ </span>
                        <?php } else { ?>
                            <?php echo $_smarty_tpl->tpl_vars['list']->value['price'];?>
đ
                        <?php }?>
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
