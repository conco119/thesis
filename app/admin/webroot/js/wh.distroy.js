function AddNewExport(){
	$.post('?mod=exDistroyAjax&site=ajax_add_export',{'submit': 1}).done(function(data){
		window.location.href = data;
		return false;
	});
}

function RemoveExport(eid){
	$.post('?mod=exDistroyAjax&site=ajax_remove_export',{'eid': eid}).done(function(data){
		window.location.href = data;
		return false;
	});
}

function SetExportValue(eid, item, value){
	$.post('?mod=exDistroyAjax&site=ajax_set_export_value',{'eid': eid, 'item': item, 'value': value}).done(function(data){
		if(data=='discount' || data=='discount_type')
			GetTotalSession(eid);
		else if(data=='payment')
			GetTotalSession(eid, 1);
		return false;
	});
}

// Ham xu ly them san pham vao hoa don nhap hang
function AddProduct(eid, id){
	id = parseInt(id);
	if(id==0 || id < 0){
		return false;
	}
	$.post('?mod=exDistroyAjax&site=ajax_add_product_session',{'eid': eid, 'id': id})
	.done(function(data){
		if(data=='0'){
			return false;
		}
		$("#prd" + id).remove();
		$("#Products tbody").prepend(data);
		GetTotalSession(eid);
		LoadProduct(eid);
		$('[data-toggle="popover"]').popover();
	});
	
}

function UpdateNumberProduct(eid, id, number, max){
	if(number<1){
		alert("Số lượng không được nhỏ hơn 1 !");
		number = 1;
	}
	// Xoa field vua duoc them
	$.post('?mod=exDistroyAjax&site=ajax_update_product_number',{'eid': eid, 'id': id, 'number': number})
	.done(function(data){
		var data = JSON.parse(data);
		if(data.is_max == '1' && config.export_alway==0){
			alert('Số lượng không được vượt quá tồn kho.');
			$("#proUnit"+id).val(data.unit_level);
			UpdateProductUnit(id, data.unit_level, eid);
		}
		$("#proNumber"+id).val(data.number);
		$("#proTotal"+id).html(data.total_item);
		GetTotalSession(eid);
	});
	
}

function RemoveProduct(eid, id){
	id = parseInt(id);
	if(id==0 || id < 0){
		return false;
	}
	
	$.post('?mod=exDistroyAjax&site=ajax_remove_product',{'eid': eid, 'id': id})
	.done(function(data){
		$("#proNo"+id).remove();
		GetTotalSession(eid);
	});
	
}

function UpdateDescriptionProduct(eid, id, number){
	id = parseInt(id);
	if(id==0 || id < 0){
		return false;
	}
	$.post('?mod=exDistroyAjax&site=ajax_update_product_description',{'eid': eid, 'id': id, 'description': number})
	.done(function(data){
		console.log(data);
		$("#proDescription"+id).val(data);
	});
}

function SetValueDescripton(eid, id){
	$.post('?mod=exDistroyAjax&site=ajax_update_product_description',{'eid': eid, 'id': id})
	.done(function(data){
		console.log(data);
		$("#proDescription"+id).val(data);
	});
}


function UpdateProductPrice(eid, id){
	var price = $("#proPrice"+id).val().replace(",", "");
	$.post('?mod=exDistroyAjax&site=ajax_update_product_price',{'eid': eid, 'id': id, 'price':price}).done(function(data){
		var data = JSON.parse(data);
		$("#proPrice"+id).val(data.price);
		$("#proTotal"+id).html(data.total_item);
		GetTotalSession(eid);
	});
}

function UpdateProductUnit(id, level, eid){
	$.post('?mod=exDistroyAjax&site=ajax_update_product_unit',{'eid': eid, 'id': id, 'level':level}).done(function(data){
		var data = JSON.parse(data);
		console.log(data);
		if(data.is_max==1){
			alert("Number is not true.");
			$("#proUnit"+id).val(data.level);
			UpdateProductUnit(id, data.level, eid);
		}
		else{
			$("#proPrice"+id).val(data.price);
			$("#proTotal"+id).html(data.total_item);
			$("#proNumber"+id).val(1);
		}
		GetTotalSession(eid);
	});
}


function GetProductFromBarcode(eid, code){
	$.post('?mod=exDistroyAjax&site=ajax_get_id_from_code',{'eid':eid, 'code':code})
	.done(function(rt){
		$("#UseBarcode").val('');
		if(rt=='0'){
			alert('Khong ton tai san pham');
			return false;
		}
		else{
			var data = JSON.parse(rt);
			if(data.exists=='0'){
				if(data.number=='0' && config.export_alway==0){
					alert('San pham nay khong con trong kho');
					return false;
				}
				AddProduct(eid, data.id);
				return false;
			}
			else{
				UpdateNumberProduct(eid, data.id, 'add', 1);
				return false;
			}
		}
	});

}


function LoadProduct(eid){
	var post = {};
	post['cate'] = $("#FilterCate").val();
	post['trade'] = $("#FilterTrademark").val();
	post['orig'] = $("#FilterOrigin").val();
	post['key'] = $("#FilterKey").val();
	post['eid'] = eid;
	
	$.post('?mod=exDistroyAjax&site=ajax_load_product', post).done(function(data){
		$("#ProductList").html(data);
	});
}


function GetTotalSession(eid, is_payment){
	if(eid==0){
		$("#SaveExport").hide();
		$(".oder").hide();
		return false;
	}
	$.post('?mod=exDistroyAjax&site=ajax_get_total_session', {'eid':eid, 'is_payment':is_payment}).done(function(data){
		if(data>0) $("#SaveExport").show();
		else $("#SaveExport").hide();
		
	});
}

