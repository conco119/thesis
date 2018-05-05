<div class="">
    <div class="row">
        <div class="col-md-9 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Thông tin mua hàng từ nhà cung cấp <b>{$supplier.name}</b>
                        <small>[{$supplier.code}]</small>
                    </h2>
                    <br>
                    <br>
                    <p class="text-left">Số điện thoại: <b>{$supplier.phone}</b> - Địa chỉ: <b>{$supplier.address}</b>
                    </p>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="h_content">
                        <button type="button" class="btn btn-primary" onclick="SetPrint();"><i class="fa fa-print"></i>
                            In
                        </button>
                        <div class="clearfix"></div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Ngày</th>
                                <th>Chi tiết mua hàng</th>
                                <th class="text-right">Tổng tiền</th>
                                <th class="text-right">Chiết khấu</th>
                                <th class="text-right">Công nợ</th>
                                <th class="text-right">Nạp tiền</th>
                                <th class="text-right">Số dư</th>
                            </tr>
                            </thead>
                            <tbody>

                            {foreach from=$detail key=date item=data}
                                <tr>
                                    <td>{gmdate("d-m-Y", strtotime($date) + 7 * 3600)}</td>
                                    <td class="padding-none">
                                        <table class="table">
                                            {foreach $data.content item=list}
                                                {if $list.number > 0}
                                                    <tr>
                                                        <td width="65%">{$list.name}</td>
                                                        <td width="10%" class="align-right">{$list.number}</td>
                                                        <td width="25%"
                                                            class="align-right">{($list.number*$list.price)|number_format}
                                                            đ
                                                        </td>
                                                    </tr>
                                                {/if}
                                            {/foreach}
                                        </table>
                                    </td>
                                    <td class="text-right">{$data.money|number_format} đ</td>
                                    <td class="text-right">{$data.discount|number_format} đ</td>
                                    <td class="text-right">{$data.debt|number_format} đ</td>
                                    <td class="text-right"> {$data.payment|number_format}đ</td>
                                    <td class="text-right">{($data.payment-$data.debt)|number_format} đ</td>
                                </tr>
                            {/foreach}
                            <tr>
                                <th colspan="2" class="text-right">Tổng chi tiết các khoản:</th>
                                <td class="text-right">{$out.total_money|number_format} đ</td>
                                <td class="text-right">{$out.total_discount|number_format} đ</td>
                                <td class="text-right">{$out.total_debt|number_format} đ</td>
                                <td class="text-right"> {$out.total_payment|number_format} đ</td>
                                <td class="text-right">{($out.total_payment-$out.total_debt)|number_format} đ</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Thống kê</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div id="Filter">
                        <select class="form-control" id="filter" onchange="filter();">
                            {$out.filter}
                        </select> {if $out.value.filter eq '2'}
                            <select class="form-control"
                                    id="year" onchange="filter();"> {$out.year}
                            </select>
                            <select class="form-control" id="month" onchange="filter();">
                                {$out.month}
                            </select>
                        {/if} {if $out.value.filter eq '1'}
                            <input type="text"
                                   class="form-control" id="date_from" placeholder="Từ ngày"
                                   onchange="filter();" value="{$out.date_from}">
                            <input
                                    type="text" class="form-control" id="date_to"
                                    placeholder="Đến ngày" onchange="filter();"
                                    value="{$out.date_to}">
                        {/if}
                    </div>


                </div>
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
<script src="{$arg.stylesheet}js/chartjs/chart.min.js"></script>
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
