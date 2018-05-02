function AddNewExport(){
	$.post('?mod=exportSupAjax&site=ajax_add_export',{'submit': 1}).done(function(data){
		window.location.href = data;
		return false;
	});
}

function RemoveExport(eid){
	$.post('?mod=exportSupAjax&site=ajax_remove_export',{'eid': eid}).done(function(data){
		window.location.href = data;
		return false;
	});
}

function SetExportValue(eid, item, value){
	$.post('?mod=exportSupAjax&site=ajax_set_export_value',{'eid': eid, 'item': item, 'value': value}).done(function(data){
		if(data=='discount' || data=='discount_type')
			GetTotalSession(eid);
		else if(data=='payment')
			GetTotalSession(eid, 1);
		return false;
	});
}

function GetOrderDetail(eid) {
    //console.log(data);
    $("#orderDetail .modal-body").load("?mod=exportSupAjax&site=ajax_get_export_session_detail", {'eid': eid});
}

// Ham xu ly them san pham vao hoa don nhap hang
function AddProduct(eid, id){
	id = parseInt(id);
	if(id==0 || id < 0){
		return false;
	}
	$.post('?mod=exportSupAjax&site=ajax_add_product_session',{'eid': eid, 'id': id})
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

function UpdateNumberProduct(eid, id, type, number, max){
	id = parseInt(id);
	if(id==0 || id < 0){
		return false;
	}
	
//	if(number > max && config.export_alway==0){
//		alert('Số lượng không được vượt quá tồn kho.');
//		number = max;
//	}
	if(number<1){
		alert("Số lượng không được nhỏ hơn 1 !");
		number = 1;
	}
	// Xoa field vua duoc them
	$.post('?mod=exportSupAjax&site=ajax_update_product_number',{'eid': eid, 'id': id, 'type':type, 'number': number})
	.done(function(data){
		var data = JSON.parse(data);
		if(data.is_max == '1' && config.export_alway==0){
			alert('Số lượng không được vượt quá tồn kho.');
			$("#proUnit"+id).val(data.unit_level);
			UpdateProductUnit(id, data.unit_level, eid);
		}
		if(type=='delete'){
			$("#proNo"+id).remove();
			//LoadProduct();
		}
		else{
			$("#proNumber"+id).val(data.number);
			$("#proTotal"+id).html(data.total_item);
		}
		GetTotalSession(eid);
	});
	
}

function UpdateWarrantyProduct(eid, id, number){
	id = parseInt(id);
	if(id==0 || id < 0){
		return false;
	}
	
	if(number<0){
		alert("Thời gian bảo hành không được nhỏ hơn 1 tháng !");
		number = 1;
	}
	$.post('?mod=exportSupAjax&site=ajax_update_product_warranty',{'eid': eid, 'id': id, 'warranty': number})
	.done(function(data){
		$("#proWarranty"+id).val(number);
	});
	
}

function UpdateDescriptionProduct(eid, id, number){
	id = parseInt(id);
	if(id==0 || id < 0){
		return false;
	}
	$.post('?mod=exportSupAjax&site=ajax_update_product_description',{'eid': eid, 'id': id, 'description': number})
	.done(function(data){
		$("#proDescription"+id).val(data);
	});
}

function SetValueDescripton(eid, id){
	$.post('?mod=exportSupAjax&site=ajax_update_product_description',{'eid': eid, 'id': id})
	.done(function(data){
		$("#proDescription"+id).val(data);
	});
}

function UpdatePriceSale(eid,number){
	$.post('?mod=exportSupAjax&site=ajax_update_price_sale',{'eid': eid, 'price_sale': number})
	.done(function(data){
		alert('Thay đổi hình thức thanh toán thành công');
		GetTotalSession(eid);
		location.reload();
	});
}

function UpdateProductPrice(eid, id){
	var price = $("#proPrice"+id).val().replace(",", "");
	$.post('?mod=exportSupAjax&site=ajax_update_product_price',{'eid': eid, 'id': id, 'price':price}).done(function(data){
		var data = JSON.parse(data);
		$("#proPrice"+id).val(data.price);
		$("#proTotal"+id).html(data.total_item);
		GetTotalSession(eid);
	});
}

function UpdateProductUnit(id, level, eid){
	$.post('?mod=exportSupAjax&site=ajax_update_product_unit',{'eid': eid, 'id': id, 'level':level}).done(function(data){
		var data = JSON.parse(data);
		if(data.is_max==1){
			alert("So luong cho don vi nay khong du. Vui long lua chon don vi nho hon.");
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
	$.post('?mod=exportSupAjax&site=ajax_get_id_from_code',{'eid':eid, 'code':code})
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


function Refresh(){
	$.post('?mod=exportSupAjax&site=ajax_refresh')
	.done(function(rt){
		$("#ExportCode").val(rt);
		LoadProduct();
		$("#Products tbody").html('');
		$("#Service tbody").html('');
		$("#showService").addClass("display-none");
		GetTotalSession();
	});
	$("#UseBarcode").focus();
}


function LoadProduct(eid){
	var post = {};
	post['cate'] = $("#FilterCate").val();
	post['trade'] = $("#FilterTrademark").val();
	post['orig'] = $("#FilterOrigin").val();
	post['key'] = $("#FilterKey").val();
	post['eid'] = eid;
	
	$.post('?mod=exportSupAjax&site=ajax_load_product', post).done(function(data){
		$("#ProductList").html(data);
	});
}


function AddCustomer(){
	$("#show-loading").show();
	var customer_group = $("#customer_group").val();
	var customer_code = $("#customer_code").val();
	var customer_name = $("#customer_name").val();
	var customer_phone = $("#customer_phone").val();
	var customer_address = $("#customer_address").val();
	$.post('?mod=customer&site=ajax_add_customer', {'submit':1, 'group':customer_group, 'code':customer_code, 'name':customer_name, 'phone':customer_phone, 'address':customer_address})
	.done(function(data){
		$("#show-loading").hide();
		if(data=='fail'){
			alert('Khong thanh cong');
			return false;
		}
		else{
			alert('them khach hang thanh cong');
			location.reload();
			return false;
		}
	});
}


function AddServices(eid, id){
	$.post('?mod=exportSupAjax&site=ajax_add_service_session',{'eid': eid, 'id': id}
	).done(function(data){
		$("#showService").removeClass("display-none");
		$("#serChoice"+id).remove();
		$("#Service tbody").append(data);
		GetTotalSession(eid);
	});
}


function ServiceUpdateNumber(eid, id, type, number){
	if(type==null)
		type = "add";
	if(number==null)
		number = 1;
	if(number < 1)
		number = 1;
	$.post('?mod=exportSupAjax&site=ajax_service_update_number',{'eid': eid, 'id': id, 'type':type, 'number':number}
	).done(function(data){
		var data = JSON.parse(data);
		if(type=='delete'){
			$('#serNo'+id).remove();
			if(data.item_number=='0')
				$("#showService").addClass("display-none");
		}
		else{
			$("#serNumber"+id).val(data.number);
			$("#serTotal"+id).html(data.total_item);
		}
		GetTotalSession(eid);
	});
}


function ServiceUpdatePrice(eid, id){
	var price = $("#serPrice"+id).val().replace(",", "");
	$.post('?mod=exportSupAjax&site=ajax_service_update_price',{'eid': eid, 'id': id, 'price':price}).done(function(data){
		var data = JSON.parse(data);
		$("#serPrice"+id).val(data.price);
		$("#serTotal"+id).html(data.total_item);
	});
	GetTotalSession(eid);
}


function LoadService(eid){
	$.post('?mod=exportSupAjax&site=ajax_load_services', {'eid':eid}).done(function(data){
		$("#ServicesChoice").html(data);
	});
}
function ServiceUpdateTime(eid, id, time){
	if(time==null || time < 0) time = 0;
	$.post('?mod=exportSupAjax&site=ajax_service_update_time',{'eid': eid, 'id': id, 'time':time}).done(function(data){
		var data = JSON.parse(data);
		if(data.check == false)
		{
			alert('Nhập sai định dạng giờ. Cần nhập lại theo định dạng 0h00');
			$("#serTime"+id).val('0h00');
			ServiceUpdateTime(eid, id, '0h00');
		}
		console.log(data);
		$("#serTotal"+id).html(data.total_item);
		GetTotalSession(eid);
	});
}

function GetTotalSession(eid, is_payment){
	if(eid==0){
		$("#SaveExport").hide();
		$(".oder").hide();
		return false;
	}
	$.post('?mod=exportSupAjax&site=ajax_get_total_session', {'eid':eid, 'is_payment':is_payment}).done(function(data){
		var data = JSON.parse(data);
		$("input[name=m_total]").val(data.total);
		$("input[name=m_total_must_pay]").val(data.total_must_pay);
		$("input[name=payment]").val(data.total_payment);
		$("input[name=debt]").val(data.debt);
		$("#product-total span").html(data.total_product);
		$("#service-total span").html(data.total_service);
		var number = data.total.replace(",", "");
		if(parseInt(number)>0) $("#SaveExport").show();
		else $("#SaveExport").hide();
		
		if(data.number_services>0) $("#showService").show();
		else $("#showService").hide();
	});
}

