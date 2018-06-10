<?php
/* Smarty version 3.1.30, created on 2018-06-10 17:38:11
  from "C:\xampp\htdocs\~mtd\htaccess\app\site\view\cart\index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b1cff93f34545_37703347',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6ff3be1cd2e6df0579c00f9eef8466cc982fdf4e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\~mtd\\htaccess\\app\\site\\view\\cart\\index.tpl',
      1 => 1528627046,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b1cff93f34545_37703347 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="sidebar_title bg_34495e">
    <h3>Quản lý giỏ hàng</h3>
</div>

<div class="row  mar-top">
    <div class="col-md-8 col-sm-8 col-xs-12" style="">
        <div class="bg_white pad-15">
            <h2>Sản phẩm </h2>
            <div class="table-responsive ">
                <table class="table">
                    <tr class="th">
                        <td>TT</td>
                        <td>Ảnh sản phẩm</td>
                        <td>Tên sản phẩm</td>

                        <td>Giá</td>
                        <td>Số lượng</td>
                        <td>Thành tiền</td>
                        <td>Xử lý</td>
                    </tr>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cart']->value['products'], 'list', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['list']->value) {
?>
                        <tr>
                            <td><?php echo $_smarty_tpl->tpl_vars['k']->value+1;?>
</td>
                            <td><img src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['product_folder_link'];?>
/<?php echo $_smarty_tpl->tpl_vars['list']->value['image_name'];?>
" width="60" height="60"></td>
                            <td class="name"><?php echo $_smarty_tpl->tpl_vars['list']->value['name'];?>
</td>

                            <td class="price">
                            <?php if ($_smarty_tpl->tpl_vars['list']->value['is_discount'] == 1) {?>
                                <?php echo number_format($_smarty_tpl->tpl_vars['list']->value['price_sale']);?>
đ
                            <?php } else { ?>
                                 <?php echo number_format($_smarty_tpl->tpl_vars['list']->value['price']);?>
đ
                            <?php }?>
                            </td>
                            <td>
                            	<input type="number" min="0" step="1" class="number" value="<?php echo $_smarty_tpl->tpl_vars['list']->value['number_count'];?>
" onchange="updateCart(this.value, <?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
);" />
                            </td>
                            <td class="price">
                            <?php if ($_smarty_tpl->tpl_vars['list']->value['is_discount'] == 1) {?>
                                <?php echo number_format(($_smarty_tpl->tpl_vars['list']->value['price_sale']*$_smarty_tpl->tpl_vars['list']->value['number_count']));?>
đ
                            <?php } else { ?>
                                <?php echo number_format(($_smarty_tpl->tpl_vars['list']->value['price']*$_smarty_tpl->tpl_vars['list']->value['number_count']));?>
đ
                            <?php }?>
                            </td>
                            <td><a href="javascript:void(0);"
                                   onclick="delateItemCart(<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
);"><i
                                        class="fa fa-trash-o fa-2x"></i></a></td>
                        </tr>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>


                </table>
            </div>
            <br>
            <h2>Dịch vụ </h2>
            <div class="table-responsive">
                <table class="table">
                    <tr class="th">
                        <td>TT</td>
                        <td>Dịch vụ</td>
                        <td>Giá</td>
                        <td>Số lượng</td>
                        <td>Thành tiền</td>
                        <td>Xử lý</td>
                    </tr>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cart']->value['services'], 'list', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['list']->value) {
?>
                        <tr>
                            <td><?php echo $_smarty_tpl->tpl_vars['k']->value+1;?>
</td>
                            <td class="name"><?php echo $_smarty_tpl->tpl_vars['list']->value['name'];?>
</td>

                            <td class="price">
                                 <?php echo number_format($_smarty_tpl->tpl_vars['list']->value['price']);?>
đ
                            </td>
                            <td>
                            	<input type="number" min="0" step="1" class="number" value="<?php echo $_smarty_tpl->tpl_vars['list']->value['number_count'];?>
" onchange="updateService(this.value, <?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
);" />
                            </td>
                            <td class="price">
                                <?php echo number_format(($_smarty_tpl->tpl_vars['list']->value['price']*$_smarty_tpl->tpl_vars['list']->value['number_count']));?>
đ
                            </td>
                            <td><a href="javascript:void(0);"
                                   onclick="deleteService(<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
);"><i
                                        class="fa fa-trash-o fa-2x"></i></a></td>
                        </tr>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>


                </table>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-sm-4 col-xs-12 ">
        <div class="pad-15 bg_f4f4f4">
            <div class="num-money pad-15">
                <p>
                    Tổng tiền: <strong
                        style="color: red;"><?php echo number_format($_smarty_tpl->tpl_vars['total']->value);?>
đ</strong>
                </p>
            </div>
            <div class="update-cart">
                <a href="?mod=product&site=index" class="btn btn-primary">Tiếp
                    tục mua hàng</a>
                <a href="#" onclick="DeleteAll()"
                   class="btn btn-primary pull-right">Xóa hết</a>
                <a href="./?mc=cart&site=payment" class="btn btn-primary pull-right">Thanh toán đơn hàng</a>
                <div class="clear"></div>
            </div>
        </div>
    </div>

</div>





<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/cart.js"><?php echo '</script'; ?>
><?php }
}
