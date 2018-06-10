<?php
/* Smarty version 3.1.30, created on 2018-06-10 21:03:20
  from "C:\xampp\htdocs\~mtd\htaccess\app\admin\view\contact\index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b1d2fa8388b17_67089541',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2c112466a778d03d8dd7fb8e7ade1364fd1ef592' => 
    array (
      0 => 'C:\\xampp\\htdocs\\~mtd\\htaccess\\app\\admin\\view\\contact\\index.tpl',
      1 => 1528639396,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b1d2fa8388b17_67089541 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="">
    <div class="x_panel">
        <div class="x_title">
            <h2>Liên hệ khách hàng</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">



            <!-- start project list -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Họ tên</th>
                            <th>Số điện thoại</th>
                            <th class="text-right">Email</th>
                            <th class="text-right">Ngày</th>
                            <th class="text-right">Trạng thái</th>
                            <th class="text-right"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['contacts']->value, 'list');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['list']->value) {
?>
                            <tr id="field<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
">
                                <td>
                                    <?php echo $_smarty_tpl->tpl_vars['list']->value['name'];?>

                                </td>
                                <td><?php echo $_smarty_tpl->tpl_vars['list']->value['phone'];?>
</td>
                                <td class="text-right">
                                	<?php echo $_smarty_tpl->tpl_vars['list']->value['email'];?>

                                </td>
                                <td class="text-center">
                                	<?php echo $_smarty_tpl->tpl_vars['list']->value['created_at'];?>

                                </td>
                                <td class="text-center" id="stt<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['list']->value['status'];?>
</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#orderDetail" onclick="GetDetailContact(<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
);"><i class="fa fa-search-plus"></i></button>
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
            <!-- end project list -->

            <div class="paging"><?php echo $_smarty_tpl->tpl_vars['paging']->value['paging'];?>
</div>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="DeleteForm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Xóa mục này</h4>
            </div>
            <div class="modal-body">Bạn chắc chắn muốn xóa mục này chứ?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy bỏ</button>
                <button type="button" class="btn btn-danger" onclick="DeleteItem();" id="DeleteItem">Xóa</button>
            </div>
        </div>
    </div>
</div>

<!-- Order Detail -->
<div class="modal fade" id="orderDetail">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body form-horizontal"></div>
            <div class="modal-footer">
                <form action="" method="post">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/moment/moment.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/datepicker/daterangepicker.js"><?php echo '</script'; ?>
>


<?php echo '<script'; ?>
>
$(document).ready(function () {
    $('#date_from').daterangepicker({singleDatePicker: true, calender_style: "picker_4", format: 'DD-MM-YYYY'}, function () {
        $('#date_from').change();
    });
    $('#date_to').daterangepicker({singleDatePicker: true, calender_style: "picker_4", format: 'DD-MM-YYYY'}, function () {
        $('#date_to').change();
    });
});

function activeStatus(table, id) {
    $.post(`./admin?mc=order&site=ajax_active`, {'table': table, 'id': id}).done(function (data) {
            if(data == 0)
              alert('You can not change');
            else
            $("#stt" + id).html(data);
    });
}

function GetDetailContact(id) {
    $.post("./admin?mc=contact&site=ajax_get_detail_contact",{"id": id}).done(function(data){
        data = JSON.parse(data)
        console.log(data)
        let append = `
        <h1 class="text-center">Nội dung</h1>
        <div class="row">
            <div class="col-md-12">
                <p>${data.description}</p>
            </div>
        </div>`
        $("#orderDetail .modal-body").html(append);
    })
}


<?php echo '</script'; ?>
>

<?php }
}
