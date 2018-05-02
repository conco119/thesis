<div class="">
	<div class="row">
		<div class="col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Quản lý groups nhân viên</h2>
					<ul class="nav navbar-right panel_toolbox">
						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
						</li>
						<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench"></i></a>
							<ul class="dropdown-menu">
								<li><a href="#">Settings 1</a></li>
								<li><a href="#">Settings 2</a></li>
							</ul></li>
						<li><a class="close-link"><i class="fa fa-close"></i></a></li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">

					<div class="h_content">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#UpdateFrom" onclick="LoadDataForForm(0);"><i class="fa fa-pencil"></i> Thêm mới</button>
						<button type="button" class="btn btn-success" onclick="HandleActive('user_groups', 1);"><i class="fa fa-check-square-o"></i> Kích hoạt</button>
						<button type="button" class="btn btn-default" onclick="HandleActive('user_groups', 0);"><i class="fa fa-times-circle"></i> Hủy</button>
						<div class="clearfix"></div>
					</div>

					<!-- start project list -->
					<div class="table-responsive">
    					<table class="table table-striped table-hover projects">
    						<thead>
    							<tr>
    								<th style="width: 1%"><input type="checkbox" id="SelectAllRows"></th>
    								<th>Mã</th>
    								<th style="width: 25%">Tên nhóm</th>
    								<th class="text-center">Sắp xếp</th>
    								<th class="text-center">Trạng thái</th>
    								<th class="text-right">Cập nhật</th>
    								<th style="width: 25%" class="text-right"></th>
    							</tr>
    						</thead>
    						<tbody>
    							{foreach from=$result item=data}
    							<tr id="field{$data.id}">
    								<td><input type="checkbox" class="item_checked" value="{$data.id}"></td>
    								<td>{$data.code}</td>
    								<td>{$data.name}</td>
    								<td class="text-center">{$data.sort}</td>
    								<td class="text-center" id="stt{$data.id}">{$data.status}</td>
    								<td class="text-right">{$data.updated}</td>
    								<td class="text-right">
    									<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#ContentModal" onclick="LoadDataContent({$data.id});"><i class="fa fa-warning"></i></button>
    									<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#UpdateFrom" onclick="LoadDataForForm({$data.id});"><i class="fa fa-pencil"></i></button>
    									<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#DeleteForm" onclick="LoadDeleteItem('user', {$data.id}, 'ajax_group_delete', 'nhóm', 'vì còn chứa nhân viên');"><i class="fa fa-trash-o"></i></button>
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

<!-- Modal Delete -->
<div class="modal fade" id="DeleteForm">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Xóa mục này</h4>
			</div>
			<div class="modal-body">Bạn chắc chắn muốn xóa mục này chứ ?</div>
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
				<h4 class="modal-title" id="title"></h4>
			</div>
			<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="">
				<div class="modal-body">
					<div class="form-group">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<input type="hidden" name="id">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Mã</label>
						<div class="col-md-4 col-sm-6 col-xs-12">
							<input class="form-control" type="text" name="code">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Tên nhóm</label>
						<div class="col-md-8 col-sm-8 col-xs-12">
							<input type="text" name="name" required="required" class="form-control" placeholder="Tên nhóm...">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Mô tả</label>
						<div class="col-md-8 col-sm-6 col-xs-12">
							<textarea rows="" cols="" class="form-control" name="description"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Sắp xếp</label>
						<div class="col-md-2 col-sm-6 col-xs-12">
							<input type="number" min="0" class="form-control" name="sort">
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
					<button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
					<button type="submit" class="btn btn-primary" name="submit">Lưu</button>
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Modal Content Item -->
<div class="modal fade" id="ContentModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="" method="post">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span>&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Phân quyền cho group nhân viên</h4>
				</div>
				<div class="modal-body form-horizontal form">
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" name="savePermission">Lưu thay đổi</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
				</div>
			</form>
		</div>
	</div>
</div>


{literal}
<script>
function LoadDataContent(id){
	$.post("?mod=user&site=load_group_permission", {'id':id} )
	.done(function(data){
		$("#ContentModal .modal-body").html(data);
	});
}

function LoadDataForForm(id) {
	$("#UpdateFrom input[type=text]").val('');
	$.post("?mod=user&site=ajax_load_group_item", {'id' : id}).done(function(data) {
		var data = JSON.parse(data);
		console.log(data);
		if (data.id == undefined) {
			$("#UpdateFrom input[name=id]").val(0);
			$("#UpdateFrom input[name=sort]").val(1);
			$("#UpdateFrom input[name=status]").attr("checked", "checked");
			$("#UpdateFrom input[name=status]").prop('checked', true);
			$("#title").html("Thêm nhóm người dùng");
		} else {
			$("#UpdateFrom input[name=id]").val(data.id);
			$("#UpdateFrom input[name=name]").val(data.name);
			$("textarea[name=description]").val(data.description);
			$("#UpdateFrom input[name=sort]").val(data.sort);
			$("#title").html("Sửa thông tin nhóm người dùng");
			if (data.status == '1'){
				$("#UpdateFrom input[name=status]").attr("checked", "checked");
				$("#UpdateFrom input[name=status]").prop('checked', true);
			}
			else{
				$("#UpdateFrom input[name=status]").removeAttr("checked");
				$("#UpdateFrom input[name=status]").prop('checked', false);
			}
		}
		$("#UpdateFrom input[name=code]").val(data.code);
	});
}
</script>
{/literal}
