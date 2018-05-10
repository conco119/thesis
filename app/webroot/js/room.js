function AddNewExport(){
	$.post('?mod=roomAjax&site=ajax_add_export',{'submit': 1}).done(function(data){
		window.location.href = data;
		return false;
	});
}

function RemoveExport(eid){
	$.post('?mod=roomAjax&site=ajax_remove_export',{'eid': eid}).done(function(data){
		return false;
	});
}

function SetExportValue(eid, item, value){
	$.post('?mod=roomAjax&site=ajax_set_export_value',{'eid': eid, 'item': item, 'value': value}).done(function(data){
		if(item=='discount' || item=='discount_type')
			GetTotalSession(eid);
		else if(item=='payment')
			GetTotalSession(eid, 1);
		
		console.log(data);
		return data;
	});
}


function StartTime(eid, status){
	$.post('?mod=roomAjax&site=ajax_set_export_room_status',{'eid': eid, 'status': status}).done(function(data){
		return false;
	});
}


// Ham xu ly them san pham vao hoa don nhap hang
function AddProduct(eid, id){
	id = parseInt(id);
	if(id==0 || id < 0){
		return false;
	}
	$.post('?mod=roomAjax&site=ajax_add_product_session',{'eid': eid, 'id': id})
	.done(function(data){
		if(data=='0'){
			return false;
		}
		$("#prd" + id).remove();
		$("#Products tbody").prepend(data);
		GetTotalSession(eid);
		LoadProduct(eid);
	});
	
}

function UpdateNumberProduct(eid, id, type, number, max){
	id = parseInt(id);
	if(id==0 || id < 0)
		return false;
	if(number < 0){
		alert("Số lượng không được âm !");
		number = 0;
	}
	// Xoa field vua duoc them
	$.post('?mod=roomAjax&site=ajax_update_product_number',{'eid': eid, 'id': id, 'type':type, 'number': number})
	.done(function(data){
		var data = JSON.parse(data);
		
		if(data.is_max == '1' && config.export_alway==0){
			alert('Số lượng không được vượt quá tồn kho.');
			$("#proUnit"+id).val(data.unit_level);
			$("#proNumber"+id).val(0);
			UpdateProductUnit( id, data.unit_level, eid);
			return false;
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
	$.post('?mod=roomAjax&site=ajax_update_product_warranty',{'eid': eid, 'id': id, 'warranty': number})
	.done(function(data){
		$("#proWarranty"+id).val(number);
	});
	
}

function UpdateDescriptionProduct(eid, id, number){
	id = parseInt(id);
	if(id==0 || id < 0){
		return false;
	}
	$.post('?mod=roomAjax&site=ajax_update_product_description',{'eid': eid, 'id': id, 'description': number})
	.done(function(data){
		$("#proDescription"+id).val(number);
	});
}

function UpdatePriceSale(eid,number){
	$.post('?mod=roomAjax&site=ajax_update_price_sale',{'eid': eid, 'price_sale': number})
	.done(function(data){
		alert('Thay đổi hình thức thanh toán thành công');
		GetTotalSession(eid);
		location.reload();
	});
}

function UpdateProductPrice(eid, id){
	var price = $("#proPrice"+id).val().replace(",", "");
	$.post('?mod=roomAjax&site=ajax_update_product_price',{'eid': eid, 'id': id, 'price':price}).done(function(data){
		var data = JSON.parse(data);
		$("#proPrice"+id).val(data.price);
		$("#proTotal"+id).html(data.total_item);
		GetTotalSession(eid);
	});
}

function UpdateProductUnit( id,level,eid){
	$.post('?mod=roomAjax&site=ajax_update_product_unit',{'eid': eid, 'id': id, 'level':level}).done(function(data){
		var data = JSON.parse(data);
		if(data.is_max==1){
			alert("Số lượng không vượt quá số lượng tồn kho");
			$("#proUnit"+id).val(data.level);
			UpdateProductUnit( id, data.level, eid);
		}
		else{
			$("#proPrice"+id).val(data.price);
			$("#proTotal"+id).html(data.total_item);
			$("#proNumber"+id).val(0);
		}
		GetTotalSession(eid);
	});
}

function GetProductFromBarcode(eid, code){
	$.post('?mod=roomAjax&site=ajax_get_id_from_code',{'eid':eid, 'code':code})
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


function Refresh(eid, reload){
	$.post('?mod=room&site=ajax_refresh', {'eid':eid})
	.done(function(rt){
		$("#ExportCode").val(rt);
		LoadProduct(eid);
		$("#Products tbody").html('');
		$("#Service tbody").html('');
		$("#showService").addClass("display-none");
		GetTotalSession(eid);
		if(reload == '1'){
			location.reload();
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
	
	$.post('?mod=roomAjax&site=ajax_load_product', post).done(function(data){
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
	$.post('?mod=roomAjax&site=ajax_add_service_session',{'eid': eid, 'id': id}
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
	$.post('?mod=roomAjax&site=ajax_service_update_number',{'eid': eid, 'id': id, 'type':type, 'number':number}
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

function ServiceUpdateTime(eid, id, time){
	if(time==null || time < 0) time = 0;

	$.post('?mod=roomAjax&site=ajax_service_update_time',{'eid': eid, 'id': id, 'time':time}).done(function(data){
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

function ServiceUpdatePrice(eid, id){
	var price = $("#serPrice"+id).val().replace(",", "");
	$.post('?mod=roomAjax&site=ajax_service_update_price',{'eid': eid, 'id': id, 'price':price}).done(function(data){
		var data = JSON.parse(data);
		$("#serPrice"+id).val(data.price);
		$("#serTotal"+id).html(data.total_item);
	});
	GetTotalSession(eid);
}


function LoadService(eid){
	$.post('?mod=roomAjax&site=ajax_load_services', {'eid':eid}).done(function(data){
		$("#ServicesChoice").html(data);
	});
}


function GetTotalSession(eid, is_payment){
	if(eid==0){
		$("#SaveExport").hide();
		$(".oder").hide();
		return false;
	}
	$.post('?mod=roomAjax&site=ajax_get_total_session', {'eid':eid, 'is_payment':is_payment}).done(function(data){
		var data = JSON.parse(data);
		
		$("input[name=m_total]").val(data.total);
		$("input[name=m_total_must_pay]").val(data.total_must_pay);
		$("input[name=payment]").val(data.total_payment);
		$("input[name=debt]").val(data.debt);
		$("#product-total span").html(data.total_product);
		$("#service-total span").html(data.total_service);
		var number = data.total.replace(",", "");
		if(parseInt(number)>0 && data.status=='3') 
			$("#SaveExport").show();
		else 
			$("#SaveExport").hide();
		
		if(data.number_services>0) 
			$("#showService").show();
		else 
			$("#showService").hide();
	});
}


/** -----------------------------
 *  Default Products (Prod4Setup)
 *  ----------------------------- */

function LoadProduct4Setup(){
	var post = {};
	post['cate'] = $("#FilterCate").val();
	post['trade'] = $("#FilterTrademark").val();
	post['orig'] = $("#FilterOrigin").val();
	post['key'] = $("#FilterKey").val();

	$.post('?mod=roomAjax&site=ajax_load_prod4setup', post).done(function(data){
		$("#ProductList").html(data);
	});
}

function AddProd4Setup(id){
	id = parseInt(id);
	if(id==0 || id < 0){
		return false;
	}
	$.post('?mod=roomAjax&site=ajax_add_prod4setup',{'id': id})
		.done(function(data){
			if(data=='0'){
				return false;
			}
			$("#prd" + id).remove();
			$("#Products tbody").prepend(data);
			LoadProduct4Setup();
		});

}

function RemoveProd4Setup(id) {
	id = parseInt(id);

	$.post('?mod=roomAjax&site=ajax_remove_prod4setup',{'id': id})
		.done(function() {
			console.log(id);
			$("#prodNo"+id).remove();
		});
}


/**
 * ---------------------BUILD FOR RUN TIME-----------------
 * 
 * 
 */

function HlsRunTime(obj){
	var started = $("#TimeEX").attr('data-started');
	var finished = $("#TimeEX").attr('data-finish');
	var price = $("#MoneyEX").attr('data-price');
	
	setInterval(function(){
		var current_time = finished;
		if(finished=='0'){
			current_time = new Date().getTime();
			current_time = current_time.toString().slice(0, -3);
		}
		var time = parseInt(current_time) - parseInt(started);
		
		var value = ConvertTime(time);
		$("#TimeEX").val(value);
		
		var new_time = parseInt(time / 60);
		var money = (parseInt(price) * new_time) / 60;
		money = ConvertMoney(money);
		$("#MoneyEX").val(money=='' ? 0 : money);
		
	}, 1000);
}

function ConvertTime(time){
	time = parseInt(time);
	var h = 0;
	var m = 0;
	var s = 0;
	
	var out_h = time;
	if(time > 3600){
		h = parseInt(time / 3600);
		out_h = time % 3600;
	}
	m = parseInt(out_h / 60);
	
	s = out_h % 60;
	
	if(h < 10) h = "0" + h;
	if(m < 10) m = "0" + m;
	if(s < 10) s = "0" + s;
	
	return h + ":" + m + ":" + s;
}

function HlsRunMoney(obj){
	var price = $(obj).attr('data-price');
	var started = $(obj).attr('data-started');
	
	setInterval(function(){
		var current_time = new Date().getTime();
		current_time = current_time.toString().slice(0, -3);
		var time = parseInt(current_time) - parseInt(started);
		var new_time = parseInt(time / 60);
		var money = (parseInt(price) * new_time) / 60;
		money = ConvertMoney(money);
		
		$(obj).val(money);
	}, 1000);
}
// Trang viết js 
function LoadInfo(eid, status){
	var id_change = $("#select_change"+eid).val();
	$.post("?mod=RoomAjax&site=ajax_load_info", {'eid': eid,'status':status, 'id_change': id_change}).done(function (data)
	{
	$("#tbody_info").html(data);
    $("#ItemInfo").attr("onclick", "UpdateRoomStatus(" + eid + ", " + status + ")");
    
});
}

function DisplayButton(id, status){
	$("#RoomBtn"+id+" a").hide();
	$("#RoomBtn"+id+" button").hide();
	if(status==0){
		$("#RoomBooking"+id).show();
		$("#RoomStart"+id).show();
	}
	else if(status==1){
		$("#RoomUpdate"+id).show();
		$("#RoomChange"+id).show();
		$("#RoomCancel"+id).show();
	}
	else if(status==2){
		$("#RoomStart"+id).show();
		$("#RoomCancel"+id).show();
	}
	else if(status==3) {
		$("#RoomUpdate" + id).show();
		$("#RoomPending" + id).show();
		//$("#RoomFinish"+id).show();
	}else if(status==5){
		$("#RoomChangeRoom" + id).show();
		$("#select_change" + id).show();
		$("#RoomCancelRoom" + id).show();
	}
	else if(status==6){
		$("#RoomBooking"+id).show();
		$("#RoomStart"+id).show();
	}
	else if(status==7){
		$("#RoomUpdate"+id).show();
		$("#RoomChange"+id).show();
		$("#RoomCancel"+id).show();
		$("#select_change" + id).hide();
	}


	var stt_icon = GetRoomStatusIcon(status);
	$("#RoomStatus"+id).html(stt_icon);
}

