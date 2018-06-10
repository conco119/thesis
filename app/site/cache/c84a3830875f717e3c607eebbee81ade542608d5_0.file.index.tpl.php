<?php
/* Smarty version 3.1.30, created on 2018-06-10 22:14:44
  from "/Users/mtd/Sites/htaccess/app/site/view/product/index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b1d4064dbcdd7_13163853',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c84a3830875f717e3c607eebbee81ade542608d5' => 
    array (
      0 => '/Users/mtd/Sites/htaccess/app/site/view/product/index.tpl',
      1 => 1528643415,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b1d4064dbcdd7_13163853 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="sidebar_title bg_34495e">
    <h1>SẢN PHẨM (<?php echo $_smarty_tpl->tpl_vars['number_product']->value;?>
 sản phẩm)</h1>
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
             <a href="?mc=product&site=detail&n=<?php echo $_smarty_tpl->tpl_vars['list']->value['link_name'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['product_folder_link'];?>
/<?php echo $_smarty_tpl->tpl_vars['list']->value['image_name'];?>
" width="100%"><a/>
            </div>
            <div class="name">
                <a href="?mc=product&site=detail&n=<?php echo $_smarty_tpl->tpl_vars['list']->value['link_name'];?>
"><?php echo $_smarty_tpl->tpl_vars['list']->value['name'];?>
</a>
            </div>
            <p class="price">
                <?php if ($_smarty_tpl->tpl_vars['list']->value['is_discount'] == 1) {?>
                    <?php echo $_smarty_tpl->tpl_vars['list']->value['sale_price'];?>
đ
                    <span><?php echo $_smarty_tpl->tpl_vars['list']->value['price'];?>
đ </span>
                <?php } else { ?>
                    <?php echo $_smarty_tpl->tpl_vars['list']->value['price'];?>
đ
                <?php }?>
            </p>
            <div class="num_star" id="Star<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
">
                <?php
$_smarty_tpl->tpl_vars['index'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['index']->step = 1;$_smarty_tpl->tpl_vars['index']->total = (int) ceil(($_smarty_tpl->tpl_vars['index']->step > 0 ? 5+1 - (1) : 1-(5)+1)/abs($_smarty_tpl->tpl_vars['index']->step));
if ($_smarty_tpl->tpl_vars['index']->total > 0) {
for ($_smarty_tpl->tpl_vars['index']->value = 1, $_smarty_tpl->tpl_vars['index']->iteration = 1;$_smarty_tpl->tpl_vars['index']->iteration <= $_smarty_tpl->tpl_vars['index']->total;$_smarty_tpl->tpl_vars['index']->value += $_smarty_tpl->tpl_vars['index']->step, $_smarty_tpl->tpl_vars['index']->iteration++) {
$_smarty_tpl->tpl_vars['index']->first = $_smarty_tpl->tpl_vars['index']->iteration == 1;$_smarty_tpl->tpl_vars['index']->last = $_smarty_tpl->tpl_vars['index']->iteration == $_smarty_tpl->tpl_vars['index']->total;?>
                    <?php if ($_smarty_tpl->tpl_vars['list']->value['number_user_rate'] != 0) {?>
                        <?php if ((round(($_smarty_tpl->tpl_vars['list']->value['total_rate']/$_smarty_tpl->tpl_vars['list']->value['number_user_rate'])))-$_smarty_tpl->tpl_vars['index']->value >= 0) {?>
                            <i class="fa fa-star checked" onclick="SetStarProduct(<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
, <?php echo $_smarty_tpl->tpl_vars['index']->value;?>
);"></i>
                        <?php } else { ?>
                            <i class="fa fa-star" onclick="SetStarProduct(<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
, <?php echo $_smarty_tpl->tpl_vars['index']->value;?>
);"></i>
                        <?php }?>
                    <?php } else { ?>
                            <i class="fa fa-star" onclick="SetStarProduct(<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
, <?php echo $_smarty_tpl->tpl_vars['index']->value;?>
);"></i>
                    <?php }?>
                <?php }
}
?>


                <span><?php echo $_smarty_tpl->tpl_vars['list']->value['number_user_rate'];?>
 đánh giá -
                    <?php if ($_smarty_tpl->tpl_vars['list']->value['number_user_rate'] != 0) {?>
                        <?php echo round(($_smarty_tpl->tpl_vars['list']->value['total_rate']/$_smarty_tpl->tpl_vars['list']->value['number_user_rate']));?>

                    <?php } else { ?>
                        0
                    <?php }?>
                điểm</span>
            </div>
            <div class="btn_function">
                <div class="col-md-12 col-sm-12 col-xs-12 col-df">
                    <button type="button" class="btn_prd cart" title="Thêm vào giỏ hàng" onclick="addToCart(<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
);"><i class="fa fa-opencart"></i> Thêm vào giỏ hàng </button>
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
