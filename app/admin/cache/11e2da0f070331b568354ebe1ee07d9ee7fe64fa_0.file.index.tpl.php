<?php
/* Smarty version 3.1.30, created on 2018-05-18 18:58:09
  from "/Users/mtd/Sites/htaccess/app/admin/view/product/index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5afebfd167af10_83910536',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '11e2da0f070331b568354ebe1ee07d9ee7fe64fa' => 
    array (
      0 => '/Users/mtd/Sites/htaccess/app/admin/view/product/index.tpl',
      1 => 1526644687,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5afebfd167af10_83910536 (Smarty_Internal_Template $_smarty_tpl) {
?>
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
                            <input type="search" class="left form-control" id="key" placeholder="Mã / tên sản phẩm" value="<?php echo $_smarty_tpl->tpl_vars['out']->value['key'];?>
">
                            <select class="left form-control" id="category"><option value="">Danh mục</option><?php echo $_smarty_tpl->tpl_vars['out']->value['categories'];?>
</select>
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
                                    <th>Tên Sản phẩm</th>
                                    <th>Thuộc danh mục</th>
									<th class="text-right">Giá</th>
                                    <th class="text-right">Nhập</th>
                                    <th class="text-right">Xuất</th>
                                    <th class="text-center">Tồn kho</th>
									<th><p class="text-center">Thành tiền</p><p class="text-right">Tổng: <?php echo number_format($_smarty_tpl->tpl_vars['out']->value['total']);?>
 đ</p></th>
                                    <th class="text-center">TT</th>
                                    <th class="text-right"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['result']->value, 'data');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
?>
                                    <tr id="field<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
">
                                        <td>
                                        	<?php echo $_smarty_tpl->tpl_vars['data']->value['name'];?>
<br />
                                        	<a href="#" title="Click để cập nhật mã sản phẩm" data-toggle="modal" data-target="#UpdateBarcode" onclick="LoadBarcode(<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
);">
                                        		<small><i class="fa fa-pencil"></i> <span id="Code<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['data']->value['code'];?>
</span></small>
                                        	</a>
                                        </td>
                                        <td><?php echo $_smarty_tpl->tpl_vars['data']->value['category_id']['name'];?>
</td>
										<td class="text-right"><?php echo $_smarty_tpl->tpl_vars['data']->value['price'];?>
</td>
                                        <td class="text-right"><?php echo intval($_smarty_tpl->tpl_vars['data']->value['imported']);?>
</td>
                                        <td class="text-right"><?php echo intval($_smarty_tpl->tpl_vars['data']->value['exported']);?>
</td>
										
                                        <td class="text-right"><?php echo intval(($_smarty_tpl->tpl_vars['data']->value['imported']-$_smarty_tpl->tpl_vars['data']->value['exported']));?>
</td>
										<td class="text-right"><?php echo number_format((($_smarty_tpl->tpl_vars['data']->value['imported']-$_smarty_tpl->tpl_vars['data']->value['exported'])*$_smarty_tpl->tpl_vars['data']->value['price_import']));?>
 đ</td>
                                        <td class="text-center" id="stt<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['data']->value['status'];?>
</td>
                                        <td class="text-right" width="15%">
											<a href="?mod=product&site=detail&id=<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" class="btn btn btn-success" title="Chi tiết nhập xuất"><i class="fa fa-search-plus"></i></a>
                                            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#UpdateForm" title="Sửa thông tin sản phẩm" onclick="LoadDataForForm(<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
);"><i class="fa fa-pencil"></i></button>
                                            <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#DeleteForm" title="Xóa sản phẩm" onclick="LoadDeleteItem('product', <?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
, '', 'sản phẩm', 'vì còn tồn tại hóa đơn');"><i class="fa fa-trash-o"></i></button>
                                        </td>
                                    </tr>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

							<tr>
								<th colspan="4" class="text-right">Tổng nhập/xuất:</th>
								<td class="text-right"><?php echo $_smarty_tpl->tpl_vars['out']->value['number_im'];?>
</td>
								<td class="text-right"><?php echo $_smarty_tpl->tpl_vars['out']->value['number_ex'];?>
</td>
								<td class="text-right"><?php echo $_smarty_tpl->tpl_vars['out']->value['number_ex']-$_smarty_tpl->tpl_vars['out']->value['number_ex'];?>
</td>
								<td class="text-right"><?php echo number_format($_smarty_tpl->tpl_vars['out']->value['total']);?>
 đ</td>
								<td colspan="2"></td>
							</tr>
                            </tbody>

                        </table>
                    </div>
                    <!-- end project list -->
                    <div class="paging"><?php echo $_smarty_tpl->tpl_vars['paging']->value['paging'];?>
</div>
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
							<input type="hidden" name="prefix_admin" value='<?php echo $_smarty_tpl->tpl_vars['arg']->value['prefix_admin'];?>
'>
							<input type="hidden" name="mc" value='<?php echo $_smarty_tpl->tpl_vars['arg']->value['mc'];?>
'>
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
					<?php if ($_smarty_tpl->tpl_vars['arg']->value['setting']['use_trademark'] == 1) {?>
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
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['arg']->value['setting']['use_origin'] == 1) {?>
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
					<?php }?>
					<div class="form-inline">
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Đơn vị</label>
						<select name="unit_id" class="form-control" required></select>
						
						
						
					</div>
					<div class="form-inline">
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Chiết khấu</label>
						<select name="discount_type" class="form-control" required></select>
						<div class="input-group" style="margin-bottom: 0px;width: 120px">
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
                        <div class="col-md-2 col-sm-4 col-xs-12">
                            <input type="text" name="price_sale" class="form-control" oninput="SetMoney(this);" placeholder="Bán buôn...">
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
						<?php if ($_smarty_tpl->tpl_vars['arg']->value['setting']['use_warranty'] == 1) {?> <label
							class="control-label col-md-2 col-sm-2 col-xs-12">Bảo hành</label>
						<div class="col-md-2 col-sm-2 col-xs-12">
							<input type="number" min="0" class="form-control" name="warranty" value="12">
						</div>
						<label class="control-label col-md-1 col-sm-1 col-xs-12">(tháng)</label><?php }?>
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


<?php echo '<script'; ?>
>

function activeStatus(table, id) {
	let prefix_admin = $("#UpdateForm input[name=prefix_admin]").val();
    $.post(`${prefix_admin}mc=product&site=ajax_active`, {'table': table, 'id': id}).done(function (data) {
            if(data == 0)
              alert('You can not change');
            else
            $("#stt" + id).html(data);
    });
}


$(document).ready(function () {
    checkShowItemUnits();
});
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

<?php echo '</script'; ?>
>

<?php echo '<script'; ?>
>
$(document).ready(function() {
	if( "<?php echo $_smarty_tpl->tpl_vars['notification']->value['status'];?>
" == "success" || "<?php echo $_smarty_tpl->tpl_vars['notification']->value['status'];?>
" == "error")
	{
		var notice = new PNotify({
			title: "<?php echo $_smarty_tpl->tpl_vars['notification']->value['title'];?>
",
			text: "<?php echo $_smarty_tpl->tpl_vars['notification']->value['text'];?>
",
			type: "<?php echo $_smarty_tpl->tpl_vars['notification']->value['status'];?>
",
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
<?php echo '</script'; ?>
><?php }
}
