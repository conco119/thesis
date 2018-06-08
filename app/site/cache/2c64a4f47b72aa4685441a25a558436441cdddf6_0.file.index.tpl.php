<?php
/* Smarty version 3.1.30, created on 2018-06-08 16:40:16
  from "D:\DocumentRoot24\~mtd\htaccess\app\site\view\category\index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b1a4f00cb1ac0_79119756',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2c64a4f47b72aa4685441a25a558436441cdddf6' => 
    array (
      0 => 'D:\\DocumentRoot24\\~mtd\\htaccess\\app\\site\\view\\category\\index.tpl',
      1 => 1528450804,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b1a4f00cb1ac0_79119756 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="sidebar_title bg_34495e">
    <h1><?php echo $_smarty_tpl->tpl_vars['category']->value['name'];?>
</h1>
</div>

<div class="row">

    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['products']->value, 'list');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['list']->value) {
?>
    <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="product_item">
            <div class="img">
               <img src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['product_folder_link'];?>
/<?php echo $_smarty_tpl->tpl_vars['list']->value['image_name'];?>
" width="100%">
            </div>
            <div class="name">
                <a href="<?php echo $_smarty_tpl->tpl_vars['list']->value['link'];?>
"><?php echo $_smarty_tpl->tpl_vars['list']->value['name'];?>
</a>
            </div>
            <p class="price"><?php echo $_smarty_tpl->tpl_vars['list']->value['price'];?>
</p>
            <div class="num_star" id="Star<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
">
            	<?php echo $_smarty_tpl->tpl_vars['list']->value['stars'];?>

            	<span><?php echo $_smarty_tpl->tpl_vars['list']->value['number_point'];?>
 đánh giá - <?php echo $_smarty_tpl->tpl_vars['list']->value['avg_point'];?>
 điểm</span>
            </div>
            <div class="btn_function">
                <div class="col-md-8 col-sm-8 col-xs-8 col-df">
                    <button type="button" class="btn_prd cart" title="Thêm vào giỏ hàng" onclick="addToCart(<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
);"><i class="fa fa-opencart"></i> Thêm vào giỏ hàng </button>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-2 col-df">
                    <button type="button" class="btn_prd like" title="Yêu thích sản phẩm" onclick="likeProduct(<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
);"><i class="fa fa-heart-o"></i></button>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-2 col-df">
                    <button class="btn_prd btn-compare" title="Thêm vào so sánh" onclick="compareProduct(<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
, <?php echo $_smarty_tpl->tpl_vars['list']->value['category_id'];?>
);"><i class="fa fa-files-o"></i></button>
                </div>
            </div>
        </div>
    </div>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>


    <div class="clear"></div>
</div>

<div class="mar-top">
    <ul class="paging">
        <?php echo $_smarty_tpl->tpl_vars['paging']->value['paging'];?>


    </ul>
</div>

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/cart.js"><?php echo '</script'; ?>
>
<?php }
}
