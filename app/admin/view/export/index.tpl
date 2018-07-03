
{* <script type="text/javascript">var config = {$js_config};</script> *}
<div class="">
	<div class="" id="AllId">
		<div class="col-lg-12 col-sm-12 col-xs-12">
			<div id="btn_export_active">
				<ul>
					<li class='active'><a href="{$arg.this_link}">{$value.code}</a></li>
				</ul>
			</div>
		</div>
	</div>



	<div class="row">
		<div class="col-md-9 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
		        	<a href="./admin?mc=export&site=statistics" style="margin-right: 20px;" class="btn btn-default pull-left"><i class="fa fa-arrow-left"></i>&ensp;Hóa đơn lưu trữ</a>
					<h2>Chi tiết đơn hàng</h2>
					<ul class="nav navbar-right panel_toolbox">
						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">

					<div class="h_content">

						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#GetProduct" onclick="LoadProduct()">
							<i class="fa fa-pencil"></i> Chọn sản phẩm
						</button>
						<button type="button" class="btn btn-success" data-toggle="modal" onclick="LoadService();" data-target="#Services">
							<i class="fa fa-check-square-o"></i> Chọn dịch vụ
						</button>
						<div class="clearfix"></div>
					</div>


					<div id="">
						<table class="table table-striped table-bordered" id="Products">
							<thead>
								<tr>
									<th width="50">#</th>
									<th>Mã</th>
									<th>Sản phẩm</th>
									<th class="text-right">Giá bán</th>
									<th class="text-center">Đơn vị</th>
									<th class="text-center">Số lượng</th>
									<th class="text-right">Thành tiền</th>
									<th class="td-actions" width="60"></th>
								</tr>
							</thead>
							<tbody>
								{foreach from=$products item=list}
								<tr id="proNo{$list.id}">
									<td>#</td>
									<td>{$list.code}</td>
									<td>{$list.name}</td>
									<td class="text-right">
										<input type="text" class="prod-price" style="margin-bottom:5px;  "
										value="{($list.price)|number_format}" disabled>
									</td>
									<td class='text-center'>
										{$list.unit_name}
									</td>
									<td class="text-center">
										<input type="number" class="prod-number" id="proNumber{$list.id}" onchange="UpdateNumberProduct({$list.id}, this.value,{$list.max_number});" value="{$list.number}">
									</td>
									<td class="text-right" id="proTotal{$list.id}">{$list.price*$list.number|number_format} đ</td>
									<td class="text-right"><button class="btn btn-danger" onclick="DeleteProductBill({$list.id})">
											<i class="fa fa-times-circle"></i>
										</button>
									</td>
								</tr>
								{/foreach}
							</tbody>
						</table>
					</div>

					<div id="showService">
						<table class="table table-striped table-bordered" id="Service">
							<thead>
								<tr>
									<th width="50">#</th>
									<th>Dịch vụ</th>
									<th class="text-right">Chi phí</th>
									<th class="text-center">Số lượng</th>
									<th class="text-right" width="120">Thành tiền</th>
									<th class="text-right" width="60"></th>
								</tr>
							</thead>
							<tbody>
								{foreach from=$services item=list}
								<tr id="serNo{$list.id}">
									<td>#</td>
									<td>{$list.name}</td>
									<td class="text-right"><input type="text"  disabled class="prod-price" value="{$list.price|number_format}"></td>
									<td class="text-center"><input type="number" class="prod-number" id="serNumber{$list.id}"
										onchange="ServiceUpdateNumber({$list.id}, this.value);" value="{$list.number}">
									</td>
									<td class="text-right" id="serTotal{$list.id}">{($list.price*$list.number)|number_format} đ</td>
									<td class="text-right"><button type="button" class="btn btn-danger" onclick="DeleteServiceBill({$list.id});">
											<i class="fa fa-times-circle"></i>
										</button>
									</td>
								</tr>
								{/foreach}
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-3 col-xs-12 oder">

			<div class="row">
				<div class="col-md12 col-xs-12">
					<div class="x_panel">
						<div class="">
							<div class="tabbable">
								<ul class="nav nav-tabs">
									<li class="active"><a href="#tab1" data-toggle="tab">Cơ
											bản</a></li>
									<li><a href="#tab2" data-toggle="tab">Chiết khấu</a></li>
									<li><a href="#tab3" data-toggle="tab">Mô tả</a></li>
								</ul>
							</div>
						</div>
						<div class="x_content">
							<br>
							<form class="form-horizontal form-label-left input_mask">
								<div class="tab-content">
									<div class="tab-pane active" id="tab1">
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-6">Ngày</label>
											<div class="col-md-9 col-sm-9 col-xs-6">
												<input class="date-picker form-control col-md-7 col-xs-12"
													onchange="SetExportValue('date', this.value);"
													required="required" type="text" id="exportday"
													value="{$value.date}">
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-3 col-sm-3 col-xs-12">
												<button type="button" class="btn btn-primary"
													onclick="LoadDataForForm(0);" data-toggle="modal"
													data-target="#UpdateFrom">
													<i class="fa fa-plus" aria-hidden="true"></i>
												</button>
											</div>
											<div class="col-md-9 col-sm-9 col-xs-12">
												<select class="select2_single form-control"
													name="customer_id" tabindex="-1"
													onchange="SetExportValue('customer_id', this.value); SetCustomerDiscount(this.value);">
													<option value=0> Lựa chọn khách hàng </option>
													{$out.customers}
												</select>
											</div>
										</div>
									</div>
									<div class="tab-pane" id="tab2">
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">Loại</label>
											<div class="col-md-9 col-sm-9 col-xs-12">
												<select class="form-control" name="discount_type"
													onchange="SetExportValue('discount_type', this.value);">{$out.discount}
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">Giá
												trị</label>
											<div class="col-md-9 col-sm-3 col-xs-9">
												<input type="text" class="form-control text-right"
													name="discount"
													onchange="SetExportValue('discount', this.value);"
													value="{$value.discount}" />
											</div>
										</div>
									</div>
									<div class="tab-pane" id="tab3">
										<div class="form-group">
											<div class="col-md-12 col-sm-12 col-xs-12"><textarea class="form-control" rows="3"  name="description" onchange="SetExportValue('description', this.value)"
													id='descriptionex' placeholder='Mô tả thêm...'> {$value.description}</textarea>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

			<div class="x_panel oder">
				<div class="x_content">
					<form class="form-horizontal form-label-left">
						<div class="form-group">
							<label class="control-label col-md-4 col-sm-4 col-xs-12">Tổng tiền</label>
							<div class="col-md-8 col-sm-8 col-xs-12">
								<input type="text" class="form-control text-right" name="m_total" readonly />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-4 col-sm-4 col-xs-12">Phải trả</label>
							<div class="col-md-8 col-sm-8 col-xs-12">
								<input type="text" class="form-control text-right" name="m_total_must_pay" readonly />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-4 col-sm-4 col-xs-12">Khách trả</label>
							<div class="col-md-8 col-sm-8 col-xs-12">
								<input type="text" name="payment"
									class="form-control text-right"
									onchange="SetExportValue('payment', this.value);"
									value="{$value.payment|number_format}" />
								<button type="button" id="GetAllPay" onclick="GetAllPayment();"
									title="Trả toàn bộ">
									<i class="fa fa-calculator"></i>
								</button>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-4 col-sm-4 col-xs-12">Khách nợ</label>
							<div class="col-md-8 col-sm-4 col-xs-12">
								<input type="text" class="form-control text-right" name="debt" readonly />
							</div>
						</div>
					</form>
					<hr>
					<div class="text-center">
						{* <button type="button" id="SaveExport" class="btn btn-lg btn-success" data-toggle="modal" data-target="#orderDetail" onclick="GetOrderDetail({$out.eid});">
							<i class="fa fa-check-square-o"></i> Lưu hóa đơn
						</button> *}
						<button type="button" id="SaveExport" class="btn btn-lg btn-success" onclick="GetOrderDetail();">
							<i class="fa fa-check-square-o"></i> Lưu hóa đơn
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- GetProduct -->
<div class="modal fade" tabindex="-1" id="GetProduct">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 class="modal-title">Nhập sản phẩm vào hóa đơn</h4>
            </div>
            <div class="modal-body">
                <div class="row form-group" id="prodFillter">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="FilterKey" class="form-control" oninput="LoadProduct();" placeholder="Mã / Tên sản phẩm">
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" id="FilterCate" onchange="LoadProduct();">
							<option value=0>Danh mục sản phẩm</option>
							{$out.categories}
						</select>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" id="FilterTrademark" onchange="LoadProduct();">
							<option value=0>Thương hiệu</option>
							{$out.trademarks}
						</select>
                    </div>
                </div>
                <div style="max-height: 400px; overflow-y: auto">
					<table class="table table-striped" id="ProductList"></table>
				</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- Services -->
<div class="modal fade" id="Services" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" >
                    <span>&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Nhập dịch vụ vào hóa đơn</h4>
            </div>
            <div class="modal-body modal-form">

                <table class="table" id="ServicesChoice"></table>

            </div>
            <div class="modal-footer">
                <a href="javascript:void(0);" class="btn btn-default"
                   data-dismiss="modal">Đóng</a>
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
                    <!-- <button type="button" data-toggle="modal" class="btn btn-info" onclick="SetcPrint();" data-dismiss="modal"><i class="fa fa-print"></i> In</button> -->
                    <button id="save_btn" type="submit" class="btn btn-success" name="submit"><i class="fa fa-save"></i> Lưu lại</button>
                    <button type="submit" class="btn btn-success" name="submit_print"><i class="fa fa-save"></i> Lưu và In</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Bỏ qua</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Print -->
<div class="modal fade" id="Print" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body modal-print">
                <iframe src="#" style="zoom:0.60" width="99.6%" height="450" id="PrintContent"></iframe>
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
                <h4 class="modal-title">Thêm khách hàng</h4>
            </div>
            <div class="modal-body form-horizontal">
                <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="hidden" name="id">
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
                        <input class="form-control" type="text" name="code" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Tên KH</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="text" name="name" required="required" class="form-control" placeholder="Name...">
                    </div>
                </div>
				<div id="name_eror" class="text-center" style="color: red; margin-bottom: 10px;">
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

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="AddNewCustomer();">Lưu lại</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Bỏ qua</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script src="{$arg.stylesheet}js/wh.export.js"></script>
<script>
	var print_id = '{if isset($smarty.session.export_id) and $smarty.session.export_id neq ''}{$smarty.session.export_id}{/if}';
</script>
{literal}
<script>
window.onload = (function()
{
	print();
})()
$(document).ready(function () {
    $('#exportday').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_4",
        format: 'DD-MM-YYYY'
    }, function (start, end, label) {
        $('#exportday').change();
    });
	$("#showService").hide();
    GetTotalSession(1);
});

function SetCustomerDiscount(value) {
    $.post("?mod=customer&site=ajax_load_group_discount", {'id': value}).done(function (data) {
        var data = JSON.parse(data);
        $("input[name=discount]").val(data.discount).change();
        $("select[name=discount_type]").html(data.select_discount_type).change();
    });
}
//thêm khách hàng ajax
function AddNewCustomer() {
    var data = {};
    data['code'] = $("#UpdateFrom input[name=code]").val();
    data['group_id'] = $("#UpdateFrom select[name=group_id]").val();
    data['name'] = $("#UpdateFrom input[name=name]").val();
    data['phone'] = $("#UpdateFrom input[name=phone]").val();
    data['address'] = $("#UpdateFrom input[name=address]").val();
	if(data['name'] == "")
			{
				$('#name_eror').html("Tên không được bỏ trống!");
				return false;

			}
    $.post("./admin?mc=customer&site=ajax_insert_item", data).done(function (data_return) {
        var data_return = JSON.parse(data_return);
		console.log(data_return);
		//return;
        $('#UpdateFrom').modal('hide');

        $(".select2_single").select2({placeholder: "Select a state", allowClear: true});
        $("select[name=customer_id]").html(data_return.categories).change();
    });
}

// load modal customer
function LoadDataForForm(id) {
    $("#UpdateFrom input[type=text]").val('');
    $.post("./admin?mc=customer&site=ajax_load", {'id': id}).done(function (data) {
        var data = JSON.parse(data);
        $("#UpdateFrom input[name=code]").val(data.code);
        $("#UpdateFrom select[name=group_id]").html(data.group);
    });
}

// trả đủ tiền
function GetAllPayment() {
    var must_pay = $("input[name=m_total_must_pay]").val();
    $("input[name=payment]").val(must_pay);
    $('input[name=payment]').change();
}

function print()
{	if(!print_id)
		return
	var link = './admin?mc=export&site=export_print&id=' + print_id;
	$("#PrintContent").attr("src", link);
	console.log(link);
}
function SetcPrint() {
    $("#PrintContent").attr("src", cprint);
    return false;
}

function SetafPrint() {
    $("#PrintContent").attr("src", afprint);
    return false;
}

function GetOrderDetail() {
    let customer_id = $("select[name=customer_id]").val();
    if(customer_id == 0) {
        alert('Vui lòng chọn khách hàng');
        return;
    }


		var detail = '1';
	    $.get("./admin?mc=exportajax&site=ajax_get_export_session_detail").done( (data) => {

			 data = JSON.parse(data);
			 if(Object.keys(data.products).length > 0 || Object.keys(data.services).length > 0)
			 	$('#orderDetail').modal('toggle');
			else
				{
					alert('Vui lòng lựa chọn mặt hàng');
					return;
				}
			 console.log(data);
				 detail = `

					<div class="modal-body form-horizontal">
						<h2>Hóa đơn bán hàng - ${data.export.code}</h2>
						<div class="modal50">
						<p><span><i class="icon-user"></i>Nhân viên bán hàng:</span> ${data.creator}</p><p><span><i class="icon-time"></i> Thời gian:</span> ${data.time}</p>
						</div>
						<div class="modal50"><p><span><i class="icon-user-md"></i> Khách hàng: </span>${data.customer.name}</p></div>
						<div class="modal50"><p><span><i class="icon-user-md"></i> Địa chỉ: </span>${data.customer.address}</p></div>
						<hr class="clear">`;

				if(Object.keys(data.products).length > 0)
				{


				detail += `
						<h3>Bảng chi tiết sản phẩm</h3>
						<table class="table table-striped table-bordered table-bor-btm">
							<thead>
							<tr>
								<th class="text-right">TT</th>
								<th>Sản phẩm</th>
								<th class="text-right">Đơn vị</th>
								<th class="text-right">Giá bán</th>
								<th class="text-right">Số lượng</th>
								<th class="text-right">Thành tiền</th>
							</tr>
							</thead>
							<tbody>
							`;
						let index = 1;
						$.each(data.products, function(key, product) {
						detail += `
							<tr>
								<td class="text-right">${index}</td>
								<td>${product.name}</td>
								<td class="text-right">${product.unit_name}</td>
								<td class="text-right">${ConvertMoney(product.price)}</td>
								<td class="text-right">${product.number}</td>
								<td class="text-right">${ConvertMoney(product.number * product.price)} đ</td>
							</tr>`;
							index++;
						})

						detail += `</tbody> </table>`;

					}
					if(Object.keys(data.services).length > 0)
					{
						detail += `

						<h3>Bảng chi tiết dịch vụ</h3>
						<table class="table table-striped table-bordered table-bor-btm">
							<thead>
							<tr>
								<th class="text-right">TT</th>
								<th>Dịch vụ</th>
								<th class="text-right">Chi phí</th>
								<th class="text-right">Số lượng</th>
								<th class="text-right">Thành tiền</th>
							</tr>
							</thead>
							<tbody>`;
							index=1;
							$.each(data.services, function(key, product) {
								detail += `<tr>
									<td class="text-right">${index}</td>
									<td>${product.name}</td>
									<td class="text-right">${ConvertMoney(product.price)} đ</td>
									<td class="text-right">${product.number}</td>
									<td class="text-right">${ConvertMoney(product.number * product.price)} đ</td>
								</tr>`
							index++;
							})
							detail += `</tbody></table>`;
					}
					detail += `
						<div class="bold text-right">`;
							detail += `<h3>Tổng tiền: ${ConvertMoney(data.export.total)} đ</h3>`
							if(data.export.total == data.export.must_pay)
								detail += `<h3>Chiết khấu: 0 đ</h3>`
							else
								detail += `<h3>Chiết khấu: ${ConvertMoney(data.export.total - data.export.must_pay)} đ</h3>`
							detail += `<h3> Khách cần trả: ${ConvertMoney(data.export.must_pay)} đ</h3>`
							detail += '<hr>';
							detail += `<h3>Khách trả: ${ConvertMoney(data.export.payment)} </h3>`;

							//<hr>
							//<p>Ghi nợ: 38,000 đ</p>
							//<h3>Thanh toán: 120,000 đ</h3>
						detail += `</div>`;
				detail += "</div>"


			$("#orderDetail .modal-body").html(detail);
		});
}




</script>
{/literal}

