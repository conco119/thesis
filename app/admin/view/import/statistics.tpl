<div class="">
    <div class="row">
        <div class="col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Lưu trữ hóa đơn nhập hàng</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="h_content">
                        <div class="form-group form-inline pull-left filter_form">
                                <select class="form-control" id="date_ex" onchange="filter();">
                                    <option value="0">Tất cả hóa đơn</option> {$out.select_export}
                                </select>
                            <input class="form-control" id="key" value="{$out.key}" name="key" onchange="filter()" placeholder="Mã phiếu nhập,Id, Tên nhà cung cấp">
                        </div>

                        <a href="./admin?mc=import&site=index" class="btn btn-primary"><i class="fa fa-pencil"></i> Tạo hóa đơn</a>
                        <div class="clearfix"></div>
                    </div>
                    <!-- start project list -->
                    <div class="table-responsive">
                        <table class="table table-striped projects">
                            <thead>
                                <tr>
                                    <th>Hóa đơn</th>
                                    <th>Nhà Cung cấp</th>
                                    <th class="text-right">Giá trị</th>
                                    <th class="text-right">Chiết khấu</th>
                                    <th class="text-right">Công nợ</th>
                                    <th>Nhân viên bán</th>
                                    <th class=""></th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach from=$result item=list}
                                    <tr>
                                        <td>{$list.code} <br> <small>{$list.date}</small></td>
                                        <td>{$list.supplier}</td>
                                        <td class="text-right">{$list.money|number_format}</td>
                                        <td class="text-right">{$list.discount}</td>
                                        <td class="text-right">{$list.debt|number_format}</td>
                                        <td>{$list.user}</td>
                                        <td class="text-right">
                                            <button type="button" data-toggle="modal" class="btn btn-default" data-target="#orderDetail" onclick="DisplayDetail({$list.id});">
                                                <i class="fa fa-search-plus"></i>
                                            </button>
                                           <!--{if $list.is_auto neq 1}-->
                                                <a href="{$list.modify}" class="btn btn-default">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            <!--{/if}-->
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

        function filter()
        {
            var date = $("#date_ex").val();
            var key = $("#key").val();

            var url = "./admin?mc=import&site=statistics";
            url += "&date=" + date;
            url += "&key=" + key;

            window.location.href = url;
        }

        function SetPrint(id) {
            $("#PrintContent").attr("src", "?mod=import&site=cprint&id=" + id);
            return false;
        }

        function DisplayDetail(id) {
            $("#orderDetail .modal-body").load("./admin?mc=import&site=ajax_get_import_info", {"id": id});
        }
    </script>
{/literal}
