<div class="">
<div id="test">

</div>
    <div class="" id="AllId">
        <div class="col-md-5 title_left">
            <h3>Thêm phiếu trả</h3>
        </div>
        <div class="col-md-7 text-right">
            <form action="" method="post">
                <button type="button" class="btn btn-primary" onclick="Refresh();"><i class="fa fa-refresh"></i> Làm mới</button>
                <button type="button" class="btn btn-success" onclick="SetPrint();"><i class="fa fa-print"></i> In PT</button>
            </form>
        </div>
    </div>
	<div class="row">
		<div class="col-md-9 col-xs-12">
			<div class="x_panel">
        <div class="x_title">
            <h2>Chi tiết phiếu trả</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <div class="h_content">
                <button id="add_product_btn" type="button" class="btn btn-primary" data-toggle="modal" data-target="#GetProduct" onclick="LoadProduct();"><i class="fa fa-pencil"></i> Thêm sản phẩm</button>
                <div class="clearfix"></div>
            </div>

            <div id="" class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="Products">
                    <thead>
                        <tr>
                            <th>Hóa đơn</th>
                            <th>Sản phẩm</th>
                            <th class="text-right">Giá bán</th>
                            <th class="text-center">SL</th>
                            <th>Đơn vị</th>
                            <th class="text-right">Thành tiền</th>
                            <th>Tình trạng</th>
                            <th>Mô tả tình trạng</th>
                            <th class="text-center" width="60"></th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach from=$products item=list}
                        <tr id="proNo{$list.id}">
                            <td>{$list.export_code}</td>
                            <td>[{$list.code}] {$list.name}</td>
                            <td class="text-right">{$list.price|number_format}</td>
                            <td class="text-center"><input class="prod-number" type="number" name="number" id="number" value="{$list.number}" min="1" max="{$list.max_number}" oninput="UpdateNumber({$list.id}, this.value, {$list.max_number});"></td>
                            <td>{$list.unit}</td>
                            <td class="text-right" id="proTotal{$list.id}">{($list.price*$list.number)|number_format} đ</td>
                            <td><select class="situation" name="situation" onchange="UpdateSituation({$list.id}, this.value);">{$list.select_situation}</select></td>
                            <td><input class="situa_des" name="situa_des" oninput="UpdateSituaDes({$list.id}, this.value);" value="{$list.situa_des}"></td>
                            <td class="text-center"><button class="btn btn-danger" onclick="RemoveProduct({$list.id}, 'delete')"><i class="fa fa-times-circle"></i></button></td>
                        </tr>
                        {/foreach}
                    </tbody>
                </table>
            </div>

        </div>
    </div>

	</div>
		
	    <div class="row" id="header">
	        <div class="col-md-3 col-xs-12">
	            <div class="x_panel"style="min-height: 340px;" >
	               			<div class="tabbable">
								<ul class="nav nav-tabs">
									<li class="active"><a href="#tab1" data-toggle="tab">Cơ bản</a></li>
									<li><a href="#tab2" data-toggle="tab">Thông tin</a></li>
									<li><a href="#tab3" data-toggle="tab">Chiết khấu</a></li>
								</ul>
							</div>
					<div class="tab-content">
						<div class="tab-pane active" id="tab1">
							<br>
		                    <form class="form-horizontal form-label-left input_mask">
		                        <div class="form-group">
		                            <label class="control-label col-md-3 col-sm-3 col-xs-12">NV lập</label>
		                            <div class="col-md-9 col-sm-9 col-xs-12">
		                                <input type="text" class="form-control" readonly="readonly" value="{$value.creator}">
		                            </div>
		                        </div>
		                        <div class="form-group">
		                                <label class="control-label col-md-4 col-sm-4 col-xs-12">Khách hàng</label> 
		                        </div>
		                        <div class="form-group">
		                                <div class="col-md-12 col-sm-12 col-xs-12">
		                                    <select class="select2_single form-control" name="customer_id" tabindex="-1" onchange="SetRevertValue('customer_id', this.value);">{$out.customers}</select>
		                                </div>
		                            </div>
		                    </form>
	            		</div>
						<div class="tab-pane" id="tab2">
		                    <br />
		                    <form class="form-horizontal form-label-left">
		
		                        <div class="form-group">
		                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Mã phiếu</label>
		                            <div class="col-md-8 col-sm-8 col-xs-12">
		                                <input type="text" name="country" id="code" class="form-control" readonly  value="{$value.code}"/>
		                            </div>
		                        </div>
		                        <div class="form-group">
		                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Ngày lập</label>
		                            <div class="col-md-8 col-sm-8 col-xs-12">
		                                <input class="date-picker form-control"  onchange="SetRevertValue('date', this.value);"
		                                    required="required" type="text" id="exportday" value="{$value.date}">
		                            </div>
		                        </div>
		
		                        <div class="form-group">
		                            <div class="col-md-12 col-sm-12 col-xs-12">
		                                <textarea class="form-control" rows="3" style="resize: vertical;" placeholder='Mô tả phiếu trả...' onchange="SetExportValue('description', this.value);">{$value.description}</textarea>
		                            </div>
		                        </div>
		                    </form>
	               		 </div>
	
						<div class="tab-pane" id="tab3">
							<br>
		                    <form class="form-horizontal form-label-left">
		
		                        <div class="form-group">
		                            <label class="control-label col-md-6 col-sm-6 col-xs-12">Tổng tiền</label>
		                            <div class="col-md-6 col-sm-6 col-xs-12">
		                                <input type="text" class="form-control text-right" name="m_total" readonly/>
		                            </div>
		                        </div>
		                        <div class="form-group">
		                            <div class="col-md-6 col-sm-12 col-xs-12">
		                                <select class="form-control" onchange="SetRevertValue('discount_type', this.value);">{$out.discount}</select>
		                            </div>
		                            <div class="col-md-6 col-sm-12 col-xs-12">
		                                <input type="text" class="form-control text-right" onchange="SetRevertValue('discount', this.value);" value="{$value.discount}"/>
		                            </div>
		                        </div>
		                        <div class="form-group">
		                            <label class="control-label col-md-6 col-sm-6 col-xs-12">Tiền phải trả khách</label>
		                            <div class="col-md-6 col-sm-6 col-xs-12">
		                                <input type="text" class="form-control text-right" name="m_total_must_pay" readonly/>
		                            </div>
		                        </div>
		                    </form>
	                	</div>
	                	<hr>
	                	<form action="" method="post">
	                	    <center><button type="submit" class="btn btn-lg btn-success" name="submit"><i class="fa fa-check-square-o"></i> Lưu Phiếu Trả</button></center>
						</form>
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
                <h4 class="modal-title">Nhập sản phẩm vào phiếu trả</h4>
            </div>
            <div class="modal-body">
                <div class="form-horizontal form-label-left">
                   {if $value.customer_id neq 0 } 
                   <div class="form-group">
                        <div class="col-md-6 col-sm-6">
                            <select class="form-control" name="FilterCate" onchange="LoadProduct();">{$out.categories}</select>
                        </div>
                        {if $arg.setting.use_trademark  eq 1} 
                        <div class="col-md-6 col-sm-6">
                            <select class="form-control" name="FilterTrademark" onchange="LoadProduct();">{$out.trademarks}</select>
                        </div>
                        {/if}
                    </div>
                     
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6">
                            <label class="control-label col-sm-3">Mã HD</label>
                            <div class="col-sm-9" style="padding: 0;">
                                <input id="export_code_search" class="form-control" type="text" name="export_code" value="" onkeyup="LoadProduct();">
                            </div>
                        </div>
                        {if $arg.setting.use_origin  eq 1}
                        <div class="col-md-6 col-sm-6">
                            <select class="form-control" name="FilterOrigin" onchange="LoadProduct();">{$out.origins}</select>
                        </div>
                        {/if}
                    </div>
                    {else}
                   <div class="col-md-12 col-sm-12">
                        <label class="control-label col-sm-3">Nhập mã hóa đơn</label>
                        <div class="col-sm-9" style="padding: 0;">
                            <input id="export_code_search1" class="form-control" type="text" name="export_code1"  onchange="LoadProduct_export();">
                        </div>
                   </div>
                  
                   {/if}
                    <br>
                    <br>
                </div>
                   <div class="">
                       <table class="table table-striped table-hover projects" id="ProductList"></table>
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
<div class="modal fade" id="Print">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body modal-print">
                <iframe src="#" style="zoom: 0.60" width="99.6%" height="450" id="PrintContent"></iframe>
            </div>
        </div>
    </div>
</div>


<script src="{$arg.stylesheet}js/wh.revert.js"></script>
{literal}
<script>
$(document).ready(function() {
    $('#exportday').daterangepicker({
      singleDatePicker: true,
      calender_style: "picker_4",
      format: 'DD-MM-YYYY'
    }, function(start, end, label) {
        $('#exportday').change();
    });

    $('.expiry').daterangepicker({ singleDatePicker: true, calender_style: "picker_4", format: 'DD-MM-YYYY'}, function(){
        $('.expiry').change();
    });

    
    GetTotalSession();
});

$("#export_code_search").keydown(function(){
    var prefix=$(this).val();
    var export_code=this;
    setTimeout(function () {
        if(export_code.value.indexOf('HD') !== 0){
            $(export_code).val(prefix);
        }
    }, 1);
});
//$("#export_code_search1").keydown(function(){
//    var prefix=$(this).val();
//    var export_code=this;
//    setTimeout(function () {
//        if(export_code.value.indexOf('HD') !== 0){
//            $(export_code).val(prefix);
//        }
//    }, 1);
//});

function SetPrint() {
    var code = $("#code").val();
    var value = "&code=" + code ;
    $("#PrintContent").attr("src","?mod=revert&site=cprint"+value);
    return false;
}
</script>
{/literal}

