function SetRevertValue(item, value){
	$.post('?mod=revertAjax&site=ajax_set_revert_value',{'item': item, 'value': value}).done(function(data){
		if(item=='customer_id')
			$("#Products tbody").html("");
			window.location.reload();
		GetTotalSession();
		return false;
	});
}


function AddProduct(id){
	id = parseInt(id);
	if(id==0 || id < 0){
		return false;
	}
	var remain = parseInt($('#remain'+id).text());
	if (remain <= 0) {
		alert('Sản phẩm này đã trả hết hàng!');
	}
	else {
		$.post('?mod=revertAjax&site=ajax_add_product_session',{'id': id})
		.done(function(data){
			if(data=='0'){
				return false;
			}
			$("#prd" + id).remove();
			$("#Products tbody").prepend(data);
		    $('.expiry').daterangepicker({ singleDatePicker: true, calender_style: "picker_4", format: 'DD-MM-YYYY'}, function(){
		    	$('.expiry').change();
		    });
			GetTotalSession();
		});
	}
	
}

function UpdateNumber(id, number,max_number){
	if(number > max_number){
		$("#number").val(max_number);
		alert('Số lượng không được vượt quá số lượng mua hàng!');
		UpdateNumber(id, max_number,max_number);
		return false;
	}
	if(number < 0 ){
		$("#number").val(1);
		alert('Số lượng trả hàng không được âm!');
		UpdateNumber(id, 1,max_number);
		return false;
	}
	$.post('?mod=revertAjax&site=ajax_update_number',{'id': id, 'number':number,'max_number':max_number }).done(function(data){
		var data = JSON.parse(data);
		$("#proTotal"+id).html(data.total_item);
		GetTotalSession();
	});
}

function UpdateSituation(id, situation){
	$.post('?mod=revertAjax&site=ajax_update_situation',{'id': id, 'situation':situation}).done(function(){});
}

function UpdateSituaDes(id, situa_des){
	$.post('?mod=revertAjax&site=ajax_update_situa_des',{'id': id, 'situa_des':situa_des}).done(function(){});
}


function RemoveProduct(id){
	id = parseInt(id);
	if(id==0 || id < 0){
		return false;
	}
	$.post('?mod=revertAjax&site=ajax_remove_product',{'id': id})
	.done(function(data){
		$("#proNo"+id).remove();
		LoadProduct();
		GetTotalSession();
	});
	
}

function LoadProduct(){
	var post = {};
	post['cate'] = $("select[name=FilterCate]").val();
	post['code'] = $("#FilterCode").val();
	post['name'] = $("#FilterName").val();
	post['trade'] = $("select[name=FilterTrademark]").val();
	post['orig'] = $("select[name=FilterOrigin]").val();
	post['export_code'] = $("input[name=export_code]").val();
	
	$.post('?mod=revertAjax&site=ajax_get_product',post)
	.done(function(data){
		$("#ProductList").html(data);
	});
}
function LoadProduct_export(){
	var post = {};
	post['export_code'] = $("input[name=export_code1]").val();
	
	$.post('?mod=revertAjax&site=ajax_get_product_report',post)
	.done(function(data){
		$("#ProductList").html(data);
	});
}


function Refresh(){
	$.post('?mod=revert&site=ajax_refresh')
	.done(function(rt){
		window.location.reload();
	});
}

function GetTotalSession(){
	$.post('?mod=revertAjax&site=ajax_get_total_session').done(function(data){
		var data = JSON.parse(data);
		$("input[name=m_total]").val(data.total);
		$("input[name=m_total_must_pay]").val(data.total_must_pay);
		$("input[name=debt]").val(data.debt);
		$("#product-total span").html(data.total_product);
		$("#service-total span").html(data.total_service);
		var number = data.total.replace(",", "");
		if(parseInt(number)>0) $("#SaveBtn").show();
		else $("#SaveBtn").hide();
	});
}

