<div class="">

    <div class="" id="AllId">
    	<div class="col-md-6 col-xs-12">
            <div id="btn_export_active">
                <ul>
                    <li class='active'><a href="{$arg.this_link}">{$value.code}</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-6 col-xs-12">
            <form class="text-right" action="" method="post">
                <button type="button" class="btn btn-primary" onclick="Refresh();"><i class="fa fa-refresh"></i> Làm mới</button>
            </form>
        </div>
    </div>

    <div class="row">
    	<div class="col-md-9 col-xs-12">
		    <div class="x_panel">
		        <div class="x_title">
		        	<a href="./admin?mc=import&site=statistics" style="margin-right: 20px;" class="btn btn-default pull-left"><i class="fa fa-arrow-left"></i>&ensp;Danh sách hóa đơn nhập</a>
		            <h2>Chi tiết hóa đơn nhập hàng</h2>
		            <ul class="nav navbar-right panel_toolbox">
		                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
		                {* <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i></a>
		                    <ul class="dropdown-menu">
		                        <li><a href="#">Thêm sản phẩm bằng tay</a></li>
		                        <li><a href="#">Thêm sản phẩm mã vạch</a></li>
		                        <li><a href="#">Thêm dịch vụ</a></li>
		                    </ul>
		                </li> *}
		            </ul>
		            <div class="clearfix"></div>
		        </div>
		        <div class="x_content">

		            <div class="h_content">
		                {* <div class="form-group form-inline">
		                    <input class="left form-control" autofocus id="UseBarcode" placeholder="Mã vạch" onchange="GetProductFromBarcode(this.value);">
		                </div> *}

		                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#GetProduct" onclick="LoadProduct();"><i class="fa fa-pencil"></i> Chọn sản phẩm</button>
		                <div class="clearfix"></div>
		            </div>


		            <div id="">
		                <table class="table table-striped table-bordered" id="Products">
		                    <thead>
		                        <tr>
		                            <th>Mã</th>
		                            <th>Sản phẩm</th>
                                    <th class="text-right">Giá nhập</th>
                                    <th class="text-center">Đơn vị</th>
		                            <th class="text-center">Số lượng</th>
		                            <th class="text-right">Thành tiền</th>
		                            <th class="td-actions"></th>
		                        </tr>
		                    </thead>
		                    <tbody>
		                        {foreach from=$products item=list}
		                            <tr id="proNo{$list.id}">
		                                <td>{$list.code}</td>
		                                <td>{$list.name}</td>
		                                <td class="text-right"><input type="text" class="prod-price" id="proPrice{$list.id}" onchange="UpdateProductPrice({$list.id}, this.value);" value="{$list.price_import|number_format}"></td>
                                        <td class="text-center">{$list.unit_name}</td>
		                                <td class="text-center"><input type="number" class="prod-number" id="proNumber{$list.id}" onchange="UpdateNumberProduct({$list.id}, 'update', this.value);" value="{$list.number}"></td>

		                                <td class="text-right" id="proTotal{$list.id}">{($list.price_import*$list.number)|number_format} đ</td>
		                                <td class="text-right"><button class="btn btn-danger" onclick="UpdateNumberProduct({$list.id}, 'delete')"><i class="fa fa-times-circle"></i></button></td>
		                            </tr>
		                        {/foreach}
		                    </tbody>
		                </table>
		            </div>

		        </div>
		    </div>
    	</div>

        <div class="col-md-3 col-xs-12">
            <div class="x_panel">
                <div class="">
                     <div class="tabbable">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab">Cơ bản</a></li>
                            <li><a href="#tab_2" data-toggle="tab">Chiết khấu</a></li>
                            <li><a href="#tab_3" data-toggle="tab">Mô tả</a></li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                    <form class="form-horizontal form-label-left input_mask">
                        <div class="tab-content">
                          <div class="tab-pane active" id="tab_1">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Ngày</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input class="date-picker form-control col-md-7 col-xs-12"  onchange="SetExportValue('date', this.value);"
                                               required="required" type="text" id="exportday" value="{$value.date}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Nhân viên</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input disabled type="text" class="form-control "  value="{$arg.user.name}"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                        {* <button type="button" class="btn btn-primary" onclick="LoadDataForForm(0);" data-toggle="modal" data-target="#UpdateFrom">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </button> *}
                                        Nhà cung cấp
                                        {* <label class="control-label"></label> *}
                                    </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select name="suppliers_id" class="select2_single form-control" tabindex="-1" onchange="SetExportValue('supplier_id', this.value);">
                                            <option value=0>Chọn nhà cung cấp</option>
                                            {$out.suppliers}
                                        </select>
                                    </div>
                                </div>
                        </div>
                        <div class="tab-pane" id="tab_3">
                            <div class="form-group">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <textarea class="form-control" rows="5" placeholder='Mô tả hóa đơn...' onchange="SetExportValue('description', this.value);">{$value.description}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_2">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Loại</label>
                            <div class="col-md-9 col-sm-12 col-xs-12">
                                <select class="form-control" onchange="SetExportValue('discount_type', this.value);">{$out.discount}</select>
                            </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                <div class="col-md-9 col-sm-12 col-xs-12">
                                    <input type="text" class="form-control text-right" onchange="SetExportValue('discount', this.value);" value="{$value.discount}"/>
                                </div>
                            </div>
                        </div>
                      </div>
                    </form>
                </div>
            </div>

            <div class="x_panel">
                <div class="x_content">
                    <form class="form-horizontal form-label-left">
                        <div class="form-group">
                            <label class="control-label col-md-5 col-sm-6 col-xs-12">Tổng tiền</label>
                            <div class="col-md-7 col-sm-6 col-xs-12">
                                <input type="text" class="form-control text-right" name="m_total" readonly/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-5 col-sm-6 col-xs-12">Phải trả</label>
                            <div class="col-md-7 col-sm-6 col-xs-12">
                                <input type="text" class="form-control text-right" name="m_total_must_pay" readonly/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-5 col-sm-6 col-xs-12">Đã trả</label>
                            <div class="col-md-7 col-sm-6 col-xs-12">
                                <input type="text" name="payment" class="form-control text-right" onchange="SetExportValue('payment', this.value);" value="{$value.payment|number_format}"/>
                                <button type="button" id="GetAllPay" onclick="GetAllPayment();" title="Trả toàn bộ"><i class="fa fa-calculator"></i></button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-5 col-sm-6 col-xs-12">Ghi nợ/Dư</label>
                            <div class="col-md-7 col-sm-6 col-xs-12">
                                <input type="text" class="form-control text-right" name="debt" readonly/>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <form class="text-center" action="" method="post">
                        <button type="submit" class="btn btn btn-success" name="submit"><i class="fa fa-check-square-o"></i> Lưu hóa đơn</button>
                        <button type="submit" class="btn btn-success" name="submit_print"><i class="fa fa-save"></i> Lưu và In</button>
                    </form>
                </div>
            </div>

        </div>

    </div>

</div>


<div class="modal fade" tabindex="-1" id="UpdateFrom">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 class="modal-title" id="title"> Thêm nhà cung cấp mới </h4>
            </div>
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <input type="hidden" name="id">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Mã</label>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <input class="form-control" type="text" name="code">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Tên NCC</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="text" name="name" required class="form-control" placeholder="Tên NCC...">
                        </div>
                        <div id="name_eror" class="text-center" style="color: red; margin-bottom: 10px;"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Người liên hệ</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="text" name="manager" class="form-control"
                                   placeholder="Người liên hệ...">
                        </div>
                        <div id="manager_eror" class="text-center" style="color: red; margin-bottom: 10px;"></div>
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
                    <button type="button" class="btn btn-primary" onclick="AddSupplier();">Lưu lại</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Bỏ qua</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- GetProduct -->
<div class="modal fade" id="GetProduct">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
				<h4 class="modal-title">Nhập sản phẩm vào hóa đơn</h4>
			</div>
			<div class="modal-body">
				<div class="row form-group" id="prodFillter">
					<div class="col-md-6 col-sm-6 col-xs-12">
						<input type="text" name="FilterKey" class="form-control" oninput="LoadProduct();" placeholder="Mã / Tên sản phẩm">
					</div>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<select class="form-control" name="FilterCate" onchange="LoadProduct();">
                            <option value=0> Danh mục sản phẩm </option>
                            {$out.categories}
                        </select>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<select class="form-control" name="FilterTrademark" onchange="LoadProduct();">
                            <option value=0> Thương hiệu </option>
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


<!-- Update export price -->
<div class="modal fade" id="UpdateExportPrice">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body form-horizontal">
                <h3 id="uxp_name">PID08 ami 6 cuon</h3>
                <p>Sản phẩm đã thay đổi giá nhập, bạn có muốn nhập lại giá bán của nó không ?</p>
                <div class="form-group">
                    <label class="control-label col-md-6 col-sm-6 col-xs-12">Giá nhập hàng</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input class="form-control text-right" type="text" name="price_import" readonly="readonly">
                        <input class="form-control" type="hidden" name="id">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-6 col-sm-6 col-xs-12">Giá bán</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input class="form-control text-right" type="text" name="price" oninput="SetMoney(this);">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" onclick="SaveExportPrice();">Lưu lại</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Bỏ qua</button>
            </div>
        </div>
    </div>
</div>

<script src="{$arg.stylesheet}js/wh.import.js"></script>
<script type="text/javascript">
    var print_id = '{if isset($smarty.session.import_id) and $smarty.session.import_id neq ''}{$smarty.session.import_id}{/if}';
    console.log(print_id);
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
    GetTotalSession(1);
});

function GetAllPayment() {
    var must_pay = $("input[name=m_total_must_pay]").val();
    $("input[name=payment]").val(must_pay);
    $('input[name=payment]').change();
}

function print()
{	if(!print_id)
		return
	var link = './admin?mc=import&site=import_print&id=' + print_id;
	$("#PrintContent").attr("src", link);
	console.log(link);
}

function SetPrint() {
    $("#PrintContent").attr("src", cprint);
    return false;
}
$(function () {
  $('[data-toggle="popover"]').popover();
});


function LoadDataForForm(id) {
    $("#UpdateFrom input[type=text]").val('');
    $("#UpdateFrom input[type=number]").val('');
    $.post("?mod=supplier&site=ajax_load_item", {'id': id}).done(function (data) {
        var data = JSON.parse(data);
        $("#UpdateFrom input[name=code]").val(data.code);
    });
}

function AddSupplier() {
    var data = {};
    data['code'] = $("#UpdateFrom input[name=code]").val();
    data['name'] = $("#UpdateFrom input[name=name]").val();
    data['manager'] = $("#UpdateFrom input[name=manager]").val();
    data['phone'] = $("#UpdateFrom input[name=phone]").val();
    data['address'] = $("#UpdateFrom input[name=address]").val();
    if(data['name'] == "")
    {
        $('#name_eror').html("Tên không được bỏ trống!");
        return false;

    }
    if(data['manager'] == "")
    {
        $('#manager_eror').html("Người liên hệ không được bỏ trống!");
        return false;

    }
    $.post("?mod=supplier&site=ajax_insert_item", data).done(function (rt) {
        var rt = JSON.parse(rt);
        $('#UpdateFrom').modal('hide');
        $(".select2_single").select2({placeholder: "Select a state", allowClear: true});
        $("select[name=suppliers_id]").html(rt.categories).change();
    });
}


</script>
{/literal}

