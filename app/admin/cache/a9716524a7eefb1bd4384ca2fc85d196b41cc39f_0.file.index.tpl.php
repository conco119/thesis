<?php
/* Smarty version 3.1.30, created on 2018-06-10 11:37:48
  from "C:\xampp\htdocs\~mtd\htaccess\app\admin\view\user\index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b1cab1c7c9c12_25473241',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a9716524a7eefb1bd4384ca2fc85d196b41cc39f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\~mtd\\htaccess\\app\\admin\\view\\user\\index.tpl',
      1 => 1528469385,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b1cab1c7c9c12_25473241 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="">
  <div class="row">
    <div class="col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Quản lý người dùng</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>

            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <div class="h_content">
            <!-- <div class="form-group form-inline">
              <input class="left form-control">
              <select class="left form-control"><option>Select</option></select>
            </div> -->

            <div class="form-group form-inline">
              <input type="search" class="left form-control" id="key" placeholder="Mã / tên người dùng" value="<?php echo $_smarty_tpl->tpl_vars['out']->value['key'];?>
">
              <select class="left form-control" id="permission"><option value="">Danh mục</option><?php echo $_smarty_tpl->tpl_vars['out']->value['permission'];?>
</select>
            </div>
            <button id="search_btn" type="button" class="btn btn-primary left" onclick="filter();"><i class="fa fa-search"></i></button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#UpdateFrom" onclick="LoadDataForForm(0);"><i class="fa fa-pencil"></i> Thêm mới</button>
            <!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="fa fa-check-square-o"></i> Kích hoạt</button> -->
            
            <div class="clearfix"></div>
          </div>

          <!-- start project list -->
          <div class="table-responsive">
              <table class="table table-striped table-hover projects">
                <thead>
                  <tr>
                    
                    <!-- <th>Avatar</th> -->
                    <th>Mã nhân viên</th>
                    <th>Nhân viên</th>
                    <th>Chức vụ</th>
                    <th class="text-center">Trạng thái</th>
                    <th class="text-right"></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['users']->value, 'data');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
?>
                  <tr id="field<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
">
                    <!-- <td>
                      <ul class="list-inline">
                        <li><img src="<?php echo $_smarty_tpl->tpl_vars['data']->value['avatar'];?>
" class="avatar" alt="Avatar"></li>
                      </ul>
                    </td> -->
                    <td><?php echo $_smarty_tpl->tpl_vars['data']->value['code'];?>
</td>
                    <td><a href="#"><?php echo $_smarty_tpl->tpl_vars['data']->value['username'];?>
 (<?php echo $_smarty_tpl->tpl_vars['data']->value['name'];?>
)</a> <br /> <small>Created <?php echo $_smarty_tpl->tpl_vars['data']->value['created_at'];?>
</small> <small>Updated <?php echo $_smarty_tpl->tpl_vars['data']->value['updated_at'];?>
</small></td>
                    <td><?php echo $_smarty_tpl->tpl_vars['data']->value['permission'];?>
</td>
                    <td class="text-center" id="stt<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
">
                      <?php echo $_smarty_tpl->tpl_vars['data']->value['status'];?>

                    </td>
                    <td class="text-right">
                      
                      <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#UpdateFrom" onclick="LoadDataForForm(<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
);"><i class="fa fa-pencil"></i></button>
                      <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#DeleteForm" onclick="LoadDeleteItem('user', <?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
, '', 'nhân viên');"><i class="fa fa-trash-o"></i></button>
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


<div class="modal fade" tabindex="-1" id="UpdateFrom">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        <h4 class="modal-title" id="title"></h4>
      </div>
      <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action='' enctype="multipart/form-data">
        <div class="modal-body">

          <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <input type='hidden' name='id'>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Tên tài khoản</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="name" required="required" class="form-control" placeholder="Tên...">
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <input type="text" name="username" required class="form-control" placeholder="Tài khoản...">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Chức vụ</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="form-control" name="permission"></select>
            </div>
          </div><br>

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
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Email</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="email" class="form-control" name="email">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Số điện thoại</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="tel" class="form-control" name="phone" pattern="[0-9]\d*" title="Số điện thoại">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Địa chỉ</label>
            <div class="col-md-8 col-sm-6 col-xs-12">
              <input class="form-control" type="text" name="address">
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
          <button type="button" class="btn btn-default" data-dismiss="modal">Bỏ qua</button>
          <button type="submit" class="btn btn-primary" name="submit">Lưu lại</button>
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
          <button type="submit" class="btn btn-primary" name="savePermission">Lưu</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
        </div>
      </form>
    </div>
  </div>
</div>


<?php echo '<script'; ?>
>


function activeUser(table, id) {
    $.post("./admin?mc=user&site=ajax_active_user", {'table': table, 'id': id}).done(function (data) {
            if(data == 0)
              alert('You can not change');
            else
            $("#stt" + id).html(data);
    });
}


function LoadDataContent(id){
  $.post("?mod=user&site=load_user_permission", {'id':id} )
  .done(function(data){
    $("#ContentModal .modal-body").html(data);
  });
}


function LoadDataForForm(id) {
  $.post("./admin?mc=user&site=ajax_load_user", {'id' : id}).done(function(data) {
      $("#UpdateFrom input[type=text]").val('');
      var data = JSON.parse(data);
      if (data.id == undefined)
      {
        $("#UpdateFrom input[name=id]").val(0);
        $("#UpdateFrom input[name=status]").attr("checked", "checked");
        $("#UpdateFrom input[name=status]").prop('checked', true);
        $("#UpdateFrom input[name=username]").removeAttr("disabled","disabled");
        $("#UpdateFrom input[name=email]").val('');
        $("#UpdateFrom input[name=phone]").val('');
        $("#title").html('Thêm tài khoản');
      }
      else
      {
        $("#UpdateFrom input[name=id]").val(data.id);
        $("#UpdateFrom input[name=name]").val(data.name);
        $("#UpdateFrom input[name=username]").val(data.username);
        $("#UpdateFrom input[name=username]").attr("disabled","disabled");
        $("#UpdateFrom input[name=email]").val(data.email);
        $("#UpdateFrom input[name=phone]").val(data.phone);
        $("#UpdateFrom input[name=address]").val(data.address);
        $("#title").html('Sửa thông tin tài khoản');
        if(data.status == 1)
        {
          $("#UpdateFrom input[name=status]").attr("checked", "checked");
          $("#UpdateFrom input[name=status]").prop('checked', true);
        }
        else
        {
          $("#UpdateFrom input[name=status]").removeAttr("checked");
          $("#UpdateFrom input[name=status]").prop('checked', false);
        }
      }
      $("#UpdateFrom select[name=permission]").html(data.permission);
      $("#UpdateFrom select[name=gender]").html(data.gender);
      $("#UpdateFrom select[name=day]").html(data.birthday.day);
      $("#UpdateFrom select[name=month]").html(data.birthday.month);
      $("#UpdateFrom select[name=year]").html(data.birthday.year);

  });
}
function filter() {
    var key = $("#key").val();
    var permission = $("#permission").val();

    var url = "./admin?mc=user&site=index";
    url += "&permission=" + permission;
    url += "&key=" + key;
    window.location.href = url;
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
