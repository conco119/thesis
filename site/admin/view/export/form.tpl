<script>
var eid = {$out.eid};
$(document).ready(function() {
    $(function() {
     var pgurl = window.location.href.substr(window.location.href.lastIndexOf("/")+1);
         $("#btn_export_active a").each(function(){
              if($(this).attr("href") == pgurl || $(this).attr("href") == '' )
              		$(this).parent().addClass("active");
         })
    });
});
</script>
<script type="text/javascript">var config = {$js_config};</script>
<div class="">

	<div class="" id="AllId">
		<div class="col-lg-12 col-sm-12 col-xs-12">
			<div id="btn_export_active">
				<ul>
					{foreach from=$session key=k item=data}
					<li><a href="{$out.url}&id={$k}">HD{$k}<span class="fa fa-remove" onclick="RemoveExport({$k});"></span></a></li>
					{/foreach}
					<li>
						<button type="button" class="btn btn-primary" onclick="AddNewExport();">
							<i class="fa fa-plus"></i>
						</button>
					</li>
				</ul>
			</div>
		</div>
	</div>



	<div class="row">
		<div class="col-md-9 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
		        	<a href="?mod=export&site=statistics" style="margin-right: 20px;" class="btn btn-default pull-left"><i class="fa fa-arrow-left"></i>&ensp;Hóa đơn lưu trữ</a>
					<h2>Chi tiết đơn hàng</h2>
					<ul class="nav navbar-right panel_toolbox">
						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">

					<div class="h_content">
						<div class="form-group form-inline">
							<input class="left form-control" id="UseBarcode" placeholder="Mã vạch" autofocus onchange="GetProductFromBarcode({$out.eid}, this.value);">
						</div>

						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#GetProduct" onclick="LoadProduct({$out.eid});">
							<i class="fa fa-pencil"></i> Chọn sản phẩm
						</button>
						{if $arg.setting.use_service eq 1}
						<button type="button" class="btn btn-success" data-toggle="modal" onclick="LoadService({$out.eid});" data-target="#Services">
							<i class="fa fa-check-square-o"></i> Chọn dịch vụ
						</button>
						{/if}
						{if $arg.setting.use_sale eq 1}
						<select class="form-control" name="price_sale" id="price_sale" onchange="UpdatePriceSale({$out.eid},this.value)"
							style="display: inline; width: 40px;"> {$out.price_sale}
						</select>
						{/if}
						<div class="clearfix"></div>
					</div>


					<div id="">
						<table class="table table-striped table-bordered" id="Products">
							<thead>
								<tr>
									<th>Mã</th>
									<th>Sản phẩm</th>
									<th class="text-right">{if $arg.setting.percent eq 1}Nguyên giá{else}Giá bán{/if}</th>
									{if $arg.setting.percent eq 1}<th class="text-center">Chiết khấu</th>
									<th class="text-right">Giá bán</th>{/if}
									<th class="text-center">SL</th>
									{if $arg.setting.use_warranty eq 1}
									<th class="text-center">Bảo hành</th>
									{/if}
									<th>Đơn vị</th> 
									{if $arg.setting.use_expiry eq 1}
									<th>HSD</th>
									{/if}
									<th class="text-right">Thành tiền</th> 
									{if $arg.setting.use_description eq 1}
									<th class="text-center" width="70">Mô tả</th>
									{/if}
									<th class="td-actions" width="60"></th>
								</tr>
							</thead>
							<tbody>
								{foreach from=$value.products item=list}
								<tr id="proNo{$list.id}">
									<td>{$list.code}</td>
									<td>{$list.name}</td>
									<td class="text-right">
										<input type="text" class="prod-price" style="margin-bottom:5px; " id="proPrice{$list.id}" onchange="UpdateProductPrice({$out.eid}, {$list.id});"
										value="{($list.price)|number_format}">
										</td>
									{if $arg.setting.percent eq 1}<td class="text-center">
										<div class="input-group" style="width: 50px;">
											<input id="propercent{$list.id}" type="text" class="form-control prod-price input-sm"  value="{$list.percent}" onchange="UpdatePercent({$out.eid}, {$list.id});" aria-describedby="basic-addon2">
											<span class="input-group-addon" id="basic-addon2" style="padding: 2px;">%</span>
										</div>
									</td>
									<td class="text-right" id="price_sell{$list.id}">
										{($list.price-$list.price*$list.percent/100)|number_format}
									</td>{/if}
									<td class="text-center">
										<input type="number" class="prod-number" id="proNumber{$list.id}" onchange="UpdateNumberProduct({$out.eid}, {$list.id}, 'update', this.value, {$list.max_number});" value="{$list.number}">
									</td> 
									{if $arg.setting.use_warranty eq 1}
									<td class="text-center">
										<input type="number" class="prod-number" id="proWarranty{$list.id}" onchange="UpdateWarrantyProduct({$out.eid}, {$list.id}, this.value);" value="{$list.warranty}">
									</td>{/if}
									<td>{$list.select_units}</td> {if $arg.setting.use_expiry eq 1}
									<td>{$list.expiry|date_format:"%d-%m-%Y"}</td>{/if}
									<td class="text-right" id="proTotal{$list.id}">{($list.price*$list.number-($list.price*$list.number*$list.percent/100))|number_format} đ</td>
									{if $arg.setting.use_description eq 1}
									<td class="text-center edit_desciption">
										<button type="button" id="test" class="btn btn-lg btn-info" data-html="true" 
										data-toggle="popover" data-placement="left" onclick="SetValueDescripton({$out.eid}, {$list.id});"
										data-content="<input type='text' class='form-control' id='proDescription{$list.id}' onchange='UpdateDescriptionProduct({$out.eid}, {$list.id}, this.value);' value='{$list.description}'>">
										<i class="fa fa-pencil"></i>
										</button>
										<!--<input type="text" class="situa_des1" id="proDescription{$list.id}" onchange="UpdateDescriptionProduct({$out.eid}, {$list.id}, this.value);" value="{$list.description}">-->
									</td>
									{/if}
									<td class="text-right"><button class="btn btn-danger" onclick="UpdateNumberProduct({$out.eid}, {$list.id}, 'delete')">
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
								{foreach from=$value.services item=list}
								<tr id="serNo{$list.id}">
									<td>#</td>
									<td>{$list.name}</td>
									<td class="text-right"><input type="text" class="prod-price" id="serPrice{$list.id}"
										onchange="ServiceUpdatePrice({$out.eid}, {$list.id});" value="{$list.price|number_format}"></td>
									<td class="text-center"><input type="number" class="prod-number" id="serNumber{$list.id}"
										onchange="ServiceUpdateNumber({$out.eid}, {$list.id}, 'update', this.value);" value="{$list.number}">
										{if $list.type == 1}
										
										<input type="text" class="prod-number text-right" id="serTime{$list.id}"
										onchange="ServiceUpdateTime({$out.eid}, {$list.id}, this.value);" value="{$list.time}">
										{/if}</td>
									<td class="text-right" id="serTotal{$list.id}">{($list.price*$list.number*$list.int_time)|number_format} đ</td>
									<td class="text-right"><button type="button" class="btn btn-danger" onclick="ServiceUpdateNumber({$out.eid}, {$list.id}, 'delete');">
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
													onchange="SetExportValue({$out.eid}, 'date', this.value);"
													required="required" type="text" id="exportday"
													value="{$value.date}">
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">NV</label>
											<div class="col-md-9 col-sm-9 col-xs-12">
												<select class="form-control"
													onchange="SetExportValue({$out.eid}, 'supporter', this.value);">{$out.supporter}
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">NVKD</label>
											<div class="col-md-9 col-sm-9 col-xs-12">
												<select class="form-control"
													onchange="SetExportValue({$out.eid}, 'staff_id', this.value);">
													<option value="0">Lựa chọn NVKD</option>
													{$out.staff_id}
												</select>
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
													onchange="SetExportValue({$out.eid}, 'customer_id', this.value); SetCustomerDiscount(this.value);">{$out.customers}
												</select>
											</div>
										</div>
									</div>
									<div class="tab-pane" id="tab2">
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">Loại</label>
											<div class="col-md-9 col-sm-9 col-xs-12">
												<select class="form-control" name="discount_type"
													onchange="SetExportValue({$out.eid}, 'discount_type', this.value);">{$out.discount}
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">Giá
												trị</label>
											<div class="col-md-9 col-sm-3 col-xs-9">
												<input type="text" class="form-control text-right"
													name="discount"
													onchange="SetExportValue({$out.eid}, 'discount', this.value);"
													value="{$value.discount}" />
											</div>
										</div>
									</div>
									<div class="tab-pane" id="tab3">
										<div class="form-group">
											<div class="col-md-12 col-sm-12 col-xs-12"><textarea class="form-control" rows="3"  name="description" onchange="SetValueDescriptonEx({$out.eid},this.value)"
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
									onchange="SetExportValue({$out.eid}, 'payment', this.value);"
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
						<button type="button" id="SaveExport" class="btn btn-lg btn-success" data-toggle="modal" data-target="#orderDetail" onclick="GetOrderDetail({$out.eid});">
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
                        <input type="text" id="FilterKey" class="form-control" oninput="LoadProduct({$out.eid});" placeholder="Mã / Tên sản phẩm">
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" id="FilterCate" onchange="LoadProduct({$out.eid});">{$out.categories}</select>
                    </div>
                    {if $arg.setting.use_trademark  eq 1} 
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" id="FilterTrademark" onchange="LoadProduct({$out.eid});">{$out.trademarks}</select>
                    </div>{/if}
                    {if $arg.setting.use_origin  eq 1} 
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" id="FilterOrigin" onchange="LoadProduct({$out.eid});">{$out.origins}</select>
                    </div>
                    {/if}
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
<script type="text/javascript">
var cprint = '{$out.cprint}';
var exprint = '{$out.exprint}';
var afid = '{if isset($smarty.session.export_id) and $smarty.session.export_id neq ''}{$smarty.session.export_id}{/if}';
var afprint = '{$out.afprint}'+afid;
//var afprint = '?mod=export&site=cprint&eid='+afid;
</script>
{literal}
<script>
$(function() {
    if (afid != '') {
        //alert(afprint);
        SetafPrint();
    }
});

function dzungx() {
    $("#save_btn").trigger("click");
}

$(document).ready(function () {
    $('#exportday').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_4",
        format: 'DD-MM-YYYY'
    }, function (start, end, label) {
        $('#exportday').change();
    });

    GetTotalSession(eid, 1);
});

function SetCustomerDiscount(value) {
    $.post("?mod=customer&site=ajax_load_group_discount", {'id': value}).done(function (data) {
        var data = JSON.parse(data);
        $("input[name=discount]").val(data.discount).change();
        $("select[name=discount_type]").html(data.select_discount_type).change();
    });
}

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
    $.post("?mod=customer&site=ajax_insert_item", data).done(function (rt) {
        var rt = JSON.parse(rt);
        $('#UpdateFrom').modal('hide');
        $(".select2_single").select2({placeholder: "Select a state", allowClear: true});
        $("select[name=customer_id]").html(rt.categories).change();
    });
}


function LoadDataForForm(id) {
    $("#UpdateFrom input[type=text]").val('');
    $.post("?mod=customer&site=ajax_load_item", {'id': id}).done(function (data) {
        var data = JSON.parse(data);
        $("#UpdateFrom input[name=code]").val(data.code);
        $("#UpdateFrom select[name=group_id]").html(data.select_groups);
    });
}


function GetAllPayment() {
    var must_pay = $("input[name=m_total_must_pay]").val();
    $("input[name=payment]").val(must_pay);
    $('input[name=payment]').change();
}

function SetcPrint() {
    $("#PrintContent").attr("src", cprint);
    return false;
}

function SetafPrint() {
    $("#PrintContent").attr("src", afprint);
    return false;
}

function GetOrderDetail(eid) {
    //console.log(data);
    $("#orderDetail .modal-body").load("?mod=exportAjax&site=ajax_get_export_session_detail", {'eid': eid});
}

$(function () {
  $('[data-toggle="popover"]').popover();
});


</script>
{/literal}

