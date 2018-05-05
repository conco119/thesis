<div class="">
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Báo cáo tài chính</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <div class="h_content">
                        <div class="form-group form-inline">
                            <select class="form-control left" id="filter" onchange="filter();">
                                {$out.filter}
                            </select>

                            {if $out.value.filter eq '2'}
                                <select class="form-control left" id="year" onchange="filter();">
                                    {$out.year}
                                </select>
                                <select class="form-control left" id="month" onchange="filter();">
                                    {$out.month}
                                </select>
                            {/if}

                            {if $out.value.filter eq '1'}
                                <input type="text" class="form-control left" id="date_from" placeholder="Từ ngày" onchange="filter();" value="{$out.date_from}">
                                <input type="text" class="form-control left" id="date_to" placeholder="Đến ngày" onchange="filter();" value="{$out.date_to}">
                            {/if}
                        </div>
                        <button data-toggle="modal" class="btn btn-primary" data-target="#UpdateItem" onclick="LoadDataForEdit();"><i class="fa fa-pencil"></i> Nạp tiền vào ngân quỹ</button>
                         <form method="post" style="display: inline;">
                            <input type="hidden" name="export_request">
                            <button type="submit" class="btn btn-success"><i class="fa fa-share-square-o"></i> Xuất file Excel</a>
                        </form>
                       
                        <div class="clearfix"></div>
                    </div>
                    <h3 class="text-right">Ngân quỹ: <b>{$money.money|number_format} đ</b></h3>

                    <!-- start project list -->
                    <table class="table table-striped table-bordered ">
                        <thead>
                            <tr>
                                <th colspan="1" rowspan="2">Ngày</th>
                                <th colspan="3" class="text-center">Các khoản thu</th>
                                <th colspan="4" class="text-center">Các khoản chi hoặc phát sinh</th>
                                <th colspan="1" rowspan="2" class="text-right">Nợ NCC</th>
                                <th colspan="1" rowspan="2" class="text-right">Tổng kết</th>
                            </tr>
                            <tr>
                            	<th class="text-right">Nạp ngân quỹ</th>
                                <th class="text-right">Doanh thu</th>
                                <th class="text-right">Thu nợ</th>
                                <th class="text-right">K.H nợ</th>
                                <th class="text-right">Nhập hàng</th>
                                <th class="text-right">Trả nợ NCC</th>
                                <th class="text-right">Chi phí</th>
                            </tr>
                        </thead>
                        <tbody>

                            {foreach from=$result item=list}
                                <tr>
                                    <td>{$list.date}</td>
                                    <td class="text-right">{$list.insert_money|number_format}</td>
                                    <td class="text-right">{$list.export|number_format}</td>
                                    <td class="text-right">{$list.pay|number_format}</td>
                                    <td class="text-right">{$list.owes|number_format}</td>
                                    <td class="text-right">{$list.import|number_format}</td>
                                    <td class="text-right">{$list.import_pay|number_format}</td>
                                    <td class="text-right">{$list.fees|number_format}</td>
                                    <td class="text-right">{$list.import_owe|number_format}</td>
                                    <td class="text-right bold">{$list.result|number_format}</td>
                                </tr>
                            {/foreach}

                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th class="text-right">{$out.stats.insert_money|number_format}</th>
                                <th class="text-right">{$out.stats.export|number_format}</th>
                                <th class="text-right">{$out.stats.pay|number_format}</th>
                                <th class="text-right">{$out.stats.owe|number_format}</th>
                                <th class="text-right">{$out.stats.import|number_format}</th>
                                <th class="text-right">{$out.stats.import_pay|number_format}</th>
                                <th class="text-right">{$out.stats.fees|number_format}</th>
                                <th class="text-right">{$out.stats.import_owe|number_format}</th>
                                <th class="text-right bold">{$out.stats.result|number_format}</th>
                            </tr>
                        </tfoot>
                    </table>
                    <!-- end project list -->

                    <div class="paging">{$paging.paging}</div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Modal Update Item -->
<div class="modal fade" id="UpdateItem">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="post" id="validate">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Nạp tiền</h4>
                </div>
                <div class="modal-body form-horizontal form">
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Office</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" name="office_id"></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Số tiền nạp</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" class="form-control" name="money" oninput="SetMoney(this);">
                        </div>
                    </div>

                    <br />
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="ImportMoney">Đồng ý</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Hủy bỏ</button> 
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{$arg.stylesheet}js/moment/moment.min.js"></script>
<script src="{$arg.stylesheet}js/chartjs/chart.min.js"></script>
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


                            function LoadDataForEdit() {
                                $("#UpdateItem input[type=text]").val('');
                                $.post("?mod=usOffice&site=ajax_load_item_for_import_money")
                                        .done(function (data) {
                                            var data = JSON.parse(data);
                                            console.log(data);
                                            $("select[name=office_id]").html(data.offices);
                                        });
                            }

                            function filter() {
                                var filter = $("#filter").val();
                                var supp = $("#supp").val();

                                var url = "./?mod=report&site=daily";
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
