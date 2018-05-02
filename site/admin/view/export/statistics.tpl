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
                            <select class="form-control" id="acount" onchange="filter();">
                                <option value="0" onchange="filter();">Người lập phiếu</option>
                                {$out.acount}
                            </select>
                            <select class="form-control" id="staff" onchange="filter();">
                                <option value="0" onchange="filter();">Chọn nhân viên kinh doanh</option>
                                {$out.staff}
                            </select>
                            <input class="form-control" id="key" value="{$out.key}" name="key" onchange="filter()"
                                   placeholder="Mã hóa đơn,id, Tên khách hàng">
                            <select class="form-control" id="filter" onchange="filter();">
                                {$out.filter}
                            </select>

                            {if $out.value.filter eq '2'}
                                <select class="form-control" id="year" onchange="filter();">
                                    {$out.year}
                                </select>
                                <select class="form-control" id="month" onchange="filter();">
                                    {$out.month}
                                </select>
                            {/if}

                            {if $out.value.filter eq '1'}
                                <input type="text" class="form-control" id="date_from" placeholder="Từ ngày" onchange="filter();" value="{$out.date_from}">
                                <input type="text" class="form-control" id="date_to" placeholder="Đến ngày" onchange="filter();" value="{$out.date_to}">
                            {/if}


                        </div>
                        <a href="?mod=export&site=form" class="btn btn-primary"><i class="fa fa-pencil"></i> Tạo hóa đơn</a>
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
                                <th class="text-right">Công nợ</th>
                                <th>Người lập phiếu</th>
                                <th>Nhân viên kinh doanh</th>
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
                                    <td class="text-right">{$list.money}</td>
                                    <td class="text-right">{$list.discount}</td>
                                    <td class="text-right">{$list.debt}</td>
                                    <td>{$list.user}</td>
                                    <td>{$list.staff_name}</td>
                                    <td class="text-right">
                                        <button type="button" title="Chi tiết hóa đơn" data-toggle="modal"
                                                class="btn btn-default" data-target="#orderDetail"
                                                onclick="SetExportInfo({$list.id});">
                                            <i class="fa fa-search-plus"></i>
                                        </button>
                                        {if $list.room_id eq 0} <a href="{$list.modify}" class="btn btn-default"><i
                                                    class="fa fa-edit"></i></a>{/if}
                                        <button type="button" title="In hóa đơn" data-toggle="modal"
                                                class="btn btn-default" onclick="SetPrint({$list.id});"
                                                data-dismiss="modal"><i class="fa fa-print"></i></button>
                                        {if $check_delete}
                                            <button type="button" title="Xóa hóa đơn" class="btn btn-default"
                                                    data-toggle="modal" data-target="#DeleteForm"
                                                    onclick="LoadDeleteItem('export', {$list.id}, '', 'hóa đơn bán', 'vì còn tồn tại trong hóa đơn');">
                                                <i class="fa fa-trash-o"></i></button>
                                        {/if}
                                    </td>
                                </tr>
                            {/foreach}
                            <tr>
                                <th colspan="2" class="text-right">
                                    Tổng doanh thu bán hàng
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
    var print = '{$out.print}';
</script>
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
            var acount = $("#acount").val();
            var staff = $("#staff").val();

            var url = "./?mod=export&site=statistics";
            url += "&filter=" + filter;
            url += "&type=" + type;
            url += "&date=" + date;
            url += "&key=" + key;
            url += "&acount=" + acount;
            url += "&staff=" + staff;

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
            $("#PrintContent").attr("src", print + id);
            return false;
        }

        function SetExportInfo(id) {
            $("#orderDetail .modal-body").load("?mod=exportAjax&site=ajax_get_export_info", {"id": id});
        }
    </script>
{/literal}
