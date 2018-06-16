<div class="">
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Bảng tổng hợp thu chi</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <div class="h_content">
                        <div class="form-group form-inline">
                            <select class="form-control left" id="date_ex" onchange="filter();">
                                <option value="0">Tất cả hóa đơn</option> {$out.select_export}
                            </select>
                        </div>
                        <button data-toggle="modal" class="btn btn-primary" data-target="#MoneyCat" onclick="LoadMoneyCat(1);"><i class="fa fa-plus"></i> Thể loại</button>
                        <button data-toggle="modal" class="btn btn-primary" data-target="#Bill" onclick="LoadDataForAddEditMoney(1);"><i class="fa fa-plus"></i> Lập phiếu thu</button>
                        <button data-toggle="modal" class="btn btn-primary" data-target="#Bill" onclick="LoadDataForAddEditMoney(0);"><i class="fa fa-mail-reply-all"></i> Lập phiếu chi</button>
                        <input type='hidden' id='permission' value='{$arg.user.permission}'>
						{* <form method="post" style="display: inline;">
							<button type="submit" class="btn btn-success" name="export_request">
								<i class="fa fa-share-square-o"></i> Xuất file
							</button>
						</form> *}

						<div class="clearfix"></div>
                    </div>

					<div id="money_stats">
						<ul>
							<li><a>Tổng thu: <span>{$money.import|number_format} đ</span></a></li>
							<li><a>Tổng chi: <span>{$money.export|number_format} đ</span></a></li>
							<li><a>Ngân quỹ: <span>{$money.total|number_format} đ</span></a></li>
						</ul>
						<div class="clearfix"></div>
					</div>

                    <!-- start project list -->
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Mã phiếu</td>
                                <th>Thể loại</th>
                                <th>Nội dung</th>
                                <th>Ngày tháng</th>
                                <th class="text-right">Thu</th>
                                <th class="text-right">Chi</th>
                                <th>Người nộp / nhận</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            {foreach from=$result item=list}
                                <tr id="field{$list.id}">
                                    <td>{$list.code}</td>
                                    <td>
                                    {$list.money_type}<br>
                                    <small>{$list.category}</small>
                                    </td>
                                    <td>{$list.description}</td>
                                    <td>{$list.date|date_format:"%d-%m-%Y"}<br><small>{$list.updated_at}</small></td>
                                    <td class="text-right">
                                        {if $list.is_import neq 0}
                                            <b style='color:red'>{$list.money|number_format} đ </b>
                                        {/if}
                                    </td>
                                    <td class="text-right">
                                        {if $list.is_import eq 0}
                                            <b style='color:red'>{$list.money|number_format} đ </b>
                                        {/if}
                                    </td>
                                    <td>
                                        {$list.object_name}
                                        {if $list.object neq NULL}
                                            {if $list.object eq "sup"}
                                                <br><small>[Nhà cung cấp]</small>
                                            {/if}

                                            {if $list.object eq "cus"}
                                                <br><small>[Khách hàng]</small>
                                            {/if}

                                            {if $list.object eq "usr"}
                                                <br><small>[Người dùng]</small>
                                            {/if}
                                        {/if}
                                    </td>
                                    <td class="text-right">
                                        {$list.btn}
                                        {* <button type="button" title="In phiếu" class="btn btn-default" data-dismiss="modal" onclick="SetPrint({$list.id})">
                                            <i class="fa fa-print"></i>
                                        </button> *}
                                    </td>
                                </tr>
                            {/foreach}

                        </tbody>
                    </table>
                    <!-- end project list -->

                    <div class="paging">{$paging.paging}</div>
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




<div class="modal fade" tabindex="-2" id="MoneyCat">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 class="modal-title" >Danh sách thể loại</h4>
            </div>
            <form data-parsley-validate class="form-horizontal form-label-left" method="post" action="">
                <div class="modal-body">
                    <button type="button" id="BtnCreateMoneyCat" data-toggle="modal" class="btn btn-primary" data-target="#AddMoneyCat" onclick='LoadCodeForAddingMonCat();'><i class="fa fa-plus" ></i> Thêm </button>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover projects">
                            <thead>
                                <tr>
                                    <th>Mã</th>
                                    <th>Tên</th>
                                    <th class="text-right">Loại</th>
                                    <th class="text-center">Chú thích</th>
                                    <th class="text-right">Trạng thái</th>
                                    <th class="text-right"></th>
                                </tr>
                            </thead>
                            <tbody id="body_table_mon_cat">
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<!-- Modal UpdateFrom -->
<div class="modal fade" tabindex="-1" id='Bill'>
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
                            <input type='hidden' name='is_import'>
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
                                {$out.object}
                            </select>
                        </div>
                    </div>
                    <div class="form-group customer_group">
                        <label class="control-label col-md-3 col-sm-2 col-xs-12">Nhóm khách hàng</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="customer_group" class="form-control" onchange="LoadCustomerGroup(this.value)"></select>
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
                                <label> <input type="checkbox" name="type" value="1">Hạch toán vào kết quả hoạt động kinh doanh</label>
                                <p class="help-block">Chọn trong trường hợp giá trị này là khoản Thu nhập thêm hoặc Chi phí vận hành, phát sinh của cửa hàng. Không chọn trong trường hợp Thu tiền hàng hoặc Trả tiền nhà cung cấp.</p>
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



<!-- /.modal -->


<!-- Modal Update Item -->
<div class="modal fade"  id="UpdateForm">
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
					<label class="control-label col-md-3 col-sm-2 col-xs-12">Mã</label>
					<div class="col-md-7 col-sm-6 col-xs-12">
						<input type="text" class="form-control" name="code">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-2 col-xs-12">Tên thể loại</label>
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
					<label class="control-label col-md-3 col-sm-2 col-xs-12">Trạng thái</label>
					<div class="col-md-9 col-sm-9 col-xs-12">
						<div class="checkbox">
							<label> <input type="checkbox" name="status"> Active / Inactive this item</label>
						</div>
					</div>
				</div>

				<br />
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="UpdateMoneyType();">Lưu lại</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Bỏ qua</button>
			</div>
		</div>
    </div>
</div>


<div class="modal fade"  id="AddMoneyCat">
    <div class="modal-dialog">
        <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Thêm thể loại</h4>
			</div>
			<div class="modal-body form-horizontal form">
				<br>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-2 col-xs-12">Mã</label>
					<div class="col-md-7 col-sm-6 col-xs-12">
						<input type="text" class="form-control" name="code">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-2 col-xs-12">Tên thể loại</label>
					<div class="col-md-7 col-sm-6 col-xs-12">
						<input type="text" class="form-control" name="name">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-2 col-xs-12">Loại</label>
					<div class="col-md-7 col-sm-6 col-xs-12">
						<label class="radio-inline"><input type="radio" name="type" value='import' checked>Thu</label>
                        <label class="radio-inline"><input type="radio" name="type" value='exprot'>Chi</label>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-2 col-xs-12">Mô tả thêm</label>
					<div class="col-md-8 col-sm-6 col-xs-12">
						<textarea class="form-control" name="description" rows="4"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-2 col-xs-12">Trạng thái</label>
					<div class="col-md-9 col-sm-9 col-xs-12">
						<div class="checkbox">
							<label> <input type="checkbox" name="status"> Active / Inactive this item</label>
						</div>
					</div>
				</div>

				<br />
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary"  onclick="AddMoneyCat();">Lưu lại</button>
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


<script>
    var print = '{$out.print}';
</script>
<script src="{$arg.stylesheet}js/moment/moment.min.js"></script>
<script type="text/javascript" src="{$arg.stylesheet}js/datepicker/daterangepicker.js"></script>
{literal}
<script>
$(document).ready(function() {
	$('#UpdateForm #datefees').daterangepicker({singleDatePicker : true, calender_style : "picker_4", format : 'DD-MM-YYYY'});
	//$('#AddForm #datefees').daterangepicker({singleDatePicker : true, calender_style : "picker_4", format : 'DD-MM-YYYY'});

	$('#date_from').daterangepicker({singleDatePicker : true, calender_style : "picker_4", format : 'DD-MM-YYYY'}, function() {
		$('#date_from').change();
	});
	$('#date_to').daterangepicker({singleDatePicker : true, calender_style : "picker_4", format : 'DD-MM-YYYY'}, function() {
		$('#date_to').change();
	});
    $(".customer_group").hide();
});
$(document).on('hidden.bs.modal', '.modal', function () {
    $('.modal:visible').length && $(document.body).addClass('modal-open');
});

function activeStatus(table, id)
{
    $.post(`./admin?mc=money&site=ajax_active`, {'table': table, 'id': id}).done(function (data) {
        if(data == 0)
        alert('You can not change');
        else
        $("#stt" + id).html(data);
    });
}
// load tất cả LOẠI phiếu thu
function LoadMoneyCat()
{
    $.post("./admin?mc=money&site=ajax_load_all_money_cat").done(function(data){
        data = JSON.parse(data);
        var permission = $("#permission").val();

        let append = '';
        $.each(data, function(key, item){
            append += `
            <tr id='row${item.id}'>
                <td>${item.code}</td>
                <td>${item.name}</td>
                <td class="text-right">${item.is_import}</td>
                <td class="text-right">${item.description}</td>
                <td class="text-center" id='stt${item.id}'>${item.status}</td>
                <td class="text-right">

                <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#UpdateForm" onclick="LoadDataForForm(${item.id});"><i class="fa fa-pencil"></i></button>`;

                 if(permission != 3)
                {
                        append += `
                        <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#DeleteForm" onclick="LoadDeleteItemRow('money', ${item.id}, 'ajax_delete_cat', 'thể loại', 'vì còn tồn tại trong phiếu thu chi');"><i class="fa fa-trash-o"></i></button>
                        </td>
                    </tr>
                    `;
                }
        })
        $("#body_table_mon_cat").html(append);
    })
}
// Load dữ liệu cho chỉnh sửa LOẠI phiểu thu
function LoadDataForForm(id)
{
    if(id != 0)
    {
        $.post("./admin?mc=money&site=ajax_load_money_cat",{"id": id}).done(function(data){
            data = JSON.parse(data);
            data = data[0]
            console.log(data)
            $("#UpdateForm input[name=id]").val(data.id);
            $("#UpdateForm input[name=code]").val(data.code);
            $("#UpdateForm input[name=name]").val(data.name);
            $("#UpdateForm input[name=description]").html(data.description);
            if(data.status == 1)
            {
                $("#UpdateForm input[name=status]").attr("checked", "checked");
                $("#UpdateForm input[name=status]").prop('checked', true);
            }
            else
            {
                $("#UpdateForm input[name=status]").removeAttr("checked");
				$("#UpdateForm input[name=status]").prop('checked', false);
            }
        })
    }
}

// Cập nhật LOẠI phiếu thu
function UpdateMoneyType()
{
    var data = {};
    data['id'] = $("#UpdateForm input[name=id]").val();
	data['code'] = $("#UpdateForm input[name=code]").val();
	data['name'] = $("#UpdateForm input[name=name]").val();
	data['description'] = $("#UpdateForm textarea[name=description]").val();
	data['status'] = $("#UpdateForm input[name=status]").is(":checked");
	if(data['name'] == '')
    {
		$("#UpdateForm input[name=name]").val('Vui lòng nhập thể loại');
		setTimeout(function(){
			$("#UpdateForm input[name=name]").val('');
			$("#UpdateForm input[name=name]").focus();
		}, 1000);
		return false;
	}
    	if(data['code'] == '')
    {
		$("#UpdateForm input[name=code]").val('Vui lòng nhập mã');
		setTimeout(function(){
			$("#UpdateForm input[name=code]").val('');
			$("#UpdateForm input[name=code]").focus();
		}, 1000);
		return false;
	}

	$.post("./admin?mc=money&site=ajax_update_money_cat", data).done(function(dt) {
        console.log('?')
        LoadMoneyCat();
	});
}
//Lấy code cho LOẠI phiếu thu mới
function LoadCodeForAddingMonCat()
{
    $.post("./admin?mc=money&site=ajax_get_code").done(function(data) {
        $("#AddMoneyCat input[name=code]").val(data);
    });
}
// click nút thêm mới LOẠI phiếu thu
function AddMoneyCat()
{
    var data = {};
	data['code'] = $("#AddMoneyCat input[name=code]").val();
	data['name'] = $("#AddMoneyCat input[name=name]").val();
	data['type'] = $("#AddMoneyCat input[name=type]:checked").val();
	data['description'] = $("#AddMoneyCat textarea[name=description]").val();
	data['status'] = $("#AddMoneyCat input[name=status]").is(":checked");
    // $.post("./admin?mc=money&site=check_duplicate_money_cat_code", { "code" : data['code'] } ).done(function(dt) {
    //     if(dt == 1)
    //     {
    //         alert('Mã bị trùng, vui lòng nhập mã khác');
    //         return;
    //     }
    //
    // });
	if(data['name'] == '')
    {
		$("#AddMoneyCat input[name=name]").val('Vui lòng nhập thể loại');
		setTimeout(function(){
			$("#AddMoneyCat input[name=name]").val('');
			$("#AddMoneyCat input[name=name]").focus();
		}, 1000);
		return false;
	}
    	if(data['code'] == '')
    {
		$("#AddMoneyCat input[name=code]").val('Vui lòng nhập mã');
		setTimeout(function(){
			$("#AddMoneyCat input[name=code]").val('');
			$("#AddMoneyCat input[name=code]").focus();
		}, 1000);
		return false;
	}

	$.post("./admin?mc=money&site=ajax_add_money_cat", data).done(function(dt) {
        $("#AddMoneyCat").modal('toggle');
        LoadMoneyCat();
	});
}

// load dữ liệu cho việc tạo PHIẾU THU
function LoadDataForAddEditMoney(is_import = 0)
{
    $("#Bill input[name=id]").val(0);
    if(is_import == 0)
    {
        $("#Bill #title_fees").html("Lập phiếu chi");
        $("#Bill input[name=is_import]").val('export')

    }
    else
    {
        $("#Bill #title_fees").html("Lập phiếu thu");
        $("#Bill input[name=is_import]").val('import')
    }

	$.post("./admin?mc=money&site=ajax_load_data_for_adding", {'is_import': is_import}).done(function(data) {
		var data = JSON.parse(data);
		$("#Bill select[name=category_id]").html(data.category);
        $("#Bill input[name=date]").val(data.date);
	});
}
//phiếu thu chi -----------------------------------------------
// load dữ liệu cho việc tạo phiếu thu chi
function LoadObject(value)
{
    if(value ==1)
        $(".customer_group").show();
    else
        $(".customer_group").hide();
	$.post("./admin?mc=money&site=ajax_load_select_object", {'type' : value}).done(function(data) {
        if(value == 1)
            $("#Bill select[name=customer_group]").html(data);
        else
            $("#Bill select[name=object_id]").html(data);
	});
}

function LoadCustomerGroup(value)
{
    $.post("./admin?mc=money&site=ajax_load_customer", {'type' : value}).done(function(data) {
        $("#Bill select[name=object_id]").html(data);
	});
}








// function OnCategoryChange(value)
// {
//     if(value != 0)
//     {
//         $("#BtnEditMoneyType").show();
//         $("#BtnDeleteMoneyType").show();
//         $.post("./admin?mc=money&site=ajax_load_info_money_cat", {"id": value}).done(function(data){
//             data = JSON.parse(data)
//             $("#UpdateMoneyType input[name=id]").val(value);
//             $("#UpdateMoneyType input[name=name]").val(data.name);
//             $("#UpdateMoneyType input[name=description]").val(data.description);
//             if(data.status == 1)
//             {
//                 $("#UpdateMoneyType input[name=status]").attr("checked", "checked");
//                 $("#UpdateMoneyType input[name=status]").prop('checked', true);
//             }
//             else
//             {
//                 $("#UpdateMoneyType input[name=status]").removeAttr("checked");
// 				$("#UpdateMoneyType input[name=status]").prop('checked', false);
//             }
//
//         })
//     }
//     else
//     {
//         $("#BtnEditMoneyType").hide();
//         $("#BtnDeleteMoneyType").hide();
//         $("#UpdateMoneyType input[name=id]").val(0);
//         $("#UpdateMoneyType input[name=name]").val('');
//         $("#UpdateMoneyType input[name=description]").val('');
//         $("#UpdateMoneyType input[name=status]").removeAttr("checked");
//         $("#UpdateMoneyType input[name=status]").prop('checked', false);
//     }
//
// }


// create money type



// function SetExportInfo(id, type) {
// 	if(type=='exp' || type=='srv')
// 	    $("#orderDetail .modal-body").load("?mod=exportAjax&site=ajax_get_export_info", {"id": id});
// 	else
// 	    $("#orderDetail .modal-body").load("?mod=import&site=ajax_get_import_info", {"id": id});
// }
//
// function SetPrint(id){
//     $("#PrintContent").attr("src", print + id);
//     return false;
// }



function LoadDataForEdit(id, is_import)
{
    if(id == 0)
        return;
    $("#title_fees").html("Chỉnh sửa phiếu thu chi");
    // return;
	$("#Bill input[name=id]").val(id);
	// $("#UpdateForm input[type=checkbox]").removeAttr("checked");
	// $("#UpdateForm select[name=object]").removeAttr('disabled');
	// $("#UpdateForm select[name=object_id]").removeAttr('disabled');
	$.post("./admin?mc=money&site=ajax_load_money", {'id':id, 'is_import':is_import}).done(function(data) {
            var data = JSON.parse(data);
			$("#Bill input[name=money]").val(data.money);
			$("#Bill textarea[name=description]").val(data.description);

//			$("#UpdateForm select[name=object]").attr('disabled','disabled');
//			$("#UpdateForm select[name=object_id]").attr('disabled','disabled');
            if (data.type == '1') {
                $("#Bill input[name=type]").attr("checked", "checked");
                $("#Bill input[name=type]").prop('checked', true);
            } else {
                $("#Bill input[name=type]").removeAttr("checked");
                $("#Bill input[name=type]").prop('checked', false);
            }

		$("#Bill input[name=date]").val(data.date);
		$("#Bill select[name=category_id]").html(data.category);
		$("#Bill select[name=object]").html(data.object);
		$("#Bill select[name=object_id]").html(data.object_id);
	});
}


function filter() {
    var date = $("#date_ex").val();
    var url = "./admin?mc=money&site=index";
    url += "&date=" + date;
    window.location.href = url;
}


// function filter() {
// 	var filter = $("#filter").val();
// 	var supp = $("#supp").val();
//     var date = $("#date_ex").val();
// 	var url = "./?mod=money&site=index";
// 	url += "&filter=" + filter;
// 	url += "&supp=" + supp;
//     url += "&date=" + date;
//
// 	if (filter == "1") {
// 		var date_from = $("#date_from").val();
// 		var date_to = $("#date_to").val();
// 		url += "&date_from=" + date_from;
// 		url += "&date_to=" + date_to;
// 	} else if (filter == "2") {
// 		var year = $("#year").val();
// 		var month = $("#month").val();
// 		url += "&year=" + year;
// 		url += "&month=" + month;
// 	}
//
// 	window.location.href = url;
// }
</script>
{/literal}
