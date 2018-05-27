function SetExportValue(item, value) {
    $.post('./admin?mc=importedit&site=ajax_set_export_value', { 'item': item, 'value': value }).done(function(data) {
        if (data == 'discount_type' || data == 'discount') {
            GetTotalSession();
        } else if (data == 'payment') {
            console.log('what');
            GetTotalSession(1);
        }
        return false;
    });
}

function AddProduct(id) {
    id = parseInt(id);
    if (id == 0 || id < 0) {
        return false;
    }
    $.post('./admin?mc=importedit&site=ajax_add_product_session', { 'id': id })
        .done(function(data) {
            if (data == '0') {
                return false;
            }
            data = JSON.parse(data)
            console.log(data)

            let append = `
				<tr id="proNo${data.id}">
					<td>${data.code}</td>
					<td>${data.name}</td>
					<td class="text-right">${data.price_import} đ</td>
					<td class="text-center">
						<input type="number" class="prod-number" id="proNumber${data.id}" onchange="UpdateNumberProduct(${data.id}, this.value);" value="1">
					</td>
					<td>${data.unit_name}</td>
					<td class="text-right" id="proTotal${data.id}">${data.price_import}đ
					</td>
					<td class="text-right">
						<button class="btn btn-danger" onclick="DeleteProductBill(${data.id})"><i class="fa fa-times-circle"></i></button>
					</td>
				</tr>
			`;
            $("#prd" + id).remove();
            $("#Products tbody").prepend(append);
            GetTotalSession();
        });
}

function UpdateNumberProduct(product_id, number) {
    product_id = parseInt(product_id);
    if (product_id == 0 || product_id < 0) {
        return false;
    }
    if (number < 1) {
        alert("Số lượng không được nhỏ hơn 1 !");
        number = 1;
    }
    $.post('./admin?mc=importedit&site=ajax_update_product_number', { 'product_id': product_id, 'number': number })
        .done(function(data) {
            var data = JSON.parse(data);
            $("#proNumber" + product_id).val(data.number_count);
            $("#proTotal" + product_id).html(data.total_item_money);
            GetTotalSession();
        });
}


function UpdateProductPrice(mid, id, price) {
    $.post('?mod=importAjax&site=ajax_change_product_price', { 'id': id, 'price': price, 'mid': mid }).done(function(data) {
        var data = JSON.parse(data);
        $("#price_sell" + id).html(data.price);
        $("#proTotal" + id).html(data.total);
        GetTotalSession(mid);
    });

}










// Tinh toan tong tien
function WarehouseImportTotal(id) {
    var price = $("#proPrice" + id).val().replace(/\,/g, "");
    var number = $("#proNumber" + id).val();
    if (parseInt(number) <= 0)
        number = 1;
    var total = parseInt(price) * parseInt(number);
    var sum_total = 0;

    //Tinh tong tien
    $.post('?mod=helps&site=ajax_get_number_format', { 'value': total })
        .done(function(data) {
            // tinh tong tien cho tung san pham
            $("#proTotal" + id).html(data + " đ");
        })
        .always(function() {
            $(".import-list").each(function() {
                var value_total = $(this).children(".import-list-total").html().replace(/\,/g, "");
                sum_total += parseInt(value_total);
            });

            $.post('?mod=helps&site=ajax_get_number_format', { 'value': sum_total })
                .done(function(data) {
                    // tinh tong tien cho ca don hang
                    $("#import-total span").html(data + " đ");
                });

        });
}


function WarehouseImportRemove(obj, id) {
    $(obj).parent().parent().remove();
    var sum_total = 0;
    $.post('?mod=importAjax&site=ajax_set_warehouse_import', { 'type': 'delete', 'id': id })
        .done(function() {
            $(".import-list").each(function() {
                var value_total = $(this).children(".import-list-total").html().replace(/\,/g, "");
                sum_total += parseInt(value_total);
            });

            $.post('?mod=helps&site=ajax_get_number_format', { 'value': sum_total })
                .done(function(data) {
                    // tinh tong tien cho ca don hang
                    $("#import-total span").html(data + " đ");
                });
        });
}

function DeleteProductBill(id) {
    $.post('./admin?mc=importEdit&site=delete_product_bill', { 'id': id })
        .done(function(data) {
            $("#proNo" + id).remove();
            // LoadProduct();
            GetTotalSession();
        });
}

function LoadProduct() {
    var post = {};
    post['cate'] = $("#FilterCate").val();
    post['trade'] = $("#FilterTrademark").val();
    post['key'] = $("#FilterKey").val();

    $.post('./admin?mc=importEdit&site=ajax_load_product', post)
        .done(function(data) {
            $("#ProductList").html(data);
        });
}


function ChangeNumberProduct(id, type) {
    var obj = $("#proNumber" + id);
    var value = parseInt(obj.val());
    if (type == '0') value = value - 1;
    else value = value + 1;

    if (value < 1) {
        alert('Số lượng không được nhỏ hơn 1 !');
        value = 1;
    }

    $.post('?mod=importAjax&site=ajax_set_warehouse_import', { 'type': 'edit', 'id': id, 'number': value }).done(function() {
        obj.val(value);
    });

    obj.val(value);
    WarehouseImportTotal(id);
}


function GetTotalSession(is_payment) {
    $.post('./admin?mc=importedit&site=ajax_get_total_session', { "is_payment": is_payment }).done(function(data) {
        var data = JSON.parse(data);
        $("input[name=m_total]").val(data.total);
        $("input[name=m_total_must_pay]").val(data.total_must_pay);
        $("input[name=debt]").val(data.debt);
        $("input[name=payment]").val(data.payment);
        // $("#product-total span").html(data.total_product);
        // $("#service-total span").html(data.total_service);
        var number = data.total.replace(",", "");
        if (parseInt(number) > 0) $("#SaveExport").show();
        else $("#SaveExport").hide();
    });
}