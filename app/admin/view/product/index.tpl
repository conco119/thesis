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
                            <select class="left form-control" id="category"><option value="0">Danh mục</option>{$out.categories}</select>
                        </div>
                        <button id="search_btn" type="button" class="btn btn-primary left" onclick="filter();"><i class="fa fa-search"></i></button>

                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#UpdateForm" onclick="LoadDataForForm(0);"><i class="fa fa-pencil"></i> Thêm mới</button>

                        <div class="clearfix"></div>
                    </div>
                    <!-- start project list -->
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Mã sản phẩm</th>
                                    <th>Tên Sản phẩm</th>
                                    <th>Hình ảnh</th>
                                    <th>Thuộc danh mục</th>
									<th class="text-right">Giá bán</th>
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
                                        <td>
											{$data.code}
                                        </td>
                                        <td>
                                        	{$data.name}
                                        </td>
                                        <td><img width='50px' src="{base_url($data.image_path)}/{$data.image_name}"></td>
                                        <td>{$data.category_id.name}</td>
										<td class="text-right">{$data.price}</td>
                                        <td class="text-right">{$data.imported|intval}</td>
                                        <td class="text-right">{$data.exported|intval}</td>
										{* Tồn kho *}
                                        <td class="text-right">{($data.imported - $data.exported)|intval}</td>
										<td class="text-right"> <b style='color:black'> {(($data.imported - $data.exported)*$data.price_import)|number_format} đ </b> </td>
                                        <td class="text-center" id="stt{$data.id}">{$data.status}</td>
                                        <td class="text-right" width="15%">
											<a href='./admin?mc=product&site=imagepost&id={$data.id}'><button type="button" class="btn btn-default btn-xs" title="Hình ảnh sản phẩm"><i class="fa fa-image"></i></button><a/>
											<a href="./admin?mc=product&site=detail&id={$data.id}" class="btn btn btn-default" title="Chi tiết nhập xuất"><i class="fa fa-search-plus"></i></a>
                                            <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#UpdateForm" title="Sửa thông tin sản phẩm" onclick="LoadDataForForm({$data.id});"><i class="fa fa-pencil"></i></button>
                                            <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#DeleteForm" title="Xóa sản phẩm" onclick="LoadDeleteItem('product', {$data.id}, '', 'sản phẩm', 'vì còn tồn tại hóa đơn');"><i class="fa fa-trash-o"></i></button>
                                        </td>
                                    </tr>
                                {/foreach}
							<tr>
								<th colspan="4" class="text-right">Tổng nhập/xuất:</th>
								<td class="text-right">{$out.number_im}</td>
								<td class="text-right">{$out.number_ex}</td>
								<td class="text-right">{$out.number_im-$out.number_ex}</td>
								<td class="text-right"><b style='color:black'> {$out.total|number_format} đ </b></td>
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
							<input type="hidden" name="prefix_admin" value='{$arg.prefix_admin}'>
							<input type="hidden" name="mc" value='{$arg.mc}'>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Danh mục</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select class="form-control" name="category_id" onchange="AddIdCategory(this.value);"></select>
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

					<div class="form-group">
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Thương hiệu</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select name="trademark_id" class="form-control" onchange="AddIdTrademark(this.value);"></select>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Đơn vị</label>
						<div class="col-md-2 col-sm-4 col-xs-12">
							<select name="unit_id" class="form-control" required></select>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Khuyến mại</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<div class="checkbox">
								<label> <input type="checkbox" name="is_discount" onchange='DiscountChange()'></label>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Chiết khấu</label>
						<div class="col-md-3 col-sm-4 col-xs-12">
							<select name="discount_type" class="form-control" required></select>
						</div>
						<div class="col-md-6 col-sm-8 col-xs-12">
							<input name='discount' id="percent" class="form-control prod-price" placeholder="chiết khấu" aria-describedby="basic-addon2" type="number">
						</div>
					</div>
					<br>
					<div class="form-group" >
					    <label class="control-label col-md-2 col-sm-2 col-xs-12"></label>
					    <div class="col-md-2 col-sm-4 col-xs-12">
                            <input type="text" name="price_import" class="form-control" oninput="SetMoney(this);" placeholder="Giá nhập...">
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-12">
                            <input type="text" name="price" class="form-control"  oninput="SetMoney(this);" placeholder="Giá bán...">
                        </div>
                        {* <div class="col-md-2 col-sm-4 col-xs-12">
                            <input type="text" name="price_sale" class="form-control" oninput="SetMoney(this);" placeholder="Bán buôn...">
                        </div> *}
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
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Bảo hành</label>
						<div class="col-md-2 col-sm-2 col-xs-12">
							<input type="number" min="0" class="form-control" name="warranty" value="12">
						</div>
						<label class="control-label col-md-1 col-sm-1 col-xs-12">(tháng)</label>
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

{literal}
<script>



function activeStatus(table, id) {
	let prefix_admin = $("#UpdateForm input[name=prefix_admin]").val();
    $.post(`${prefix_admin}mc=product&site=ajax_active`, {'table': table, 'id': id}).done(function (data) {
            if(data == 0)
              alert('You can not change');
            else
            $("#stt" + id).html(data);
    });
}



function checksubmit() {
	let prefix_admin = $("#UpdateForm input[name=prefix_admin]").val();
	var code= $("#UpdateForm input[name=code]").val();
	var id= $("#UpdateForm input[name=id]").val();
	$.post(`${prefix_admin}mc=product&site=ajax_check_code`,{'code':code,'id':id}).done(function(data) {
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

$(document).on('hidden.bs.modal', '.modal', function () {
	$('.modal:visible').length && $(document.body).addClass('modal-open');
});


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


$('#key, #category').keypress(function( event ){
      if ( event.which == 13 ) {
         $('#search_btn').trigger('click');
      }
});



function filter() {
    var key = $("#key").val();
    var category = $("#category").val();

    var url = "./admin?mc=product&site=index";
    url += "&category=" + category;
    url += "&key=" + key;
    window.location.href = url;
}

function LoadDataForForm(id) {
	let mc = $("#UpdateForm input[name=mc]").val();
	let prefix_admin = $("#UpdateForm input[name=prefix_admin]").val();
    $("#UpdateForm input[type=text]").val('');
    $("#UpdateForm input[type=number]").val('');
    $.post(`${prefix_admin}mc=${mc}&site=ajax_load`, {'id': id}).done(function (data) {
        var data = JSON.parse(data);
        console.log(data);
        if (data.id == undefined) {
            $("#UpdateForm input[name=id]").val(0);
            $("#UpdateForm input[name=number_warning]").val(10);
            $("#UpdateForm input[name=warranty]").val(12);
			$("#UpdateForm input[name=discount]").val(0);
            $("#UpdateForm input[name=status]").attr("checked", "checked");
            $("#UpdateForm input[name=status]").prop('checked', true);
            $("#title_product").html('Thêm sản phẩm mới');

        } else {
            $("#UpdateForm input[name=id]").val(data.id);
            $("#UpdateForm input[name=name]").val(data.name);
            $("#showUnit").val('0');
            $("#UpdateForm input[name=price_import]").val(data.price_import);
            $("#UpdateForm input[name=price]").val(data.price);
            $("#UpdateForm input[name=price_sale]").val(data.price_sale);
			$("#UpdateForm input[name=discount]").val(data.discount);
            $("#title_product").html('Sửa thông tin sản phẩm');

            $("#UpdateFrom input[name=warranty]").val(data.warranty);
            $("#UpdateForm input[name=number_warning]").val(data.number_warning);
            $("#UpdateForm input[name=warranty]").val(data.warranty);
            $("#UpdateForm textarea[name=description]").val(data.description);
			if(data.is_discount == 1)
			{
				$("#UpdateForm input[name=is_discount]").prop('checked', true);
				$("#UpdateForm select[name=discount_type]").prop('disabled', false);
				$("#UpdateForm input[name=discount]").prop('disabled', false);
			}
			else
			{
				$("#UpdateForm input[name=is_discount]").prop('checked', false);
				$("#UpdateForm select[name=discount_type]").prop('disabled', true);
				$("#UpdateForm input[name=discount]").prop('disabled', true);
			}
            if (data.status == '1') {
                $("#UpdateForm input[name=status]").attr("checked", "checked");
                $("#UpdateForm input[name=status]").prop('checked', true);
            } else {
                $("#UpdateForm input[name=status]").removeAttr("checked");
                $("#UpdateForm input[name=status]").prop('checked', false);
            }
        }
        $("#UpdateForm input[name=code]").val(data.code);
        $("#UpdateForm select[name=category_id]").html(data.category_id);
        $("#UpdateForm select[name=unit_id]").html(data.unit_id);
        $("#UpdateForm select[name=trademark_id]").html(data.trademark_id);
        $("#UpdateForm select[name=discount_type]").html(data.discount_type);

    });
}


function DiscountChange(value)
{
	let is_checked = $("#UpdateForm input[name=is_discount]").is(':checked')
	if(is_checked)
	{
		$("#UpdateForm select[name=discount_type]").prop('disabled', false);
		$("#UpdateForm input[name=discount]").prop('disabled', false);
	}
	else
	{
		$("#UpdateForm select[name=discount_type]").prop('disabled', true);
		$("#UpdateForm input[name=discount]").prop('disabled', true);
	}

}



</script>
{/literal}
<script>
$(document).ready(function() {
	$(".mc_product").addClass('active');
	$(".mc_product ul").css('display', 'block');
	$("#product_index").addClass('current-page');

	$("#UpdateForm select[name=discount_type]").prop('disabled', true);
	$("#UpdateForm input[name=discount]").prop('disabled', true);
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