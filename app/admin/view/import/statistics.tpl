<div class="">
    <div class="row">
        <div class="col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Lưu trữ hóa đơn nhập hàng</h2>
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
                            <input class="form-control" id="key" value="{$out.key}" name="key" onchange="filter()" placeholder="Mã phiếu nhập,Id, Tên nhà cung cấp">
                        </div>

                        <a href="./admin?mc=import&site=index" class="btn btn-primary"><i class="fa fa-pencil"></i> Tạo hóa đơn</a>
                        <div class="clearfix"></div>
                    </div>
                    <!-- start project list -->
                    <div class="table-responsive">
                        <table class="table table-striped projects">
                            <thead>
                                <tr>
                                    <th>Hóa đơn</th>
                                    <th>Nhà Cung cấp</th>
                                    <th class="text-right">Giá trị</th>
                                    <th class="text-right">Chiết khấu</th>
                                    <th class="text-right">NCC nợ</th>
                                    <th>Người lập phiếu</th>
                                    <th>Cập nhật bởi</th>
                                    <th class=""></th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach from=$result item=list}
                                    <tr id="field{$list.id}">
                                        <td>{$list.code} <br> <small>{$list.date}</small></td>
                                        <td>{$list.supplier}</td>
                                        <td class="text-right"> <b style='color:red'> {$list.must_pay|number_format}đ </b></td>
                                        <td class="text-right">{$list.discount}</td>
                                        <td class="text-right">{($list.payment - $list.must_pay)|number_format}</td>
                                        <td>{$list.user}</td>
                                        <td>
                                            {if isset($list.updater.name)}
                                                {$list.updater.name} <br>
                                                <small>{$list.updated_at}</small>
                                            {/if}
                                        </td>
                                        <td class="text-right">
                                            <button type="button" data-toggle="modal" class="btn btn-default" data-target="#orderDetail" onclick="DisplayDetail({$list.id});">
                                                <i class="fa fa-search-plus"></i>
                                            </button>
                                                <a href="./admin?mc=importedit&site=modify&id={$list.id}" class="btn btn-default">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            <button type="button" title="In hóa đơn" data-toggle="modal"
                                                class="btn btn-default" onclick="SetPrint({$list.id});"
                                                data-dismiss="modal"><i class="fa fa-print"></i></button>
                                            <button type="button" title="Xóa hóa đơn" class="btn btn-default"
                                                    data-toggle="modal" data-target="#DeleteForm"
                                                    onclick="LoadDeleteItem('import', {$list.id}, '', 'hóa đơn bán', 'vì còn tồn tại trong hóa đơn');">
                                                <i class="fa fa-trash-o"></i></button>
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

<script src="{$arg.stylesheet}js/moment/moment.min.js"></script>
<script type="text/javascript" src="{$arg.stylesheet}js/datepicker/daterangepicker.js"></script>
{literal}
    <script>
        $(document).ready(function () {


            $(".mc_import").addClass('active');
            $(".mc_import ul").css('display', 'block');
            $("#import_statistics").addClass('current-page');

            $('#date_from').daterangepicker({singleDatePicker: true, calender_style: "picker_4", format: 'DD-MM-YYYY'}, function () {
                $('#date_from').change();
            });
            $('#date_to').daterangepicker({singleDatePicker: true, calender_style: "picker_4", format: 'DD-MM-YYYY'}, function () {
                $('#date_to').change();
            });
        });

        function filter()
        {
            var date = $("#date_ex").val();
            var key = $("#key").val();

            var url = "./admin?mc=import&site=statistics";
            url += "&date=" + date;
            url += "&key=" + key;

            window.location.href = url;
        }

        function SetPrint(id) {
            $("#PrintContent").attr("src", "./admin?mc=import&site=import_print&id=" + id);
            return false;
        }

        function DisplayDetail(id) {
            $.post("./admin?mc=import&site=ajax_get_detail_import", {"id": id}).done(function(data){
                data = JSON.parse(data)

                var append = `
                    <div class="modal-body form-horizontal">
                        <h1 class="text-center">Hóa đơn nhập hàng</h1>
                        <h2 class="text-center">[Mã: ${data.code} - Ngày ${data.date}]</h2>
                        <p><span>Nhà cung cấp:</span>${data.supplier_name}</p>
                        <p><span>Nhân viên:</span> ${data.user_name}</p>
                        <p><span>Thời gian:</span> ${data.created_at}</p>
                        <table class="table table-striped table-bordered table-bor-btm">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th class="text-right">Đơn vị</th>
                                    <th class="text-right">Giá nhập</th>
                                    <th class="text-right">SL</th>
                                    <th class="text-right">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>`;
                            $.each(data.products, function(index, product) {
                            append += `
                                <tr>
                                    <td>${product.name}</td>
                                    <td class="text-right">${product.unit_name}</td>
                                    <td class="text-right">${ConvertMoney(product.price_import)} đ</td>
                                    <td class="text-right">${product.number_count}</td>
                                    <td class="text-right">${ConvertMoney(product.number_count * product.price_import)} đ</td>
                                </tr>`;
                            })
                        append += `
                            </tbody>
                        </table>`;
                    append += `
                        <div class="bold text-right">
                        <h4>Tổng tiền hàng: ${ConvertMoney(data.total_money)} đ</h4></div>
                    `;
                    if(data.total_money != data.must_pay)
                        append += `
                            <div class="bold text-right">
                                <h4>Chiết khấu: ${ConvertMoney(data.total_money - data.must_pay)} đ</h4></div>
                        `;
                    if(data.payment != data.must_pay)
                        append += `
                            <div class="bold text-right">
                                <h4>NCC nợ: ${ConvertMoney(data.payment - data.must_pay)} đ</h4></div>
                        `;
                        append += `
                            <hr class="line">
                            <div class="bold text-right">
                                <h4>Tiền trả NCC: ${ConvertMoney(data.payment)} đ</h4></div>
                        `;
            $("#orderDetail .modal-body").html(append)
            });
        }
    </script>
{/literal}
