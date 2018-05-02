<div class="">
    <div class="row">
        <div class="x_panel">
            <div class="x_title">
                <h2>Thông tin nhập xuất của sản phẩm: {$product_info.name} [{$product_info.code}]</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <div class="h_content">

                    <a href="?mod=product&site=index" class="btn btn-primary left"><i
                                class="fa fa-bars"></i> Quản lý sản phẩm</a>
                    <div class="clearfix"></div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th colspan="6" class="text-center">Nhập hàng</th>
                            </tr>
                            <tr>
                                <th>Ngày</th>
                                <th>Mã hóa dơn</th>
                                <th class="text-right">Số lượng</th>
                                <th class="text-right">Đơn vị</th>
                                <th class="text-right">Tổng tiền</th>
                                <th class="text-center">Chi tiết hóa đơn</th>
                            </tr>
                            </thead>
                            <tbody>
                            {foreach from=$detail_im  item=data_im}
                                <tr>
                                    <td>{$data_im.time}</td>
                                    <td>{$data_im.code}</td>
                                    <td class="text-right">{$data_im.number}</td>
                                    <td class="text-right">{$data_im.unit}</td>
                                    <td class="text-right">{$data_im.total}</td>
                                    <td class="text-center">
                                        <button type="button" title="Chi tiết hóa đơn" data-toggle="modal"
                                                class="btn btn-default" data-target="#orderDetail"
                                                onclick="SetImportInfo({$data_im.id_im});">
                                            <i class="fa fa-search-plus"></i>
                                        </button>
                                    </td>
                                </tr>
                            {/foreach}
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th colspan="6" class="text-center">Xuất hàng</th>
                            </tr>
                            <tr>
                                <th>Ngày</th>
                                <th>Mã hóa dơn</th>
                                <th class="text-right">Số lượng</th>
                                <th class="text-right">Đơn vị</th>
                                <th class="text-right">Tổng tiền</th>
                                <th class="text-center">Chi tiết hóa đơn</th>
                            </tr>
                            </thead>
                            <tbody>
                            {foreach from=$detail_ex  item=data}
                                <tr>
                                    <td>{$data.time}</td>
                                    <td>{$data.code}</td>
                                    <td class="text-right">{$data.number}</td>
                                    <td class="text-right">{$data.unit}</td>
                                    <td class="text-right">{$data.total}</td>
                                    <td class="text-center">
                                        <button type="button" title="Chi tiết hóa đơn" data-toggle="modal"
                                                class="btn btn-default" data-target="#orderDetail"
                                                onclick="SetExportInfo({$data.id});">
                                            <i class="fa fa-search-plus"></i>
                                        </button>
                                    </td>
                                </tr>
                            {/foreach}
                        </table>
                    </div>
                </div>
                {*</td>*}
                {*<td class="text-right">{$data.money|number_format} đ</td>*}
                {*<td class="text-right">{$data.test|number_format} đ</td>*}
                {*<td class="text-right">{$data.debt|number_format} đ</td>*}
                {*<td class="text-right">{$data.payment|number_format} đ</td>*}
                {*</tr>*}

                </tbody>
                </table>

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

<!-- Modal Detail Products -->
<div class="modal fade" tabindex="-1" id="DetailProduct">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 class="modal-title">Thông tin chi tiết mua hàng</h4>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Print -->
<div class="modal fade" id="Print">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body modal-print">
                <iframe src="#" style="zoom: 0.60" width="99.6%" height="450" id="PrintContent"></iframe>
            </div>
        </div>
    </div>
</div>


<script src="{$arg.stylesheet}js/moment/moment.min.js"></script>
<script type="text/javascript"
        src="{$arg.stylesheet}js/datepicker/daterangepicker.js"></script>
<script>
    var this_url = '{$out.url}';
    var this_print = '{$out.print}';
</script>
{literal}
    <script>

        $(document).ready(function () {
            $('#date_from').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_4",
                format: 'DD-MM-YYYY'
            }, function () {
                $('#date_from').change();
            });
            $('#date_to').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_4",
                format: 'DD-MM-YYYY'
            }, function () {
                $('#date_to').change();
            });
        });
        function SetExportInfo(id) {
            $("#orderDetail .modal-body").load("?mod=exportAjax&site=ajax_get_export_info", {"id": id});
        }
        function SetImportInfo(id) {
            $("#orderDetail .modal-body").load("?mod=import&site=ajax_get_import_info", {"id": id});
        }

        function DetailProduct(customer_id, date) {
            $("#DetailProduct .modal-body").load("?mod=customer&site=ajax_load_products", {
                'id': customer_id,
                'date': date
            });
        }

        function filter() {
            var filter = $("#filter").val();
            var url = this_url;
            url += "&filter=" + filter;

            if (filter == "1") {
                var date_from = $("#date_from").val();
                var date_to = $("#date_to").val();
                url += "&date_from=" + date_from;
                url += "&date_to=" + date_to;
            }
            else if (filter == "2") {
                var year = $("#year").val();
                var month = $("#month").val();
                url += "&year=" + year;
                url += "&month=" + month;
            }

            window.location.href = url;
        }
        function SetPrint() {
            $("#PrintContent").attr("src", this_print);
            return false;
        }


    </script>
{/literal}
