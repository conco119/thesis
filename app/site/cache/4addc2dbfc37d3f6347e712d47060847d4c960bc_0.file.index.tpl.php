<?php
/* Smarty version 3.1.30, created on 2018-06-08 16:01:09
  from "D:\DocumentRoot24\~mtd\htaccess\app\site\view\home\index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b1a45d52d1141_15896502',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4addc2dbfc37d3f6347e712d47060847d4c960bc' => 
    array (
      0 => 'D:\\DocumentRoot24\\~mtd\\htaccess\\app\\site\\view\\home\\index.tpl',
      1 => 1528448461,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b1a45d52d1141_15896502 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['random_product']->value != NULL) {?>
    <div class="img_cate_bg mar-btm">
        <ul class="bxslider">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['random_product']->value, 'list');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['list']->value) {
?>
                <li><img src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['product_folder_link'];?>
/<?php echo $_smarty_tpl->tpl_vars['list']->value['image_name'];?>
"></li>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

        </ul>
    </div>
<?php }?>

<div class="sidebar_title bg_34495e mar-btn-20">
    <h1>Đèn thông minh</h1>
</div>
<div class="row">
        <ul class="prod-slider">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['smart_light']->value, 'list');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['list']->value) {
?>
                <li>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="product_item">
                            <div class="img">
                                <a href="./?mc=productdetail&n=<?php echo $_smarty_tpl->tpl_vars['list']->value['link_name'];?>
">
                                    <img src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['product_folder_link'];?>
/<?php echo $_smarty_tpl->tpl_vars['list']->value['image_name'];?>
" width="100%">
                                </a>
                            </div>
                            <div class="name">
                                <a href="<?php echo $_smarty_tpl->tpl_vars['list']->value['link'];?>
"><?php echo $_smarty_tpl->tpl_vars['list']->value['name'];?>
</a>
                            </div>
                            <p class="price">
                                <?php echo $_smarty_tpl->tpl_vars['list']->value['price'];?>
đ
                                <?php if ($_smarty_tpl->tpl_vars['list']->value['is_discount'] == 1) {?>
                                        <span><?php echo $_smarty_tpl->tpl_vars['list']->value['sale_price'];?>
đ </span>
                                <?php }?>
                            </p>

                            <div class="num_star" id="Star<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
">
                                <i class="fa fa-star" onclick="SetStarProduct(32, 1);"></i>
                                <i class="fa fa-star" onclick="SetStarProduct(32, 1);"></i>
                                <i class="fa fa-star" onclick="SetStarProduct(32, 1);"></i>
                                <i class="fa fa-star" onclick="SetStarProduct(32, 1);"></i>
                                <i class="fa fa-star" onclick="SetStarProduct(32, 1);"></i>
                                <span><?php echo $_smarty_tpl->tpl_vars['list']->value['number_point'];?>
 đánh giá - <?php echo $_smarty_tpl->tpl_vars['list']->value['avg_point'];?>
 điểm</span>
                            </div>
                            <div class="btn_function">
                                <div class="col-md-12 col-sm-12 col-xs-12 col-df">
                                    <button type="button" class="btn_prd cart" title="Thêm vào giỏ hàng"
                                            onclick="addToCart(<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
);"><i class="fa fa-opencart"></i> Thêm vào
                                        giỏ hàng
                                    </button>
                                </div>
                            </div>
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

<div class="sidebar_title bg_34495e mar-btn-20">
    <h1>Ổ cắm thông minh</h1>
</div>
<div class="row">
        <ul class="prod-slider">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['plugin']->value, 'list');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['list']->value) {
?>
                <li>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="product_item">
                            <div class="img">
                                <a href="./?mc=productdetail&n=<?php echo $_smarty_tpl->tpl_vars['list']->value['link_name'];?>
">
                                    <img src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['product_folder_link'];?>
/<?php echo $_smarty_tpl->tpl_vars['list']->value['image_name'];?>
" width="100%">
                                </a>
                            </div>
                            <div class="name">
                                <a href="<?php echo $_smarty_tpl->tpl_vars['list']->value['link'];?>
"><?php echo $_smarty_tpl->tpl_vars['list']->value['name'];?>
</a>
                            </div>
                            <p class="price">
                                <?php echo $_smarty_tpl->tpl_vars['list']->value['price'];?>
đ
                                <?php if ($_smarty_tpl->tpl_vars['list']->value['is_discount'] == 1) {?>
                                        <span><?php echo $_smarty_tpl->tpl_vars['list']->value['sale_price'];?>
đ </span>
                                <?php }?>
                            </p>

                            <div class="num_star" id="Star<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
">
                                <i class="fa fa-star" onclick="SetStarProduct(32, 1);"></i>
                                <i class="fa fa-star" onclick="SetStarProduct(32, 1);"></i>
                                <i class="fa fa-star" onclick="SetStarProduct(32, 1);"></i>
                                <i class="fa fa-star" onclick="SetStarProduct(32, 1);"></i>
                                <i class="fa fa-star" onclick="SetStarProduct(32, 1);"></i>
                                <span><?php echo $_smarty_tpl->tpl_vars['list']->value['number_point'];?>
 đánh giá - <?php echo $_smarty_tpl->tpl_vars['list']->value['avg_point'];?>
 điểm</span>
                            </div>
                            <div class="btn_function">
                                <div class="col-md-12 col-sm-12 col-xs-12 col-df">
                                    <button type="button" class="btn_prd cart" title="Thêm vào giỏ hàng"
                                            onclick="addToCart(<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
);"><i class="fa fa-opencart"></i> Thêm vào
                                        giỏ hàng
                                    </button>
                                </div>
                            </div>
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

<div class="sidebar_title bg_34495e mar-btn-20">
    <h1>Thiết bị an ninh</h1>
</div>
<div class="row">
        <ul class="prod-slider">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['security']->value, 'list');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['list']->value) {
?>
                <li>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="product_item">
                            <div class="img">
                                <a href="./?mc=productdetail&n=<?php echo $_smarty_tpl->tpl_vars['list']->value['link_name'];?>
">
                                    <img src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['product_folder_link'];?>
/<?php echo $_smarty_tpl->tpl_vars['list']->value['image_name'];?>
" width="100%">
                                </a>
                            </div>
                            <div class="name">
                                <a href="<?php echo $_smarty_tpl->tpl_vars['list']->value['link'];?>
"><?php echo $_smarty_tpl->tpl_vars['list']->value['name'];?>
</a>
                            </div>
                            <p class="price">
                                <?php echo $_smarty_tpl->tpl_vars['list']->value['price'];?>
đ
                                <?php if ($_smarty_tpl->tpl_vars['list']->value['is_discount'] == 1) {?>
                                        <span><?php echo $_smarty_tpl->tpl_vars['list']->value['sale_price'];?>
đ </span>
                                <?php }?>
                            </p>

                            <div class="num_star" id="Star<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
">
                                <i class="fa fa-star" onclick="SetStarProduct(32, 1);"></i>
                                <i class="fa fa-star" onclick="SetStarProduct(32, 1);"></i>
                                <i class="fa fa-star" onclick="SetStarProduct(32, 1);"></i>
                                <i class="fa fa-star" onclick="SetStarProduct(32, 1);"></i>
                                <i class="fa fa-star" onclick="SetStarProduct(32, 1);"></i>
                                <span><?php echo $_smarty_tpl->tpl_vars['list']->value['number_point'];?>
 đánh giá - <?php echo $_smarty_tpl->tpl_vars['list']->value['avg_point'];?>
 điểm</span>
                            </div>
                            <div class="btn_function">
                                <div class="col-md-12 col-sm-12 col-xs-12 col-df">
                                    <button type="button" class="btn_prd cart" title="Thêm vào giỏ hàng"
                                            onclick="addToCart(<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
);"><i class="fa fa-opencart"></i> Thêm vào
                                        giỏ hàng
                                    </button>
                                </div>
                            </div>
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

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/cart.js"><?php echo '</script'; ?>
>
<?php }
}
