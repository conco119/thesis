<div class="">
    <div class="x_panel">
        <div class="x_title">
            <h2>Quản lý khách hàng</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <div class="h_content">
                <div class="form-group form-inline">
                    <select class="form-control left" id="group" >
                        <option value="">Tất cả khách hàng</option>
                        {$customer_groups}
                    </select>
                </div>
                <div class="form-group form-inline">
                    <input class="form-control left" id="key" value="{$out.key}" placeholder="Mã, Tên" >
                </div>
                <button type="button" class="btn btn-primary left" onclick="filter();"><i class="fa fa-search"></i></button>

                  <a href="{$arg.prefix_admin}mc=customergroup&site=index" class="btn btn-primary left"><i class="fa fa-pencil"></i> Quản lý nhóm</a>
                {* <form method="post" style="display: inline; float: left;">
                    <input type="hidden" name="export_request" />
                    <button type="submit" class="btn btn-success"><i class="fa fa-share-square-o"></i> Xuất file Excel</a></button>
                </form> *}
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#UpdateFrom" onclick="LoadDataForForm(0);"><i class="fa fa-pencil"></i> Thêm mới</button>
                {* <button type="button" class="btn btn-success" onclick="HandleActive('customers', 1);"><i class="fa fa-check-square-o"></i> Kích hoạt</button>
                <button type="button" class="btn btn-default" onclick="HandleActive('customers', 0);"><i class="fa fa-times-circle"></i> Hủy</button> *}
                <div class="clearfix"></div>
            </div>

            <!-- start project list -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Khách hàng</th>
                            <th>Nhóm</th>
                            <th class="text-right">Tài khoản</th>
                            {* <th class="text-right">Chi tiết mua hàng</th> *}
                            <th class="text-right">Tổng mua</th>
                            <th class="text-center">TT</th>
                            <th class="text-right"></th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach from=$customers item=list}
                            <tr id="field{$list.id}">
                                <td>
                                [{$list.code}] {$list.name} <br>
                                <small>Created by: {$list.creator.username} - {$list.creator.name}</small>
                                </td>
                                <td>{$list.group.name}</td>
                                <td class="text-right">
                                	{$list.money|number_format} đ
                                </td>
                                {* <td class="text-center"><a href="?mod=customer&site=detail&id={$list.id}" class="btn btn btn-success"><i class="fa fa-search-plus"></i></a></td> *}
                                <td class="text-right">
                                	{$list.must_pay|number_format} đ
                                    {* <a href="?mod=customer&site=history&id={$list.id}" class="btn btn btn-success"><i class="fa fa-search-plus"></i></a> *}
                                </td>
                                <td class="text-center" id="stt{$list.id}">{$list.status}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#UpdateFrom" onclick="LoadDataForForm({$list.id});"><i class="fa fa-pencil"></i></button>
                                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#DeleteForm" onclick="LoadDeleteItem('customer', {$list.id}, '', 'khách hàng', 'vì còn tồn tại hóa đơn');"><i class="fa fa-trash-o"></i></button>
                                </td>
                            </tr>
                        {/foreach}
                    <tr>
                        <th colspan="2" class="text-right">
                            Tổng tài khoản
                        </th>
                        <th class="text-right">
                            {$out.total_money|number_format} đ
                        </th>
                        <th class="text-right">
                            Tổng mua hàng
                        </th>
                        <th class="text-right">
                            {$out.total_must_pay|number_format} đ
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
                <h4 class="modal-title" id="title"> </h4>
            </div>
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <input type="hidden" name="id">
							<input type="hidden" name="prefix_admin" value='{$arg.prefix_admin}'>
							<input type="hidden" name="mc" value='{$arg.mc}'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Nhóm KH</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" name="group_id"></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Mã</label>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <input class="form-control" type="text" name="code">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Tên KH</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="text" name="name" required class="form-control" placeholder="Tên KH">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Giới tính</label>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <select class="form-control" name="gender"></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Ngày sinh</label>
                        <div class="col-md-2 col-sm-3 col-xs-12">
                            <select class="form-control" name="day"></select>
                        </div>
                        <div class="col-md-2 col-sm-3 col-xs-12">
                            <select class="form-control" name="month"></select>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <select class="form-control" name="year"></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Điện thoại</label>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <input type="tel" class="form-control" name="phone" pattern="[0-9]\d*" title="Số điện thoại">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Địa chỉ</label>
                        <div class="col-md-9 col-sm-6 col-xs-12">
                            <input type="text" class="form-control" name="address">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Email</label>
                        <div class="col-md-9 col-sm-6 col-xs-12">
                            <input type="email" class="form-control" name="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Status</label>
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

<script src="{$arg.stylesheet}js/moment/moment.min.js"></script>
<script type="text/javascript" src="{$arg.stylesheet}js/datepicker/daterangepicker.js"></script>

{literal}
<script>
$(document).ready(function () {
    $('#date_from').daterangepicker({singleDatePicker: true, calender_style: "picker_4", format: 'DD-MM-YYYY'}, function () {
        $('#date_from').change();
    });
    $('#date_to').daterangepicker({singleDatePicker: true, calender_style: "picker_4", format: 'DD-MM-YYYY'}, function () {
        $('#date_to').change();
    });
});

function activeStatus(table, id) {
	let prefix_admin = $("#UpdateFrom input[name=prefix_admin]").val();
    $.post(`${prefix_admin}mc=customer&site=ajax_active`, {'table': table, 'id': id}).done(function (data) {
            if(data == 0)
              alert('You can not change');
            else
            $("#stt" + id).html(data);
    });
}

function LoadDataForForm(id) {
    let mc = $("#UpdateFrom input[name=mc]").val();
	let prefix_admin = $("#UpdateFrom input[name=prefix_admin]").val();
    $("#UpdateFrom input[type=text]").val('');
    $.post(`${prefix_admin}mc=${mc}&site=ajax_load`, {'id' : id}).done(function(data) {
        var data = JSON.parse(data);
        console.log(data);
        if (data.id == undefined) {
            $("#UpdateFrom input[name=id]").val(0);
            $("#UpdateFrom input[name=status]").attr("checked", "checked");
            $("#UpdateFrom input[name=status]").prop('checked', true);
            $("#title").html('Thêm khách hàng');
        } else {
            $("#UpdateFrom input[name=id]").val(data.id);
            $("#UpdateFrom input[name=name]").val(data.name);
            $("#UpdateFrom input[name=phone]").val(data.phone);
            $("#UpdateFrom input[name=address]").val(data.address);
            $("#UpdateFrom input[name=email]").val(data.email);
            $("#title").html('Sửa thông tin khách hàng');
            if (data.status == '1') {
                $("#UpdateFrom input[name=status]").attr("checked", "checked");
                $("#UpdateFrom input[name=status]").prop('checked', true);
            } else {
                $("#UpdateFrom input[name=status]").removeAttr("checked");
                $("#UpdateFrom input[name=status]").prop('checked', false);
            }
        }
        $("#UpdateFrom input[name=code]").val(data.code);
        $("#UpdateFrom select[name=day]").html(data.birthday.day);
        $("#UpdateFrom select[name=month]").html(data.birthday.month);
        $("#UpdateFrom select[name=year]").html(data.birthday.year);
        $("#UpdateFrom select[name=gender]").html(data.gender);
        $("#UpdateFrom select[name=group_id]").html(data.group);
    });
}

function filter()
{
  var key = $("#key").val();
    var category = $("#group").val();
    var url = "./admin?mc=customer&site=index";
    url += "&group_id=" + category;
    url += "&key=" + key;
    window.location.href = url;
}

</script>
{/literal}
<script>
$(document).ready(function() {

	$(".mc_customer").addClass('active');
	$(".mc_customer ul").css('display', 'block');
	$("#customer_index").addClass('current-page');

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