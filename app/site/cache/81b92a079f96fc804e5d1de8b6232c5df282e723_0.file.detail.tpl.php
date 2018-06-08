<?php
/* Smarty version 3.1.30, created on 2018-06-09 00:01:23
  from "C:\xampp\htdocs\~mtd\htaccess\app\site\view\product\detail.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b1ab66333e155_91267437',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '81b92a079f96fc804e5d1de8b6232c5df282e723' => 
    array (
      0 => 'C:\\xampp\\htdocs\\~mtd\\htaccess\\app\\site\\view\\product\\detail.tpl',
      1 => 1528469385,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b1ab66333e155_91267437 (Smarty_Internal_Template $_smarty_tpl) {
?>


<div class="detail-product" id="product<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
">
    <div class="col-md-5 col-sm-5 col-xs-12 mar-top">

        <ul id="etalage">
            <li>
                <img class="etalage_thumb_image" src="<?php echo $_smarty_tpl->tpl_vars['value']->value['avatar'];?>
" width="100%">
                <img class="etalage_source_image target" src="<?php echo $_smarty_tpl->tpl_vars['value']->value['avatar'];?>
" width="100%">
            </li>
            <?php if ($_smarty_tpl->tpl_vars['images']->value != '') {?>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['images']->value, 'list');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['list']->value) {
?>
                <li>
                    <img class="etalage_thumb_image" src="<?php echo $_smarty_tpl->tpl_vars['list']->value;?>
" width="100%">
                    <img class="etalage_source_image target" src="<?php echo $_smarty_tpl->tpl_vars['list']->value;?>
" width="100%">
                </li>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

            <?php }?>
        </ul>
        <img class="block-mobile" src="<?php echo $_smarty_tpl->tpl_vars['value']->value['avatar'];?>
" width="100%" >
    </div>
    <div class="col-md-7 col-sm-7 col-xs-12">
        <div class="info_prd_detail">
            <h1 class="name"><?php echo $_smarty_tpl->tpl_vars['value']->value['name'];?>
</h1>
            <p class="by"><i class="fa fa-barcode"></i> Mã Sản phẩm: <b><?php echo $_smarty_tpl->tpl_vars['value']->value['code'];?>
</b></p>
            <?php if ($_smarty_tpl->tpl_vars['value']->value['trademark'] != NULL) {?><p><i class="fa fa-trophy"></i> Nhãn Hiệu: <b><?php echo $_smarty_tpl->tpl_vars['value']->value['trademark'];?>
</b></p><?php }?>
            <div class="box">
                <div class="show-small-info">
                    <ul>
                        <li><i class="fa fa-clock-o"></i> Cập nhật lúc <?php echo $_smarty_tpl->tpl_vars['value']->value['updated'];?>
 </li>
                        <li><i class="fa fa-eye"></i> <?php echo $_smarty_tpl->tpl_vars['value']->value['views'];?>
 lượt</li>
                        <li><i class="fa fa-heart-o"></i> <?php echo $_smarty_tpl->tpl_vars['value']->value['likes'];?>
 lượt</li>
                    </ul>
                </div>
                <div class="show-small-info">
                    <p><i class="fa fa-tags"></i> <?php echo $_smarty_tpl->tpl_vars['value']->value['category'];?>
</p>
                </div>

                <div class="show-small-info">
                    <p id="Star<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
" class="star-big">
                        <?php echo $_smarty_tpl->tpl_vars['value']->value['stars'];?>

                        <span><?php echo $_smarty_tpl->tpl_vars['value']->value['number_point'];?>
 đánh giá - <?php echo $_smarty_tpl->tpl_vars['value']->value['avg_point'];?>
 điểm</span>
                    </p>
                </div>
            </div>

            <div class="price">
                <p><label>Giá bán:</label> <?php echo $_smarty_tpl->tpl_vars['value']->value['price_sale'];?>
</p>
            </div>

            <div class="addcart">
               Số Lượng: <input type="number" width="30" value="1" id="CartNumber<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
"/>   <button onclick="addNumberToCart(<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
);"><i class="fa fa-opencart" ></i> Đặt Mua Ngay</button>
                <button class="btn-like-big" type="button" onclick="likeProduct(<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
);"><i class="fa fa-heart-o"></i> Yêu thích </button>
                <button type="button" class="btn-compare-big" onclick="compareProduct(<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
, <?php echo $_smarty_tpl->tpl_vars['value']->value['category_id'];?>
);"><i class="fa fa-files-o"></i> So sánh</button>
            </div>
            
            <div class="support-detail">
                <label>Tel: <?php echo $_smarty_tpl->tpl_vars['output']->value['info_footer']['phone'];?>
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
        <a href="javascript:void(0)" class="active" tab="tab0">Thống số kỹ thuật</a>
        <a href="javascript:void(0)" tab="tab1">Mô tả sản phẩm</a>
        <a href="javascript:void(0)" tab="tab2">Đánh giá (0)</a>

        <div class="tab_cont block bg_white" id="tab0">
            <?php echo $_smarty_tpl->tpl_vars['value']->value['description'];?>

        </div>
        <div class="tab_cont bg_white" id="tab1">
            <?php echo $_smarty_tpl->tpl_vars['value']->value['content'];?>

        </div>
        <div class="tab_cont bg_white" id="tab2">
            <div class="fb-comments" data-href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['this_link'];?>
" data-numposts="3"  data-width="100%" data-colorscheme="light"></div>	
        </div>
    </div>
    <br /><br />
</div>



<div class="sidebar_title full bg_34495e">
    <h3> Sản phẩm liên quan</h3>
</div>

<div class="row">
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['other']->value, 'list');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['list']->value) {
?>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="product_item">
                <div class="img">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['list']->value['link'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['list']->value['img'];?>
" width="100%"></a>
                </div>
                <div class="name">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['list']->value['link'];?>
"><?php echo $_smarty_tpl->tpl_vars['list']->value['name'];?>
</a>
                </div>
                <div class="price">
                    <?php echo $_smarty_tpl->tpl_vars['list']->value['price'];?>

                    <p>
                        <span class="old"> </span><span class="aft">  </span>
                    </p>
                </div>
                <div class="num_star full">
                    <span></span> <span></span> <span></span> <span></span> <span></span>
                </div>
                <div class="btn_function">
                    <div class="col-md-8 col-sm-8 col-xs-8 col-df">
                        <button type="button" class="btn_prd cart" onclick="addToCart(<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
);">
                            <i class="fa fa-opencart"></i> Thêm vào giỏ hàng
                        </button>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-2 col-df">
                        <button class="btn_prd like">
                            <i class="fa fa-heart-o"></i>
                        </button>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-2 col-df">
                        <button class="btn_prd btn-compare">
                            <i class="fa fa-picture-o"></i>
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
 type="text/javascript">
        $('#etalage').etalage({
            thumb_image_height: 300
        });

    <?php echo '</script'; ?>
>

<?php }
}
