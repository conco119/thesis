<div class="">
    <div class="row">
        <div class="col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Quản lý bộ sản phẩm</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="h_content">
                        <div class="form-group form-inline">
                            <input type="search" class="left form-control" id="key" placeholder="Mã / tên bộ sản phẩm" value="{$out.key}">
                        </div>
                        <button id="search_btn" type="button" class="btn btn-primary left" onclick="filter();"><i class="fa fa-search"></i></button>

                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#UpdateForm" onclick="LoadDataForForm(0);"><i class="fa fa-pencil"></i> Thêm mới</button>
                        <button type="button" class="btn btn-success" onclick="HandleCopy();"><i class="fa fa-copy"></i> Copy</button>
                        <button type="button" class="btn btn-danger" onclick="HandleDelete('products');"><i class="fa fa-times-circle"></i> Xóa</button>
                        <div class="clearfix"></div>
                    </div>
                    
                    <!-- start project list -->
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center"><input type="checkbox" id="SelectAllRows"></th>
                                    <th>Bộ sản phẩm</th>
                                    <th class="text-right">Giá bán</th>
                                    <th class="text-right">Giá vốn</th>
                                    <th class="text-center">TT</th>
                                    <th class="text-center">Cập nhật</th>
                                    <th class="text-right"></th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach from=$result item=data}
                                    <tr id="field{$data.id}">
                                        <td class="text-center"><input type="checkbox" class="item_checked" value="{$data.id}"></td>
                                        <td>
                                            {$data.name}<br /> 
                                            <small>{$data.code}</small>
                                        </td>
                                        <td class="text-right">{$data.price}</td>
                                        <td class="text-right">{$data.total_fund}</td>
                                        <td class="text-center" id="stt{$data.id}">{$data.status}</td>
                                        <td class="text-center">{$data.updated}</td>
                                        <td class="text-right">
                                            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#UpdateForm" onclick="LoadDataForForm({$data.id});"><i class="fa fa-pencil"></i></button>
                                            <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#DeleteForm" onclick="LoadDeleteItem('product', {$data.id}, 'ajax_delete_combo', 'bộ sản phẩm', 'vì còn tồn tại hóa đơn');"><i class="fa fa-trash-o"></i></button>
                                        </td>
                                    </tr>
                                {/foreach}
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
                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy bỏ</button>
                <button type="button" class="btn btn-danger" onclick="DeleteItem();" id="DeleteItem">Xóa</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal UpdateFrom -->
<div class="modal fade" tabindex="-1" id="UpdateForm">
    <div class="modal-dialog">
        <div id="combo_modal" class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
                <h4 class="modal-title" id="title_product"></h4>
            </div>
            <div id="modal_loading">
                <p><i class="fa fa-circle-o-notch fa-spin fa-fw fa-lg"></i> Đang tải ...</p>
            </div>
            <form id="combo_form" data-parsley-validate class="form-horizontal form-label-left" method="post" action="">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <input type="hidden" name="id">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Bộ SP</label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <input type="text" name="code" required="required" class="form-control" placeholder="Mã...">
                        </div>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" name="name" required="required" class="form-control" placeholder="Name...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Giá bán</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="text" name="price" class="form-control" oninput="SetMoney(this);" placeholder="Giá bán...">
                        </div>
                    </div>
                    
                    <h4 id="combo_title" class="text-center">Thành phần của bộ sản phẩm</h4>
                    
                    <div id="combo_content" class="form-group">
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <select id="product_select" name="product_id" style="width: 100%;" data-placeholder="Chọn sản phẩm ..." tabindex="-1">
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <input id="out_number" type="number" name="number" min="1" required class="form-control text-right" value="1" title="Số lượng" placeholder="Số lượng">
                        </div>
                        <div class="col-md-1 col-sm-1 col-xs-12">
                            <button id="add_prod_btn" type="button" class="btn btn-info" onclick="AddProduct();" style="min-width: 80px;"><i class="fa fa-plus"></i>&ensp;Thêm</button>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table id="product_list" class="table table-striped table-hover table-bordered combo-table">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th class="text-right">Giá vốn</th>
                                    <th class="text-right">Số lượng</th>
                                    <th class="text-right">Thành tiền</th>
                                    <th class="text-right" style="width: 52px;"></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <thead id="foot">
                            	<tr><th colspan="3" class="text-right">Tổng giá vốn:</th><th id="total_fund" class="text-right">0</th><th></th></tr>
                            </thead>
                        </table>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Mô tả thêm</label>
                        <div class="col-md-9 col-sm-6 col-xs-12">
                            <textarea rows="2" name="description" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Status</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <div class="checkbox">
                                <label> <input type="checkbox" name="status" value="1"> Active / Inactive this item </label>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" name="submit" onclick="SaveCombo();">Lưu lại</button>
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
$(function () {
	$("#UpdateForm").on('show.bs.modal', function () {
        $('#combo_modal').hide();
    });
    
    $("#UpdateForm").on('shown.bs.modal', function () {
        CalcTotal();
        CheckTbody();
        $('#combo_modal').fadeIn(350);
        $('#product_select').chosen({
            allow_single_deselect: true
        });
        CheckAddedProducts();
    });
    
    $('#key, #category').keypress(function( event ){
      if ( event.which == 13 ) {
         $('#search_btn').trigger('click');
      }
    });
    
    $("#add_prod_btn").focusout(function(){
    	$("#product_select_chosen").tooltip('destroy');
    });
});

function CheckAddedProducts() {
    $("table#product_list tbody tr").each(function() {
        var td_id = $(this).find('.prod_id').val();
        $('#product_select option[value='+td_id+']').hide();
    });
    $('#product_select').trigger('chosen:updated');
}

function CheckTbody(){
	var tbody = $("#product_list tbody");

	if (tbody.children().length == 0) {
	    $('#product_list').hide();
	}
	else {
		$('#product_list').show();
	}
}

function CalcTotal(){
	var sum = 0;
	$('table#product_list>tbody>tr>td:nth-child(4)').each( function(){
	    sum += parseInt($(this).html().replace(/,/g, '')) || 0;
	});
	$('#total_fund').html(NumberFormat(sum));
}

function SaveCombo(){
	var prod_id = [];
    var prod_num = [];
    
    $("table#product_list tbody tr").each(function() {
        var td_id = $(this).find('.prod_id').val();
        prod_id.push(td_id);
        var td_num = $(this).find('.prod-number').val();
        prod_num.push(td_num);
    });
    
    var send_id = JSON.stringify(prod_id);
    var send_num = JSON.stringify(prod_num);

    if ($('input[name=name]').val() != '' && $('input[name=code]').val() != '' && prod_id.length > 0) {
        var $form = $('#combo_form'), url = '?mod=product&site=combo';
        var posting = $.post(url, {
            code: $form.find("input[name=code]").val(),
            name: $form.find("input[name=name]").val(),
            price: $form.find("input[name=price]").val(),
            description: $form.find("textarea[name=description]").val(),
            status: $form.find("input[name=status]").val(),
            id: $form.find("input[name=id]").val(),
            id_list: send_id,
            num_list: send_num
        })
        .done(function (data) {
            location.reload();
        });
    }
    else {
        var notice = new PNotify({
            title: 'Vui lòng kiểm tra lại!',
            text: 'Các trường Mã, Tên và Thành phần của bộ sản phẩm không được để trống.',
            type: 'error',
            mouse_reset: false,
            buttons: {
                sticker: false,
            }
        });
        notice.get().click(function () {
            notice.remove();
        });
    }
}

function AddProduct(){
    if($('#product_select').val() == ''){
        $('#product_select_chosen').tooltip({
			'trigger':'manual',
			'title': 'Vui lòng chọn sản phẩm',
			'placement': 'top',
			'delay': { "show": 500, "hide": 0 },
		}).tooltip('show');
    }
    else{
        $('#add_prod_btn').html('<i class="fa fa-circle-o-notch fa-spin fa-fw"></i>');
        $('#add_prod_btn').attr('disabled','');
        var id = $('#product_select').val();
        $.post("?mod=product&site=ajax_add_product", {'id': id}).done(function (data) {
            var data = JSON.parse(data);
            console.log(data);
            var product_name = '<tr id="prodfield'+data.id+'"><td>'+data.name+'<br><small>'+data.code+'</small><input class="prod_id" type="hidden" value="'+data.id+'"</td>';
            var product_price = '<td id="single_price'+data.id+'" class="text-right">'+data.price+'</td>';
            var int_price = parseInt(data.price.replace(/,/g, ''));
            var product_number = '<td class="text-right"><input id="number'+data.id+'" class="prod-number" required oninput="CalcPrice('+data.id+');" style="width: 55px;" type="number" min="1" style="width: 65px;" value="'+$('#out_number').val()+'"></td>';
            var product_total = '<td id="total_price'+data.id+'" class="text-right">'+NumberFormat(int_price * parseInt($('#out_number').val()))+'</td>';
            var remove_btn = '<td class="text-right" style="width: 52px;"><button type="button" class="btn btn-danger btm-sm" title="Loại bỏ" onclick="RemoveProduct('+data.id+');"><i class="fa fa-times"></i></button></td></tr>';
            var result = product_name+product_price+product_number+product_total+remove_btn;
            
            var price_total = int_price * parseInt($('#out_number').val());
            
            $('#product_list tbody').append(result);
            $('#product_select option[value='+data.id+']').hide();
            $('#product_select').val('');
            $('#product_select').trigger('chosen:updated');
            $('#out_number').val(1);
            $('#add_prod_btn').removeAttr('disabled');
            $('#add_prod_btn').html('<i class="fa fa-plus"></i>&ensp;Thêm');
            CalcTotal();
            CheckTbody();
        });
    }
}

function RemoveProduct(field){
    $('#prodfield'+field).remove();
    $('#product_select option[value='+field+']').show();
    $('#product_select').trigger('chosen:updated');
    CalcTotal();
    CheckTbody();
}

function LoadDataForForm(id) {
    $("#UpdateForm input[type=text]").val('');
    $("#out_number").val('1');
    $('#product_select').val('');
    $('#product_select').trigger('chosen:updated');
    $("#UpdateForm textarea").val('');
    $("#product_list tbody").empty();
    
    $.post("?mod=product&site=ajax_load_combo", {'id': id}).done(function (data) {
        var data = JSON.parse(data);
        console.log(data);
        if (data.id == undefined) {
            $("#UpdateForm input[name=id]").val(0);
            $("#UpdateForm input[name=status]").attr("checked", "checked");
            $("#UpdateForm input[name=status]").prop('checked', true);
            $("#title_product").html('Thêm bộ sản phẩm mới');
        } else {
            $("#UpdateForm input[name=id]").val(data.id);
            $("#UpdateForm input[name=name]").val(data.name);
            $("#UpdateForm input[name=price]").val(data.price);
            $("#title_product").html('Sửa thông tin bộ sản phẩm');
            $("#UpdateForm textarea[name=description]").val(data.description);
            $("#product_list tbody").html(data.item);
            if (data.status == '1') {
                $("#UpdateForm input[name=status]").attr("checked", "checked");
                $("#UpdateForm input[name=status]").prop('checked', true);
            } else {
                $("#UpdateForm input[name=status]").removeAttr("checked");
                $("#UpdateForm input[name=status]").prop('checked', false);
            }
        }
        $("#UpdateForm input[name=code]").val(data.code);
        $("#UpdateForm select[name=product_id]").html(data.select_products);
    });
}

function CalcPrice(field){
    var single_price = parseInt($('#single_price'+field).html().replace(/,/g, ''));
    var number = $('#number'+field).val();
    $('#total_price'+field).html(NumberFormat(single_price * number));
    CalcTotal();
}

function NumberFormat(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function filter() {
    var key = $("#key").val();
    var category = $("#category").val();

    var url = "./?mod=product&site=combo";
    url += "&key=" + key;
    window.location.href = url;
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
        alert("Chọn mục xử lý.");
        return false;
    }
    var str = arr.toString();
    $.post("?mod=product&site=ajax_copy", {'id': str})
            .done(function () {
                alert("Copy successfully.");
                location.reload();
            });
}

</script>
{/literal}
