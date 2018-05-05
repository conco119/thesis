<div class="">
    <div class="x_panel">
        <div class="x_title">
            <h2>Quản lý khách hàng</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <div class="h_content">
                <div class="form-group form-inline">
                    <select class="form-control left" id="group" >
                        <option value="">Tất cả khách hàng</option>
                        {$out.categories}
                    </select>
                </div>
                <div class="form-group form-inline">
                    <input class="form-control left" id="key" placeholder="Mã, Tên, SĐT" >
                </div>
                <button type="button" class="btn btn-primary left" onclick="filter();"><i class="fa fa-search"></i></button>
                  
                  <a href="?mod=customer&site=groups" class="btn btn-primary left"><i class="fa fa-pencil"></i> Quản lý nhóm</a>
                <form method="post" style="display: inline; float: left;">
                    <input type="hidden" name="export_request" />
                    <button type="submit" class="btn btn-success"><i class="fa fa-share-square-o"></i> Xuất file Excel</a></button>
                </form>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#UpdateFrom" onclick="LoadDataForForm(0);"><i class="fa fa-pencil"></i> Thêm mới</button>
                <button type="button" class="btn btn-success" onclick="HandleActive('customers', 1);"><i class="fa fa-check-square-o"></i> Kích hoạt</button>
                <button type="button" class="btn btn-default" onclick="HandleActive('customers', 0);"><i class="fa fa-times-circle"></i> Hủy</button>
                <div class="clearfix"></div>
            </div>

            <!-- start project list -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center"><input type="checkbox" id="SelectAllRows"></th>
                            <th>Khách hàng</th>
                            <th>Nhóm</th>
                            <th class="text-right">Tài khoản / Ghi nợ</th>
                            <th class="text-right">Chi tiết mua hàng</th>
                            <th class="text-right">Tổng mua</th>
                            <th class="text-center">TT</th>
                            <th class="text-right"></th>
                        </tr>
                    </thead>
                    <tbody>
    
                        {foreach from=$result item=list}
                            <tr id="field{$list.id}">
                                <td class="text-center"><input type="checkbox" class="item_checked" value="{$list.id}"></td>
                                <td>[{$list.code}] {$list.name}</td>
                                <td>{$list.group_name}</td>
                                <td class="text-right">
                                	{$list.money|number_format}
                                </td>
                                <td class="text-center"><a href="?mod=customer&site=detail&id={$list.id}" class="btn btn btn-success"><i class="fa fa-search-plus"></i></a></td>
                                <td class="text-right">
                                	{$list.buy_money|number_format}
                                    <a href="?mod=customer&site=history&id={$list.id}" class="btn btn btn-success"><i class="fa fa-search-plus"></i></a>
                                </td>
                                <td class="text-center" id="stt{$list.id}">{$list.status}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#UpdateFrom" onclick="LoadDataForForm({$list.id});"><i class="fa fa-pencil"></i></button>
                                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#DeleteForm" onclick="LoadDeleteItem('customer', {$list.id}, '', 'khách hàng', 'vì còn tồn tại hóa đơn');"><i class="fa fa-trash-o"></i></button>
                                </td>
                            </tr>
                        {/foreach}
                    <tr>
                        <th colspan="3" class="text-right">
                            Tổng tài khoản
                        </th>
                        <th class="text-right">
                            {$out.total_owe_d|number_format} đ
                        </th>
                        <th class="text-right">
                            Tổng mua hàng
                        </th>
                        <th class="text-right">
                            {$out.total_price|number_format} đ
                        </th>
                    </tr>
                    <tr>
                        <th colspan="3" class="text-right">
                            Tổng ghi nợ
                        </th>
                        <th class="text-right">
                            {$out.total_owe_a|number_format} đ
                        </th>
                        <td colspan="4">

                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!-- end project list -->

            <div class="paging">{$paging.paging}</div>
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
                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy bỏ</button>
                <button type="button" class="btn btn-danger" onclick="DeleteItem();" id="DeleteItem">Xóa</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal UpdateFrom -->
<div class="modal fade" tabindex="-1" id="UpdateFrom">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 class="modal-title" id="title"> </h4>
            </div>
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <input type="hidden" name="id">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Nhóm KH</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" name="group_id"></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Mã</label>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <input class="form-control" type="text" name="code">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Tên KH</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="text" name="name" required class="form-control" placeholder="Tên KH">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Điện thoại</label>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <input type="tel" class="form-control" name="phone" pattern="[0-9]\d*" title="Số điện thoại">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Địa chỉ</label>
                        <div class="col-md-9 col-sm-6 col-xs-12">
                            <input type="text" class="form-control" name="address">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Status</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <div class="checkbox">
                                <label> <input type="checkbox" name="status" value="1">Kích hoạt</label>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="submit">Lưu lại</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Bỏ qua</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script src="{$arg.stylesheet}js/moment/moment.min.js"></script>
<script type="text/javascript" src="{$arg.stylesheet}js/datepicker/daterangepicker.js"></script>
<script>
var owe = {$chart.debt};
var pay = {$chart.pay};
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
            $("#title").html('Thêm khách hàng');
        } else {
            $("#UpdateFrom input[name=id]").val(data.id);
            $("#UpdateFrom input[name=name]").val(data.name);
            $("#UpdateFrom input[name=phone]").val(data.phone);
            $("#UpdateFrom input[name=address]").val(data.address);
            $("#title").html('Sửa thông tin khách hàng');
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

function filter() 
{
  var key = $("#key").val();
    var category = $("#group").val();
    var url = "./?mod=customer&site=index";
    url += "&group=" + category;
    url += "&key=" + key;
    window.location.href = url;
}

</script>
{/literal}
