<div class="">
    <div class="row">
        <div class="col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Lưu trữ phiếu trả hàng</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="h_content">
                        <div class="form-group form-inline pull-left filter_form">
                            <select class="form-control" id="filter" onchange="filter();">
                                {$out.filter}
                            </select>
                            {if $out.value.filter eq '2'}
                                <select class="form-control" id="year" onchange="filter();">{$out.year}</select>
                                <select class="form-control" id="month" onchange="filter();">{$out.month}</select>
                            {else if $out.value.filter eq '1'}
                                <input type="text" class="form-control" id="date_from" placeholder="Từ ngày" onchange="filter();" value="{$out.date_from}">
                                <input type="text" class="form-control" id="date_to" placeholder="Đến ngày" onchange="filter();" value="{$out.date_to}">
                            {else}
                                <select class="form-control" id="date_ex" onchange="filter();">
                                    <option value="0">Tất cả hóa đơn</option> {$out.select_export}
                                </select>
                            {/if}
                            <input class="form-control" id="key" value="{$out.key}" name="key" onchange="filter()" placeholder="Id, Tên nhà cung cấp">
                        </div>
                        <a href="?mod=import&site=reimport" class="btn btn-primary"><i class="fa fa-pencil"></i> Tạo hóa đơn</a>
                        <div class="clearfix"></div>
                    </div>
                    <!-- start project list -->
                    <div class="table-responsive">
                        <table class="table table-striped projects">
                            <thead>
                                <tr>
                                    <th>Hóa đơn</th>
                                    <th>Ngày lập</th>
                                    <th class="text-right">Tiền thanh toán</th>
                                    <th class="text-right">Công nợ</th>
                                    <th>Nhân viên lập</th>
                                    <th class=""></th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach from=$result item=list}
                                    <tr>
                                        <td>{$list.code}</td>
                                        <td>{$list.date}</td>
                                        <td class="text-right">{$list.money|number_format}</td>
                                        <td class="text-right">{$list.debt|number_format}</td>
                                        <td>{$list.user}</td>
                                        <td class="text-right">
                                            <button type="button" data-toggle="modal" class="btn btn-default" data-target="#orderDetail" onclick="DisplayDetail({$list.id});">
                                                <i class="fa fa-search-plus"></i>
                                            </button>
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
            $('#date_from').daterangepicker({singleDatePicker: true, calender_style: "picker_4", format: 'DD-MM-YYYY'}, function () {
                $('#date_from').change();
            });
            $('#date_to').daterangepicker({singleDatePicker: true, calender_style: "picker_4", format: 'DD-MM-YYYY'}, function () {
                $('#date_to').change();
            });
        });

        function filter() {
            var filter = $("#filter").val();
            var key = $("#key").val();
            var url = "./?mod=import&site=reimport_list";
            var date = $("#date_ex").val();
            url += "&filter=" + filter;
            url += "&date=" + date;
            url += "&key=" + key;

            if (filter == "1") {
                var date_from = $("#date_from").val();
                var date_to = $("#date_to").val();
                url += "&date_from=" + date_from;
                url += "&date_to=" + date_to;
            } else if (filter == "2") {
                var year = $("#year").val();
                var month = $("#month").val();
                url += "&year=" + year;
                url += "&month=" + month;
            }

            window.location.href = url;
        }

        function SetPrint(id) {
            $("#PrintContent").attr("src", "?mod=import&site=cprint&id=" + id);
            return false;
        }

        function DisplayDetail(id) {
            $("#orderDetail .modal-body").load("?mod=import&site=ajax_get_import_info", {"id": id});
        }
    </script>
{/literal}
