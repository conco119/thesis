<?php
/* Smarty version 3.1.30, created on 2018-06-10 22:14:42
  from "/Users/mtd/Sites/htaccess/app/site/view/servicee/index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b1d4062e1b597_66336552',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ca9d86df2ca03eb00a2277ad5247d40fe45f38a8' => 
    array (
      0 => '/Users/mtd/Sites/htaccess/app/site/view/servicee/index.tpl',
      1 => 1528643415,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b1d4062e1b597_66336552 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div id="web-service">
	<div class="row" style='padding:20px'>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Dịch vụ</th>
                <th>Giá</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['services']->value, 'service');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['service']->value) {
?>
                <tr>
                    <td><?php echo $_smarty_tpl->tpl_vars['service']->value['name'];?>
</td>
                    <td style='color:red'><?php echo number_format($_smarty_tpl->tpl_vars['service']->value['price']);?>
đ</td>
                    <td>
                        <div class='btn_function' style='width:70%'>
                        <button type="button" class="btn_prd cart" title="Thêm vào giỏ hàng" onclick="addService(<?php echo $_smarty_tpl->tpl_vars['service']->value['id'];?>
);"><i class="fa fa-opencart"></i> Thêm vào
                            giỏ hàng
                        </button>
                        </div>
                    </td>
                </tr>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

            </tbody>
        </table>
	</div>
</div>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/cart.js"><?php echo '</script'; ?>
><?php }
}
