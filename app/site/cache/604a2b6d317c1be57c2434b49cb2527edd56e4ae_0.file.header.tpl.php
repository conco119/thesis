<?php
/* Smarty version 3.1.30, created on 2018-06-08 23:06:38
  from "C:\xampp\htdocs\~mtd\htaccess\app\site\view\layouts\includes\header.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b1aa98e57ccd7_33235940',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '604a2b6d317c1be57c2434b49cb2527edd56e4ae' => 
    array (
      0 => 'C:\\xampp\\htdocs\\~mtd\\htaccess\\app\\site\\view\\layouts\\includes\\header.tpl',
      1 => 1528473997,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b1aa98e57ccd7_33235940 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="container">
    <div class="top_link bg_white">
        <ul class="pull-left hide-mobile">
        </ul>
        <ul class="pull-right">
            <?php if ($_smarty_tpl->tpl_vars['arg']->value['user']['id'] == 0) {?>
                <li><a href="./cus/?site=login"><i class="fa fa-user"></i>
                        Đăng nhập </a></li>
                <li><a href="./cus/?site=register"><i class="fa fa-register"></i>
                        Đăng ký</a></li>
            <?php } else { ?>
                <li class="pull-right"><a href="./cus/?site=logout"><i
                            class="fa fa-user"></i> Đăng Xuất</a></li>
                <li class="pull-right"><a href="./cus/?site=detail"><i
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
                            Call 12893543 <i class="fa fa-phone fa-2x"></i>
                            <p>Thứ 2 - Thứ 7: 8h đến 18h</p>
                        </div>
                        <ul class="phone">
                            <li class="bg_f5791f">
                                <a href="./gio-hang/">
                                    <i class="fa fa-cart-plus"></i> <span><?php echo $_smarty_tpl->tpl_vars['arg']->value['number_cart'];?>
 0 item</span>
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
