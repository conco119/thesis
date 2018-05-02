<div class="">
    <div class="row">
        <div class="col-xs-12">
            <div class="x_panel">
                <div class="x_title">
		            <h2>Quản lý sản phẩm</h2>
		            <ul class="nav navbar-right panel_toolbox">
		                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
		                <li><a class="close-link"><i class="fa fa-close"></i></a></li>
		            </ul>
		            <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="h_content">
                        <div class="form-group form-inline">
                            <input type="search" class="left form-control" id="key" placeholder="Mã / tên sản phẩm" value="{$out.key}">
                            <select class="left form-control" id="category"><option value="">Danh mục</option>{$out.categories}</select>
                        </div>
                        <button id="search_btn" type="button" class="btn btn-primary left" onclick="filter();"><i class="fa fa-search"></i></button>

                        <a href="?mod=product&site=import" class="btn btn-primary"><i class="fa fa-file-excel-o"></i> Nhập từ file</a>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#UpdateForm" onclick="LoadDataForForm(0);"><i class="fa fa-pencil"></i> Thêm mới</button>
                        <button type="button" class="btn btn-success" onclick="HandleCopy();"><i class="fa fa-copy"></i> Sao chép</button>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#DeleteFormAll"  onclick="LoadDeleteItemAll('products');"><i class="fa fa-times-circle"></i> Xóa</button>
                        <div class="clearfix"></div>
                    </div>
                    <!-- start project list -->
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center"><input type="checkbox" id="SelectAllRows"></th>
                                    <th>Tên Sản phẩm</th>
                                    <th>thuộc danh mục</th>
									<th class="text-right">Giá</th>
                                    <th class="text-right">Nhập</th>
                                    <th class="text-right">Xuất</th>
                                    <th class="text-center">Tồn kho</th>
									<th><p class="text-center">Thành tiền</p><p class="text-right">Tổng: {$out['total']|number_format} đ</p></th>
                                    <th class="text-center">TT</th>
                                    <th class="text-right"></th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach from=$result item=data}
                                    <tr id="field{$data.id}">
                                        <td class="text-center"><input type="checkbox" class="item_checked" value="{$data.id}"></td>
                                        <td>
                                        	{$data.name}<br /> 
                                        	<a href="#" title="Click để cập nhật mã sản phẩm" data-toggle="modal" data-target="#UpdateBarcode" onclick="LoadBarcode({$data.id});">
                                        		<small><i class="fa fa-pencil"></i> <span id="Code{$data.id}">{$data.code}</span></small>
                                        	</a>
                                        </td>
                                        <td>{$data.category}</td>
										<td class="text-right">{$data.price}</td>
                                        <td class="text-right">{$data.imported|intval}</td>
                                        <td class="text-right">{$data.exported|intval}</td>
                                        <td class="text-right">{($data.imported - $data.exported)|intval}</td>
										<td class="text-right">{(($data.imported - $data.exported)*$data.price_import)|number_format} đ</td>
                                        <td class="text-center" id="stt{$data.id}">{$data.status}</td>
                                        <td class="text-right" width="15%">
											<a href="?mod=product&site=detail&id={$data.id}" class="btn btn btn-success" title="Chi tiết nhập xuất"><i class="fa fa-search-plus"></i></a>
                                            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#UpdateForm" title="Sửa thông tin sản phẩm" onclick="LoadDataForForm({$data.id});"><i class="fa fa-pencil"></i></button>
                                            <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#DeleteForm" title="Xóa sản phẩm" onclick="LoadDeleteItem('product', {$data.id}, '', 'sản phẩm', 'vì còn tồn tại hóa đơn');"><i class="fa fa-trash-o"></i></button>
                                        </td>
                                    </tr>
                                {/foreach}
							<tr>
								<th colspan="4" class="text-right">Tổng nhập/xuất:</th>
								<td class="text-right">{$out.number_im}</td>
								<td class="text-right">{$out.number_ex}</td>
								<td class="text-right">{$out.number_ex-$out.number_ex}</td>
								<td class="text-right">{$out.total|number_format} đ</td>
								<td colspan="2"></td>
							</tr>
                            </tbody>

                        </table>
                    </div>
                    <!-- end project list -->
                    <div class="paging">{$paging.paging}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal UpdateBarcode -->
<div class="modal fade" id="UpdateBarcode">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Cập nhật mã sản phẩm</h4>
            </div>
            <div class="modal-body">
                <p><b>Hướng dẫn:</b> Vui lòng quét mã vạch của sản phẩm hoặc nhập mã mới sản phẩm sau đó bấm nút "Enter" trên bàn phím để lưu mã mới.</p>
                <br>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Nhập mã</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="text" name="code" required="required" class="form-control" onchange="UpdateBarcode();" placeholder="Code ...">
                    </div>
                </div>
                <br><br><br>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="DeleteFormAll">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Xóa mục này</h4>
            </div>
            <div class="modal-body">Bạn chắc chắn muốn xóa mục này chứ?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy bỏ</button>
                <button type="button" class="btn btn-danger" onclick="LoadDeleteItem();" id="DeleteItemAll">Xóa</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete All -->
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
<div class="modal fade" tabindex="-1" id="UpdateForm">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span>&times;</span>
				</button>
				<h4 class="modal-title" id="title_product"></h4>
			</div>
			<form id="demo-form2" data-parsley-validate
				class="form-horizontal form-label-left" method="post" action="" onsubmit="return checksubmit();">
				<div class="modal-body">
					<div class="form-group">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<input type="hidden" name="id">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Danh mục</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select class="form-control" name="category_id" onchange="AddIdCategory(this.value);"></select>
						</div>
						<div class="col-md-1 col-sm-1 col-xs-12">
							<button type="button" class="btn btn-default" data-toggle="modal" data-target="#UpdateCategory" onclick="UpdateCategory(0);">
								<i class="fa fa-pencil"></i>
							</button>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Sản phẩm</label>
						<div class="col-md-3 col-sm-4 col-xs-12">
							<input type="text" name="code" oninput="change_code();" required="required" class="form-control" placeholder="Mã...">
							<p id="errorcode" style="color: #be2626; display: none"> Mã sản phẩm bị trùng!</p>
						</div>
						<div class="col-md-6 col-sm-8 col-xs-12">
							<input type="text" name="name" required="required" class="form-control" placeholder="Name...">
						</div>
					</div>
					{if $arg.setting.use_trademark eq 1}
					<div class="form-group">
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Thương hiệu</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select name="trademark_id" class="form-control" onchange="AddIdTrademark(this.value);"></select>
						</div>
                        <div class="col-md-1 col-sm-1 col-xs-12">
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#UpdateTrademark" onclick="UpdateTrademark(0);">
                                <i class="fa fa-pencil"></i>
                            </button>
                        </div>
					</div>
					{/if}
					{if $arg.setting.use_origin eq 1}
					<div class="form-group">
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Xuất xứ</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select class="form-control" name="origin_id" onchange="AddIdOrigin(this.value);"></select>
						</div>
                        <div class="col-md-1 col-sm-1 col-xs-12">
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#UpdateOrigin" onclick="UpdateOrigin(0);">
                                <i class="fa fa-pencil"></i>
                            </button>
                        </div>
					</div>
					{/if}
					<div class="form-inline">
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Đơn vị</label>
						<select name="unit" class="form-control" required></select>
						<div class="input-group" style="margin-bottom: 0px;width: 120px">
							<input id="percent" class="form-control prod-price" placeholder="chiết khấu" onchange="UpdatePriceImport(this.value,1);" aria-describedby="basic-addon2" type="text">
							<span class="input-group-addon" id="basic-addon2">%</span>
						</div>
						<i style="padding: 10px;" class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Giá nhập được tính theo phần trăm chiết khấu giá bán"></i>
						{*<input type="text" name="price_origin"  class="form-control"  placeholder="Nguyên giá...">*}
						{*<input type="text" name="percent_import" onchange="set_price_import(this.value);" style="width: 110px;" class="form-control"  placeholder="% nhập ...">*}
						{*<input type="text" name="percent"  onchange="set_price(this.value);" style="width: 110px;"  class="form-control"  placeholder="% bán lẻ ...">*}
						{*<input type="text" name="percent_sale"  onchange="set_price_sale(this.value);" style="width: 110px;"  class="form-control" placeholder="% bán buôn...">*}
					</div>
					<br>
					<div class="form-group" >
					    <label class="control-label col-md-2 col-sm-2 col-xs-12"></label>
					    <div class="col-md-2 col-sm-4 col-xs-12">
                            <input type="text" name="price_import" class="form-control" oninput="SetMoney(this);" placeholder="Giá nhập...">
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-12">
                            <input type="text" name="price" class="form-control"  onchange="SetPriceImport(this.value,1);" oninput="SetMoney(this);" placeholder="Giá bán...">
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-12">
                            <input type="text" name="price_sale" class="form-control" oninput="SetMoney(this);" placeholder="Bán buôn...">
                        </div>
                        <div class="col-md-1 col-sm-1 col-xs-12">
                            <button type="button" class="btn btn-default" id="showUnit" onclick="ShowUnit(this);">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
					</div>
					<div class="form-group" id="large-unit">
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Đơn vị vừa</label>
						<div class="col-md-3 col-sm-4 col-xs-12">
							<select name="unit_nomal" id="select_nomal" class="form-control" onchange="showItem(this);"></select>
						</div>
						<div class="input-group" style="margin-bottom: 0px;width: 120px">
							<input id="percent_nomal" class="form-control prod-price" placeholder="chiết khấu" onchange="UpdatePriceImport(this.value,2);" aria-describedby="basic-addon2" type="text">
							<span class="input-group-addon" id="basic-addon2">%</span>
						</div>
					</div>
					<div class="form-group" id="unit_nomal">
						<label class="control-label col-md-2 col-sm-2 col-xs-12"></label>
						<div class="col-md-2 col-sm-4 col-xs-12">
							<input type="text" name="price_import_nomal" class="form-control" oninput="SetMoney(this);" placeholder="Giá nhập...">
						</div>
						<div class="col-md-2 col-sm-4 col-xs-12">
							<input type="text" name="price_nomal" onchange="SetPriceImport(this.value,2);" class="form-control" oninput="SetMoney(this);" placeholder="Giá bán...">
						</div>
						<div class="col-md-2 col-sm-4 col-xs-12">
                            <input type="text" name="price_sale_nomal" class="form-control" oninput="SetMoney(this);" placeholder="Bán buôn...">
                        </div>
						<div class="col-md-2 col-sm-4 col-xs-12">
							<input type="number" oninput="SetMoney(this);" name="unit_nomal_number" onchange="UpdatePriceQty(this.value,2);" id="number_nomal" class="form-control" placeholder="SL...">
						</div>
					</div>
					<div class="form-group" id="small-units">
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Đơn vị lớn</label>
						<div class="col-md-3 col-sm-4 col-xs-12">
							<select name="unit_big" id="select_big" class="form-control" onchange="showItem(this);"></select>
						</div>
						<div class="input-group" style="margin-bottom: 0px;width: 120px">
							<input id="percent_big" class="form-control prod-price" placeholder="chiết khấu" onchange="UpdatePriceImport(this.value,3);" aria-describedby="basic-addon2" type="text">
							<span class="input-group-addon" id="basic-addon2">%</span>
						</div>
					</div>
					<div class="form-group" id="unit_big">
						<label class="control-label col-md-2 col-sm-2 col-xs-12"></label>
						<div class="col-md-2 col-sm-4 col-xs-12">
							<input type="text" name="price_import_big" class="form-control" oninput="SetMoney(this);" placeholder="Giá nhập...">
						</div>
						<div class="col-md-2 col-sm-4 col-xs-12">
							<input type="text" name="price_big" onchange="SetPriceImport(this.value,3);" class="form-control" oninput="SetMoney(this);" placeholder="Giá bán...">
						</div>
						<div class="col-md-2 col-sm-4 col-xs-12">
                            <input type="text" name="price_sale_big" class="form-control" oninput="SetMoney(this);" placeholder="Bán buôn...">
                        </div>
						<div class="col-md-2 col-sm-4 col-xs-12">
							<input type="number" name="unit_big_number" onchange="UpdatePriceQty(this.value,3)" id="number_big" class="form-control" placeholder="SL...">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Mô tả thêm</label>
						<div class="col-md-9 col-sm-6 col-xs-12">
							<textarea rows="4" name="description" class="form-control"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Cảnh báo hết hàng</label>
						<div class="col-md-2 col-sm-6 col-xs-12">
							<input type="number" min="1" class="form-control" name="number_warning">
						</div>
						{if $arg.setting.use_warranty eq 1} <label
							class="control-label col-md-2 col-sm-2 col-xs-12">Bảo hành</label>
						<div class="col-md-2 col-sm-2 col-xs-12">
							<input type="number" min="0" class="form-control" name="warranty" value="12">
						</div>
						<label class="control-label col-md-1 col-sm-1 col-xs-12">(tháng)</label>{/if}
					</div>
					<div class="form-group">
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Trạng thái</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<div class="checkbox">
								<label> <input type="checkbox" name="status" value="1"> Kích hoạt </label>
							</div>
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" id="submit_product" name="submit">Lưu lại</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Bỏ qua</button>
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- Modal UpdateTrademark -->
<div class="modal fade" tabindex="-1" id="UpdateTrademark">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
				<h4 class="modal-title">Thương hiệu sản phẩm</h4>
			</div>
			<div class="modal-body form-horizontal form">
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
					<label class="control-label col-md-2 col-sm-2 col-xs-12">Thương hiệu</label>
					<div class="col-md-8 col-sm-8 col-xs-12">
						<input type="text" name="name" required="required" class="form-control" placeholder="Name...">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-12">Sắp xếp</label>
					<div class="col-md-2 col-sm-6 col-xs-12">
						<input type="number" class="form-control" name="sort">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" onclick="AjaxSaveTrademark();">Lưu lại</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Bỏ qua</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- Modal UpdateOrigin -->
<div class="modal fade" tabindex="-1" id="UpdateOrigin">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
				<h4 class="modal-title">Xuất xứ sản phẩm</h4>
			</div>
			<div class="modal-body form-horizontal">
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
					<label class="control-label col-md-2 col-sm-2 col-xs-12">Xuất xứ</label>
					<div class="col-md-8 col-sm-8 col-xs-12">
						<input type="text" name="name" required="required" class="form-control" placeholder="Name...">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-12">Sắp xếp</label>
					<div class="col-md-2 col-sm-6 col-xs-12">
						<input type="number" class="form-control" name="sort">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary" onclick="AjaxSaveOrigin();">Lưu lại</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Bỏ qua</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- Modal UpdateCategory -->
<div class="modal fade" tabindex="-1" id="UpdateCategory">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
				<h4 class="modal-title">Danh mục sản phẩm</h4>
			</div>
			<div class="modal-body form-horizontal">
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
					<label class="control-label col-md-2 col-sm-2 col-xs-12">Danh mục</label>
					<div class="col-md-8 col-sm-8 col-xs-12">
						<input type="text" name="name" required="required" class="form-control" placeholder="Tên danh mục...">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-12">Sắp xếp</label>
					<div class="col-md-2 col-sm-6 col-xs-12">
						<input type="number" class="form-control" name="sort">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary" onclick=" AjaxSaveCategory();">Lưu lại</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Bỏ qua</button>
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
				<iframe src="#" style="zoom:0.60" width="99.6%" height="450" id="PrintContent"></iframe>
			</div>
		</div>
	</div>
</div>
<script>
	 var print = '{$out.print}';
</script>
{literal}
<script>
$(document).ready(function () {
    checkShowItemUnits();
});
function checksubmit() {
	var code= $("#UpdateForm input[name=code]").val();
	var id= $("#UpdateForm input[name=id]").val();
	$.post('?mod=product&site=ajax_check_code',{'code':code,'id':id}).done(function(data) {
		if(data==0){
			$('#errorcode').show();
			return false;
		}
		else {
			$('#demo-form2').removeAttr('onsubmit');
			$('#submit_product').trigger('click');
		}
	});
	return false;
}
function change_code() {
	$('#errorcode').hide();
}
function setprintprice() {
	var arr = [];
	$(".item_checked").each(function () {
		if ($(this).is(':checked')) {
			var value = $(this).val();
			arr.push(value);
		}
	});
	var str = arr.toString();
	$("#PrintContent").attr("src", print+'&id='+str);
	return false;
}
$(document).on('hidden.bs.modal', '.modal', function () {
	$('.modal:visible').length && $(document.body).addClass('modal-open');
});
//function set_price_import(value) {
//
//
//}
function AddIdTrademark(id){
	$("button[data-target=#UpdateTrademark]").attr("onclick", "UpdateTrademark("+parseInt(id)+");");
}
function UpdateTrademark(id) {
	$("#UpdateTrademark input[type=text]").val('');
	$.post("?mod=product&site=ajax_load_trademark_item", {'id' : id}).done(function(data) {
		var data = JSON.parse(data);
		if (data.id == undefined) {
			$("#UpdateTrademark input[name=id]").val(0);
			$("#UpdateTrademark input[name=sort]").val(1);
		} else {
			$("#UpdateTrademark input[name=id]").val(data.id);
			$("#UpdateTrademark input[name=name]").val(data.name);
			$("#UpdateTrademark input[name=sort]").val(data.sort);
		}
		$("#UpdateTrademark input[name=code]").val(data.code);
	});
}
function AjaxSaveTrademark(){
	var data = {};
	data['id'] = $("#UpdateTrademark input[name=id]").val();
	data['name'] = $("#UpdateTrademark input[name=name]").val();
	data['code'] = $("#UpdateTrademark input[name=code]").val();
	data['sort'] = $("#UpdateTrademark input[name=sort]").val();
	//data['status'] = $("#UpdateTrademark input[name=status]").prop('checked') ? 1 : 0;
	if(data['name'] == ''){
		$("#UpdateTrademark input[name=name]").val('Vui lòng nhập thể loại');
		setTimeout(function(){
			$("#UpdateTrademark input[name=name]").val('');
			$("#UpdateTrademark input[name=name]").focus();
		}, 1000);
		return false;
	}
		
	$.post("?mod=product&site=ajax_save_trademark", data).done(function(rt) {
		var rt = JSON.parse(rt);
		$('#UpdateTrademark').modal('hide');
		$("#UpdateForm select[name=trademark_id]").html(rt.select);
		AddIdTrademark(rt.id);
		return false;
	});
}



function AddIdOrigin(id){
	$("button[data-target=#UpdateOrigin]").attr("onclick", "UpdateOrigin("+parseInt(id)+");");
}

function UpdateOrigin(id) {
	$("#UpdateOrigin input[type=text]").val('');
	$.post("?mod=product&site=ajax_load_origin_item", {'id' : id}).done(function(data) {
		var data = JSON.parse(data);
		if (data.id == undefined) {
			$("#UpdateOrigin input[name=id]").val(0);
			$("#UpdateOrigin input[name=sort]").val(1);
		} else {
			$("#UpdateOrigin input[name=id]").val(data.id);
			$("#UpdateOrigin input[name=name]").val(data.name);
			$("#UpdateOrigin input[name=sort]").val(data.sort);
		}
		$("#UpdateOrigin input[name=code]").val(data.code);
	});
}

function AjaxSaveOrigin(){
	var data = {};
	data['id'] = $("#UpdateOrigin input[name=id]").val();
	data['name'] = $("#UpdateOrigin input[name=name]").val();
	data['code'] = $("#UpdateOrigin input[name=code]").val();
	data['sort'] = $("#UpdateOrigin input[name=sort]").val();
	if(data['name'] == ''){
		$("#UpdateOrigin input[name=name]").val('Vui lòng nhập xuất xứ');
		setTimeout(function(){
			$("#UpdateOrigin input[name=name]").val('');
			$("#UpdateOrigin input[name=name]").focus();
		}, 1000);
		return false;
	}
		
	$.post("?mod=product&site=ajax_save_origin", data).done(function(rt) {
		var rt = JSON.parse(rt);
		$('#UpdateOrigin').modal('hide');
		$("#UpdateForm select[name=origin_id]").html(rt.select);
		AddIdOrigin(rt.id);
		return false;
	});
}

function AjaxSaveCategory(){
	var data = {};
	data['id'] = $("#UpdateCategory input[name=id]").val();
	data['name'] = $("#UpdateCategory input[name=name]").val();
	data['code'] = $("#UpdateCategory input[name=code]").val();
	data['sort'] = $("#UpdateCategory input[name=sort]").val();
	if(data['name'] == ''){
		$("#UpdateCategory input[name=name]").val('Vui lòng nhập danh mục sản phẩm');
		setTimeout(function(){
			$("#UpdateCategory input[name=name]").val('');
			$("#UpdateCategory input[name=name]").focus();
		}, 1000);
		return false;
	}

	$.post("?mod=product&site=ajax_save_category", data).done(function(rt) {
		var rt = JSON.parse(rt);
		$('#UpdateCategory').modal('hide');
		$("#UpdateForm select[name=category_id]").html(rt.select);
		AddIdCategory(rt.id);
		return false;
	});
}
function AddIdCategory(id){
	$("button[data-target=#UpdateCategory]").attr("onclick", "UpdateCategory("+parseInt(id)+");");
}
function UpdateCategory(id) {
	$("#UpdateCategory input[type=text]").val('');
	$.post("?mod=product&site=ajax_load_category_item", {'id' : id}).done(function(data) {
		var data = JSON.parse(data);
		if (data.id == undefined) {
			$("#UpdateCategory input[name=id]").val(0);
			$("#UpdateCategory input[name=sort]").val(1);
		} else {
			$("#UpdateCategory input[name=id]").val(data.id);
			$("#UpdateCategory input[name=name]").val(data.name);
			$("#UpdateCategory input[name=sort]").val(data.sort);
		}
		$("#UpdateCategory input[name=code]").val(data.code);
	});
}

function LoadBarcode(id){
	var $this = $("#UpdateBarcode input");
	$($this).attr('onchange', 'UpdateBarcode('+id+', this.value);').focus();
	$('#UpdateBarcode').on('shown.bs.modal', function () {
	    $('#UpdateBarcode input').focus();
	}) 
}

function UpdateBarcode(id, code){
    $.post("?mod=product&site=ajax_update_barcode", {'id': id, 'code':code}).done(function (data) {
		$('#UpdateBarcode input').val('');
    	if(data==0){
    		return false;
    	}
    	else if(data == 1){
    		$('#UpdateBarcode').modal('hide');
    		$("#Code"+id).html(code);
    		return false;
    	}
    	else{
    		alert(data);
    		return false;
    	}
    });

}

$('#key, #category').keypress(function( event ){
      if ( event.which == 13 ) {
         $('#search_btn').trigger('click');
      }
});

function ShowUnit(obj){
    var sts = $(obj).val();
	var min_big = $("#number_nomal").val();
    if(sts == 1){
         if($("#large-unit").hasClass('hidden')){
            $("#large-unit").removeClass('hidden');
			$("#select_nomal").attr('required','');
			 $("#number_nomal").attr('required','');
			 $("#number_nomal").attr('min','1');
        }
		 else{$("#small-units").removeClass('hidden');
			 $("#number_big").attr('required','');
			$("#select_big").attr('required','');
			 $("#number_big").attr('min',min_big);
		 }
    }else if(sts == 0){
        if($("#large-unit").hasClass('hidden')){
            $("#large-unit").removeClass('hidden');
			$("#number_nomal").attr('required','');
			$("#select_nomal").attr('required','');
			$("#number_nomal").attr('min','1');
        }else{
            $("#small-units").removeClass('hidden');
			$("#number_big").attr('required','');
			$("#select_big").attr('required','');
			$("#number_big").attr('min',min_big);
        }
    }
    
}

function showItem(obj) {
    var name = $(obj).attr('name');
    var value = $(obj).val();
    if (value == 0 || value == null) {
        $("#" + name).hide();
    } else {
        var unit_nomal = $("select[name=unit_nomal]").val();
        if (name == 'unit_big' && (unit_nomal == 0 || unit_nomal == null)) {
            alert("Vui lòng chọn đơn vị vừa trước !");
            $(obj).val(0)
            return false;
        }
        $("#" + name).show();
    }
    //console.log(name);
}

function checkShowItemUnits() {
    var unit_nomal = $("select[name=unit_nomal]").val();
    var unit_big = $("select[name=unit_big]").val();
    console.log(unit_nomal);
    if (unit_nomal == 0 || unit_nomal == null)
        $("#unit_nomal").hide();
    else
        $("#unit_nomal").show();

    if (unit_big == 0 || unit_big == null)
        $("#unit_big").hide();
    else
        $("#unit_big").show();
}

function filter() {
    var key = $("#key").val();
    var category = $("#category").val();

    var url = "./?mod=product&site=index";
    url += "&category=" + category;
    url += "&key=" + key;
    window.location.href = url;
}

function LoadDataForForm(id) {
    $("#UpdateForm input[type=text]").val('');
    $("#UpdateForm input[type=number]").val('');
    $.post("?mod=product&site=ajax_load_item", {'id': id}).done(function (data) {
        var data = JSON.parse(data);
        console.log(data);
        if (data.id == undefined) {
            $("#UpdateForm input[name=id]").val(0);
            $("#UpdateForm input[name=number_warning]").val(10);
            $("#UpdateForm input[name=warranty]").val(12);
            $("#UpdateForm input[name=status]").attr("checked", "checked");
            $("#UpdateForm input[name=status]").prop('checked', true);
            $("#large-unit").addClass('hidden');
            $("#small-units").addClass('hidden');
            $("#title_product").html('Thêm sản phẩm mới');
            $("#showUnit").val('1');
            
        } else {
            $("#UpdateForm input[name=id]").val(data.id);
            $("#UpdateForm input[name=name]").val(data.name);
            $("#showUnit").val('0');
            $("#UpdateForm input[name=price_import]").val(data.price_import);
            $("#UpdateForm input[name=price]").val(data.price);
            $("#UpdateForm input[name=price_sale]").val(data.price_sale);
            
            $("#title_product").html('Sửa thông tin sản phẩm');

            $("#UpdateFrom input[name=warranty]").val(data.warranty);
            
            if(data.unit_nomal == null ){
                $("#large-unit").addClass('hidden');
            }else{
                $("#large-unit").removeClass('hidden');
            }
            if(data.unit_big == null ){
                $("#small-units").addClass('hidden');
            }else{
                $("#small-units").removeClass('hidden');
            }
           
            $("#UpdateForm input[name=unit_nomal_number]").val(data.unit_nomal_number);
            $("#UpdateForm input[name=price_import_nomal]").val(data.price_import_nomal);
            $("#UpdateForm input[name=price_nomal]").val(data.price_nomal);
            $("#UpdateForm input[name=price_sale_nomal]").val(data.price_sale_nm);

            $("#UpdateForm input[name=unit_big_number]").val(data.unit_big_number);
            $("#UpdateForm input[name=price_import_big]").val(data.price_import_big);
            $("#UpdateForm input[name=price_big]").val(data.price_big);
            $("#UpdateForm input[name=price_sale_big]").val(data.price_sale_big);
            $("#UpdateForm input[name=number_warning]").val(data.number_warning);
            $("#UpdateForm input[name=warranty]").val(data.warranty);
            $("#UpdateForm textarea[name=description]").val(data.description);

            if (data.status == '1') {
                $("#UpdateForm input[name=status]").attr("checked", "checked");
                $("#UpdateForm input[name=status]").prop('checked', true);
            } else {
                $("#UpdateForm input[name=status]").removeAttr("checked");
                $("#UpdateForm input[name=status]").prop('checked', false);
            }
        }
        $("#UpdateForm input[name=code]").val(data.code);
        $("#UpdateForm select[name=category_id]").html(data.select_categories);
        $("#UpdateForm select[name=unit]").html(data.select_unit);
        $("#UpdateForm select[name=unit_nomal]").html(data.select_unit_nomal);
        $("#UpdateForm select[name=unit_big]").html(data.select_unit_big);
        $("#UpdateForm select[name=trademark_id]").html(data.select_trademark);
        $("#UpdateForm select[name=origin_id]").html(data.select_origin);
        checkShowItemUnits();
        AddIdTrademark(data.trademark_id);
        AddIdOrigin(data.origin_id);
    });
}

function HandleCopy() {
    var arr = [];
    $(".item_checked").each(function () {
        if ($(this).is(':checked')) {
            var value = $(this).val();
            arr.push(value);
        }
    });
    if (arr.length < 1) {
        alert("Chọn mục xử lý.")
        return false;
    }
    var str = arr.toString();
    $.post("?mod=product&site=ajax_copy", {'id': str})
            .done(function () {
                alert("Sao chep thanh cong.");
                location.reload();
            });
}
function  LoadDeleteItemAll(table) {
	$("#DeleteItemAll").attr("onclick", "HandleMultiDelete('" + table + "');");
	
}

function HandleMultiDelete(table) {
    var arr = [];
    $(".item_checked").each(function () {
        if ($(this).is(':checked')) {
            var value = $(this).val();
            arr.push(value);
        }
    });
    if (arr.length < 1) {
        alert("Chọn 1 mục để xử lý");
        return false;
    }
    var str = arr.toString();
    $.post("?mod=product&site=ajax_multi_delete", {'id': str}).done(function () {
        location.reload();
    });

}
	function UpdatePercent(value,id) {
		$.post("?mod=product&site=ajax_update_percent", {'id': id,'value':value}).done(function (data) {
			if(data==0){
				alert('error');
			}
			else {
				$('#price'+id).html(data);
				$('propercent'+id).val(value);
				alert('Thanh cong!');
			}
		});

	}
	/*add function update price*/

	function UpdatePriceQty(value,type){
		/*
		price_import         |price         | price_sale
		price_import_normal  |price_normal  | price_sale_normal
		price_import_big	 |price_big	    | price_sale_big

		*/

		//name=unit_normal_number
		if(type==2){
			
			var price_im= $("input[name=price_import]").val().replace(/,/g,"");			
			var price = $("input[name=price]").val().replace(/,/g,"");			
			var price_import_normal = parseInt(price_im)*parseInt(value);	

			$("input[name=price_import_nomal]").val(price_import_normal);
			var price_normal = parseInt(price)*parseInt(value);
			//alert('Price normal:'+price_normal);
			$("input[name=price_nomal]").val(price_normal);

			//SetMoney($("input[name=price_import_nomal]"));

			//SetMoney($("input[name=price_nomal]"));
		}

		if(type==3){
			var price_import_nomal= $("input[name=price_import_nomal]").val().replace(/,/g,"");			
			var price_normal = $("input[name=price_nomal]").val().replace(/,/g,"");			

			var price_import_big = parseInt(price_import_nomal)*parseInt(value);				
			var price_big = parseInt(price_normal)*parseInt(value);
			//alert('Price normal:'+price_normal);
			$("input[name=price_big]").val(price_big);
			$("input[name=price_import_big]").val(price_import_big);

			//SetMoney($("input[name=price_import_nomal]"));
			//SetMoney($("input[name=price_nomal]"));
		}

	}
	/*end add*/
	
	function UpdatePriceImport(value,type) {
		if(type==1){
			var price_ex= $("input[name=price]").val().replace(/,/g, "");
			if(price_ex==""){
				alert('Vui lòng nhập giá bán!');
				$("#percent").val(0);
				return false;
			}
			var price_im= parseInt(price_ex) - parseInt(price_ex)*parseInt(value)/100;
			$("input[name=price_import]").val(price_im);
			SetMoney($("input[name=price_import]"));
		}
		if(type==2){
			var price_ex= $("input[name=price_nomal]").val().replace(/,/g, "");
			if(price_ex==""){
				alert('Vui lòng nhập giá bán!');
				$("#percent_nomal").val(0);
				return false;
			}
			var price_im= parseInt(price_ex) - parseInt(price_ex)*parseInt(value)/100;
			$("input[name=price_import_nomal]").val(price_im);
			SetMoney($("input[name=price_import_nomal]"));
		}
		if(type==3){
			var price_ex= $("input[name=price_big]").val().replace(/,/g, "");
			if(price_ex==""){
				alert('Vui lòng nhập giá bán!');
				$("#percent_big").val(0);
				return false;
			}
			var price_im= parseInt(price_ex) - parseInt(price_ex)*parseInt(value)/100;
			$("input[name=price_import_big]").val(price_im);
			SetMoney($("input[name=price_import_big]"));
		}
	}
	function SetPriceImport(value,type) {
		value=value.replace(/,/g, "");
		if(type==1){
			var per= $('#percent').val();
			if(per==""){
				return false;
			}
			var price_im= parseInt(value) - parseInt(value)*parseInt(per)/100;
			$("input[name=price_import]").val(price_im);
			SetMoney($("input[name=price_import]"));
		}
		if(type==2){
			var per= $('#percent_nomal').val();
			if(per==""){
				return false;
			}
			var price_im= parseInt(value) - parseInt(value)*parseInt(per)/100;
			$("input[name=price_import_nomal]").val(price_im);
			SetMoney($("input[name=price_import_nomal]"));
		}
		if(type==1){
			var per= $('#percent_big').val();
			if(per==""){
				return false;
			}
			var price_im= parseInt(value) - parseInt(value)*parseInt(per)/100;
			$("input[name=price_import_big]").val(price_im);
			SetMoney($("input[name=price_import_big]"));
		}
	}

</script>
{/literal}
