function SetExportValue(item, value){
	$.post('./admin?mc=import&site=ajax_set_export_value',{'item': item, 'value': value}).done(function(data){
		console.log(data);
		if(data=='discount_type' || data=='discount'){
			GetTotalSession();
		}
		else if(data=='payment'){
			GetTotalSession(1);
		}
		return false;
	});
}

function LoadProduct(){
	var post = {};
	post['key'] = $("input[name=FilterKey]").val();

	post['cate'] = $("select[name=FilterCate]").val();
	post['trade'] = $("select[name=FilterTrademark]").val();

	// console.log(post);
	$.post('./admin?mc=import&site=ajax_load_product',post)
	.done(function(data){
		$("#ProductList").html(data);
	});
}


function AddProduct(id){
	id = parseInt(id);
	if(id==0 || id < 0){
		return false;
	}
	$.post('./admin?mc=import&site=ajax_add_product_session',{'id': id})
	.done(function(data){
		if(data=='0'){
			return false;
		}
		$("#prd" + id).remove();
		$("#Products tbody").prepend(data);
		LoadProduct();
		GetTotalSession();
	});

}

function UpdateNumberProduct(id, type, number){
	id = parseInt(id);
	if(id==0 || id < 0){
		return false;
	}
	if(number<1){
		alert("Số lượng không được nhỏ hơn 1 !");
		number = 1;
	}
	$.post('./admin?mc=import&site=ajax_update_product_number',{'id': id, 'type':type, 'number': number})
	.done(function(data){
		var data = JSON.parse(data);
		if(type=='delete'){
			$("#proNo"+id).remove();
			LoadProduct();
		}
		else{
			$("#proNumber"+id).val(data.number);
			$("#proTotal"+id).html(data.total_item);
		}
		GetTotalSession();
	});

}


function UpdateProductPrice(id, price){
	$.post('./admin?mc=import&site=ajax_change_product_price',
			{'id':id, 'price':price}
	).done(function(data){
		var data = JSON.parse(data);
		$("#proPrice"+id).val(data.price);
		$("#proTotal"+id).html(data.total);
		LoadDataForFormUpdatePrice(id);
		GetTotalSession();
	});

}

// function UpdatePercent(id,percent){
// 	$.post('?mod=import&site=ajax_change_product_percent',
// 		{'id':id, 'percent':percent}
// 	).done(function(data){
// 		var data = JSON.parse(data);
// 		$("#price_sell"+id).html(data.price);
// 		$("#proTotal"+id).html(data.total);
// 		GetTotalSession();
// 	});

// }

// function UpdateDescriptionProduct(id, value)
// {
// 	id = parseInt(id);
// 	if(id==0 || id < 0){
// 		return false;
// 	}

// 	console.log(value);
// 	$.post('?mod=import&site=ajax_update_product_description',{'id': id, 'description': value})
// 	.done(function(data){
// 		$("#proDescription"+id).val(data);
// 	});
// }

// function SetValueDescripton(id){
// 	$.post('?mod=import&site=ajax_update_product_description',{'id': id})
// 	.done(function(data){
// 		console.log(data);
// 		$("#proDescription"+id).val(data);
// 	});
// }

function LoadDataForFormUpdatePrice(id) {
	$("#UpdateExportPrice input[type=text]").val('');
	$.post("./admin?mc=product&site=ajax_load_price_item", {'id' : id}).done(function(data) {
		var data = JSON.parse(data);
		console.log(data);
		$("#UpdateExportPrice input[name=id]").val(data.id);
		$("#UpdateExportPrice #uxp_name").html(data.name);
		$("#UpdateExportPrice input[name=price_import]").val(data.price_import);
		$("#UpdateExportPrice input[name=price]").val(data.price);
	});
	$("#UpdateExportPrice").modal("show");
}


function SaveExportPrice(){
	var data = {};
	data['id'] = $("#UpdateExportPrice input[name=id]").val();
	data['price'] = $("#UpdateExportPrice input[name=price]").val();
	$.post("./admin?mc=product&site=ajax_saved_price", data).done(function() {
		$("#UpdateExportPrice").modal("hide");
	});
}


// function UpdateProductUnit(id, level){
// 	$.post('?mod=import&site=ajax_update_product_unit',{'id': id, 'level':level}).done(function(data){
// 		var data = JSON.parse(data);
// 		$("#proPrice"+id).val(data.price);
// 		$("#price_sell"+id).html(data.price_sell);
// 		$("#proTotal"+id).html(data.total_item);
// 		$("#proNumber"+id).val(1);
// 		GetTotalSession();
// 	});
// }


// function GetProductFromBarcode(code){
// 	$.post('?mod=import&site=ajax_get_id_from_code',{'code':code})
// 	.done(function(rt){
// 		$("#UseBarcode").val('');
// 		if(rt=='0'){
// 			alert('Khong ton tai san pham');
// 			return false;
// 		}
// 		else{
// 			var data = JSON.parse(rt);
// 			if(data.exists=='0'){
// 				AddProduct(data.id);
// 				return false;
// 			}
// 			else{
// 				UpdateNumberProduct(data.id, 'add', 1);
// 				return false;
// 			}
// 		}
// 	});

// }

// function UpdateExpiry(id, date){
// 	$.post('?mod=import&site=ajax_update_expiry',{'id': id, 'date':date}).done(function(){});
// }

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
	$.post('?mod=import&site=ajax_set_warehouse_import',{'type':'delete', 'id': id})
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





function Refresh(){
	$.post('./admin?mc=import&site=ajax_refresh')
	.done(function(rt){
		LoadProduct();
		$("#Products tbody").html('');
		GetTotalSession();
	});
}

function GetTotalSession(is_payment){
	$.post('./admin?mc=import&site=ajax_get_total_session', {'is_payment':is_payment}).done(function(data){
		var data = JSON.parse(data);
		console.log(data);
		$("input[name=m_total]").val(data.total);
		$("input[name=m_total_must_pay]").val(data.total_must_pay);
		$("input[name=payment]").val(data.payment);
		$("input[name=debt]").val(data.debt);
		// $("#product-total span").html(data.total_product);
		// $("#service-total span").html(data.total_service);
		var number = data.total.replace(",", "");
		if(parseInt(number)>0) $("#SaveExport").show();
		else $("#SaveExport").hide();
	});
}

