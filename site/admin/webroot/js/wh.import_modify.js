function SetExportValue(mid, item, value){
	$.post('?mod=importAjax&site=ajax_set_export_value',{'mid': mid, 'item': item, 'value': value}).done(function(data){
		return false;
	});
}

function AddProduct(mid, id){
	id = parseInt(id);
	if(id==0 || id < 0){
		return false;
	}
	$.post('?mod=importAjax&site=ajax_add_product_session',{'id': id, 'mid':mid})
	.done(function(data){
		if(data=='0'){
			return false;
		}
		$("#prd" + id).remove();
		$("#Products tbody").prepend(data);
	    $('.expiry').daterangepicker({ singleDatePicker: true, calender_style: "picker_4", format: 'DD-MM-YYYY'}, function(){
	    	$('.expiry').change();
	    });
	    $('[data-toggle="popover"]').popover();
		GetTotalSession(mid);
	});
}

function UpdateNumberProduct(mid, id, type, number){
	id = parseInt(id);
	if(id==0 || id < 0){
		return false;
	}
	if(number<1){
		alert("Số lượng không được nhỏ hơn 1 !");
		number = 1;
	}
	$.post('?mod=importAjax&site=ajax_update_product_number',{'id':id, 'type':type, 'number':number, 'mid':mid})
	.done(function(data){
		var data = JSON.parse(data);
		if(type=='delete'){
			$("#proNo"+id).remove();
			LoadProduct(mid);
		}
		else{
			$("#proNumber"+id).val(data.number);
			$("#proTotal"+id).html(data.total_item);
		}
		GetTotalSession(mid);
	});
	
}


function UpdateProductPrice(mid, id, price){
	$.post('?mod=importAjax&site=ajax_change_product_price',
			{'id':id, 'price':price, 'mid':mid}
	).done(function(data){
		var data = JSON.parse(data);
		$("#price_sell"+id).html(data.price);
		$("#proTotal"+id).html(data.total);
		GetTotalSession(mid);
	});
	
}
function UpdatePercent(mid,id,percent){
	$.post('?mod=importAjax&site=ajax_change_product_percent',
		{'id':id, 'percent':percent, 'mid':mid}
	).done(function(data){
		var data = JSON.parse(data);
		$("#price_sell"+id).html(data.price);
		$("#proTotal"+id).html(data.total);
		GetTotalSession(mid);
	});

}

function UpdateProductUnit(id, level, mid){
	$.post('?mod=importAjax&site=ajax_update_product_unit',{'id': id, 'level':level, 'mid':mid}).done(function(data){
		var data = JSON.parse(data);
		$("#proPrice"+id).val(data.price);
		$("#proTotal"+id).html(data.total_item);
		$("#proNumber"+id).val(1);
		GetTotalSession(mid);
	});
}


function GetProductFromBarcode(mid, code){
	$.post('?mod=importAjax&site=ajax_get_id_from_code',{'code':code, 'mid':mid})
	.done(function(rt){
		$("#UseBarcode").val('');
		if(rt=='0'){
			alert('Khong ton tai san pham');
			return false;
		}
		else{
			var data = JSON.parse(rt);
			if(data.exists=='0'){
				AddProduct(mid, data.id);
				return false;
			}
			else{
				UpdateNumberProduct(mid, data.id, 'add', 1);
				return false;
			}
		}
	});

}

function UpdateExpiry(mid, id, date){
	$.post('?mod=importAjax&site=ajax_update_expiry',{'mid': mid, 'id': id, 'date':date}).done(function(data){
	});
}
function UpdateDescriptionProduct(mid, id, value)
{
	$.post('?mod=importAjax&site=ajax_update_product_description',{'mid': mid, 'id': id, 'description':value}).done(function(data){
	});
}
function SetValueDescripton(mid,id){
	$.post('?mod=importAjax&site=ajax_update_product_description',{'mid': mid,'id': id})
	.done(function(data){
		console.log(data);
		$("#proDescription"+id).val(data);
	});
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
	$.post('?mod=importAjax&site=ajax_set_warehouse_import',{'type':'delete', 'id': id})
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


function LoadProduct(mid){
	var post = {};
	post['cate'] = $("#FilterCate").val();
	post['trade'] = $("#FilterTrademark").val();
	post['orig'] = $("#FilterOrigin").val();
	post['key'] = $("#FilterKey").val();
	post['mid'] = mid;
	
	$.post('?mod=importAjax&site=ajax_load_product',post)
	.done(function(data){
		$("#ProductList").html(data);
	});
}


function Refresh(mid){
	$.post('?mod=importAjax&site=ajax_refresh', {'mid':mid})
	.done(function(rt){
		if(rt=='1')
			window.location.reload();
		return false;
	});
}

function ChangeNumberProduct(id, type){
	var obj = $("#proNumber"+id);
	var value = parseInt(obj.val());
	if(type=='0') value = value - 1;
	else value = value + 1;
	
	if(value < 1){
		alert('Số lượng không được nhỏ hơn 1 !');
		value = 1;
	}
	
	$.post('?mod=importAjax&site=ajax_set_warehouse_import',{'type':'edit', 'id': id, 'number':value}
	).done(function(){
		obj.val(value);
	});

	obj.val(value);
	WarehouseImportTotal(id);
}


function GetTotalSession(mid){
	$.post('?mod=importAjax&site=ajax_get_total_session', {'mid':mid}).done(function(data){
		var data = JSON.parse(data);
		$("input[name=m_total]").val(data.total);
		$("input[name=m_total_must_pay]").val(data.total_must_pay);
		$("input[name=debt]").val(data.debt);
		$("#product-total span").html(data.total_product);
		$("#service-total span").html(data.total_service);
		var number = data.total.replace(",", "");
		if(parseInt(number)>0) $("#SaveExport").show();
		else $("#SaveExport").hide();
	});
}


function UpdateDiscount(){
	
}