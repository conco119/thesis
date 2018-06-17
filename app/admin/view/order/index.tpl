<div class="">
    <div class="x_panel">
        <div class="x_title">
            <h2>Khách hàng đặt hàng</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">



            <!-- start project list -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Họ tên</th>
                            <th>Số điện thoại</th>
                            <th class="text-right">Email</th>
                            <th class="text-right">Địa chỉ</th>
                            <th class="text-right">Ngày</th>
                            <th class="text-right">Trạng thái</th>
                            <th class="text-right"></th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach from=$orders item=list}
                            <tr id="field{$list.id}">
                                <td>
                                    {$list.name}
                                </td>
                                <td>{$list.phone}</td>
                                <td class="text-right">
                                	{$list.email}
                                </td>
                                <td class="text-center">{$list.address}</a></td>
                                <td class="text-center">
                                	{$list.created_at}
                                </td>
                                <td class="text-center" id="stt{$list.id}">{$list.status}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#orderDetail" onclick="GetDetailOrder({$list.id});"><i class="fa fa-search-plus"></i></button>
                                    {* <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#DeleteForm" onclick="LoadDeleteItem('order', {$list.id}, '', 'đơn', '');"><i class="fa fa-trash-o"></i></button> *}
                                </td>
                            </tr>
                        {/foreach}
                    </tbody>
                </table>
            </div>
            <!-- end project list -->

            <div class="paging">{$paging.paging}</div>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="DeleteForm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Xóa mục này</h4>
            </div>
            <div class="modal-body">Bạn chắc chắn muốn xóa mục này chứ?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy bỏ</button>
                <button type="button" class="btn btn-danger" onclick="DeleteItem();" id="DeleteItem">Xóa</button>
            </div>
        </div>
    </div>
</div>

<!-- Order Detail -->
<div class="modal fade" id="orderDetail">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body form-horizontal"></div>
            <div class="modal-footer">
                <form action="" method="post">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{$arg.stylesheet}js/moment/moment.min.js"></script>
<script type="text/javascript" src="{$arg.stylesheet}js/datepicker/daterangepicker.js"></script>

{literal}
<script>
$(document).ready(function () {
    $('#date_from').daterangepicker({singleDatePicker: true, calender_style: "picker_4", format: 'DD-MM-YYYY'}, function () {
        $('#date_from').change();
    });
    $('#date_to').daterangepicker({singleDatePicker: true, calender_style: "picker_4", format: 'DD-MM-YYYY'}, function () {
        $('#date_to').change();
    });
});

function activeStatus(table, id) {
    $.post(`./admin?mc=order&site=ajax_active`, {'table': table, 'id': id}).done(function (data) {
            if(data != 0)
              $("#stt" + id).html(data);
    });
}

function GetDetailOrder(id) {
    $.post("./admin?mc=order&site=ajax_get_detail_order",{"id": id}).done(function(data){
        data = JSON.parse(data)
        console.log(data)
        let append = `
        <h1 class="text-center">Khách đặt hàng</h1>
        <h2 class="text-center">[Ngày ${data.date}]</h2>
        <div class="row">
            <div class="col-md-12">
                <p><span><i class="icon-user-md"></i> Tên khách hàng:</span> ${data.name}</p>
                <p><span><i class="icon-user-md"></i> Địa chỉ:</span> ${data.address}</p>
                <p><span><i class="icon-user-md"></i> Số điện thoại:</span> ${data.phone}</p>
                <p><span><i class="icon-user-md"></i> Phương thức thanh toán:</span> ${data.type}</p>
            </div>
        </div>`

                if(Object.keys(data.products).length > 0)
                {
                    append += `
                    <h3>Chi tiết sản phẩm</h3>
                    <table class="table table-striped table-bordered table-bor-btm">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th class="text-right">Đơn vị</th>
                                <th class="text-right">Giá bán</th>
                                <th class="text-right">SL</th>
                                <th class="text-right">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>`
                        let index = 1;
                        $.each(data.products, function(key, product) {
                            append += `
                            <tr>
                                <td>${product.name}</td>
                                <td class="text-right">${product.unit_name}</td>
                                <td class="text-right">${ConvertMoney(product.price)} đ</td>
                                <td class="text-right">${product.number_count}</td>
                                <td class="text-right">${ConvertMoney(product.price * product.number_count)} đ</td>
                            </tr>`
                            index++;
                        })
                    append += `
                        </tbody>
                    </table>`
                }
                if(Object.keys(data.services).length > 0)
                {
                    append += `
                    <h3>Chi tiết dịch vụ</h3>
                    <table class="table table-striped table-bordered table-bor-btm">
                        <thead>
                            <tr>
                                <th>Dịch vụ</th>
                                <th class="text-right">Chi phí</th>
                                <th class="text-right">SL</th>
                                <th class="text-right">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>`
                        $.each(data.services, function(key, service) {
                            append +=`
                            <tr>
                                <td>${service.name}</td>
                                <td class="text-right">${ConvertMoney(service.price)} đ</td>
                                <td class="text-right">${service.number_count}</td>
                                <td class="text-right">${ConvertMoney(service.price * service.number_count)} đ</td>
                            </tr>`
                        })
                    append +=`
                        </tbody>
                    </table>`
                }

                    append += `<div class="bold text-right">`;
                    append += `<h3>Tổng tiền: ${ConvertMoney(data.total_money)} đ</h3>`
                    append += `</div>`;

        $("#orderDetail .modal-body").html(append);
    })
}
</script>
{/literal}

