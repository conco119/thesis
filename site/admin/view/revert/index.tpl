<div class="">
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Lưu trữ sản phẩm trả hàng</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="h_content">
                        <div class="form-group form-inline">
	                        <select class="left form-control" id="filter" onchange="filter();">
	                            {$out.filter}
	                        </select>
	
	                        {if $out.value.filter eq '2'}
	                            <select class="left form-control" id="year" onchange="filter();">
	                                {$out.year}
	                            </select>
	                            <select class="left form-control" id="month" onchange="filter();">
	                                {$out.month}
	                            </select>
	                        {/if}
	
	                        {if $out.value.filter eq '1'}
	                            <input type="text" class="left form-control" id="date_from" placeholder="Từ ngày" onchange="filter();" value="{$out.date_from}">
	                            <input type="text" class="left form-control" id="date_to" placeholder="Đến ngày" onchange="filter();" value="{$out.date_to}">
	                        {/if}
	                    </div>
                        <a href="?mod=revert&site=create" class="btn btn-primary"><i class="fa fa-pencil"></i> Tạo phiếu trả hàng</a>
                        <div class="clearfix"></div>
                    </div>
                    <!-- start project list -->
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                            	<th>Mã phiếu trả</th>
                                <th>Sản phẩm</th>
                                <th>Hóa đơn bán</th>
                                <th class="text-right">Giá bán</th>
                                <th class="text-right">SL</th>
                                <th>Khách hàng</th>
                                <th class="text-center">Tình trạng</th>
                                <th>Mô tả</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach from=$result item=list}
                                <tr>
                                	<td>{$list.r_code} <br> <small>{$list.r_date}</small></td>
                                    <td>[{$list.code}] {$list.name}</td>
                                    <td>{$list.e_code} <br> <small>{$list.e_date}</small></td>
                                    <td class="text-right">{$list.price|number_format}</td>
                                    <td class="text-right">{$list.number}</td>
                                    <td>{$list.customer}</td>
                                    <td class="text-center">{$list.situation}</td>
                                    <td>{$list.situa_des}</td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
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

<script src="{$arg.stylesheet}js/moment/moment.min.js"></script>
<script src="{$arg.stylesheet}js/chartjs/chart.min.js"></script>
<script type="text/javascript" src="{$arg.stylesheet}js/datepicker/daterangepicker.js"></script>
<script>
    var real = {$stats.real};
    var debt = {$stats.debt};
    var payment = {$stats.payment};
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
    var supp = $("#supp").val();

    var url = "./?mod=revert&site=index";
    url += "&filter=" + filter;
    url += "&supp=" + supp;

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
</script>
{/literal}
