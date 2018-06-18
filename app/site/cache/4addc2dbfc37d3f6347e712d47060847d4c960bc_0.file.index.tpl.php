<?php
/* Smarty version 3.1.30, created on 2018-06-18 13:36:51
  from "D:\DocumentRoot24\~mtd\htaccess\app\site\view\home\index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b275303112a35_70793440',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4addc2dbfc37d3f6347e712d47060847d4c960bc' => 
    array (
      0 => 'D:\\DocumentRoot24\\~mtd\\htaccess\\app\\site\\view\\home\\index.tpl',
      1 => 1528691475,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b275303112a35_70793440 (Smarty_Internal_Template $_smarty_tpl) {
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
                                <a href="./?mc=product&site=detail&n=<?php echo $_smarty_tpl->tpl_vars['list']->value['link_name'];?>
">
                                    <img src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['product_folder_link'];?>
/<?php echo $_smarty_tpl->tpl_vars['list']->value['image_name'];?>
" width="100%">
                                </a>
                            </div>
                            <div class="name">
                                <a href="./?mc=product&site=detail&n=<?php echo $_smarty_tpl->tpl_vars['list']->value['link_name'];?>
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
                                <a href="./?mc=product&site=detail&n=<?php echo $_smarty_tpl->tpl_vars['list']->value['link_name'];?>
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
                                <a href="./?mc=product&site=detail&n=<?php echo $_smarty_tpl->tpl_vars['list']->value['link_name'];?>
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
