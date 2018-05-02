<div class="">
    <div class="row">
        <div class="col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Lưu trữ phiếu trả hàng nhà cung cấp</h2>
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
                            <input class="form-control" id="key" value="{$out.key}" name="key" onchange="filter()" placeholder="Id, Tên khách hàng">
                        </div>
                        <a href="?mod=export&site=export_sup" class="btn btn-primary"><i class="fa fa-pencil"></i> Tạo hóa đơn</a>
                        <div class="clearfix"></div>
                    </div>
                    <!-- start project list -->
                    <div class="table-responsive">
                        <table class="table table-striped projects">
                            <thead>
                                <tr>
                                    <th>Hóa đơn</th>
                                    <th>Nhà cung cấp</th>
                                    <th class="text-center">Ngày lập phiếu</th>
                                    <th class="text-right">Giá trị</th>
                                    <th class="text-center">NV lập phiếu</th>
                                    <th class=""></th>
                                </tr>
                            </thead>
                            <tbody>

                                {foreach from=$result item=list}
                                    <tr>
                                        <td>{$list.code}</td>
                                        <td>{$list.supplier}</td>
                                        <td class="text-center">{$list.date}</td>
                                        <td class="text-right">{$list.money}</td>
                                        <td class="text-center">{$list.user}</td>
                                        <td class="text-right">
                                            <button type="button" data-toggle="modal" class="btn btn-default" data-target="#orderDetail" onclick="SetExportInfo({$list.id});">
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
            var type = $("#type").val();
            var date = $("#date_ex").val();
            var key = $("#key").val();
            var url = "./?mod=export&site=distroy_list";
            url += "&filter=" + filter;
            url += "&type=" + type;
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

        function SetExportInfo(id) {
            $("#orderDetail .modal-body").load("?mod=exportAjax&site=ajax_get_export_info", {"id": id});
        }
    </script>
{/literal}
