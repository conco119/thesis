<?php
/* Smarty version 3.1.30, created on 2018-05-26 17:29:40
  from "/Users/mtd/Sites/htaccess/app/admin/view/customergroup/index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b0937141a7ae8_79687947',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a18643eeee7add21edfc1db76cf05f1d237bfd1d' => 
    array (
      0 => '/Users/mtd/Sites/htaccess/app/admin/view/customergroup/index.tpl',
      1 => 1527330568,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b0937141a7ae8_79687947 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="">
	<div class="row">
		<div class="col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Quản lý nhóm khách hàng</h2>
					<ul class="nav navbar-right panel_toolbox">
						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<div class="h_content">
						<a href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['prefix_admin'];?>
mc=customer&site=index" class="btn btn-primary left"><i class="fa fa-bars"></i> Quản lý khách hàng</a>

						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#UpdateFrom" onclick="LoadDataForForm(0);"><i class="fa fa-pencil"></i> Thêm mới</button>
						<div class="clearfix"></div>
					</div>

					<!-- start project list -->
					<div class="table-responsive">
    					<table class="table table-striped table-hover projects">
    						<thead>
    							<tr>
    								<th>Mã</th>
    								<th style="width: 25%">Tên nhóm</th>
    								<th class="text-center">Trạng thái</th>
    								<th class="text-right">Cập nhật</th>
    								<th style="width: 20%" class="text-right"></th>
    							</tr>
    						</thead>
    						<tbody>
    							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['customergroups']->value, 'data');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
?>
    							<tr id="field<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
">
    								<td><?php echo $_smarty_tpl->tpl_vars['data']->value['code'];?>
</td>
    								<td><?php echo $_smarty_tpl->tpl_vars['data']->value['name'];?>
</td>
    								<td class="text-center" id="stt<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['data']->value['status'];?>
</td>
    								<td class="text-right"><?php echo $_smarty_tpl->tpl_vars['data']->value['updated_at'];?>
</td>
    								<td class="text-right">
    									<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#UpdateFrom" onclick="LoadDataForForm(<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
);"><i class="fa fa-pencil"></i></button>
    									<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#DeleteForm" onclick="LoadDeleteItem('<?php echo $_smarty_tpl->tpl_vars['arg']->value['mc'];?>
', <?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
, '', 'nhóm', 'vì có chứa khách hàng');"><i class="fa fa-trash-o"></i></button>
    								</td>
    							</tr>
    							<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

    						</tbody>
    					</table>
					</div>
					<!-- end project list -->

					<div class="paging"><?php echo $_smarty_tpl->tpl_vars['paging']->value['paging'];?>
</div>
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
							<input type="hidden" name="prefix_admin" value='<?php echo $_smarty_tpl->tpl_vars['arg']->value['prefix_admin'];?>
'>
							<input type="hidden" name="mc" value='<?php echo $_smarty_tpl->tpl_vars['arg']->value['mc'];?>
'>
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
							<input type="text" name="name" required="required" class="form-control" placeholder="Tên nhóm">
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


<?php echo '<script'; ?>
>

function activeStatus(table, id) {
	let prefix_admin = $("#UpdateFrom input[name=prefix_admin]").val();
    $.post(`${prefix_admin}mc=customergroup&site=ajax_active`, {'table': table, 'id': id}).done(function (data) {
            if(data == 0)
              alert('You can not change');
            else
            $("#stt" + id).html(data);
    });
}

function LoadDataForForm(id) {
	let mc = $("#UpdateFrom input[name=mc]").val();
	let prefix_admin = $("#UpdateFrom input[name=prefix_admin]").val();
	console.log(mc, prefix_admin);
	$("#UpdateFrom input[type=text]").val('');
	$("#UpdateFrom input[type=number]").val('');
	$.post(`${prefix_admin}mc=${mc}&site=ajax_load`, {'id' : id}).done(function(data) {
		var data = JSON.parse(data);
		console.log(data);
		if (data.id == undefined) {
			$("#UpdateFrom input[name=id]").val(0);
			$("#UpdateFrom input[name=status]").attr("checked", "checked");
			$("#UpdateFrom input[name=status]").prop('checked', true);
			$("#title").html("Thêm nhóm khách hàng mới");
		} else {
			$("#UpdateFrom input[name=id]").val(data.id);
			$("#UpdateFrom input[name=name]").val(data.name);
			$("#UpdateFrom input[name=discount]").val(data.discount);
			$("#title").html("Sửa thông tin nhóm khách hàng");
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
		$("#UpdateFrom select[name=discount_type]").html(data.discount_type);
	});
}

<?php echo '</script'; ?>
>

<?php echo '<script'; ?>
>
$(document).ready(function() {
	if( "<?php echo $_smarty_tpl->tpl_vars['notification']->value['status'];?>
" == "success" || "<?php echo $_smarty_tpl->tpl_vars['notification']->value['status'];?>
" == "error")
	{
		var notice = new PNotify({
			title: "<?php echo $_smarty_tpl->tpl_vars['notification']->value['title'];?>
",
			text: "<?php echo $_smarty_tpl->tpl_vars['notification']->value['text'];?>
",
			type: "<?php echo $_smarty_tpl->tpl_vars['notification']->value['status'];?>
",
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
<?php echo '</script'; ?>
><?php }
}
