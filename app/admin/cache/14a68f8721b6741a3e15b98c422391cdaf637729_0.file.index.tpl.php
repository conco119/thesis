<?php
/* Smarty version 3.1.30, created on 2018-05-21 23:23:23
  from "/Users/mtd/Sites/htaccess/app/admin/view/money/index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b02f27b8c2ad4_37288592',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '14a68f8721b6741a3e15b98c422391cdaf637729' => 
    array (
      0 => '/Users/mtd/Sites/htaccess/app/admin/view/money/index.tpl',
      1 => 1526919799,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b02f27b8c2ad4_37288592 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once '/Users/mtd/Sites/htaccess/library/smarty/plugins/modifier.date_format.php';
?>
<div class="">
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Bảng tổng hợp sổ thu chi</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <div class="h_content">
                        <div class="form-group form-inline">
                            <select class="form-control left" id="filter" onchange="filter();">
                                <?php echo $_smarty_tpl->tpl_vars['out']->value['filter'];?>

                            </select>
                            <?php if ($_smarty_tpl->tpl_vars['out']->value['value']['filter'] == '2') {?>
                                <select class="form-control left" id="year" onchange="filter();"><?php echo $_smarty_tpl->tpl_vars['out']->value['year'];?>
</select>
                                <select class="form-control left" id="month" onchange="filter();"><?php echo $_smarty_tpl->tpl_vars['out']->value['month'];?>
</select>
                            <?php } elseif ($_smarty_tpl->tpl_vars['out']->value['value']['filter'] == '1') {?>
                                <input type="text" class="form-control left" id="date_from" placeholder="Từ ngày" onchange="filter();" value="<?php echo $_smarty_tpl->tpl_vars['out']->value['date_from'];?>
">
                                <input type="text" class="form-control left" id="date_to" placeholder="Đến ngày" onchange="filter();" value="<?php echo $_smarty_tpl->tpl_vars['out']->value['date_to'];?>
">
                            <?php } else { ?>
                                <select class="form-control left" id="date_ex" onchange="filter();">
                                    <option value="0">Tất cả hóa đơn</option> <?php echo $_smarty_tpl->tpl_vars['out']->value['select_export'];?>

                                </select>
                            <?php }?>
                        </div>
                        <button data-toggle="modal" class="btn btn-primary" data-target="#AddForm" onclick="AddMoney(1);"><i class="fa fa-plus"></i> Lập phiếu thu</button>
                        <button data-toggle="modal" class="btn btn-primary" data-target="#AddForm" onclick="AddMoney(0);"><i class="fa fa-mail-reply-all"></i> Lập phiếu chi</button>
						<form method="post" style="display: inline;">
							<button type="submit" class="btn btn-success" name="export_request">
								<i class="fa fa-share-square-o"></i> Xuất file
							</button>
						</form>

						<div class="clearfix"></div>
                    </div>

					<div id="money_stats">
						<ul>
							<li><a>Tổng thu: <span><?php echo number_format($_smarty_tpl->tpl_vars['money']->value['import']);?>
 đ</span></a></li>
							<li><a>Tổng chi: <span><?php echo number_format($_smarty_tpl->tpl_vars['money']->value['export']);?>
 đ</span></a></li>
							<li><a>Ngân quỹ: <span><?php echo number_format($_smarty_tpl->tpl_vars['money']->value['total']);?>
 đ</span></a></li>
						</ul>
						<div class="clearfix"></div>
					</div>

                    <!-- start project list -->
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Mã phiếu</td>
                                <th>Thể loại</th>
                                <th>Ngày tháng</th>
                                <th class="text-right">Thu</th>
                                <th class="text-right">Chi</th>
                                <th>Người nộp / nhận</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['result']->value, 'list');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['list']->value) {
?>
                                <tr id="field<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
">
                                    <td><?php echo $_smarty_tpl->tpl_vars['list']->value['code'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['list']->value['money_type'];?>
<br><small><?php echo $_smarty_tpl->tpl_vars['list']->value['category'];?>
</small></td>
                                    <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['list']->value['date'],"%d-%m-%Y");?>
<br><small><?php echo $_smarty_tpl->tpl_vars['list']->value['updated_at'];?>
</small></td>
                                    <td class="text-right">
                                        <?php if ($_smarty_tpl->tpl_vars['list']->value['is_import'] != 0) {?>
                                            <?php echo number_format($_smarty_tpl->tpl_vars['list']->value['money']);?>
 đ
                                        <?php }?>
                                    </td>
                                    <td class="text-right">
                                        <?php if ($_smarty_tpl->tpl_vars['list']->value['is_import'] == 0) {?>
                                            <?php echo number_format($_smarty_tpl->tpl_vars['list']->value['money']);?>
 đ
                                        <?php }?>
                                    </td>
                                    <td>
                                        <?php echo $_smarty_tpl->tpl_vars['list']->value['object_name'];?>

                                        <?php if ($_smarty_tpl->tpl_vars['list']->value['object'] != NULL) {?>
                                            <br><small>[<?php echo $_smarty_tpl->tpl_vars['list']->value['object'];?>
]</small>
                                        <?php }?>
                                    </td>
                                    <td class="text-right">
                                        <?php echo $_smarty_tpl->tpl_vars['list']->value['btn'];?>

                                        <button type="button" title="In phiếu" class="btn btn-default" data-dismiss="modal" onclick="SetPrint(<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
)">
                                            <i class="fa fa-print"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>


                        </tbody>
                    </table>
                    <!-- end project list -->

                    <div class="paging"><?php echo $_smarty_tpl->tpl_vars['paging']->value['paging'];?>
</div>
                </div>
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

<!-- Print -->
<div class="modal fade" id="Print">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body modal-print">
                <iframe src="#" style="zoom:0.60" width="99.6%" height="450" id="PrintContent"></iframe>
            </div>
        </div>
    </div>
</div>

<!-- Modal UpdateFrom -->
<div class="modal fade" tabindex="-1" id="UpdateForm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 class="modal-title" id="title_fees"></h4>
            </div>
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <input type="hidden" name="id">
                            <input type="hidden" name="is_import">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-2 col-xs-12">Ngày lập phiếu</label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <input type="text" id="datefees" class="form-control" name="date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-2 col-xs-12">Đối tượng</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="object" class="form-control" onchange="LoadObject(this.value);"></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-2 col-xs-12">Người nộp / nhận</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="object_id" class="form-control"></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-2 col-xs-12">Thể loại</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="category_id" class="form-control" onchange="AddIdMoneyType(this.value);"></select>
                        </div>
                        <div class="col-md-2 col-sm-6 col-xs-12">
                        	<button type="button" id="BtnUpdateMoneyType" data-toggle="modal" class="btn btn-primary" data-target="#UpdateMoneyType" onclick="UpdateMoneyType(0);"><i class="fa fa-pencil"></i></button>
                    	</div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-2 col-xs-12">Số tiền</label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <input type="text" name="money" required="required" class="form-control text-right" oninput="SetMoney(this);">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-2 col-xs-12">Mô tả thêm</label>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                            <textarea class="form-control" rows="4" name="description"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-2 col-xs-12">&nbsp;</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <div class="checkbox">
                                <label> <input type="checkbox" name="type" value="1">Cập nhật tới báo cáo lợi nhuận</label>
                                <p class="help-block">Khi tích chọn, số tiền này sẽ được tổng hợp vào chi phí hoặc doanh thu thêm trong báo cáo lợi nhuận.
                                Trong trường hợp tạo phiếu thu tiền khách nợ hoặc chi phí khác làm phát sinh tài khoản của khách hàng hoặc nhà cung cấp
                                thì nên bỏ chọn để tránh sai số lợi nhuận.</p>
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

<!-- Modal UpdateFrom -->
<div class="modal fade" tabindex="-1" id="AddForm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 class="modal-title" id="title_fees"></h4>
            </div>
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <input type="hidden" name="id">
                            <input type="hidden" name="is_import">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-2 col-xs-12">Ngày lập phiếu</label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <input type="text" id="datefees" class="form-control" name="date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-2 col-xs-12">Đối tượng</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="object" class="form-control" onchange="LoadObject(this.value);">
                                  <option value="0">Lựa chọn đối tượng</option>
                                  <option value="1">Khách hàng</option>
                                  <option value="2">Nhà cung cấp</option>
                                  <option value="3">Nhân viên</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-2 col-xs-12">Người nộp / nhận</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="object_id" class="form-control"></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-2 col-xs-12">Thể loại</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="category_id" class="form-control" onchange="AddIdMoneyType(this.value);"></select>
                        </div>
                        <div class="col-md-2 col-sm-6 col-xs-12">
                        	<button type="button" id="BtnUpdateMoneyType" data-toggle="modal" class="btn btn-primary" data-target="#UpdateMoneyType" onclick="UpdateMoneyType(0);"><i class="fa fa-pencil"></i></button>
                    	</div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-2 col-xs-12">Số tiền</label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <input type="text" name="money" required="required" class="form-control text-right" oninput="SetMoney(this);">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-2 col-xs-12">Mô tả thêm</label>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                            <textarea class="form-control" rows="4" name="description"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-2 col-xs-12">&nbsp;</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <div class="checkbox">
                                <label> <input type="checkbox" name="type" value="1">Cập nhật tới báo cáo lợi nhuận</label>
                                <p class="help-block">Khi tích chọn, số tiền này sẽ được tổng hợp vào chi phí hoặc doanh thu thêm trong báo cáo lợi nhuận.
                                Trong trường hợp tạo phiếu thu tiền khách nợ hoặc chi phí khác làm phát sinh tài khoản của khách hàng hoặc nhà cung cấp
                                thì nên bỏ chọn để tránh sai số lợi nhuận.</p>
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



<!-- Modal Update Item -->
<div class="modal fade" id="UpdateMoneyType">
    <div class="modal-dialog">
        <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Cập nhật thể loại</h4>
			</div>
			<div class="modal-body form-horizontal form">
				<br>
                <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="hidden" name="id">
                    </div>
                </div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-2 col-xs-12">Thể loại</label>
					<div class="col-md-7 col-sm-6 col-xs-12">
						<input type="text" class="form-control" name="name">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-2 col-xs-12">Mô tả thêm</label>
					<div class="col-md-8 col-sm-6 col-xs-12">
						<textarea class="form-control" name="description" rows="4"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-2 col-xs-12">Sắp xếp</label>
					<div class="col-md-2 col-sm-6 col-xs-12">
						<input type="number" class="form-control" name="sort">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-2 col-xs-12">Trạng thái</label>
					<div class="col-md-9 col-sm-9 col-xs-12">
						<div class="checkbox">
							<label> <input type="checkbox" name="status" value="1"> Active / Inactive this item</label>
						</div>
					</div>
				</div>

				<br />
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" onclick="AjaxSaveType();">Lưu lại</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Bỏ qua</button>
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
                <button type="button" class="btn btn-danger" onclick="DeleteItem();" id="DeleteItem">Đồng ý</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy bỏ</button>
            </div>
        </div>
    </div>
</div>

<?php echo '<script'; ?>
>
    var print = '<?php echo $_smarty_tpl->tpl_vars['out']->value['print'];?>
';
<?php echo '</script'; ?>
>
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
$(document).ready(function() {
	$('#UpdateForm #datefees').daterangepicker({singleDatePicker : true, calender_style : "picker_4", format : 'DD-MM-YYYY'});
	$('#AddForm #datefees').daterangepicker({singleDatePicker : true, calender_style : "picker_4", format : 'DD-MM-YYYY'});

	$('#date_from').daterangepicker({singleDatePicker : true, calender_style : "picker_4", format : 'DD-MM-YYYY'}, function() {
		$('#date_from').change();
	});
	$('#date_to').daterangepicker({singleDatePicker : true, calender_style : "picker_4", format : 'DD-MM-YYYY'}, function() {
		$('#date_to').change();
	});
});
$(document).on('hidden.bs.modal', '.modal', function () {
    $('.modal:visible').length && $(document.body).addClass('modal-open');
});

function LoadObject(type){
	$.post("?mod=money&site=ajax_load_select_object", {'type' : type}).done(function(data) {
		$("#UpdateForm select[name=object_id]").html(data);
	});
}

var set_is_import = 0;
function AddIdMoneyType(id){
	$("#BtnUpdateMoneyType").attr('onclick', 'UpdateMoneyType('+id+');')
}

function SetExportInfo(id, type) {
	if(type=='exp' || type=='srv')
	    $("#orderDetail .modal-body").load("?mod=exportAjax&site=ajax_get_export_info", {"id": id});
	else
	    $("#orderDetail .modal-body").load("?mod=import&site=ajax_get_import_info", {"id": id});
}

function SetPrint(id){
    $("#PrintContent").attr("src", print + id);
    return false;
}

function UpdateMoneyType(id) {
	//$('#UpdateForm').modal('hide');
	$("#UpdateMoneyType input[type=text]").val('');
	$.post("?mod=money&site=ajax_load_money_category_item", {'id':id}).done(function(data) {
		var data = JSON.parse(data);
		if (data.id == undefined) {
			$("#UpdateMoneyType input[name=id]").val(0);
			$("#UpdateMoneyType input[name=sort]").val(1);
			$("#UpdateMoneyType input[name=status]").attr("checked", "checked");
			$("#UpdateMoneyType input[name=status]").prop('checked', true);
		} else {
			$("#UpdateMoneyType input[name=id]").val(data.id);
			$("#UpdateMoneyType input[name=name]").val(data.name);
			$("#UpdateMoneyType input[name=description]").val(data.description);
			$("#UpdateMoneyType input[name=sort]").val(data.sort);
			if (data.status == '1') {
				$("#UpdateMoneyType input[name=status]").attr("checked", "checked");
				$("#UpdateMoneyType input[name=status]").prop('checked', true);
			} else {
				$("#UpdateMoneyType input[name=status]").removeAttr("checked");
				$("#UpdateMoneyType input[name=status]").prop('checked', false);
			}
		}
	});
}

function LoadDataForEdit(id, is_import)
{
	set_is_import = is_import;
	$("#UpdateForm input[type=text]").val('');
	$("#UpdateForm input[type=checkbox]").removeAttr("checked");
	$("#UpdateForm select[name=object]").removeAttr('disabled');
	$("#UpdateForm select[name=object_id]").removeAttr('disabled');
	var msg = '';
	$.post("./admin?mc=money&site=ajax_load_item", {'id':id, 'is_import':is_import}).done(function(data) {
		var data = JSON.parse(data);
		if (data.id == undefined)
        {
            //$("#UpdateForm input[name=type]").attr("checked", "checked");
            //$("#UpdateForm input[name=type]").prop('checked', true);
			$("#UpdateForm input[name=id]").val(0);
			msg = 'Lập phiếu thu';
			if(is_import=='0')
				msg = 'Lập phiếu chi';
			$("#title_fees").html(msg);
		}
        else
        {
			$("#UpdateForm input[name=id]").val(data.id);
			$("#UpdateForm input[name=title]").val(data.title);
			$("#UpdateForm input[name=money]").val(data.money);
			$("#UpdateForm input[name=money]").val(data.money);
			$("#UpdateForm textarea[name=description]").val(data.description);

//			$("#UpdateForm select[name=object]").attr('disabled','disabled');
//			$("#UpdateForm select[name=object_id]").attr('disabled','disabled');
            if (data.type == '1') {
                $("#UpdateForm input[name=type]").attr("checked", "checked");
                $("#UpdateForm input[name=type]").prop('checked', true);
            } else {
                $("#UpdateForm input[name=type]").removeAttr("checked");
                $("#UpdateForm input[name=type]").prop('checked', false);
            }

			msg = 'Chỉnh sửa phiếu thu';
			if(is_import=='0')
				msg = 'Chỉnh sửa phiếu chi';
			$("#title_fees").html(msg);
		 }
		$("#UpdateForm input[name=is_import]").val(is_import);
		$("#UpdateForm input[name=date]").val(data.date);
		$("#UpdateForm select[name=category_id]").html(data.category);
		$("#UpdateForm select[name=object]").html(data.object);
		$("#UpdateForm select[name=object_id]").html(data.object_id);
		AddIdMoneyType(data.category_id);
	});
}

function AddMoney(is_import)
{

    if(is_import == 1)
        $("#AddForm #title_fees").html("Lập phiếu thu");
    else
        $("#AddForm #title_fees").html("Lập phiếu chi");
	$("#AddForm input[type=text]").val('');
	$("#AddForm input[type=checkbox]").removeAttr("checked");
	$("#AddForm select[name=object]").removeAttr('disabled');
	$("#AddForm select[name=object_id]").removeAttr('disabled');
	$.post("./admin?mc=money&site=ajax_load_data_for_adding", {'is_import':is_import}).done(function(data) {
		var data = JSON.parse(data);
        console.log(data);
		$("#AddForm input[name=is_import]").val(is_import);
		$("#AddForm input[name=date]").val(data.date);
		$("#AddForm select[name=category_id]").html(data.category);
		$("#AddForm select[name=object]").html(data.object);
		$("#AddForm select[name=object_id]").html(data.object_id);
		AddIdMoneyType(data.category_id);
	});
}

function AjaxSaveType(){
	var data = {};
	data['id'] = $("#UpdateMoneyType input[name=id]").val();
	data['name'] = $("#UpdateMoneyType input[name=name]").val();
	data['description'] = $("#UpdateMoneyType textarea[name=description]").val();
	data['sort'] = $("#UpdateMoneyType input[name=sort]").val();
	data['status'] = $("#UpdateMoneyType input[name=status]").val();
	data['is_import'] = set_is_import;
	if(data['name'] == ''){
		$("#UpdateMoneyType input[name=name]").val('Vui lòng nhập thể loại');
		setTimeout(function(){
			$("#UpdateMoneyType input[name=name]").val('');
			$("#UpdateMoneyType input[name=name]").focus();
		}, 1000);
		return false;
	}

	$.post("?mod=money&site=ajax_save_money_type", data).done(function(rt) {
		var rt = JSON.parse(rt);
		$('#UpdateMoneyType').modal('hide');
		//$('#UpdateForm').modal('show');
		$("#UpdateForm select[name=category_id]").html(rt.select);
		AddIdMoneyType(rt.id);
		return false;
	});
}

function filter() {
	var filter = $("#filter").val();
	var supp = $("#supp").val();
    var date = $("#date_ex").val();
	var url = "./?mod=money&site=index";
	url += "&filter=" + filter;
	url += "&supp=" + supp;
    url += "&date=" + date;

	if (filter == "1") {
		var date_from = $("#date_from").val();
		var date_to = $("#date_to").val();
		url += "&date_from=" + date_from;
		url += "&date_to=" + date_to;
	} else if (filter == "2") {
		var year = $("#year").val();
		var month = $("#month").val();
		url += "&year=" + year;
		url += "&month=" + month;
	}

	window.location.href = url;
}
<?php echo '</script'; ?>
>

<?php }
}
