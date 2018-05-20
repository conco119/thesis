
function SetExportValue(item, value)
{
	$.post('./admin?mc=exportajax&site=ajax_set_export_value',{'item': item, 'value': value}).done(function(data)
	{
		console.log(data);
		if(data=='discount_type' || data=='discount')
		{
			GetTotalSession();
		}
		else if(data=='payment')
		{
			GetTotalSession(1);
		}
		return false;
	});
}

// Ham xu ly them san pham vao hoa don nhap hang
function AddProduct(id){
	id = parseInt(id);
	if(id==0 || id < 0)
	{
		return false;
	}
	$.post('./admin?mc=exportajax&site=ajax_add_product_session',{'id': id})
	.done(function(data){
		if(data=='0'){
			return false;
		}
		data = JSON.parse(data);
		let prepend = `
			<tr id="proNo${data.id}">
				<td>#</td>
				<td>${data.code}</td>
				<td>${data.name}</td>
				<td class="text-right">
					<input type="text" class="prod-price" style="margin-bottom:5px;  "
					value="${data.price}" disabled>
				</td>
				<td class='text-center'>
					${data.unit_name}
				</td>
				<td class="text-center">
					<input type="number" class="prod-number" id="proNumber${data.id}" onchange="UpdateNumberProduct(${data.id}, this.value, ${data.max_number});" value="1">
				</td>
				<td class="text-right" id="proTotal${data.id}">${data.price} đ</td>
				<td class="text-right"><button class="btn btn-danger" onclick="DeleteProductBill(${data.id})">
						<i class="fa fa-times-circle"></i>
					</button>
				</td>
			</tr>
		`;
		$("#Products tbody").append(prepend);
		LoadProduct();
		GetTotalSession();
	});
}

function DeleteProductBill(id)
{
	$.post('./admin?mc=exportajax&site=delete_product_bill',{'id': id})
	.done(function(data){
			$("#proNo"+id).remove();
			// LoadProduct();
			GetTotalSession();
	});
}

function UpdateNumberProduct(id, number, max){

	id = parseInt(id);
	if(id==0 || id < 0)
	{
		return false;
	}

	if(number<1)
	{
		alert("Số lượng không được nhỏ hơn 1 !");
		number = 1;
	}
	// Xoa field vua duoc them
	$.post('./admin?mc=exportajax&site=ajax_update_product_number',{'id': id, 'number': number})
	.done(function(data){
		console.log(data);
		var data = JSON.parse(data);
		if(number > max)
		{
			alert('Số lượng không được vượt quá tồn kho.');
		}

		$("#proNumber"+id).val(data.number);
		$("#proTotal"+id).html(data.total_item_money);
		GetTotalSession();
	});

}





function SetValueDescripton(eid, id){
	$.post('?mod=exportAjax&site=ajax_update_product_description',{'eid': eid, 'id': id})
	.done(function(data){
		$("#proDescription"+id).val(data);
	});
}









function Refresh(){
	$.post('?mod=exportAjax&site=ajax_refresh')
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


function LoadProduct(){
	var post = {};
	post['cate'] = $("#FilterCate").val();
	post['trade'] = $("#FilterTrademark").val();
	post['key'] = $("#FilterKey").val();

	$.post('./admin?mc=exportajax&site=ajax_load_product', post).done(function(data){
		$("#ProductList").html(data);
	});
}



function LoadService(){
	$.post('./admin?mc=exportajax&site=ajax_load_services').done(function(data){
		console.log(data);
		$("#ServicesChoice").html(data);
	});
}

function AddServices(id){
	$.post('./admin?mc=exportajax&site=ajax_add_service_session',{'id': id}
	).done(function(data){
		data = JSON.parse(data)
		let append = `
			<tr id="serNo${data.id}">
				<td>#</td>
				<td>${data.name}</td>
				<td class="text-right"><input type="text" class="prod-price" value="${data.price}" disabled></td>
				<td class="text-center"><input type="number" class="prod-number" id="serNumber${data.id}"
					onchange="ServiceUpdateNumber(${data.id}, this.value);" value="1">
				</td>
				<td class="text-right" id="serTotal${data.id}">${data.price} đ</td>
				<td class="text-right"><button type="button" class="btn btn-danger" onclick="DeleteServiceBill(${data.id});">
						<i class="fa fa-times-circle"></i>
					</button>
				</td>
			</tr>
		`;
		// $("#showService").show("display-none");
		$("#serChoice"+id).remove();
		LoadService();
		$("#Service tbody").append(append);
		GetTotalSession();
	});
}

function DeleteServiceBill(id)
{
	$.post('./admin?mc=exportajax&site=ajax_delete_service_bill',{'id': id}
	).done(function(data){
		var data = JSON.parse(data);
		$('#serNo'+id).remove();
		if(data.item_number == '0')
			$("#showService").addClass("display-none");
		GetTotalSession();
	});
}
function ServiceUpdateNumber(id, number){
	if(number < 1)
	{
		alert("Số lượng không được nhỏ hơn 1 !");
		number = 1;
	}

	$.post('./admin?mc=exportajax&site=ajax_service_update_number',{'id': id, 'number':number}
	).done(function(data){
		var data = JSON.parse(data);
		$("#serNumber"+id).val(data.number);
		$("#serTotal"+id).html(data.total_money);
		GetTotalSession();
	});
}





function GetTotalSession(is_payment){
	$.post('./admin?mc=exportajax&site=ajax_get_total_session', {'is_payment':is_payment}).done(function(data){
		var data = JSON.parse(data);
		$("input[name=m_total]").val(data.total);
		$("input[name=m_total_must_pay]").val(data.total_must_pay);
		$("input[name=payment]").val(data.payment);
		$("input[name=debt]").val(data.debt);
		$("#product-total span").html(data.total_product);
		$("#service-total span").html(data.total_service);
		var number = data.total.replace(",", "");


		if(data.number_services>0)
			$("#showService").show();
		else
			$("#showService").hide();
	});
}

