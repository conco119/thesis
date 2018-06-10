<?php
/* Smarty version 3.1.30, created on 2018-06-10 19:44:39
  from "C:\xampp\htdocs\~mtd\htaccess\app\site\view\product\detail.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b1d1d37cea432_65847865',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '81b92a079f96fc804e5d1de8b6232c5df282e723' => 
    array (
      0 => 'C:\\xampp\\htdocs\\~mtd\\htaccess\\app\\site\\view\\product\\detail.tpl',
      1 => 1528634678,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b1d1d37cea432_65847865 (Smarty_Internal_Template $_smarty_tpl) {
?>


<div class="detail-product" id="product<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
">
    <div class="col-md-5 col-sm-5 col-xs-12 mar-top">
        <ul id="etalage">
            <li>
                <img class="etalage_thumb_image" src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['product_folder_link'];?>
/<?php echo $_smarty_tpl->tpl_vars['value']->value['images'][0]['name'];?>
" width="100%">
                <img class="etalage_source_image target" src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['product_folder_link'];?>
/<?php echo $_smarty_tpl->tpl_vars['value']->value['images'][0]['name'];?>
" width="100%">
            </li>
            <?php if ($_smarty_tpl->tpl_vars['value']->value['images'] != '') {?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['value']->value['images'], 'list', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['list']->value) {
?>
                <?php if ($_smarty_tpl->tpl_vars['k']->value != 0) {?>
                    <li>
                        <img class="etalage_thumb_image" src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['product_folder_link'];?>
/<?php echo $_smarty_tpl->tpl_vars['list']->value['name'];?>
" width="100%">
                        <img class="etalage_source_image target" src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['product_folder_link'];?>
/<?php echo $_smarty_tpl->tpl_vars['list']->value['name'];?>
" width="100%">
                    </li>
                <?php }?>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

            <?php }?>
        </ul>
        <img class="block-mobile" src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['product_folder_link'];?>
/<?php echo $_smarty_tpl->tpl_vars['value']->value['images'][0]['name'];?>
" width="100%" >
    </div>
    <div class="col-md-7 col-sm-7 col-xs-12">
        <div class="info_prd_detail">
            <h1 class="name"><?php echo $_smarty_tpl->tpl_vars['value']->value['name'];?>
</h1>
            <p class="by"><i class="fa fa-barcode"></i> Mã Sản phẩm: <b><?php echo $_smarty_tpl->tpl_vars['value']->value['code'];?>
</b></p>
            <p><i class="fa fa-trophy"></i> Nhãn Hiệu: <b><?php echo $_smarty_tpl->tpl_vars['value']->value['trademark_name'];?>
</b></p>
            <div class="box">
                <div class="show-small-info">
                    <ul>
                        
                        <li><i class="fa fa-eye"></i> <b>Lượt xem</b> <?php echo $_smarty_tpl->tpl_vars['value']->value['views'];?>
</li>
                    </ul>
                </div>
                <div class="show-small-info">
                    <p><i class="fa fa-tags"></i> <?php echo $_smarty_tpl->tpl_vars['value']->value['category_name'];?>
</p>
                </div>
                <div class="show-small-info">
                     <p><i class="fa fa-folder-open"></i> Tình trạng:
                        <b>
                        <?php if ($_smarty_tpl->tpl_vars['value']->value['imported']-$_smarty_tpl->tpl_vars['value']->value['exported'] > 0) {?>
                            <span style='color:red'> Còn hàng </span>
                        <?php } else { ?>
                            <span style='color:red'>  Hết hàng  </span>
                        <?php }?>
                        </b>
                    </p>
                </div>

                <div class="show-small-info">
                    <div class="star-big" id="Star<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
">
                        <?php
$_smarty_tpl->tpl_vars['index'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['index']->step = 1;$_smarty_tpl->tpl_vars['index']->total = (int) ceil(($_smarty_tpl->tpl_vars['index']->step > 0 ? 5+1 - (1) : 1-(5)+1)/abs($_smarty_tpl->tpl_vars['index']->step));
if ($_smarty_tpl->tpl_vars['index']->total > 0) {
for ($_smarty_tpl->tpl_vars['index']->value = 1, $_smarty_tpl->tpl_vars['index']->iteration = 1;$_smarty_tpl->tpl_vars['index']->iteration <= $_smarty_tpl->tpl_vars['index']->total;$_smarty_tpl->tpl_vars['index']->value += $_smarty_tpl->tpl_vars['index']->step, $_smarty_tpl->tpl_vars['index']->iteration++) {
$_smarty_tpl->tpl_vars['index']->first = $_smarty_tpl->tpl_vars['index']->iteration == 1;$_smarty_tpl->tpl_vars['index']->last = $_smarty_tpl->tpl_vars['index']->iteration == $_smarty_tpl->tpl_vars['index']->total;?>
                            <?php if ($_smarty_tpl->tpl_vars['value']->value['number_user_rate'] != 0) {?>
                                <?php if ((round(($_smarty_tpl->tpl_vars['value']->value['total_rate']/$_smarty_tpl->tpl_vars['value']->value['number_user_rate'])))-$_smarty_tpl->tpl_vars['index']->value >= 0) {?>
                                    <i class="fa fa-star checked" onclick="SetStarProduct(<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
, <?php echo $_smarty_tpl->tpl_vars['index']->value;?>
);"></i>
                                <?php } else { ?>
                                    <i class="fa fa-star" onclick="SetStarProduct(<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
, <?php echo $_smarty_tpl->tpl_vars['index']->value;?>
);"></i>
                                <?php }?>
                            <?php } else { ?>
                                    <i class="fa fa-star" onclick="SetStarProduct(<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
, <?php echo $_smarty_tpl->tpl_vars['index']->value;?>
);"></i>
                            <?php }?>
                        <?php }
}
?>


                        <span><?php echo $_smarty_tpl->tpl_vars['value']->value['number_user_rate'];?>
 đánh giá -
                            <?php if ($_smarty_tpl->tpl_vars['value']->value['number_user_rate'] != 0) {?>
                                <?php echo round(($_smarty_tpl->tpl_vars['value']->value['total_rate']/$_smarty_tpl->tpl_vars['value']->value['number_user_rate']));?>

                            <?php } else { ?>
                                0
                            <?php }?>
                        điểm</span>
                    </div>
                </div>
            </div>

            <div class="price">
                <p>
                <label>Giá bán:</label>
                    <?php if ($_smarty_tpl->tpl_vars['value']->value['is_discount'] == 1) {?>
                        <?php echo $_smarty_tpl->tpl_vars['value']->value['sale_price'];?>
đ
                        <span><?php echo $_smarty_tpl->tpl_vars['value']->value['price'];?>
đ </span>
                    <?php } else { ?>
                        <?php echo $_smarty_tpl->tpl_vars['value']->value['price'];?>
đ
                    <?php }?>
                </p>
            </div>

            <div class="addcart">
               
               <button onclick="addToCart(<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
);"><i class="fa fa-opencart" ></i> Đặt Mua Ngay</button>
            </div>

            <div class="support-detail">
                <label>Tel: <?php echo $_smarty_tpl->tpl_vars['info']->value['info']['phone'];?>
</label>

                <ul class="help-payal">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['output']->value['menu_p4'], 'list');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['list']->value) {
?>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list']->value['child_menu'], 'child', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['child']->value) {
?>
                            <li><a href="<?php echo $_smarty_tpl->tpl_vars['child']->value['link'];?>
"><?php echo $_smarty_tpl->tpl_vars['k']->value+1;?>
:  <?php echo $_smarty_tpl->tpl_vars['child']->value['name'];?>
</a></li>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                </ul>
            </div>


            <!--<div class="pro-show-btn mar-top mar-btm">
                <button class="btn-like-big" type="button" onclick="likeProduct(<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
);"><i class="fa fa-heart-o"></i> Yêu thích </button>
                <button type="button" class="btn-compare-big" onclick="compareProduct(<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
, <?php echo $_smarty_tpl->tpl_vars['value']->value['category_id'];?>
);"><i class="fa fa-files-o"></i> So sánh</button>
            </div>
            -->

        </div>
    </div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 col-df">
    <div class="btn_tab_event">
        <a href="javascript:void(0)" class="active" tab="tab0">Mô tả sản phẩm</a>
        <div class="tab_cont block bg_white" id="tab0">
             <?php echo $_smarty_tpl->tpl_vars['value']->value['content'];?>

        </div>
    </div>
    <br /><br />
</div>



<div class="sidebar_title full bg_34495e">
    <h3> Sản phẩm liên quan</h3>
</div>

<div class="row">
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['relate_product']->value, 'list');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['list']->value) {
?>
        <div class="col-md-4 col-sm-4 col-xs-12">
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
                        <button type="button" class="btn_prd cart" onclick="addToCart(<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
);">
                            <i class="fa fa-opencart"></i> Thêm vào giỏ hàng
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

</div>
<br />

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/cart.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/hoverZoomjquery.etalage.min.js"><?php echo '</script'; ?>
>

    <?php echo '<script'; ?>
 type="text/javascript">
        $('#etalage').etalage({
            thumb_image_height: 300
        });

    <?php echo '</script'; ?>
>

<?php }
}
