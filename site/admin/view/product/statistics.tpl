<div class="">
    <div class="row">
        <div class="col-md-9">
            <div class="x_panel">
                    <h2>{$out.title}</h2>
                <hr>
                    <form method="post" style="display: inline-block; float: left;">
                        <button type="submit" name="export_request" class="left btn btn-success "><i
                                    class="fa fa-share-square-o"></i> Xuất file Excel</button>
                    </form>
                    <div class="clearfix"></div>
                <div class="x_content" id="product">
                    <table class="table table-striped projects">
                        <thead>
                        <tr>
                            <th><input type="checkbox" id="rowSelectAll"></th>
                            <th>Mã</th>
                            <th>Tên</th>
                            <th>Nhóm</th>
                            <th>Số lượng</th>
                            <th class="text-right">Tổng tiền</th>
                        </tr>
                        </thead>
                        <tbody>

                        {foreach from=$result item=list}
                            <tr>
                                <td><input type="checkbox" class="row-select" name="ckeck[]" value="{$list.id}"></td>
                                <td>{$list.code}</td>
                                <td>{$list.name}</td>
                                <td>{$list.gr}</td>
                                <td>{$list.count}</td>
                                <td class="text-right">{$list.owe|number_format}</td>
                            </tr>
                        {/foreach}
                        </tbody>
                        <tfoot>
                        <tr>
                        <th colspan="4" class="text-right">Tổng:</th>
                        <td class="text-right">{$out.number} </td>
                            <td class="text-right">{$out.total|number_format} đ</td>
                        </tr>
                        </tfoot>
                    </table>

                </div>
                <div class="paging">{$paging.paging}</div>
            </div>

        </div>

        <div class="col-md-3">
            <div class="x_panel">
                <div id="product_show">
                    {*<div class="x_title">*}
                    {*<h2>Mối quan tâm</h2>*}
                    {*<div class="clearfix"></div>*}
                    {*{$out.care}*}
                    {*</div>*}

                    <div id="Filter">
                        <h4>Nhập, xuất hàng</h4>
                        {$out.type}
                        <h4 style="margin-top: 0px;">Nhân viên</h4>
                        <select class="form-control" id="acount" onchange="filter();">
                            <option value="0" onchange="filter();">Nhân viên</option>
                            {$out.acount}
                        </select>
                        <h4 style="margin-top: 0px;">Nhóm sản phẩm</h4>
                        <select class="form-control" id="group" onchange="filter();">
                            <option value="0" onchange="filter();">Nhóm sản phẩm</option>
                            {$out.categories}
                        </select>
                        <h4 style="margin-top: 0px;">Thời gian</h4>
                        <select class="form-control" id="filter" onchange="filter();">
                            {$out.filter}
                        </select>

                        {if $out.value.filter eq '2'}
                            <select class="form-control" id="year" onchange="filter();">{$out.year}</select>
                            <select class="form-control" id="month" onchange="filter();">{$out.month}</select>

                        {else if $out.value.filter eq '1'}
                            <div class='input-group date pull-right' id='date_f'>
                                <input type='text'style="margin: 0px" class="form-control" id="" placeholder="Từ ngày" onchange="filter();"
                                       value='{$out.date_from|date_format:"%m-%d-%Y %H:%M %p"}'>
	                            <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar">
                                    </span>
                                </span>
                            </div>
                            <div class='input-group date pull-right' id='date_t'>
                                <input style="margin: 0px" type='text' class="form-control" id="" placeholder="Đến ngày"
                                       onchange="filter();" value='{$out.date_to|date_format:"%m-%d-%Y %H:%M %p"}'><span
                                        class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                            <input id="date_from" onchange="filter();" value="{$out.date_from}" type="hidden">
                            <input id="date_to" onchange="filter();" value="{$out.date_to}" type="hidden">
                        {else}
                            <select class="form-control" id="date_ex" onchange="filter();">
                                <option value="0">Tất cả hóa đơn</option> {$out.select_export}
                            </select>
                        {/if}
                    </div>
                </div>
                <hr>
                {*<div class=" row form-group">*}
                {*<label class="col-lg-5">Số lượng</label>*}
                {*<div class="col-lg-7"><input type="number" name="limit" onchange="filter();" class="form-control" value="{$out.limit}" min="1"></div>*}
                {*</div>*}
            </div>
        </div>

    </div>
</div>

<link href="{$arg.stylesheet}js/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet">
<script src="{$arg.stylesheet}js/moment/moment.min.js"></script>
<script type="text/javascript" src="{$arg.stylesheet}js/datepicker/daterangepicker.js"></script>
<script src="{$arg.stylesheet}js/datetimepicker/bootstrap-datetimepicker.min.js"></script>
{literal}
    <script>
        $(document).ready(function () {
            $('#date_f').datetimepicker({}, function () {

            });
            $('#date_t').datetimepicker({}, function () {

            });

            if ($("input[name=type]:checked").val() == 2) {
                $('#product_show').hide();
                $('#product').hide();
            }
            $("#date_f").on("dp.hide", function (e) {
                var date = new Date(e.date._d).getTime();
                var new_time = date.toString().substring(0, 10);
                $("#date_from").val(new_time);
                $('#date_from').change();
            });
            $("#date_t").on("dp.hide", function (e) {
                var date = new Date(e.date._d).getTime();
                var new_time = date.toString().substring(0, 10);
                $("#date_to").val(new_time);
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
            var group = $("#group").val();
            var acount = $("#acount").val();
            var date = $("#date_ex").val();
            var type = $("input[name=type]:checked").val();
            var limit = $("input[name=limit]").val();
            var url = "./?mod=product&site=statistics";
            url += "&filter=" + filter;
            url += "&type=" + type;
            url += "&limit=" + limit;
            url += "&group=" + group;
            url += "&date=" + date;
            url += "&acount=" + acount;

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
