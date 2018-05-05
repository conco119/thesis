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
                            <input type="hidden" name="export_request">
                            <button type="submit" class="btn btn-success"><i class="fa fa-share-square-o"></i> Xuất file Excel</a></button>
                        </form>
                        <div class="clearfix"></div>
                    </div>

                    <!-- start project list -->
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="SelectAllRows"></th>
                                <th>Mã KH</th>
                                <th>Tên KH</th>
                                <th>Nhóm KH</th>
                                <!-- <th>Nhóm</th> -->
                                <th class="text-right">{$out.title_money}</th>
                                <!-- <th class="text-right">Tổng nợ</th>
                                <th class="text-right">Đã trả</th>
                                <th class="text-right">Nợ tồn</th> -->
                                <th class="text-right"></th>
                            </tr>
                        </thead>
                        <tbody>

                            {foreach from=$result item=list}
                                <tr>
                                    <td><input type="checkbox" class="item_checked" value="{$list.id}"></td>
                                    <td>[{$list.code}]</td>
                                    <td>{$list.name}</td>
                                    <td>{$list.group_name}</td>
                                    <!-- <td>{$list.group_name}</td> -->
                                    <td class="text-right">
                                        {$list.total|number_format}<!-- &nbsp;
                                        <button type="button" class="btn btn-small" data-target="#ContentModal" data-toggle="modal" onclick="LoadDataContent({$list.id}, 'ajax_load_products');"><i class="btn-icon-only icon-qrcode"> </i></button>
                                        <button type="button" class="btn btn-small" data-target="#ContentModal" data-toggle="modal" onclick="LoadDataContent({$list.id}, 'ajax_load_exports');"><i class="btn-icon-only icon-th-list"> </i></button> -->
                                    </td>
                                    <!-- <td class="text-right"> -->
                                        <!-- {$list.debt|number_format} --><!-- &nbsp;
                                        <button type="button" class="btn btn-small" data-target="#ContentModal" data-toggle="modal" onclick="LoadDataContent({$list.id}, 'ajax_load_owe_exports');"><i class="btn-icon-only icon-zoom-in"> </i></button> -->
                                    <!-- </td>
                                    <td class="text-right">
                                        {$list.pay|number_format} --><!-- &nbsp;
                                        <button type="button" class="btn btn-small" data-target="#ContentModal" data-toggle="modal" onclick="LoadDataContent({$list.id}, 'ajax_load_payments');"><i class="btn-icon-only icon-zoom-in"> </i></button> -->
                                    <!-- </td>
                                    <td class="text-right">{($list.debt-$list.pay)|number_format}</td> -->
                                    <td class="text-right">
                                        <a href="?mod=customer&site=detail&id={$list.id}&group={$out.detail_group}&filter={$out.detail_filter}&year={$out.detail_year}&month={$out.detail_month}&date_from={$out.detail_datefrom}&date_to={$out.detail_dateto}" class="btn btn btn-success"><i class="fa fa-search-plus"></i></a>
                                    </td>
                                </tr>
                            {/foreach}

                        </tbody>
                    </table>
                    <!-- end project list -->

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
                    <h4>Lọc</h4>
                    <div id="Filter">
                        <select class="form-control" id="group" onchange="filter();">
                            <option value="">Nhóm khách hàng</option>
                            {$out.categories}
                        </select>

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
function GetCustomerInfo(value) {
    $.post('?mod=customer&site=ajax_load_customer_info&id=' + value)
            .done(function (data) {
                var cus = JSON.parse(data);
                $("#code").val(cus.code);
                $("#name").val(cus.name);
                $("#phone").val(cus.phone);
                $("#address").val(cus.address);
                $("#owe").val(cus.money);
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
        //$("#money").val(NumberFormat(money));
        return false;
    }
}


function LoadDataForForm(id) {
    $("#UpdateFrom input[type=text]").val('');
    $.post("?mod=customer&site=ajax_load_item", {'id': id}).done(function (data) {
        var data = JSON.parse(data);
        console.log(data);
        if (data.id == undefined) {
            $("#UpdateFrom input[name=id]").val(0);
            $("#UpdateFrom input[name=sort]").val(1);
            $("#UpdateFrom input[name=status]").attr("checked", "checked");
            $("#UpdateFrom input[name=status]").prop('checked', true);
        } else {
            $("#UpdateFrom input[name=id]").val(data.id);
            $("#UpdateFrom input[name=name]").val(data.name);
            $("#UpdateFrom input[name=phone]").val(data.phone);
            $("#UpdateFrom input[name=address]").val(data.address);
            if (data.status == '1') {
                $("#UpdateFrom input[name=status]").attr("checked", "checked");
                $("#UpdateFrom input[name=status]").prop('checked', true);
            } else {
                $("#UpdateFrom input[name=status]").removeAttr("checked");
                $("#UpdateFrom input[name=status]").prop('checked', false);
            }
        }
        $("#UpdateFrom input[name=code]").val(data.code);
        $("#UpdateFrom select[name=group_id]").html(data.select_groups);
    });
}

function filter() {
    var filter = $("#filter").val();
      var cate = $("input[name=radio_care]:checked").val();
    var limit = $("input[name=limit]").val();
    var type = $("#type").val();
    var group = $("#group").val();
    var url = "./?mod=customer&site=statistics";
    url += "&group=" + group;
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
