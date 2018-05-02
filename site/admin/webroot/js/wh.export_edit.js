
// Ham xu ly them san pham vao hoa don nhap hang
function AddProduct(mid, id){
	id = parseInt(id);
	if(id==0 || id < 0){
		return false;
	}
	$.post('?mod=exportEditAjax&site=ajax_add_product_session',{'id': id, 'mid':mid})
	.done(function(data){
		if(data=='0'){
			return false;
		}
		$("#prd" + id).remove();
		$("#Products tbody").prepend(data);
		GetTotalSession(mid);
		$('[data-toggle="popover"]').popover();
	});
	
}
function UpdatePriceSale(mid,number){
	$.post('?mod=ExportEditAjax&site=ajax_update_price_sale',{'mid': mid, 'price_sale': number})
	.done(function(data){
		alert('Thay đổi hình thức thanh toán thành công');
		GetTotalSession(mid);
		location.reload();
	});
}
function UpdateDescriptionProduct(mid, id, value)
{
	id = parseInt(id);
	if(id==0 || id < 0){
		return false;
	}
	$.post('?mod=exportEditAjax&site=ajax_update_product_description',{'mid': mid, 'id': id, 'description': value})
	.done(function(data){
		$("#proDescription"+id).val(data);
	});
}
function SetValueDescripton(mid, id){
	$.post('?mod=exportEditAjax&site=ajax_update_product_description',{'mid': mid, 'id': id})
	.done(function(data){
		$("#proDescription"+id).val(data);
	});
}


function UpdateNumberProduct(mid, id, type, number, max){
	id = parseInt(id);
	if(id==0 || id < 0){
		return false;
	}
	if(number<1){
		alert("Số lượng không được nhỏ hơn 1 !");
		number = 1;
	}
	// Xoa field vua duoc them
	$.post('?mod=exportEditAjax&site=ajax_update_product_number',{'mid':mid, 'id': id, 'type':type, 'number': number})
	.done(function(data){
		var data = JSON.parse(data);
		if(data.is_max == '1' && config.export_alway==0){
			alert('Số lượng không được vượt quá tồn kho.');
			$("#proUnit"+id).val(data.unit_level);
			//UpdateProductUnit(id, data.unit_level);
		}
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

function UpdateProductPrice(mid, id){
	var price = $("#proPrice"+id).val();
	$.post('?mod=exportEditAjax&site=ajax_update_product_price',
	{'id': id, 'price':price, 'mid':mid}).done(function(data){
		var data = JSON.parse(data);
		$("#proPrice"+id).val(data.price);
		$("#price_sell"+id).html(data.price_sell);
		$("#proTotal"+id).html(data.total_item);
		GetTotalSession(mid);
	});
}
function UpdatePercent(mid, id) {
	var percent = $("#propercent" + id).val();
	$.post('?mod=exportEditAjax&site=ajax_update_percent', {
		'mid': mid,
		'id': id,
		'percent': percent
	}).done(function (data) {
		var data = JSON.parse(data);
		$("#propercent" + id).val(data.percent);
		$("#price_sell"+id).html(data.price);
		$("#proTotal" + id).html(data.total_item);
		GetTotalSession(mid);
	});
}

function UpdateProductUnit(id, level, mid){
	$.post('?mod=exportEditAjax&site=ajax_update_product_unit',{'id': id, 'level':level, 'mid':mid}).done(function(data){
		var data = JSON.parse(data);
		if(data.is_max==1){
			alert("Number is not true.");
			$("#proUnit"+id).val(data.level);
			UpdateProductUnit(id, data.level, mid);
		}
		else{
			$("#proPrice"+id).val(data.price);
			$("#proTotal"+id).html(data.total_item);
			$("#proNumber"+id).val(1);
		}
		GetTotalSession(mid);
	});
}

function GetProductFromBarcode(mid, code){
	$.post('?mod=exportEditAjax&site=ajax_get_id_from_code',{'code':code, 'mid':mid})
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


function Refresh(mid){
	$.post('?mod=export&site=ajax_refesh_export_modify', {'mid':mid})
	.done(function(rt){
		if(rt=='1')
			window.location.reload();
		return false;
	});
}


function RemoveExport(mid){
	$.post('?mod=exportEditAjax&site=ajax_remove_export', {'mid':mid})
	.done(function(rt){
		if(rt=='1')
			window.location.href = "?mod=export&site=statistics";
		return false;
	});

}


function LoadProduct(mid){
	var post = {};
	post['cate'] = $("#FilterCate").val();
	post['trade'] = $("#FilterTrademark").val();
	post['orig'] = $("#FilterOrigin").val();
	post['key'] = $("#FilterKey").val();
	post['mid'] = mid;
	
	$.post('?mod=exportEditAjax&site=ajax_load_product',post)
	.done(function(data){
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


function AddServices(mid, id){
	$.post('?mod=exportEditAjax&site=ajax_add_service_session',{'id': id, 'mid':mid}
	).done(function(data){
		$("#showService").removeClass("display-none");
		$("#serChoice"+id).remove();
		$("#Service tbody").append(data);
		GetTotalSession(mid);
	});
}


function ServiceUpdateNumber(mid, id, type, number){
	if(type==null)
		type = "add";
	if(number==null)
		number = 1;
	if(number < 1)
		number = 1;
	$.post('?mod=exportEditAjax&site=ajax_service_update_number',{'id': id, 'type':type, 'number':number, 'mid':mid}
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
		GetTotalSession(mid);
	});
}


function ServiceUpdatePrice(mid, id){
	var price = $("#serPrice"+id).val().replace(",", "");
	$.post('?mod=exportEditAjax&site=ajax_service_update_price',{'id': id, 'price':price, 'mid':mid}).done(function(data){
		var data = JSON.parse(data);
		$("#serPrice"+id).val(data.price);
		$("#serTotal"+id).html(data.total_item);
	});
	GetTotalSession(mid);
}


function LoadService(mid){
	$.post('?mod=exportEditAjax&site=ajax_load_services',{'mid':mid}).done(function(data){
		$("#ServicesChoice").html(data);
	});
}


function SetExportValue(eid, item, value){
	$.post('?mod=exportEditAjax&site=ajax_set_export_value',{'eid': eid, 'item': item, 'value': value}).done(function(data){
		GetTotalSession(eid);
		return false;
	});
}


function SetCustomerDiscount(value){
	$.post("?mod=customer&site=ajax_load_group_discount", {'id':value}).done(function (data) {
		var data = JSON.parse(data);
		$("input[name=discount]").val(data.discount).change();
		$("select[name=discount_type]").html(data.select_discount_type).change();
	});
}


function GetTotalSession(mid){
	$.post('?mod=exportEditAjax&site=ajax_get_total_session', {'mid':mid}).done(function(data){
		var data = JSON.parse(data);
		$("input[name=m_total]").val(data.total);
		$("input[name=m_total_must_pay]").val(data.total_must_pay);
		$("input[name=debt]").val(data.debt);
		if(data.debt_type < 0) $("#type").show();
		else $("#type").hide();
		$("#product-total span").html(data.total_product);
		$("#service-total span").html(data.total_service);
		var number = data.total.replace(",", "");
		if(parseInt(number)>0) $("#SaveExport").show();
		else $("#SaveExport").hide();
		
		if(data.number_services>0) $("#showService").show();
		else $("#showService").hide();

	});
}


function UpdateWarrantyProduct(mid, id, number){
	id = parseInt(id);
	if(id==0 || id < 0){
		return false;
	}
	
	if(number<0){
		alert("Thời gian bảo hành không được nhỏ hơn 1 tháng !");
		number = 1;
	}
	$.post('?mod=exporteditAjax&site=ajax_update_product_warranty',{'mid': mid, 'id': id, 'warranty': number})
	.done(function(data){
		$("#proWarranty"+id).val(number);
	});
	
}
function ServiceUpdateTime(mid, id, time){
	if(time==null || time < 0) time = 0;
	$.post('?mod=exporteditAjax&site=ajax_service_update_time',{'mid': mid, 'id': id, 'time':time}).done(function(data){
		var data = JSON.parse(data);
		if(data.check==false)
		{
			alert('Nhập sai định dạng giờ. Cần nhập lại theo định dạng 0h00');
			$("#serTime"+id).val('0h00');
			ServiceUpdateTime(mid, id, '0h00');
		}
		$("#serTotal"+id).html(data.total_item);
		GetTotalSession(mid);
	});
}
