<div class="">
    <div class="row">
        <div class="col-md-9">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Thống kê kho hàng</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <div class="h_content">
                        <a href="?mod=export&site=create" class="btn btn-primary"><i class="fa fa-pencil"></i> Tạo hóa đơn</a>
                        <div class="clearfix"></div>
                    </div>

                    <!-- start project list -->
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th>Mã</th>
                                <th>Sản phẩm</th>
                                <th class="text-right">Giá nhập</th>
                                <th class="text-right">Giá xuất</th>
                                <th class="text-right">Tổng nhập</th>
                                <th class="text-right">Tổng xuất</th>
                                <th class="text-right">Tồn kho</th>
                                <th class="text-right"></th>
                            </tr>
                        </thead>
                        <tbody>

                            {foreach from=$result item=list}
                                <tr class="{$list.style}">
                                    <td>{$list.code}</td>
                                    <td>{$list.name} <br> <small><i class="fa fa-cog"></i> {$list.category}</small></td>
                                    <td class="text-right">{($list.price_import)|number_format}</td>
                                    <td class="text-right">{$list.price|number_format}</td>
                                    <td class="text-right">{$list.import}</td>
                                    <td class="text-right">{$list.export}</td>
                                    <td class="text-right">{$list.number}</td>
                                    <td class="text-right">
                                        <a data-toggle="modal" class="btn btn-default" data-target="#ModalInfo" onclick="SetModalInfo({$list.id});"><i class="fa fa-search-plus"></i></a>
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
                    <div id="Filter">
                        <input type="text" class="form-control" id="key" placeholder="Mã / tên sản phẩm" value="{$out.key}">
                        <select class="form-control" id="category">
                            <option value="">Nhóm sản phẩm</option>
                            {$out.categories}
                        </select>
                        <button type="button" class="btn btn-primary form-control" onclick="filter();">Tìm kiếm sản phẩm</button>
                    </div>

                    <canvas id="pieChart" height="280"></canvas>

                    <ul class="barStats">
                        <li><center> <b>BIỂU ĐỒ LƯỢNG SẢN PHẨM</b></center></li>
                        <li><b>Chú thích</b></li>
                        <li><i class="fa fa-circle" style="color: #f5a732;"></i> Sắp hết hàng<span class="pull-right bold">{$stats.total_warning}</span></li>
                        <li><i class="fa fa-circle" style="color: #ff0000;"></i> Đã hết hàng<span class="pull-right bold">{$stats.total_empty}</span></li>
                        <li><center><b>TỔNG KẾT</b></center></li>
                        <li> Tổng sản phẩm<span class="pull-right bold">{$stats.total}</span></li>
                        <li> Tổng giá trị kho<span class="pull-right bold">{$stats.money|number_format}</span></li>
                    </ul>

                </div>
            </div>
        </div>

    </div>
</div>

<!-- orderDetail -->
<div class="modal fade" id="ModalInfo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"> <span>&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Thống kê lịch sử nhập hàng</h4>
            </div>
            <div class="modal-body form-horizontal">
            </div>
        </div>
    </div>
</div>

<script src="{$arg.stylesheet}js/moment/moment.min.js"></script>
<script src="{$arg.stylesheet}js/chartjs/chart.min.js"></script>
<script>
                            var nomal = {$stats.nomal};
                            var total_warning = {$stats.total_warning};
                            var total_empty = {$stats.total_empty};
</script>
{literal}
    <script>
        function filter() {
            var key = $("#key").val();

            var category = $("#category").val();

            var url = "./?mod=product&site=warehouse";
            url += "&category=" + category;
            url += "&key=" + key;
            window.location.href = url;
        }


        function SetModalInfo(id) {
            $("#ModalInfo .modal-body").load("?mod=import&site=ajax_get_import_product_info", {"id": id});
        }

        //Pie chart
        Chart.defaults.global.legend = {enabled: false};
        var ctx = document.getElementById("pieChart");
        var data = {
            datasets: [{
                data: [nomal, total_warning, total_empty],
                backgroundColor: ["#69D2E7", "#f5a732", "#ff0000"],
                label: 'My dataset' // for legend
            }],
            labels: ["Sản phẩm", "Sắp hết", "Hết hàng"]
        };
        var pieChart = new Chart(ctx, {data: data, type: 'pie', otpions: {legend: false}});
    </script>
{/literal}
