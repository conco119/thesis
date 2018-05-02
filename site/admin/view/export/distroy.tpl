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
		        	<a href="?mod=export&site=distroy_list" style="margin-right: 20px;" class="btn btn-default pull-left"><i class="fa fa-arrow-left"></i>&ensp;Hóa đơn lưu trữ</a>
					<h2>Chi tiết sản phẩm hủy bỏ</h2>
					<ul class="nav navbar-right panel_toolbox">
						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">

					<div class="h_content">
						<div class="form-group form-inline">
							<input class="left form-control" id="UseBarcode" placeholder="Mã vạch" onchange="GetProductFromBarcode({$out.eid}, this.value);">
						</div>

						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#GetProduct" onclick="LoadProduct({$out.eid});">
							<i class="fa fa-pencil"></i> Chọn sản phẩm
						</button>
						<div class="clearfix"></div>
					</div>


					<div id="">
						<table class="table table-striped table-bordered" id="Products">
							<thead>
								<tr>
									<th>Mã</th>
									<th>Sản phẩm</th>
									<th class="text-center">SL</th> 
									<th>Đơn vị</th> 
									<th class="text-center" width="120">Mô tả</th>
									<th class="td-actions" width="60"></th>
								</tr>
							</thead>
							<tbody>
								{foreach from=$value.products item=list}
								<tr id="proNo{$list.id}">
									<td>{$list.code}</td>
									<td>{$list.name}</td>
									<td class="text-center">
										<input type="number" class="prod-number" id="proNumber{$list.id}" onchange="UpdateNumberProduct({$out.eid}, {$list.id}, this.value, {$list.max_number});" value="{$list.number}">
									</td> 
									<td>{$list.select_units}</td>
									<td class="text-center edit_desciption">
										<button type="button" id="test" class="btn btn-lg btn-info" data-html="true" 
										data-toggle="popover" data-placement="left" onclick="SetValueDescripton({$out.eid}, {$list.id});"
										data-content="<input type='text' class='form-control' id='proDescription{$list.id}' onchange='UpdateDescriptionProduct({$out.eid}, {$list.id}, this.value);' value='{$list.description}'>">
										<i class="fa fa-pencil"></i>
										</button>
									</td>
									<td class="text-right">
										<button class="btn btn-danger" onclick="RemoveProduct({$out.eid}, {$list.id})">
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
									<li class="active"><a href="#tab1" data-toggle="tab">Thông tin phiếu</a></li>
								</ul>
							</div>
						</div>
						<div class="x_content">
							<br>
							<form class="form-horizontal form-label-left input_mask">
								<div class="tab-content">
									<div class="tab-pane active" id="tab1">
										<div class="form-group">
											<label class="control-label col-md-4 col-sm-4 col-xs-6">Ngày lập</label>
											<div class="col-md-8 col-sm-8 col-xs-6">
												<input class="date-picker form-control"
													onchange="SetExportValue({$out.eid}, 'date', this.value);"
													required="required" type="text" id="exportday"
													value="{$value.date}">
											</div>
										</div>
										<br>
										<div class="form-group">
											<div class="col-md-12 col-sm-12 col-xs-12">
												<textarea class="form-control" rows="5" placeholder='Mô tả thêm...'></textarea>
											</div>
										</div>
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
                <div style="max-height: 400px; overflow-y: auto"><table class="table table-striped" id="ProductList"></table></div>
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


<!-- Order Detail -->
<div class="modal fade" id="orderDetail">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body form-horizontal"></div>
            <div class="modal-footer">
                <form action="" method="post">
                    <!-- <button type="button" data-toggle="modal" class="btn btn-info" onclick="SetcPrint();" data-dismiss="modal"><i class="fa fa-print"></i> In</button> -->
                    <button type="submit" class="btn btn-success" name="submit"><i class="fa fa-save"></i> Lưu lại</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Bỏ qua</button>
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


<script src="{$arg.stylesheet}js/wh.distroy.js"></script>
<script type="text/javascript">
var cprint = '{$out.cprint}';
var exprint = '{$out.exprint}';
</script>
{literal}
<script>


$(document).ready(function () {
	GetTotalSession(eid);
    $('#exportday').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_4",
        format: 'DD-MM-YYYY'
    }, function (start, end, label) {
        $('#exportday').change();
    });

});

function SetcPrint() {
    $("#PrintContent").attr("src", cprint);
    return false;
}

function GetOrderDetail(eid) {
    $("#orderDetail .modal-body").load("?mod=exDistroyAjax&site=ajax_get_export_session_detail", {'eid': eid});
}

$(function () {
  $('[data-toggle="popover"]').popover();
});


</script>
{/literal}

