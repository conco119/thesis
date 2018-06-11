<?php
/* Smarty version 3.1.30, created on 2018-06-10 22:16:55
  from "/Users/mtd/Sites/htaccess/app/site/view/cart/payment.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b1d40e72162b7_93915830',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e58809e7e5bdb6d9b3eb4ab6cc5d9cac43f3c6e5' => 
    array (
      0 => '/Users/mtd/Sites/htaccess/app/site/view/cart/payment.tpl',
      1 => 1528643415,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b1d40e72162b7_93915830 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="sidebar_title bg_34495e">
    <h3>Thanh toán đơn hàng</h3>
</div>
<div class="row bg_white col-df">
    <form class="form" role="form" method="POST" action="?mc=cart&site=order" id="validate">
        <div class="col-md-7 col-sm-7 col-xs-12" id="payment_form">
            <h3>Nhập thông tin đơn hàng</h3>

            <div class="form-group">
                <label for="cus_name">Họ tên <span style='color:red'>*</span></label>
                <input type="text" class="form-control required"  name="cus_name" value="<?php echo $_smarty_tpl->tpl_vars['arg']->value['user']['name'];?>
">
            </div>

            <div class="form-group">
                <label for="cus_name">Điện thoại <span style='color:red'>*</span></label>
                <input type="text" class="form-control required"  name="cus_phone" value="<?php echo $_smarty_tpl->tpl_vars['arg']->value['user']['phone'];?>
">
            </div>

            <div class="form-group">
                <label for="pwd">Email liên hệ <span style='color:red'>*</span></label>
                <input type="text" class="form-control required email"   name="cus_email" id="email" value="<?php echo $_smarty_tpl->tpl_vars['arg']->value['user']['email'];?>
">
            </div>

            <div class="form-group">
                <label for="pwd">Địa chỉ nhận hàng <span style='color:red'>*</span></label>
                <input type="text" class="form-control required"  name="cus_address" placeholder="Tên Phố"  value="<?php echo $_smarty_tpl->tpl_vars['arg']->value['user']['address'];?>
">
            </div>

            <div class="form-group">
                <h3 class="title">Thông tin thêm</h3>
                <textarea class="form-control" rows="5" name="content" placeholder="Ghi chú về đơn hàng, ví dụ: Lưu ý khi giao hàng"></textarea>
            </div>

        </div>

        <div class="col-md-5 col-sm-5 col-xs-12" id="order">
            <div class="order_info">
                <h3 class="title">Đơn hàng của bạn</h3>

                <ul>
                    <li class="line bor-bottom">
                        <div><b>SẢN PHẨM</b></div>
                        <div><b>TỔNG</b></div>
                    </li>

                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cart']->value['products'], 'list');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['list']->value) {
?>
                        <li class="line bor-bottom itm_order">
                            <div>
                                <a href="javascript:void(0)"> <?php echo $_smarty_tpl->tpl_vars['list']->value['name'];?>
 <span>x<?php echo $_smarty_tpl->tpl_vars['list']->value['number_count'];?>
</span></a>
                            </div>

                            <div class="price">
                                <p>
                                    <?php if ($_smarty_tpl->tpl_vars['list']->value['is_discount'] == 1) {?>
                                        <?php echo number_format(($_smarty_tpl->tpl_vars['list']->value['price_sale']*$_smarty_tpl->tpl_vars['list']->value['number_count']));?>
đ
                                    <?php } else { ?>
                                        <?php echo number_format(($_smarty_tpl->tpl_vars['list']->value['price']*$_smarty_tpl->tpl_vars['list']->value['number_count']));?>
đ
                                    <?php }?>
                                </p>
                            </div>
                        </li>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>


                    <br>
                    <li class="line bor-bottom">
                        <div><b>DỊCH VỤ</b></div>
                        <div><b>TỔNG</b></div>
                    </li>

                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cart']->value['services'], 'list');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['list']->value) {
?>
                        <li class="line bor-bottom itm_order">
                            <div>
                                <a href="javascript:void(0)"> <?php echo $_smarty_tpl->tpl_vars['list']->value['name'];?>
 <span>x<?php echo $_smarty_tpl->tpl_vars['list']->value['number_count'];?>
</span></a>
                            </div>

                            <div class="price">
                                <p>
                                    <?php echo number_format(($_smarty_tpl->tpl_vars['list']->value['price']*$_smarty_tpl->tpl_vars['list']->value['number_count']));?>
đ
                                </p>
                            </div>
                        </li>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>





                    <li class="line total">
                        <div>
                            <p>Tổng:</p>
                        </div>
                        <div class="obama-total">
                            <p><?php echo number_format($_smarty_tpl->tpl_vars['total']->value);?>
đ</p>
                        </div>
                    </li>

                </ul>

                <div class="radio">
                    <label><input type="radio" name="type" checked="" value="1">Chuyển khoản ngân hàng</label>
                    <p class="bor-bottom">Chúng tôi sẽ gửi hàng ngay sau khi nhận được thanh toán chuyển khoản của bạn</p>
                    <label><input type="radio" name="type" value="0">Trả tiền mặt khi nhận hàng (COD)</label>
                </div>

                <div class="button-btn text-center mar-top mar-btm">
                    <button class="btn-order bg_34495e" name="FrmSubmit" type="submit">Gửi thông tin đặt hàng</button>
                </div>

            </div>
        </div>
    </form>
</div>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/validate.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
    $("#validate").validate();
<?php echo '</script'; ?>
><?php }
}
