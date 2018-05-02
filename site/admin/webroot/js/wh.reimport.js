function SetExportValue(item, value){
	$.post('?mod=importReAjax&site=ajax_set_export_value',{'item': item, 'value': value}).done(function(data){
		if(data=='discount_type' || data=='discount'){
			GetTotalSession();
		}
		else if(data=='payment'){
			GetTotalSession(1);
		}
		return false;
	});
}


function AddProduct(id){
	id = parseInt(id);
	if(id==0 || id < 0){
		return false;
	}
	$.post('?mod=importReAjax&site=ajax_add_product_session',{'id': id})
	.done(function(data){
		if(data=='0'){
			return false;
		}
		$("#prd" + id).remove();
		$("#Products tbody").prepend(data);
	    $('[data-toggle="popover"]').popover();
		GetTotalSession();
	});
	
}

function UpdateNumberProduct(id, number, max){
	id = parseInt(id);
	if(id==0 || id < 0){
		return false;
	}
	if(number<0){
		alert("Số lượng không được nhỏ hơn 0 !");
		number = 0;
	}
	$.post('?mod=importReAjax&site=ajax_update_product_number',{'id': id, 'number': number, 'max':max}).done(function(data){
		var data = JSON.parse(data);
		if(data.is_max != undefined){
			alert('Số lượng vượt quá mức tối đa');
			$("#proNumber"+id).val(0);
			$("#proTotal"+id).html('0 đ');
		}
		else{
			$("#proNumber"+id).val(data.number);
			$("#proTotal"+id).html(data.total_item);
		}
		GetTotalSession();
	});
	
}


function RemoveProduct(id){
	id = parseInt(id);
	if(id==0 || id < 0)
		return false;
	$.post('?mod=importReAjax&site=ajax_remove_product',{'id': id}).done(function(){
		$("#proNo"+id).remove();
		LoadProduct();
		GetTotalSession();
	});
	
}


function UpdateProductPrice(id, price){
	$.post('?mod=importReAjax&site=ajax_change_product_price',
			{'id':id, 'price':price}
	).done(function(data){
		var data = JSON.parse(data);
		$("#proPrice"+id).val(data.price);
		$("#proTotal"+id).html(data.total);
		GetTotalSession();
	});
	
}
function UpdateDescriptionProduct(id, value){
	id = parseInt(id);
	if(id==0 || id < 0){
		return false;
	}
	$.post('?mod=importReAjax&site=ajax_update_product_description',{'id': id, 'description': value})
	.done(function(data){
		$("#proDescription"+id).val(data);
	});
}
function SetValueDescripton(id){
	$.post('?mod=importReAjax&site=ajax_update_product_description',{'id': id})
	.done(function(data){
		console.log(data);
		$("#proDescription"+id).val(data);
	});
}


function SaveExportPrice(){
	var data = {};
	data['id'] = $("#UpdateExportPrice input[name=id]").val();
	data['price'] = $("#UpdateExportPrice input[name=price]").val();
	$.post("?mod=product&site=ajax_saved_price", data).done(function() {
		$("#UpdateExportPrice").modal("hide");
	});
}


function UpdateProductUnit(id, level){
	$.post('?mod=importReAjax&site=ajax_update_product_unit',{'id': id, 'level':level}).done(function(data){
		var data = JSON.parse(data);
		$("#proPrice"+id).val(data.price);
		$("#proTotal"+id).html('0 đ');
		$("#proNumber"+id).val(0);
		GetTotalSession();
	});
}


function UpdateExpiry(id, date){
	$.post('?mod=importReAjax&site=ajax_update_expiry',{'id': id, 'date':date}).done(function(){});
}

// Tinh toan tong tien
function WarehouseImportTotal(id){
	var price = $("#proPrice"+id).val().replace(/\,/g, "");
	var number = $("#proNumber"+id).val();
	if(parseInt(number) <= 0)
		number = 1;
	var total = parseInt(price) * parseInt(number);
	var sum_total = 0;
	
	//Tinh tong tien
	$.post('?mod=helps&site=ajax_get_number_format', {'value':total})
		.done(function(data){
			// tinh tong tien cho tung san pham
			$("#proTotal"+id).html(data + " đ");
		})
		.always(function(){
			$(".import-list").each(function(){
				var value_total = $(this).children(".import-list-total").html().replace(/\,/g, "");
				sum_total += parseInt(value_total);
			});
			
			$.post('?mod=helps&site=ajax_get_number_format', {'value':sum_total})
				.done(function(data){
					// tinh tong tien cho ca don hang
					$("#import-total span").html(data + " đ");
				});
			
		});
}


function WarehouseImportRemove(obj, id){
	$(obj).parent().parent().remove();
	var sum_total = 0;
	$.post('?mod=importReAjax&site=ajax_set_warehouse_import',{'type':'delete', 'id': id})
	.done(function(){
		$(".import-list").each(function(){
			var value_total = $(this).children(".import-list-total").html().replace(/\,/g, "");
			sum_total += parseInt(value_total);
		});
		
		$.post('?mod=helps&site=ajax_get_number_format', {'value':sum_total})
			.done(function(data){
				// tinh tong tien cho ca don hang
				$("#import-total span").html(data + " đ");
			});
	});
}


function LoadProduct(){
	var post = {};
	post['code'] = $("input[name=FilterCode]").val();
	
	$.post('?mod=importReAjax&site=ajax_load_product',post)
	.done(function(data){
		$("#ProductList").html(data);
	});
}


function Refresh(){
	$.post('?mod=importReAjax&site=ajax_refresh')
	.done(function(rt){
		LoadProduct();
		$("#Products tbody").html('');
		GetTotalSession();
	});
}

function GetTotalSession(is_payment){
	$.post('?mod=importReAjax&site=ajax_get_total_session', {'is_payment':is_payment}).done(function(data){
		var data = JSON.parse(data);
		$("input[name=m_total]").val(data.total);
		$("input[name=m_total_must_pay]").val(data.total_must_pay);
		$("input[name=payment]").val(data.payment);
		$("input[name=debt]").val(data.debt);
		$("#product-total span").html(data.total_product);
		$("#service-total span").html(data.total_service);
		var number = data.total.replace(",", "");
		if(parseInt(number)>0) $("#SaveExport").show();
		else $("#SaveExport").hide();
	});
}
function  UpdateIdExport(value) {
	$.post('?mod=importReAjax&site=ajax_update_id_export', {'value':value}).done(function(data)
	{
		$("#customer").val(data);
		LoadProduct();
			$("#Products tbody").html('');
		GetTotalSession();
	});
}

