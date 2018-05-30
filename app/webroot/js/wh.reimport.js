function SetExportValue(item, value) {
    $.post('./admin?mc=reimport&site=ajax_set_export_value', { 'item': item, 'value': value }).done(function(data) {
        if (data == 'discount_type' || data == 'discount') {
            GetTotalSession();
        } else if (data == 'payment') {
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
    $.post('./admin?mc=reimport&site=ajax_add_product_session', { 'id': id })
        .done(function(data) {
            if (data == '0') {
                return false;
            }
            data = JSON.parse(data);
            $("#prd" + id).remove();
            let append = `
					<tr id="proNo${data.product_id}">
						<td>${data.code}</td>
						<td>${data.product_name}</td>
						<td class="text-right">
							<input type="text" class="prod-price" value="${data.price}">
						</td>
						<td class="text-center">
							<input type="number" class="prod-number" id="proNumber${data.product_id}" onchange="UpdateNumberProduct(${data.product_id}, this.value, ${data.max_number});" value="1">
						</td>
						<td>Chiếc</td>
						<td class="text-right" id="proTotal${data.product_id}">${data.price} đ
						</td>
						<td class="text-right">
							<button class="btn btn-danger" onclick="RemoveProduct(${data.product_id})">
								<i class="fa fa-times-circle"></i>
							</button>
						</td>
					</tr>
			`;
            $("#Products tbody").prepend(append);
            GetTotalSession();
        });

}

function UpdateNumberProduct(id, number, max) {
    id = parseInt(id);
    if (id == 0 || id < 0) {
        return false;
    }
    if (number <= 0) {
        alert("Số lượng không được nhỏ hơn 0 !");
        number = 1;
    }
    if (number > max) {
        alert("Số lượng vượt quá");
        number = max;
    }
    $.post('./admin?mc=reimport&site=ajax_update_product_number', { 'id': id, 'number': number, 'max': max }).done(function(data) {
        data = JSON.parse(data);
        $("#proNumber" + id).val(data.number);
        $("#proTotal" + id).html(data.total_item_money);
        GetTotalSession();
    });

}


function RemoveProduct(id) {
    id = parseInt(id);
    if (id == 0 || id < 0)
        return false;
    $.post('./admin?mc=reimport&site=delete_product_bill', { 'id': id }).done(function() {
        $("#proNo" + id).remove();
        LoadProduct();
        GetTotalSession();
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
    $.post('?mod=importReAjax&site=ajax_set_warehouse_import', { 'type': 'delete', 'id': id })
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


function LoadProduct() {
    var post = {};
    post['code'] = $("input[name=FilterCode]").val();

    $.post('./admin?mc=reimport&site=ajax_load_product', post)
        .done(function(data) {
            $("#ProductList").html(data);
        });
}


function Refresh() {
    $.post('?mod=importReAjax&site=ajax_refresh')
        .done(function(rt) {
            LoadProduct();
            $("#Products tbody").html('');
            GetTotalSession();
        });
}

function GetTotalSession(is_payment) {
    $.post('./admin?mc=reimport&site=ajax_get_total_session', { 'is_payment': is_payment }).done(function(data) {
        data = JSON.parse(data);
        $("input[name=m_total]").val(data.total);
        $("input[name=m_total_must_pay]").val(data.total_must_pay);
        $("input[name=payment]").val(data.payment);
        $("input[name=debt]").val(data.debt);
    });
}

function UpdateIdExport(value) {
    $.post('./admin?mc=reimport&site=ajax_update_id_export', { 'value': value }).done(function(data) {
        $("#customer").val(data);
        LoadProduct();
        $("#Products tbody").html('');
        GetTotalSession();
    });
}