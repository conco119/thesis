<div class="">
	<div class="row">
		<div class="col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Chức vụ nhân viên</h2>
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
						<button type="button" class="btn btn-success" onclick="HandleActive('user_positions', 1);"><i class="fa fa-check-square-o"></i> Kích hoạt</button>
						<button type="button" class="btn btn-default" onclick="HandleActive('user_positions', 0);"><i class="fa fa-times-circle"></i> Hủy</button>
						<div class="clearfix"></div>
					</div>

					<!-- start project list -->
					<div class="table-responsive">
    					<table class="table table-striped table-hover projects">
    						<thead>
    							<tr>
    								<th style="width: 1%"><input type="checkbox" id="SelectAllRows"></th>
    								<th>Mã</th>
    								<th style="width: 25%">Tên chức vụ</th>
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
    								<td>{$data.code}</td>
    								<td>{$data.name}</td>
    								<td class="text-center">{$data.sort}</td>
    								<td class="text-center" id="stt{$data.id}">{$data.status}</td>
    								<td class="text-right">{$data.updated}</td>
    								<td class="text-right">
    									<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#UpdateFrom" onclick="LoadDataForForm({$data.id});"><i class="fa fa-pencil"></i></button>
    									<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#DeleteForm" onclick="LoadDeleteItem('user', {$data.id}, 'ajax_position_delete', 'chức vụ', 'vì có chứa nhân viên');"><i class="fa fa-trash-o"></i></button>
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
				<h4 class="modal-title">Insert / Update Form</h4>
			</div>
			<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="">
				<div class="modal-body">
					<div class="form-group">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<input type="hidden" name="id">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Code</label>
						<div class="col-md-4 col-sm-6 col-xs-12">
							<input class="form-control" type="text" name="code">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Name</label>
						<div class="col-md-8 col-sm-8 col-xs-12">
							<input type="text" name="name" required="required" class="form-control" placeholder="Name...">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Sort</label>
						<div class="col-md-2 col-sm-6 col-xs-12">
							<input type="number" class="form-control" name="sort">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Status</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<div class="checkbox">
								<label> <input type="checkbox" name="status" value="1"> Active / Inactive this item</label>
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

{literal}
<script>
	function LoadDataForForm(id) {
		$("#UpdateFrom input[type=text]").val('');
		$.post("?mod=user&site=ajax_load_position_item", {'id' : id}).done(function(data) {
			var data = JSON.parse(data);
			console.log(data);
			if (data.id == undefined) {
				$("#UpdateFrom input[name=id]").val(0);
				$("#UpdateFrom input[name=sort]").val(1);
				$("#UpdateFrom input[name=status]").attr("checked", "checked");
				$("#UpdateFrom input[name=status]").prop('checked', true);
			} else {
				$("#UpdateFrom input[name=id]").val(data.id);
				$("#UpdateFrom input[name=name]").val(data.name);
				$("#UpdateFrom input[name=sort]").val(data.sort);
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
