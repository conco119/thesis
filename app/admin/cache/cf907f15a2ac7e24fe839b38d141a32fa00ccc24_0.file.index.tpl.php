<?php
/* Smarty version 3.1.30, created on 2018-06-17 11:22:13
  from "/Users/mtd/Sites/htaccess/app/admin/view/customer/index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b25e1f50f75d8_18323772',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cf907f15a2ac7e24fe839b38d141a32fa00ccc24' => 
    array (
      0 => '/Users/mtd/Sites/htaccess/app/admin/view/customer/index.tpl',
      1 => 1529209331,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b25e1f50f75d8_18323772 (Smarty_Internal_Template $_smarty_tpl) {
?>
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
                        <?php echo $_smarty_tpl->tpl_vars['customer_groups']->value;?>

                    </select>
                </div>
                <div class="form-group form-inline">
                    <input class="form-control left" id="key" value="<?php echo $_smarty_tpl->tpl_vars['out']->value['key'];?>
" placeholder="Mã, Tên" >
                </div>
                <button type="button" class="btn btn-primary left" onclick="filter();"><i class="fa fa-search"></i></button>

                  <a href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['prefix_admin'];?>
mc=customergroup&site=index" class="btn btn-primary left"><i class="fa fa-pencil"></i> Quản lý nhóm</a>
                
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#UpdateFrom" onclick="LoadDataForForm(0);"><i class="fa fa-pencil"></i> Thêm mới</button>
                
                <div class="clearfix"></div>
            </div>

            <!-- start project list -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Khách hàng</th>
                            <th>Nhóm</th>
                            <th class="text-right">Tài khoản</th>
                            
                            <th class="text-right">Tổng mua</th>
                            <th class="text-center">TT</th>
                            <th class="text-right"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['customers']->value, 'list');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['list']->value) {
?>
                            <tr id="field<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
">
                                <td>
                                [<?php echo $_smarty_tpl->tpl_vars['list']->value['code'];?>
] <?php echo $_smarty_tpl->tpl_vars['list']->value['name'];?>
 <br>
                                <small>Created by: <?php echo $_smarty_tpl->tpl_vars['list']->value['creator']['username'];?>
 - <?php echo $_smarty_tpl->tpl_vars['list']->value['creator']['name'];?>
</small>
                                </td>
                                <td><?php echo $_smarty_tpl->tpl_vars['list']->value['group']['name'];?>
</td>
                                <td class="text-right">
                                	<?php echo number_format($_smarty_tpl->tpl_vars['list']->value['money']);?>
 đ
                                </td>
                                
                                <td class="text-right">
                                	<?php echo number_format($_smarty_tpl->tpl_vars['list']->value['must_pay']);?>
 đ
                                    
                                </td>
                                <td class="text-center" id="stt<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['list']->value['status'];?>
</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#UpdateFrom" onclick="LoadDataForForm(<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
);"><i class="fa fa-pencil"></i></button>
                                    <?php if ($_smarty_tpl->tpl_vars['arg']->value['user']['permission'] != 3) {?>
                                        <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#DeleteForm" onclick="LoadDeleteItem('customer', <?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
, '', 'khách hàng', 'vì còn tồn tại hóa đơn');"><i class="fa fa-trash-o"></i></button>
                                    <?php }?>
                                </td>
                            </tr>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                    <tr>
                        <th colspan="2" class="text-right">
                            Tổng tài khoản
                        </th>
                        <th class="text-right">
                            <?php echo number_format($_smarty_tpl->tpl_vars['out']->value['total_money']);?>
 đ
                        </th>
                        <th class="text-right">
                            Tổng mua hàng
                        </th>
                        <th class="text-right">
                            <?php echo number_format($_smarty_tpl->tpl_vars['out']->value['total_must_pay']);?>
 đ
                        </th>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!-- end project list -->

            <div class="paging"><?php echo $_smarty_tpl->tpl_vars['paging']->value['paging'];?>
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
                <h4 class="modal-title" id="title"> </h4>
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
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Giới tính</label>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <select class="form-control" name="gender"></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Ngày sinh</label>
                        <div class="col-md-2 col-sm-3 col-xs-12">
                            <select class="form-control" name="day"></select>
                        </div>
                        <div class="col-md-2 col-sm-3 col-xs-12">
                            <select class="form-control" name="month"></select>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <select class="form-control" name="year"></select>
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
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Email</label>
                        <div class="col-md-9 col-sm-6 col-xs-12">
                            <input type="email" class="form-control" name="email">
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

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/moment/moment.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/datepicker/daterangepicker.js"><?php echo '</script'; ?>
>


<?php echo '<script'; ?>
>
$(document).ready(function () {
    $('#date_from').daterangepicker({singleDatePicker: true, calender_style: "picker_4", format: 'DD-MM-YYYY'}, function () {
        $('#date_from').change();
    });
    $('#date_to').daterangepicker({singleDatePicker: true, calender_style: "picker_4", format: 'DD-MM-YYYY'}, function () {
        $('#date_to').change();
    });
});

function activeStatus(table, id) {
	let prefix_admin = $("#UpdateFrom input[name=prefix_admin]").val();
    $.post(`${prefix_admin}mc=customer&site=ajax_active`, {'table': table, 'id': id}).done(function (data) {
            if(data == 0)
              alert('You can not change');
            else
            $("#stt" + id).html(data);
    });
}

function LoadDataForForm(id) {
    let mc = $("#UpdateFrom input[name=mc]").val();
	let prefix_admin = $("#UpdateFrom input[name=prefix_admin]").val();
    $("#UpdateFrom input[type=text]").val('');
    $.post(`${prefix_admin}mc=${mc}&site=ajax_load`, {'id' : id}).done(function(data) {
        var data = JSON.parse(data);
        console.log(data);
        if (data.id == undefined) {
            $("#UpdateFrom input[name=id]").val(0);
            $("#UpdateFrom input[name=status]").attr("checked", "checked");
            $("#UpdateFrom input[name=status]").prop('checked', true);
            $("#title").html('Thêm khách hàng');
        } else {
            $("#UpdateFrom input[name=id]").val(data.id);
            $("#UpdateFrom input[name=name]").val(data.name);
            $("#UpdateFrom input[name=phone]").val(data.phone);
            $("#UpdateFrom input[name=address]").val(data.address);
            $("#UpdateFrom input[name=email]").val(data.email);
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
        $("#UpdateFrom select[name=day]").html(data.birthday.day);
        $("#UpdateFrom select[name=month]").html(data.birthday.month);
        $("#UpdateFrom select[name=year]").html(data.birthday.year);
        $("#UpdateFrom select[name=gender]").html(data.gender);
        $("#UpdateFrom select[name=group_id]").html(data.group);
    });
}

function filter()
{
  var key = $("#key").val();
    var category = $("#group").val();
    var url = "./admin?mc=customer&site=index";
    url += "&group_id=" + category;
    url += "&key=" + key;
    window.location.href = url;
}

<?php echo '</script'; ?>
>

<?php echo '<script'; ?>
>
$(document).ready(function() {

	$(".mc_customer").addClass('active');
	$(".mc_customer ul").css('display', 'block');
	$("#customer_index").addClass('current-page');

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
