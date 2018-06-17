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

                {* <button type="button" class="btn btn-success" onclick="HandleActive('suppliers', 1);"><i class="fa fa-check-square-o"></i> Kích hoạt</button>
                <button type="button" class="btn btn-default" onclick="HandleActive('suppliers', 0);"><i class="fa fa-times-circle"></i> Hủy</button>
                <form method="post" style="display: inline">
                    <input type="hidden" name="export_request" />
                    <button type="submit" class="btn btn-success"><i class="fa fa-share-square-o"></i> Xuất file Excel</button>
                </form> *}
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
                        {foreach from=$suppliers item=data}
                            <tr id="field{$data.id}">
                                <td>{$data.code}</td>
                                <td>{$data.name}</td>
                                <td>{$data.phone}</td>
                                <td class="text-right"> <b style='color:red'> {$data.money|number_format} <b/>
                                    {* <a href="?mod=supplier&site=detail&id={$data.id}"
                                    class="btn btn btn-success">
                                        <i class="fa fa-search-plus"></i>
                                    </a> *}
                                </td>
                                <td class="text-right"> <b style='color:red'> {$data.must_pay|number_format}đ </b>
                                    {* <a href="?mod=supplier&site=history&id={$data.id}"
                                    class="btn btn btn-success">
                                        <i class="fa fa-search-plus"></i>
                                    </a> *}
                                    </td>
                                <td class="text-center" id="stt{$data.id}">{$data.status}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#UpdateFrom" onclick="LoadDataForForm({$data.id});"><i class="fa fa-pencil"></i></button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#DeleteForm" onclick="LoadDeleteItem('supplier', {$data.id}, '', 'nhà cung cấp', 'vì còn tồn tại trong hóa đơn');"><i class="fa fa-trash-o"></i></button>
                                </td>
                            </tr>
                        {/foreach}
                        <tr>
                            <th colspan="3" class="text-right">
                                Tổng:
                            </th>
                            <th class="text-right">
                                {$total|number_format} đ
                            </th>
                            <th class="text-right">
                                {$total_must_pay|number_format} đ
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- end project list -->

            <div class="paging">{$paging.paging}</div>
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
							<input type="hidden" name="prefix_admin" value='{$arg.prefix_admin}'>
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

{literal}
    <script>
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
    </script>
{/literal}
<script>
$(document).ready(function() {

	$(".mc_supplier").addClass('active');
	$(".mc_supplier ul").css('display', 'block');
	$("#supplier_index").addClass('current-page');

	if( "{$notification.status}" == "success" || "{$notification.status}" == "error")
	{
		var notice = new PNotify({
			title: "{$notification.title}",
			text: "{$notification.text}",
			type: "{$notification.status}",
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
</script>