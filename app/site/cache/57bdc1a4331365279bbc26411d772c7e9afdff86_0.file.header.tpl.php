<?php
/* Smarty version 3.1.30, created on 2018-06-10 22:14:15
  from "/Users/mtd/Sites/htaccess/app/site/view/layouts/includes/header.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b1d4047aa0360_05722449',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '57bdc1a4331365279bbc26411d772c7e9afdff86' => 
    array (
      0 => '/Users/mtd/Sites/htaccess/app/site/view/layouts/includes/header.tpl',
      1 => 1528643415,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b1d4047aa0360_05722449 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="container">
    <div class="top_link bg_white">
        <ul class="pull-left hide-mobile">
        </ul>
        <ul class="pull-right">
            <?php if ($_smarty_tpl->tpl_vars['arg']->value['user']['id'] == 0) {?>
                <li><a href="./?mc=customer&site=login"><i class="fa fa-user"></i>
                        Đăng nhập </a></li>
                <li><a href="./?mc=customer&site=register"><i class="fa fa-register"></i>
                        Đăng ký</a></li>
            <?php } else { ?>
                <li class="pull-right"><a href="./?mc=customer&site=logout"><i
                            class="fa fa-user"></i> Đăng Xuất</a></li>
                <li class="pull-right"><a href="../?mc=customer&site=detail"><i
                            class="fa fa-user"></i> <?php echo $_smarty_tpl->tpl_vars['arg']->value['user']['name'];?>
</a></li>
            <?php }?>
            </ul>
            <div class="clear"></div>
        </div>
    </div>

    <div class="container">
        <div class="header">

            <div class="col-md-3 col-sm-3 col-xs-12 col-df">
                <div class="logo">
                    <a href=""><img src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['logo_folder_link'];?>
/<?php echo $_smarty_tpl->tpl_vars['info']->value['logo'];?>
"> Máy tính đông tây</a>
                </div>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12 col-df">
                <div class="col-md-7 col-sm-7 col-xs-12">

                    <form action="./search/" method="get" id="search-form">
                        <input type="text" name="skey" class="form-control" placeholder="Tìm kiếm">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>

                </div>
                <div class="col-md-5 col-sm-5 col-xs-12 col-df hide-mobile">

                    <div class="col-md-12 col-sm-12 col-xs-12 col-df nav_header">
                        <div class="item_hd bg_a1aaaf">
                            Call <?php echo $_smarty_tpl->tpl_vars['info']->value['info']['phone'];?>
 <i class="fa fa-phone fa-2x"></i>
                            <p>Thứ 2 - Thứ 7: 8h đến 18h</p>
                        </div>
                        <ul class="phone">
                            <li class="bg_f5791f">
                                <a href="./?mc=cart">
                                    <i class="fa fa-cart-plus"></i> <span id='cart-number'><?php echo $_smarty_tpl->tpl_vars['cart_number']->value['product'];?>
 sản phẩm <?php echo $_smarty_tpl->tpl_vars['cart_number']->value['service'];?>
 dịch vụ</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div><?php }
}
