function SetExportValue(item, value) {
    $.post('./admin?mc=exportedit&site=ajax_set_export_value', { 'item': item, 'value': value }).done(function(data) {
        if (data == 'discount_type' || data == 'discount') {
            GetTotalSession();
        } else if (data == 'payment') {
            GetTotalSession(1);
        }
        return false;
    });
}


// Ham xu ly them san pham vao hoa don nhap hang
function AddProduct(id) {
    id = parseInt(id);
    if (id == 0 || id < 0) {
        return false;
    }
    $.post('./admin?mc=exportEdit&site=ajax_add_product_session', { 'id': id })
        .done(function(data) {
            if (data == '0') {
                return false;
            }
            data = JSON.parse(data)
            var prepend = `
					<tr id="proNo${data.product_id}">
						<td>${data.code}</td>
						<td>${data.name}</td>
						<td class="text-right">
							<input type="text" class="prod-price" value="${data.price}">
						</td>
						<td class="text-center">${data.unit_name}</td>
						<td class="text-center">
							<input type="number" class="prod-number" id="proNumber${data.product_id}" onchange="UpdateNumberProduct(${data.product_id}, this.value, ${data.max_number});" value="1">
						</td>
						<td class="text-right" id="proTotal${data.product_id}">
						${data.price} đ</td>
						<td class="text-right">
							<button class="btn btn-danger" onclick="DeleteProductBill(${data.product_id})"><i class="fa fa-times-circle"></i></button>
						</td>
					</tr>
			`;
            $("#prd" + id).remove();
            $("#Products tbody").prepend(prepend);
            GetTotalSession();
        });

}

function DeleteProductBill(id) {
    $.post('./admin?mc=exportedit&site=delete_product_bill', { 'id': id })
        .done(function(data) {
            $("#proNo" + id).remove();
            // LoadProduct();
            GetTotalSession();
        });
}

function DeleteServiceBill(service_id) {
    $.post('./admin?mc=exportedit&site=delete_service_bill', { 'service_id': service_id })
        .done(function(data) {
            $("#serNo" + service_id).remove();
            GetTotalSession();
        });
}




function UpdateNumberProduct(id, number, max_number) {
    id = parseInt(id);
    if (id == 0 || id < 0) {
        return false;
    }
    if (number < 1) {
        alert("Số lượng không được nhỏ hơn 1 !");
        number = 1;
    }
    if (number > max_number) {
        alert("Vượt quá tồn kho !");
        number = max_number;
    }
    // Xoa field vua duoc them
    $.post('./admin?mc=exportEdit&site=ajax_update_product_number', { 'id': id, 'number': number, "max_number": max_number })
        .done(function(data) {
            data = JSON.parse(data);
            $("#proNumber" + id).val(data.number_count);
            $("#proTotal" + id).html(data.total_item_money);
            GetTotalSession();
        });
}






// function GetProductFromBarcode(mid, code) {
//     $.post('?mod=exportEditAjax&site=ajax_get_id_from_code', { 'code': code, 'mid': mid })
//         .done(function(rt) {
//             $("#UseBarcode").val('');
//             if (rt == '0') {
//                 alert('Khong ton tai san pham');
//                 return false;
//             } else {
//                 var data = JSON.parse(rt);
//                 if (data.exists == '0') {
//                     if (data.number == '0' && config.export_alway == 0) {
//                         alert('San pham nay khong con trong kho');
//                         return false;
//                     }
//                     AddProduct(mid, data.id);
//                     return false;
//                 } else {
//                     UpdateNumberProduct(mid, data.id, 'add', 1);
//                     return false;
//                 }
//             }
//         });

// }




// function RemoveExport(mid) {
//     $.post('?mod=exportEditAjax&site=ajax_remove_export', { 'mid': mid })
//         .done(function(rt) {
//             if (rt == '1')
//                 window.location.href = "?mod=export&site=statistics";
//             return false;
//         });

// }


function LoadProduct(mid) {
    var post = {};
    post['cate'] = $("#FilterCate").val();
    post['trade'] = $("#FilterTrademark").val();
    post['key'] = $("#FilterKey").val();
    $.post('./admin?mc=exportEdit&site=ajax_load_product', post)
        .done(function(data) {
            $("#ProductList").html(data);
        });
}


// function AddCustomer() {
//     $("#show-loading").show();
//     var customer_group = $("#customer_group").val();
//     var customer_code = $("#customer_code").val();
//     var customer_name = $("#customer_name").val();
//     var customer_phone = $("#customer_phone").val();
//     var customer_address = $("#customer_address").val();
//     $.post('?mod=customer&site=ajax_add_customer', { 'submit': 1, 'group': customer_group, 'code': customer_code, 'name': customer_name, 'phone': customer_phone, 'address': customer_address })
//         .done(function(data) {
//             $("#show-loading").hide();
//             if (data == 'fail') {
//                 alert('Khong thanh cong');
//                 return false;
//             } else {
//                 alert('them khach hang thanh cong');
//                 location.reload();
//                 return false;
//             }
//         });
// }


function AddServices(id) {
    $.post('./admin?mc=exportEdit&site=ajax_add_service_session', { 'id': id }).done(function(data) {
        data = JSON.parse(data)
        $("#showService").show();
        $("#serChoice" + id).remove();
        var append = `
			<tr id="serNo${data.service_id}">
				<td>#</td>
				<td>${data.name}</td>
				<td class="text-right">
					<input type="text" class="prod-price" id="serPrice${data.service_id}" onchange="ServiceUpdatePrice(${data.service_id});" value="${data.price}">
				</td>
				<td class="text-center">
					<input type="number" class="prod-number" id="serNumber${data.service_id}" onchange="ServiceUpdateNumber(${data.service_id}, this.value);" value="1">
				</td>
				<td class="text-right" id="serTotal${data.service_id}">${data.price}</td>
				<td class="text-right">
					<button type="button" class="btn btn-danger" onclick="DeleteServiceBill(${data.service_id});"><i class="fa fa-times-circle"></i></button>
				</td>
			</tr>
		`;
        $("#Service tbody").append(append);
        GetTotalSession();
    });
}


function ServiceUpdateNumber(service_id, number) {
    if (number < 1) {
        number = 1;
        alert("Số lượng phải lớn hơn 0");
    }
    $.post('./admin?mc=exportedit&site=ajax_service_update_number', { 'service_id': service_id, 'number': number }).done(function(data) {
        data = JSON.parse(data);
        $("#serNumber" + service_id).val(data.number_count);
        $("#serTotal" + service_id).html(data.total_item_money);
        GetTotalSession();
    });
}




function LoadService() {
    $.post('./admin?mc=exportEdit&site=ajax_load_services').done(function(data) {
        $("#ServicesChoice").html(data);
    });
}







function GetTotalSession(is_payment) {
    $.post('./admin?mc=exportEdit&site=ajax_get_total_session', { 'is_payment': is_payment }).done(function(data) {
        data = JSON.parse(data);
        console.log(data)
        $("input[name=m_total]").val(data.total);
        $("input[name=m_total_must_pay]").val(data.total_must_pay);
        $("input[name=debt]").val(data.debt);
        $("input[name=payment]").val(data.payment);
        var number = data.total.replace(",", "");
        if (parseInt(number) > 0) $("#SaveExport").show();
        else $("#SaveExport").hide();

        if (data.number_services > 0) $("#showService").show();
        else $("#showService").hide();
        console.log(data.number);
    });
}