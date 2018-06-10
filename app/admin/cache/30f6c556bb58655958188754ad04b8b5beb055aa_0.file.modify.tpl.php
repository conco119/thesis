<?php
/* Smarty version 3.1.30, created on 2018-06-10 21:46:33
  from "C:\xampp\htdocs\~mtd\htaccess\app\admin\view\exportedit\modify.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b1d39c9268670_45251211',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '30f6c556bb58655958188754ad04b8b5beb055aa' => 
    array (
      0 => 'C:\\xampp\\htdocs\\~mtd\\htaccess\\app\\admin\\view\\exportedit\\modify.tpl',
      1 => 1528469385,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b1d39c9268670_45251211 (Smarty_Internal_Template $_smarty_tpl) {
?>

<div class="">

	<div class="" id="AllId">
		<div class="col-md-6 col-xs-12">
			<h2>Chỉnh sửa hóa đơn bán hàng</h2>
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
						<div class="form-group form-inline">
							<input class="left form-control" id="UseBarcode" placeholder="Mã vạch" >
						</div>

						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#GetProduct" onclick="LoadProduct();"><i class="fa fa-pencil"></i> Chọn sản phẩm</button>
						<button type="button" class="btn btn-success" data-toggle="modal" onclick="LoadService();" data-target="#Services"><i class="fa fa-check-square-o"></i> Chọn dịch vụ</button>

						<div class="clearfix"></div>
					</div>


					<div id="">
						<table class="table table-striped table-bordered" id="Products">
							<thead>
								<tr>
									<th>Mã</th>
									<th>Sản phẩm</th>
									<th class="text-right">Giá bán</th>
									<th class="text-center">Đơn vị</th>
									<th class="text-center">Số lượng</th>
									<th class="text-right">Thành tiền</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['products']->value, 'list');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['list']->value) {
?>
								<tr id="proNo<?php echo $_smarty_tpl->tpl_vars['list']->value['product_id'];?>
">
									<td><?php echo $_smarty_tpl->tpl_vars['list']->value['code'];?>
</td>
									<td><?php echo $_smarty_tpl->tpl_vars['list']->value['name'];?>
</td>
									<td class="text-right"><input type="text" class="prod-price" value="<?php echo number_format(($_smarty_tpl->tpl_vars['list']->value['price']));?>
"></td>
									<td class="text-center"><?php echo $_smarty_tpl->tpl_vars['list']->value['unit_name'];?>
</td>
									<td class="text-center"><input type="number" class="prod-number" id="proNumber<?php echo $_smarty_tpl->tpl_vars['list']->value['product_id'];?>
" onchange="UpdateNumberProduct(<?php echo $_smarty_tpl->tpl_vars['list']->value['product_id'];?>
, this.value, <?php echo $_smarty_tpl->tpl_vars['list']->value['max_number'];?>
);" value="<?php echo $_smarty_tpl->tpl_vars['list']->value['number_count'];?>
"></td>
									<td class="text-right" id="proTotal<?php echo $_smarty_tpl->tpl_vars['list']->value['product_id'];?>
">
									<?php echo number_format(($_smarty_tpl->tpl_vars['list']->value['price']*$_smarty_tpl->tpl_vars['list']->value['number_count']));?>
 đ</td>
									<td class="text-right"><button class="btn btn-danger" onclick="DeleteProductBill(<?php echo $_smarty_tpl->tpl_vars['list']->value['product_id'];?>
)"><i class="fa fa-times-circle"></i></button></td>
								</tr>
								<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

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
									<th class="text-right" width="180">Thành tiền</th>
									<th class="text-right" width="80"></th>
								</tr>
							</thead>
							<tbody>
								<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['services']->value, 'list');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['list']->value) {
?>
								<tr id="serNo<?php echo $_smarty_tpl->tpl_vars['list']->value['service_id'];?>
">
									<td>#</td>
									<td><?php echo $_smarty_tpl->tpl_vars['list']->value['name'];?>
</td>
									<td class="text-right"><input type="text" class="prod-price" disabled value="<?php echo number_format($_smarty_tpl->tpl_vars['list']->value['price']);?>
"></td>
									<td class="text-center"><input type="number" class="prod-number" id="serNumber<?php echo $_smarty_tpl->tpl_vars['list']->value['service_id'];?>
" onchange="ServiceUpdateNumber(<?php echo $_smarty_tpl->tpl_vars['list']->value['service_id'];?>
, this.value);" value="<?php echo $_smarty_tpl->tpl_vars['list']->value['number_count'];?>
">
									<td class="text-right" id="serTotal<?php echo $_smarty_tpl->tpl_vars['list']->value['service_id'];?>
"><?php echo number_format(($_smarty_tpl->tpl_vars['list']->value['price']*$_smarty_tpl->tpl_vars['list']->value['number_count']));?>
 đ</td>
									<td class="text-right"><button type="button" class="btn btn-danger" onclick="DeleteServiceBill(<?php echo $_smarty_tpl->tpl_vars['list']->value['service_id'];?>
);"><i class="fa fa-times-circle"></i></button></td>
								</tr>
								<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

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
                            <li class="active"><a href="#tab1" data-toggle="tab">Cơ bản</a></li>
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
        							<label class="control-label col-md-3 col-sm-3 col-xs-12">HD</label>
        							<div class="col-md-9 col-sm-9 col-xs-12">
        								<input type="text" name="country" class="form-control col-md-10" readonly  value="<?php echo $_smarty_tpl->tpl_vars['export']->value['code'];?>
"/>
        							</div>
        						</div>
        						<div class="form-group">
        							<label class="control-label col-md-3 col-sm-3 col-xs-12">Ngày</label>
        							<div class="col-md-9 col-sm-9 col-xs-12">
        								<input class="date-picker form-control col-md-7 col-xs-12"  onchange="SetExportValue('date', this.value);"
        									required="required" type="text" id="exportday" value="<?php echo $_smarty_tpl->tpl_vars['export']->value['date'];?>
">
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
        								<select name="customer_id" class="select2_single form-control" tabindex="-1" onchange="SetExportValue('customer_id', this.value);"><?php echo $_smarty_tpl->tpl_vars['out']->value['customers'];?>
</select>
        							</div>
        						</div>
        						</div>
                            <div class="tab-pane" id="tab2">

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Chiết khấu</label>
                                    <div class="col-md-9 col-sm-12 col-xs-12">
                                        <select name="discount_type" class="form-control" onchange="SetExportValue('discount_type', this.value);"><?php echo $_smarty_tpl->tpl_vars['out']->value['discount'];?>
</select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Giá trị</label>
                                    <div class="col-md-9 col-sm-12 col-xs-12">
                                        <input type="text" name="discount" class="form-control text-right" onchange="SetExportValue('discount', this.value);" value="<?php echo $_smarty_tpl->tpl_vars['export']->value['discount'];?>
"/>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab3">
    						<div class="form-group">
    							<div class="col-md-12 col-sm-12 col-xs-12">
    								<textarea class="form-control" rows="3" placeholder='mô tả thêm...' onchange="SetExportValue('description', this.value);"><?php echo $_smarty_tpl->tpl_vars['export']->value['description'];?>
</textarea>
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
							<label class="control-label col-md-5 col-sm-6 col-xs-12">Tiền phải thanh toán</label>
							<div class="col-md-7 col-sm-6 col-xs-12">
								<input type="text" class="form-control text-right" name="m_total_must_pay" readonly/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-5 col-sm-6 col-xs-12">Tiền thanh toán</label>
							<div class="col-md-7 col-sm-6 col-xs-12">
								<input type="text" name="payment" class="form-control text-right" onchange="SetExportValue('payment', this.value);" value="<?php echo number_format($_smarty_tpl->tpl_vars['export']->value['payment']);?>
"/>
								<button type="button" id="GetAllPay" onclick="GetAllPayment();" title="Trả toàn bộ"><i class="fa fa-calculator"></i></button>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-5 col-sm-6 col-xs-12">Khách nợ</label>
							<div class="col-md-7 col-sm-6 col-xs-12">
								<input type="text" class="form-control text-right" name="debt" readonly/>
							</div>
						</div>
					</form>
                    <hr>
                    <form action="" method="post" class="text-center">
                    	<button type="submit" class="btn btn-lg btn-success" name="submit" ><i class="fa fa-check-square-o"></i> Lưu hóa đơn</button>
					</form>
				</div>
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
						<input type="text" id="FilterKey" class="form-control" oninput="LoadProduct(<?php echo $_smarty_tpl->tpl_vars['out']->value['mid'];?>
);">
					</div>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<select class="form-control" id="FilterCate" onchange="LoadProduct(<?php echo $_smarty_tpl->tpl_vars['out']->value['mid'];?>
);"><?php echo $_smarty_tpl->tpl_vars['out']->value['categories'];?>
</select>
					</div>
					 <div class="col-md-6 col-sm-6 col-xs-12">
						<select class="form-control" id="FilterTrademark" onchange="LoadProduct(<?php echo $_smarty_tpl->tpl_vars['out']->value['mid'];?>
);"><?php echo $_smarty_tpl->tpl_vars['out']->value['trademarks'];?>
</select>
					</div>
				</div>
				<div style="max-height: 400px; overflow-y: auto"><table class="table table-striped projects" id="ProductList"></table></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
					data-dismiss="modal">Close</a>
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
					<button type="button" data-toggle="modal" class="btn btn-default" onclick="SetPrint();" data-dismiss="modal"><i class="icon-print"></i> In</button>
					<button type="submit" class="btn btn-default" name="submit"><i class="icon-save"></i> Lưu </button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</form>
			</div>
		</div>
	</div>
</div>


<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/wh.export_edit.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
>
$(document).ready(function() {
    $('#exportday').daterangepicker({
      singleDatePicker: true,
      calender_style: "picker_4",
      format: 'DD-MM-YYYY'
    }, function(start, end, label) {
        $('#exportday').change();
    });

    GetTotalSession(1);
});

function GetAllPayment(){
	var must_pay = $("input[name=m_total_must_pay]").val();
	$("input[name=payment]").val(must_pay);
	$('input[name=payment]').change();
}

// function GetOrderDetail(mid){
//   //console.log(data);
//   $("#orderDetail .modal-body").load("?mod=exportAjax&site=ajax_get_export_session_detail", {'mid':mid});
// }





// function AddNewCustomer() {
//     var data = {};
//     data['code'] = $("#UpdateFrom input[name=code]").val();
//     data['group_id'] = $("#UpdateFrom select[name=group_id]").val();
//     data['name'] = $("#UpdateFrom input[name=name]").val();
//     data['phone'] = $("#UpdateFrom input[name=phone]").val();
//     data['address'] = $("#UpdateFrom input[name=address]").val();
//   if(data['name'] == "")
//       {
//         $('#name_eror').html("Tên không được bỏ trống!");
//         return false;

//       }
//     $.post("?mod=customer&site=ajax_insert_item", data).done(function (rt) {
//         var rt = JSON.parse(rt);
//         $('#UpdateFrom').modal('hide');
//         $(".select2_single").select2({placeholder: "Select a state", allowClear: true});
//         $("select[name=customer_id]").html(rt.categories).change();
//     });
// }


// function LoadDataForForm(id) {
//     $("#UpdateFrom input[type=text]").val('');
//     $.post("?mod=customer&site=ajax_load_item", {'id': id}).done(function (data) {
//         var data = JSON.parse(data);
//         $("#UpdateFrom input[name=code]").val(data.code);
//         $("#UpdateFrom select[name=group_id]").html(data.select_groups);
//     });
// }

<?php echo '</script'; ?>
>


<?php }
}
