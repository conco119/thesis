<div class="">
	<div class="row">
		<div class="col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Bảng phân quyền nhân viên</h2>
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
						<button type="button" class="btn btn-success" onclick="HandleActive('user_permissions', 1);"><i class="fa fa-check-square-o"></i> Kích hoạt</button>
						<button type="button" class="btn btn-default" onclick="HandleActive('user_permissions', 0);"><i class="fa fa-times-circle"></i> Hủy</button>
						<div class="clearfix"></div>
					</div>

					<!-- start project list -->
					<div class="table-responsive">
    					<table class="table table-striped table-hover projects">
    						<thead>
    							<tr>
    								<th><input type="checkbox" id="SelectAllRows"></th>
    								<th>Tên phân quyền</th>
    								<th>Url phân quyền</th>
    								<th>Level</th>
    								<th class="text-center">Sắp xếp</th>
    								<th class="text-center">Trạng thái</th>
    								<th class="text-right">Cập nhật</th>
    								<th class="text-right"></th>
    							</tr>
    						</thead>
    						<tbody>
    							{foreach from=$result item=data}
    							<tr id="field{$data.id}">
    								<td><input type="checkbox" class="item_checked" value="{$data.id}"></td>
    								<td>{$data.name}<br /> <small><i class="fa fa-star"></i> {$data.type}</small></td>
    								<td>{$data.mod} | {$data.site}</td>
    								<td>{$data.level}</td>
    								<td class="text-center">{$data.sort}</td>
    								<td class="text-center" id="stt{$data.id}">{$data.status}</td>
    								<td class="text-right">{$data.updated}</td>
    								<td class="text-right">
    									<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#UpdateFrom" onclick="LoadDataForForm({$data.id});"><i class="fa fa-pencil"></i></button>
    									<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#DeleteForm" onclick="LoadDeleteItem('user', {$data.id}, 'ajax_permission_delete', 'phân quyền', 'vì còn chứa nhân viên');"><i class="fa fa-trash-o"></i></button>
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
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Danh mục</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select class="form-control" name="type"></select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Tên</label>
						<div class="col-md-8 col-sm-8 col-xs-12">
							<input type="text" name="name" required="required" class="form-control" placeholder="Tên...">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Url</label>
						<div class="col-md-4 col-sm-4 col-xs-12">
							<input type="text" name="mod" required="required" class="form-control" placeholder="module...">
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12">
							<input type="text" name="site" required="required" class="form-control" placeholder="function...">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Mức</label>
						<div class="col-md-4 col-sm-6 col-xs-12">
							<select class="form-control" name="level"></select>
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
					<button type="button" class="btn btn-default" data-dismiss="modal">Thoát</button>
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
					<button type="submit" class="btn btn-primary" name="savePermission">Save changes</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
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
	$.post("?mod=user&site=ajax_load_permission_item", {'id' : id}).done(function(data) {
		var data = JSON.parse(data);
		console.log(data);
		if (data.id == undefined) {
			$("#UpdateFrom input[name=id]").val(0);
			$("#UpdateFrom input[name=sort]").val(1);
			$("#UpdateFrom input[name=status]").attr("checked", "checked");
			$("#UpdateFrom input[name=status]").prop('checked', true);
			$("#title").html("Thêm nhóm phân quyền");
		} else {
			$("#UpdateFrom input[name=id]").val(data.id);
			$("#UpdateFrom input[name=name]").val(data.name);
			$("#UpdateFrom input[name=mod]").val(data.mod);
			$("#UpdateFrom input[name=site]").val(data.site);
			$("#UpdateFrom input[name=sort]").val(data.sort);
			$("#title").html("Sửa thông tin nhóm phân quyền");
			if (data.status == '1'){
				$("#UpdateFrom input[name=status]").attr("checked", "checked");
				$("#UpdateFrom input[name=status]").prop('checked', true);
			}
			else{
				$("#UpdateFrom input[name=status]").removeAttr("checked");
				$("#UpdateFrom input[name=status]").prop('checked', false);
			}
		}
		$("#UpdateFrom select[name=type]").html(data.select_type);
		$("#UpdateFrom select[name=level]").html(data.select_level);
	});
}
</script>
{/literal}
