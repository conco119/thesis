<div class="">
    <div class="x_panel">
        <div class="x_title">
            <h2>Quản lý dịch vụ</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <div class="h_content">
                <!--<div class="form-group form-inline">
                    <input class="left form-control" id="key" type="text" placeholder="Mã / tên dịch vụ" value="{$out.key}">
                </div>
                <button type="button" class="btn btn-primary left" onclick="filter();"><i class="fa fa-search"></i></button>-->

                <!--<a href="{$out.import}" class="btn btn-primary"><i class="fa fa-file-excel-o"></i>&ensp;Nhập</a>-->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#UpdateForm" onclick="LoadDataForForm(0);"><i class="fa fa-pencil"></i>&ensp;Thêm mới</button>
                <!--<button type="button" class="btn btn-success" onclick="HandleCopy();"><i class="fa fa-copy"></i>&ensp;Copy</button>-->
                {* <button type="button" class="btn btn-success" onclick="HandleActive('services', 1);"><i class="fa fa-check-square-o"></i>&ensp;Kích hoạt</button> *}
                {* <button type="button" class="btn btn-default" onclick="HandleActive('services', 0);"><i class="fa fa-times-circle"></i>&ensp;Hủy</button> *}
                <div class="clearfix"></div>
            </div>

            <!-- start project list -->
            <div class="table-responsive">
            <table class="table table-striped table-hover projects">
                <thead>
                    <tr>
                        <th>Dịch vụ</th>
                        <th class="text-right">Giá bán</th>
                        <th class="text-center">Trạng thái</th>
                        <th class="text-right">Cập nhật</th>
                        <th class="text-right">Tạo</th>
                        <th class="text-right">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$services item=data}
                        <tr id="field{$data.id}">
                            <td>{$data.name}<br /> <small><i class="fa fa-star"></i> {$data.code}</small></td>
                            <td class="text-right"> <b style='color:red'> {$data.price} </b> </td>
                            <td class="text-center" id="stt{$data.id}">{$data.status}</td>
                            <td class="text-right">{$data.updated_at}</td>
                            <td class="text-right">{$data.created_at}</td>
                            <td class="text-right">
                                <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#UpdateForm" onclick="LoadDataForForm({$data.id});"><i class="fa fa-pencil"></i></button>
                                <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#DeleteForm" onclick="LoadDeleteItem('{$arg.mc}', {$data.id}, '', 'dịch vụ', 'vì còn tồn tại trong hóa đơn');"><i class="fa fa-trash-o"></i></button>
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

<!-- Modal UpdateForm -->
<div class="modal fade" tabindex="-1" id="UpdateForm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 id="update_title" class="modal-title">Thêm / Sửa dịch vụ</h4>
            </div>
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <input type="hidden" name="id">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Dịch vụ</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="text" name="name" required="required" class="form-control" placeholder="Tên dịch vụ...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Mã</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="text" name="code" required="required" class="form-control" placeholder="Mã dịch vụ...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Chi phí</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="text" name="price" required="required" class="form-control" oninput="setPrice(this);" placeholder="Giá bán...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Mô tả thêm</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <textarea style="resize: vertical;" rows="4" name="description" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Trạng thái</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <div class="checkbox">
                                <label> <input type="checkbox" name="status" value="1"> Kích hoạt</label>
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


{literal}
<script>
$(document).ready(function () {
    $('#UpdateForm').on('shown.bs.modal', function () {
        $('input[name=name]').focus();
    });
});

function activeStatus(table, id) {
    $.post("./admin?mc=service&site=ajax_active", {'table': table, 'id': id}).done(function (data) {
            if(data == 0)
              alert('You can not change');
            else
            $("#stt" + id).html(data);
    });
}

function LoadDataForForm(id) {
    $("#UpdateForm input[type=text]").val('');
    $("#UpdateForm textarea").val('');
    $.post("./admin?mc=service&site=ajax_load", {'id': id}).done(function (data) {
        var data = JSON.parse(data);
        if (data.id == undefined) {
            $("#UpdateForm input[name=id]").val(0);
            $("#UpdateForm input[name=name]").val("");
            $("#UpdateForm input[name=price]").val("");
            $("#UpdateForm input[name=status]").attr("checked", "checked");
            $("#UpdateForm input[name=status]").prop('checked', true);
            $("#update_title").html('Thêm dịch vụ mới');
        } else {
            $("#update_title").html('Sửa dịch vụ');
            $("#UpdateForm input[name=id]").val(data.id);
            $("#UpdateForm input[name=name]").val(data.name);
            $("#UpdateForm input[name=price]").val(data.price);
            $("#UpdateForm textarea[name=description]").val(data.description);

            if (data.status == '1') {
                $("#UpdateForm input[name=status]").attr("checked", "checked");
                $("#UpdateForm input[name=status]").prop('checked', true);
            } else {
                $("#UpdateForm input[name=status]").removeAttr("checked");
                $("#UpdateForm input[name=status]").prop('checked', false);
            }
        }
        $("#UpdateForm input[name=code]").val(data.code);
    });
}


</script>
{/literal}
<script>
$(document).ready(function() {
	if( "{$notification.status}" == "success" || "{$notification.status}" == "error")
	{
		var notice = new PNotify({
			title: "{$notification.title}",
			text: "{$notification.text}",
			type: "{$notification.status}",
			mouse_reset: false,
			buttons: {
				sticker: false,
		}
		});
		notice.get().click(function () {
			notice.remove();
		});
	}
})
</script>