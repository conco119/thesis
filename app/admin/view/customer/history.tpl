<div class="">
    <div class="row">
        <div class="col-md-9">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Lịch sử mua hàng của khách hàng <b>{$customer.name}</b><small>[{$customer.code}]</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>


                </div>
                <div class="x_content">

                    <!-- start project list -->
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th>Hóa đơn</th>
                                <th class="text-center">Mô tả</th>
                                <th>Khách hàng</th>
                                <th class="text-right">Giá trị</th>
                                <th class="text-right">Chiết khấu</th>
                                <th class="text-right">Công nợ</th>
                                <th>NV Bán</th>
                                <th class=""></th>
                            </tr>
                        </thead>
                        <tbody>

                            {foreach from=$result item=list}
                                <tr>
                                    <td>{$list.code} <br> <small>{$list.date}</small></td>
                                    <td>{$list.description}</td>
                                    <td>{$list.customer}</td>
                                    <td class="text-right">{$list.money}</td>
                                    <td class="text-right">{$list.discount}</td>
                                    <td class="text-right">{$list.debt}</td>
                                    <td>{$list.user}</td>
                                    <td class="text-right">
                                        <button type="button" data-toggle="modal" class="btn btn-default" data-target="#orderDetail" onclick="SetExportInfo({$list.id});">
                                            <i class="fa fa-search-plus"></i>
                                        </button>
                                        <a href="{$list.modify}" class="btn btn-default"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                            {/foreach}

                        </tbody>
                    </table>
                    <!-- end project list -->

                    <div class="paging">{$paging.paging}</div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Thống kê</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <h4>Lọc theo thời gian</h4>
                    <div id="Filter">
                        <select class="form-control" id="filter" onchange="filter();">
                            {$out.filter}
                        </select> {if $out.value.filter eq '2'} <select class="form-control" id="year" onchange="filter();"> {$out.year}
                        </select> <select class="form-control" id="month" onchange="filter();">
                            {$out.month}
                        </select> {/if} {if $out.value.filter eq '1'} <input type="text" class="form-control" id="date_from" placeholder="Từ ngày" onchange="filter();" value="{$out.date_from}"> <input type="text" class="form-control" id="date_to" placeholder="Đến ngày" onchange="filter();" value="{$out.date_to}"> {/if}
                    </div>
                    <h4>Lọc theo công nợ</h4>
                    <select class="form-control" id="care_debt" onchange="filter();">
                        {$out.care_debt}
                    </select>
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Thoát</button>
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
<script>
    var this_url = '{$out.url}';
</script>

<script src="{$arg.stylesheet}js/moment/moment.min.js"></script>
<script src="{$arg.stylesheet}js/chartjs/chart.min.js"></script>
<script type="text/javascript" src="{$arg.stylesheet}js/datepicker/daterangepicker.js"></script>
{literal}
<script>

    $(document).ready(function() {
        $('#date_from').daterangepicker({singleDatePicker: true, calender_style: "picker_4", format: 'DD-MM-YYYY'}, function(){
            $('#date_from').change();
        });
        $('#date_to').daterangepicker({singleDatePicker: true, calender_style: "picker_4", format: 'DD-MM-YYYY'}, function(){
            $('#date_to').change();
        });
    });

function SetExportInfo(id) {
    $("#orderDetail .modal-body").load("?mod=exportAjax&site=ajax_get_export_info", {"id": id});
}
function filter(){
    var filter = $("#filter").val();
    var care_debt = $("#care_debt").val();
    var url = this_url;
    url += "&filter=" + filter+"&care_debt="+care_debt;

    if(filter=="1"){
        var date_from = $("#date_from").val();
        var date_to = $("#date_to").val();
        url += "&date_from=" + date_from;
        url += "&date_to=" + date_to;
    }
    else if(filter=="2"){
        var year = $("#year").val();
        var month = $("#month").val();
        url += "&year=" + year;
        url += "&month=" + month;
    }

    window.location.href = url;
}
</script>
{/literal}
