<?php
/* Smarty version 3.1.30, created on 2018-06-17 11:22:37
  from "/Users/mtd/Sites/htaccess/app/admin/view/supplier/index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b25e20d4b0993_50597941',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3b444f11d5cd861fb4e2643b75c48220cae3aa8b' => 
    array (
      0 => '/Users/mtd/Sites/htaccess/app/admin/view/supplier/index.tpl',
      1 => 1529209356,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b25e20d4b0993_50597941 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="">
    <div class="x_panel">
        <div class="x_title">
            <h2>Quản lý nhà cung cấp</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Settings 1</a></li>
                        <li><a href="#">Settings 2</a></li>
                    </ul></li>
                <li><a class="close-link"><i class="fa fa-close"></i></a></li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <div class="h_content">

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#UpdateFrom" onclick="LoadDataForForm(0);"><i class="fa fa-pencil"></i> Thêm mới</button>

                
                <div class="clearfix"></div>
            </div>

            <!-- start project list -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Mã</th>
                            <th>Tên</th>
                            <th>Điện thoại</th>
                            <th class="text-right">Tài khoản</th>
                            <th class="text-right">Tổng nhập</th>
                            <th class="text-center">Trạng thái</th>
                            <th class="text-right"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['suppliers']->value, 'data');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
?>
                            <tr id="field<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
">
                                <td><?php echo $_smarty_tpl->tpl_vars['data']->value['code'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['data']->value['name'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['data']->value['phone'];?>
</td>
                                <td class="text-right"> <b style='color:red'> <?php echo number_format($_smarty_tpl->tpl_vars['data']->value['money']);?>
 <b/>
                                    
                                </td>
                                <td class="text-right"> <b style='color:red'> <?php echo number_format($_smarty_tpl->tpl_vars['data']->value['must_pay']);?>
đ </b>
                                    
                                    </td>
                                <td class="text-center" id="stt<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['data']->value['status'];?>
</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#UpdateFrom" onclick="LoadDataForForm(<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
);"><i class="fa fa-pencil"></i></button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#DeleteForm" onclick="LoadDeleteItem('supplier', <?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
, '', 'nhà cung cấp', 'vì còn tồn tại trong hóa đơn');"><i class="fa fa-trash-o"></i></button>
                                </td>
                            </tr>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                        <tr>
                            <th colspan="3" class="text-right">
                                Tổng:
                            </th>
                            <th class="text-right">
                                <?php echo number_format($_smarty_tpl->tpl_vars['total']->value);?>
 đ
                            </th>
                            <th class="text-right">
                                <?php echo number_format($_smarty_tpl->tpl_vars['total_must_pay']->value);?>
 đ
                            </th>
                        </tr>
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

<!-- Modal UpdateFrom -->
<div class="modal fade" tabindex="-1" id="UpdateFrom">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 class="modal-title" id="title_supplier"></h4>
            </div>
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <input type="hidden" name="id">
							<input type="hidden" name="prefix_admin" value='<?php echo $_smarty_tpl->tpl_vars['arg']->value['prefix_admin'];?>
'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Mã NCC</label>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <input class="form-control" type="text" name="code">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Tên</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="text" name="name" required="required" class="form-control" placeholder="Tên nhà cung cấp">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Người liên hệ</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="text" name="manager" required="required" class="form-control" placeholder="Người liên hệ...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Điện thoại</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="tel" name="phone" required pattern="[0-9]\d*" title="Số điện thoại" class="form-control" placeholder="Điện thoại...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Địa chỉ</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="text" name="address" required="required" class="form-control" placeholder="Địa chỉ...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Trạng thái</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <div class="checkbox">
                                <label> <input type="checkbox" name="status" value="1">Kích hoạt</label>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="submit">Lưu lại</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Bỏ qua</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


    <?php echo '<script'; ?>
>
        function activeStatus(table, id) {
            let prefix_admin = $("#UpdateFrom input[name=prefix_admin]").val();
            $.post(`${prefix_admin}mc=supplier&site=ajax_active`, {'table': table, 'id': id}).done(function (data) {
                    if(data == 0)
                    alert('You can not change');
                    else
                    $("#stt" + id).html(data);
            });
        }
        function LoadDataForForm(id) {
            let prefix_admin = $("#UpdateFrom input[name=prefix_admin]").val();
            $("#UpdateFrom input[type=text]").val('');
            $.post(`${prefix_admin}mc=supplier&site=ajax_load`, {'id': id}).done(function (data) {
                var data = JSON.parse(data);
                console.log(data);
                if (data.id == undefined) {
                    $("#UpdateFrom input[name=id]").val(0);
                    $("#UpdateFrom input[name=sort]").val(1);
                    $("#UpdateFrom input[name=status]").attr("checked", "checked");
                    $("#UpdateFrom input[name=status]").prop('checked', true);
                    $("#title_supplier").html('Thêm nhà cung cấp mới');
                } else {
                    $("#UpdateFrom input[name=id]").val(data.id);
                    $("#UpdateFrom input[name=name]").val(data.name);
                    $("#UpdateFrom input[name=manager]").val(data.manager);
                    $("#UpdateFrom input[name=phone]").val(data.phone);
                    $("#UpdateFrom input[name=address]").val(data.address);
                    $("#title_supplier").html('Sửa thông tin nhà cung cấp');
                    if (data.status == '1') {
                        $("#UpdateFrom input[name=status]").attr("checked", "checked");
                        $("#UpdateFrom input[name=status]").prop('checked', true);
                    } else {
                        $("#UpdateFrom input[name=status]").removeAttr("checked");
                        $("#UpdateFrom input[name=status]").prop('checked', false);
                    }
                }
                $("#UpdateFrom input[name=code]").val(data.code);
            });
        }
    <?php echo '</script'; ?>
>

<?php echo '<script'; ?>
>
$(document).ready(function() {

	$(".mc_supplier").addClass('active');
	$(".mc_supplier ul").css('display', 'block');
	$("#supplier_index").addClass('current-page');

	if( "<?php echo $_smarty_tpl->tpl_vars['notification']->value['status'];?>
" == "success" || "<?php echo $_smarty_tpl->tpl_vars['notification']->value['status'];?>
" == "error")
	{
		var notice = new PNotify({
			title: "<?php echo $_smarty_tpl->tpl_vars['notification']->value['title'];?>
",
			text: "<?php echo $_smarty_tpl->tpl_vars['notification']->value['text'];?>
",
			type: "<?php echo $_smarty_tpl->tpl_vars['notification']->value['status'];?>
",
			mouse_reset: false,
			buttons: {
				sticker: false,
		}
		});
		notice.get().click(function () {
			notice.remove();
		});
	}
})
<?php echo '</script'; ?>
><?php }
}
