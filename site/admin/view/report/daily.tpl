<div class="">
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Báo cáo thu chi theo ngày</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <div class="h_content">
                        <div class="form-group form-inline pull-left">
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
                        </div>
                         <form method="post" style="display: inline;">
                            <input type="hidden" name="export_request">
                            <button type="submit" class="btn btn-success"><i class="fa fa-share-square-o"></i> Xuất file Excel</button>
                        </form>
                       
                        <div class="clearfix"></div>
                    </div>

                    <!-- start project list -->
                    <table class="table table-striped table-bordered ">
                        <thead>
                            <tr>
                                <th>Ngày</th>
                                <th class="text-right">Các khoản thu</th>
                                <th class="text-right">Các khoản chi</th>
                                <th class="text-right">Tổng kết</th>
                            </tr>
                        </thead>
                        <tbody>

                            {foreach from=$result item=list}
                                <tr>
                                    <td>{$list.date}</td>
                                    <td class="text-right">{$list.imported|number_format} đ</td>
                                    <td class="text-right">- {$list.exported|number_format} đ</td>
                                    <td class="text-right bold">{($list.imported-$list.exported)|number_format} đ</td>
                                </tr>
                            {/foreach}

                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th class="text-right">{$total.imported|number_format} đ</th>
                                <th class="text-right">- {$total.exported|number_format} đ</th>
                                <th class="text-right">{($total.imported-$total.exported)|number_format} đ</th>
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
                                var date = $("#date_ex").val();

                                var url = "./?mod=report&site=daily";
                                url += "&filter=" + filter;
                                url += "&supp=" + supp;
                                url += "&date=" + date;

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
