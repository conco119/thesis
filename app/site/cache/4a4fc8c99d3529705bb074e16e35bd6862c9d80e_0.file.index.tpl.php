<?php
/* Smarty version 3.1.30, created on 2018-06-09 00:05:08
  from "C:\xampp\htdocs\~mtd\htaccess\app\site\view\product\index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b1ab7448ba425_59138741',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4a4fc8c99d3529705bb074e16e35bd6862c9d80e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\~mtd\\htaccess\\app\\site\\view\\product\\index.tpl',
      1 => 1528477507,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b1ab7448ba425_59138741 (Smarty_Internal_Template $_smarty_tpl) {
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
            	<span><?php echo $_smarty_tpl->tpl_vars['list']->value['number_point'];?>
 x đánh giá - <?php echo $_smarty_tpl->tpl_vars['list']->value['avg_point'];?>
 x điểm</span>
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
