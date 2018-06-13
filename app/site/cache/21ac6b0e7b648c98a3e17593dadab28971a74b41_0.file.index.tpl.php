<?php
/* Smarty version 3.1.30, created on 2018-06-13 07:47:46
  from "/Users/mtd/Sites/htaccess/app/site/view/cart/index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b2069b2e69a40_78606425',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '21ac6b0e7b648c98a3e17593dadab28971a74b41' => 
    array (
      0 => '/Users/mtd/Sites/htaccess/app/site/view/cart/index.tpl',
      1 => 1528850865,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b2069b2e69a40_78606425 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="sidebar_title bg_34495e">
    <h3>Quản lý giỏ hàng</h3>
</div>

<div class="row  mar-top">
    <div class="col-md-8 col-sm-8 col-xs-12" style="">
        <div class="bg_white pad-15">
        <?php if (count($_smarty_tpl->tpl_vars['cart']->value['products']) > 0) {?>
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
        <?php }?>

            <br>
        <?php if (count($_smarty_tpl->tpl_vars['cart']->value['services']) > 0) {?>
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
        <?php }?>
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
