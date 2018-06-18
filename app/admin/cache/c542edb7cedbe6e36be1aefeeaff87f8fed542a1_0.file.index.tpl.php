<?php
/* Smarty version 3.1.30, created on 2018-06-18 13:49:50
  from "D:\DocumentRoot24\~mtd\htaccess\app\admin\view\service\index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b27560e5e0710_08431454',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c542edb7cedbe6e36be1aefeeaff87f8fed542a1' => 
    array (
      0 => 'D:\\DocumentRoot24\\~mtd\\htaccess\\app\\admin\\view\\service\\index.tpl',
      1 => 1529303517,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b27560e5e0710_08431454 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="">
    <div class="x_panel">
        <div class="x_title">
            <h2>Quản lý dịch vụ</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <div class="h_content">
                <!--<div class="form-group form-inline">
                    <input class="left form-control" id="key" type="text" placeholder="Mã / tên dịch vụ" value="<?php echo $_smarty_tpl->tpl_vars['out']->value['key'];?>
">
                </div>
                <button type="button" class="btn btn-primary left" onclick="filter();"><i class="fa fa-search"></i></button>-->

                <!--<a href="<?php echo $_smarty_tpl->tpl_vars['out']->value['import'];?>
" class="btn btn-primary"><i class="fa fa-file-excel-o"></i>&ensp;Nhập</a>-->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#UpdateForm" onclick="LoadDataForForm(0);"><i class="fa fa-pencil"></i>&ensp;Thêm mới</button>
                <!--<button type="button" class="btn btn-success" onclick="HandleCopy();"><i class="fa fa-copy"></i>&ensp;Copy</button>-->
                
                
                <div class="clearfix"></div>
            </div>

            <!-- start project list -->
            <div class="table-responsive">
            <table class="table table-striped table-hover projects">
                <thead>
                    <tr>
                        <th>Dịch vụ</th>
                        <th class="text-right">Giá bán</th>
                        <th class="text-center">Trạng thái</th>
                        <th class="text-right">Cập nhật</th>
                        <th class="text-right">Tạo</th>
                        <th class="text-right">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['services']->value, 'data');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
?>
                        <tr id="field<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
">
                            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['name'];?>
<br /> <small><i class="fa fa-star"></i> <?php echo $_smarty_tpl->tpl_vars['data']->value['code'];?>
</small></td>
                            <td class="text-right"> <b style='color:red'> <?php echo $_smarty_tpl->tpl_vars['data']->value['price'];?>
 </b> </td>
                            <td class="text-center" id="stt<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['data']->value['status'];?>
</td>
                            <td class="text-right"><?php echo $_smarty_tpl->tpl_vars['data']->value['updated_at'];?>
</td>
                            <td class="text-right"><?php echo $_smarty_tpl->tpl_vars['data']->value['created_at'];?>
</td>
                            <td class="text-right">
                                <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#UpdateForm" onclick="LoadDataForForm(<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
);"><i class="fa fa-pencil"></i></button>
                                <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#DeleteForm" onclick="LoadDeleteItem('<?php echo $_smarty_tpl->tpl_vars['arg']->value['mc'];?>
', <?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
, '', 'dịch vụ', 'vì còn tồn tại trong hóa đơn');"><i class="fa fa-trash-o"></i></button>
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

<!-- Modal UpdateForm -->
<div class="modal fade" tabindex="-1" id="UpdateForm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 id="update_title" class="modal-title">Thêm / Sửa dịch vụ</h4>
            </div>
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <input type="hidden" name="id">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Dịch vụ</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="text" name="name" required="required" class="form-control" placeholder="Tên dịch vụ...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Mã</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="text" name="code" required="required" class="form-control" placeholder="Mã dịch vụ...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Chi phí</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="text" name="price" required="required" class="form-control" oninput="setPrice(this);" placeholder="Giá bán...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Mô tả thêm</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <textarea style="resize: vertical;" rows="4" name="description" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Trạng thái</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <div class="checkbox">
                                <label> <input type="checkbox" name="status" value="1"> Kích hoạt</label>
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
$(document).ready(function () {
    $('#UpdateForm').on('shown.bs.modal', function () {
        $('input[name=name]').focus();
    });
});

function activeStatus(table, id) {
    $.post("./admin?mc=service&site=ajax_active", {'table': table, 'id': id}).done(function (data) {
            if(data == 0)
              alert('You can not change');
            else
            $("#stt" + id).html(data);
    });
}

function LoadDataForForm(id) {
    $("#UpdateForm input[type=text]").val('');
    $("#UpdateForm textarea").val('');
    $.post("./admin?mc=service&site=ajax_load", {'id': id}).done(function (data) {
        var data = JSON.parse(data);
        if (data.id == undefined) {
            $("#UpdateForm input[name=id]").val(0);
            $("#UpdateForm input[name=name]").val("");
            $("#UpdateForm input[name=price]").val("");
            $("#UpdateForm input[name=status]").attr("checked", "checked");
            $("#UpdateForm input[name=status]").prop('checked', true);
            $("#update_title").html('Thêm dịch vụ mới');
        } else {
            $("#update_title").html('Sửa dịch vụ');
            $("#UpdateForm input[name=id]").val(data.id);
            $("#UpdateForm input[name=name]").val(data.name);
            $("#UpdateForm input[name=price]").val(data.price);
            $("#UpdateForm textarea[name=description]").val(data.description);

            if (data.status == '1') {
                $("#UpdateForm input[name=status]").attr("checked", "checked");
                $("#UpdateForm input[name=status]").prop('checked', true);
            } else {
                $("#UpdateForm input[name=status]").removeAttr("checked");
                $("#UpdateForm input[name=status]").prop('checked', false);
            }
        }
        $("#UpdateForm input[name=code]").val(data.code);
    });
}


<?php echo '</script'; ?>
>

<?php echo '<script'; ?>
>
$(document).ready(function() {
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
