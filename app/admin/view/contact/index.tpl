<div class="">
    <div class="x_panel">
        <div class="x_title">
            <h2>Liên hệ khách hàng</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">



            <!-- start project list -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Họ tên</th>
                            <th>Số điện thoại</th>
                            <th class="text-right">Email</th>
                            <th class="text-right">Ngày</th>
                            <th class="text-right">Trạng thái</th>
                            <th class="text-right"></th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach from=$contacts item=list}
                            <tr id="field{$list.id}">
                                <td>
                                    {$list.name}
                                </td>
                                <td>{$list.phone}</td>
                                <td class="text-right">
                                	{$list.email}
                                </td>
                                <td class="text-center">
                                	{$list.created_at}
                                </td>
                                <td class="text-center" id="stt{$list.id}">{$list.status}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#orderDetail" onclick="GetDetailContact({$list.id});"><i class="fa fa-search-plus"></i></button>
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

function activeStatus(table, id) {
    $.post(`./admin?mc=contact&site=ajax_active`, {'table': table, 'id': id}).done(function (data) {
            if(data != 0)
                $("#stt" + id).html(data);
    });
}

function GetDetailContact(id) {
    $.post("./admin?mc=contact&site=ajax_get_detail_contact",{"id": id}).done(function(data){
        data = JSON.parse(data)
        console.log(data)
        let append = `
        <h1 class="text-center">Nội dung</h1>
        <div class="row">
            <div class="col-md-12">
                <p>${data.description}</p>
            </div>
        </div>`
        $("#orderDetail .modal-body").html(append);
    })
}


</script>
{/literal}
