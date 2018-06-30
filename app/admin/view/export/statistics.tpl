<div class="">
    <div class="row">
        <div class="col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Lưu trữ hóa đơn bán hàng</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="h_content">
                        <div class="form-group form-inline pull-left filter_form">
                            <select class="form-control" id="date_ex" onchange="filter();">
                                <option value="0">Tất cả hóa đơn</option> {$out.select_export}
                            </select>
                            <input class="form-control" id="key" value="{$out.key}" name="key" onchange="filter()" placeholder="Mã hóa đơn,id, Tên khách hàng">
                        </div>
                        <a href="./admin?mc=export&site=index" class="btn btn-primary"><i class="fa fa-pencil"></i> Tạo hóa đơn</a>
                        <div class="clearfix"></div>
                    </div>
                    <!-- start project list -->
                    <div class="table-responsive">
                        <table class="table table-striped projects">
                            <thead>
                            <tr>
                                <th>Hóa đơn</th>
                                <th>Khách hàng</th>
                                <th class="text-right">Giá trị</th>
                                <th class="text-right">Chiết khấu</th>
                                <th class="text-right">Khách nợ</th>
                                <th>Người lập phiếu</th>
                                <th>Cập nhật bởi</th>
                                <th class=""></th>
                            </tr>
                            </thead>
                            <tbody>

                            {foreach from=$result item=list}
                                <tr id="field{$list.id}">
                                    <td>{$list.code} <br>
                                        <small>{$list.date}</small>
                                    </td>
                                    <td>{$list.customer}</td>
                                    <td class="text-right"> <b style='color:red'> {$list.must_pay|number_format}đ </b></td>
                                    <td class="text-right">{$list.discount}</td>
                                    <td class="text-right">{($list.must_pay - $list.payment)|number_format}</td>
                                    <td>{$list.user}</td>
                                    <td>
                                        {if isset($list.updater.name)}
                                            {$list.updater.name} <br>
                                            <small>{$list.updated_at}</small>
                                        {/if}
                                    </td>
                                    <td class="text-right">
                                        <button type="button" title="Chi tiết hóa đơn" data-toggle="modal"
                                                class="btn btn-default" data-target="#orderDetail"
                                                onclick="GetDetailExport({$list.id});">
                                            <i class="fa fa-search-plus"></i>
                                        </button>
                                        <a href="./admin?mc=exportedit&site=modify&id={$list.id}" class="btn btn-default"><i
                                                    class="fa fa-edit"></i></a>
                                        <button type="button" title="In hóa đơn" data-toggle="modal"
                                                class="btn btn-default" onclick="SetPrint({$list.id});"
                                                data-dismiss="modal"><i class="fa fa-print"></i></button>
                                         {if $arg.user.permission neq 3}
                                            <button type="button" title="Xóa hóa đơn" class="btn btn-default"
                                                    data-toggle="modal" data-target="#DeleteForm"
                                                    onclick="LoadDeleteItem('export', {$list.id}, '', 'hóa đơn bán', 'vì còn tồn tại trong hóa đơn');">
                                                <i class="fa fa-trash-o"></i>
                                            </button>
                                        {/if}
                                    </td>
                                </tr>
                            {/foreach}
                            <tr>
                                <th colspan="2" class="text-right">
                                    Tổng
                                </th>
                                <td class="text-right" style="color:red;font-weight: bold">
                                    {$out.total|number_format} đ
                                </td>
                                <td colspan="4"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- end project list -->
                    <div class="paging">{$paging.paging}</div>
                </div>
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

<!-- Print -->
<div class="modal fade" id="Print">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body modal-print">
                <iframe src="#" style="zoom:0.60" width="99.6%" height="450" id="PrintContent"></iframe>
            </div>
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
                <button type="button" class="btn btn-danger" onclick="DeleteItem();" id="DeleteItem">Đồng ý</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy bỏ</button>
            </div>
        </div>
    </div>
</div>

<link href="{$arg.stylesheet}js/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet">
<script src="{$arg.stylesheet}js/moment/moment.min.js"></script>
<script type="text/javascript" src="{$arg.stylesheet}js/datepicker/daterangepicker.js"></script>
<script src="{$arg.stylesheet}js/datetimepicker/bootstrap-datetimepicker.min.js"></script>
<script>

</script>
{literal}
    <script>
        $(document).ready(function () {

            $(".mc_export").addClass('active');
            $(".mc_export ul").css('display', 'block');
            $("#export_statistics").addClass('current-page');

            $('#date_from').daterangepicker({singleDatePicker: true, calender_style: "picker_4", format: 'DD-MM-YYYY'}, function () {
                $('#date_from').change();
            });
            $('#date_to').daterangepicker({singleDatePicker: true, calender_style: "picker_4", format: 'DD-MM-YYYY'}, function () {
                $('#date_to').change();
            });
        });

        function filter() {
            var date = $("#date_ex").val();
            var key = $("#key").val();
            var url = "./admin?mc=export&site=statistics";
            url += "&date=" + date;
            url += "&key=" + key;
            window.location.href = url;
        }

        function SetPrint(id) {
            $("#PrintContent").attr("src", "./admin?mc=export&site=export_print&id=" + id);
            return false;
        }

        function GetDetailExport(id) {
            $.post("./admin?mc=exportajax&site=ajax_get_detail_export",{"id": id}).done(function(data){
                data = JSON.parse(data)
                console.log(data)
                let append = `
                        <h1 class="text-center">Hóa đơn bán hàng</h1>
                        <h2 class="text-center">[Mã: ${data.code} - Ngày ${data.date}]</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <p><span><i class="icon-user"></i> Lập phiếu:</span> ${data.user_name}</p>
                                <p><span><i class="icon-time"></i> Thời gian lập:</span> ${data.created_at}</p>
                            </div>
                            <div class="col-md-6">
                                <p><span><i class="icon-user-md"></i> Khách hàng:</span> ${data.customer_name}</p>
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

                    append += `
						<div class="bold text-right">`;
							append += `<h3>Tổng tiền: ${ConvertMoney(data.total_money)} đ</h3>`
                            if(data.total_money == data.must_pay)
                                append += `<h3>Chiết khấu: 0 đ</h3>`
                            else
                                append += `<h3>Chiết khấu: ${ConvertMoney(data.total_money - data.must_pay)} đ</h3>`
							append += `<h3> Khách cần trả: ${ConvertMoney(data.must_pay)} đ</h3>`
							append += '<hr>';
							append += `<h3>Khách trả: ${ConvertMoney(data.payment)} </h3>`;
						append += `</div>`;
                       // <div class="bold text-right">
                         //   <h3>Tiền thanh toán: 158,000 đ</h3>
                        //</div>

                $("#orderDetail .modal-body").html(append);
            })

        }
    </script>
{/literal}
