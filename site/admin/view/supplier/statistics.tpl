<div class="">
    <div class="row">
        <div class="col-md-9">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{$out.title}</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <div class="h_content">
                        <form method="post" style="display: inline-block; float: left;">
                            
                            <button type="submit" name="export_request" class="left btn btn-success"><i class="fa fa-share-square-o"></i> Xuất file Excel</a></button>
                        </form>
                        <div class="clearfix"></div>
                    </div>

                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="rowSelectAll"></th>
                                <th>Mã</th>
                                <th>Nhà cung cấp</th>
                                <th class="text-right">{$out.title_money}</th>
                                <th class="text-right"></th>
                            </tr>
                        </thead>
                        <tbody>

                            {foreach from=$result item=list}
                                <tr>
                                    <td><input type="checkbox" class="row-select" name="ckeck[]" value="{$list.id}"></td>
                                    <td>{$list.code}</td>
                                    <td>{$list.name}</td>
                                    <td class="text-right">{$list.owe|number_format}</td>
                                    <td class="text-right">
                                        <a href="?mod=supplier&site=detail&id={$list.id}&filter={$out.detail_filter}&year={$out.detail_year}&month={$out.detail_month}&date_from={$out.detail_datefrom}&date_to={$out.detail_dateto}" class="btn btn btn-success"><i class="fa fa-search-plus"></i></a>
                                    </td>
                                </tr>
                            {/foreach}

                        </tbody>
                    </table>

                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Mối quan tâm</h2>
                    <div class="clearfix"></div>
                       {$out.care}
                </div>
                <div class="x_content">
                    <div id="Filter">
                        <h4 style="margin-top: 0px;">Thời gian</h4>
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
                    <div class=" row form-group">
                        <label class="col-lg-5">Số lượng</label>
                        <div class="col-lg-7"><input type="number" name="limit" onchange="filter();" class="form-control" value="{$out.limit}" min="1"></div>
                     </div>
                </div>
            </div>
        </div>

    </div>
</div>


<script src="{$arg.stylesheet}js/moment/moment.min.js"></script>
<script type="text/javascript" src="{$arg.stylesheet}js/datepicker/daterangepicker.js"></script>
<script>
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

var money = 0;
function GetSupplierInfo(value) {
    $.post('?mod=supplier&site=ajax_load_item', {'id': value})
            .done(function (data) {
                var cus = JSON.parse(data);
                $("#code").val(cus.code);
                $("#name").val(cus.name);
                $("#phone").val(cus.phone);
                $("#address").val(cus.address);
                $("#owe").val(cus.owe);
                $("#money").val(0);
                money = cus.owe.replace(/,/gi, "");
                $("#group-payment").show();
            });
}

function GetAllMoney() {
    $.post('?mod=helps&site=ajax_get_number_format&id=', {'value': money}).done(function (data) {
        $("#money").val(data);
    });
}

function CheckMoneyPayment(value) {
    var value = value.replace(/,/gi, "");
    if (parseInt(value) > parseInt(money)) {
        alert('So tien nhap vuot qua cong no');
        $.post('?mod=helps&site=ajax_get_number_format&id=', {'value': money}).done(function (data) {
            $("#money").val(data);
        });
        return false;
    }
}


function filter() {
    var filter = $("#filter").val();
    var type = $("#type").val();
    var cate = $("input[name=radio_care]:checked").val();
    var limit = $("input[name=limit]").val();
    var url = "./?mod=supplier&site=statistics";
    url += "&filter=" + filter;
    url += "&type=" + type;
    url += "&cate=" + cate;
    url += "&limit=" + limit;

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
