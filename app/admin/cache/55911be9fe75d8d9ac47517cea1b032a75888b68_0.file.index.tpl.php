<?php
/* Smarty version 3.1.30, created on 2018-06-10 22:18:17
  from "/Users/mtd/Sites/htaccess/app/admin/view/order/index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b1d4139774ce5_55551006',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '55911be9fe75d8d9ac47517cea1b032a75888b68' => 
    array (
      0 => '/Users/mtd/Sites/htaccess/app/admin/view/order/index.tpl',
      1 => 1528643415,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b1d4139774ce5_55551006 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="">
    <div class="x_panel">
        <div class="x_title">
            <h2>Khách hàng đặt hàng</h2>
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
                            <th class="text-right">Địa chỉ</th>
                            <th class="text-right">Ngày</th>
                            <th class="text-right">Trạng thái</th>
                            <th class="text-right"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['orders']->value, 'list');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['list']->value) {
?>
                            <tr id="field<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
">
                                <td>
                                    <?php echo $_smarty_tpl->tpl_vars['list']->value['name'];?>

                                </td>
                                <td><?php echo $_smarty_tpl->tpl_vars['list']->value['phone'];?>
</td>
                                <td class="text-right">
                                	<?php echo $_smarty_tpl->tpl_vars['list']->value['email'];?>

                                </td>
                                <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['list']->value['address'];?>
</a></td>
                                <td class="text-center">
                                	<?php echo $_smarty_tpl->tpl_vars['list']->value['created_at'];?>

                                </td>
                                <td class="text-center" id="stt<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['list']->value['status'];?>
</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#orderDetail" onclick="GetDetailOrder(<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
);"><i class="fa fa-search-plus"></i></button>
                                    
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
    $.post(`./admin?mc=order&site=ajax_active`, {'table': table, 'id': id}).done(function (data) {
            if(data == 0)
              alert('You can not change');
            else
            $("#stt" + id).html(data);
    });
}

function GetDetailOrder(id) {
    $.post("./admin?mc=order&site=ajax_get_detail_order",{"id": id}).done(function(data){
        data = JSON.parse(data)
        console.log(data)
        let append = `
        <h1 class="text-center">Khách đặt hàng</h1>
        <h2 class="text-center">[Ngày ${data.date}]</h2>
        <div class="row">
            <div class="col-md-12">
                <p><span><i class="icon-user-md"></i> Tên khách hàng:</span> ${data.name}</p>
                <p><span><i class="icon-user-md"></i> Địa chỉ:</span> ${data.address}</p>
                <p><span><i class="icon-user-md"></i> Số điện thoại:</span> ${data.phone}</p>
                <p><span><i class="icon-user-md"></i> Phương thức thanh toán:</span> ${data.type}</p>
            </div>
        </div>`

                if(Object.keys(data.products).length > 0)
                {
                    append += `
                    <h3>Chi tiết sản phẩm</h3>
                    <table class="table table-striped table-bordered table-bor-btm">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th class="text-right">Đơn vị</th>
                                <th class="text-right">Giá bán</th>
                                <th class="text-right">SL</th>
                                <th class="text-right">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>`
                        let index = 1;
                        $.each(data.products, function(key, product) {
                            append += `
                            <tr>
                                <td>${product.name}</td>
                                <td class="text-right">${product.unit_name}</td>
                                <td class="text-right">${ConvertMoney(product.price)} đ</td>
                                <td class="text-right">${product.number_count}</td>
                                <td class="text-right">${ConvertMoney(product.price * product.number_count)} đ</td>
                            </tr>`
                            index++;
                        })
                    append += `
                        </tbody>
                    </table>`
                }
                if(Object.keys(data.services).length > 0)
                {
                    append += `
                    <h3>Chi tiết dịch vụ</h3>
                    <table class="table table-striped table-bordered table-bor-btm">
                        <thead>
                            <tr>
                                <th>Dịch vụ</th>
                                <th class="text-right">Chi phí</th>
                                <th class="text-right">SL</th>
                                <th class="text-right">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>`
                        $.each(data.services, function(key, service) {
                            append +=`
                            <tr>
                                <td>${service.name}</td>
                                <td class="text-right">${ConvertMoney(service.price)} đ</td>
                                <td class="text-right">${service.number_count}</td>
                                <td class="text-right">${ConvertMoney(service.price * service.number_count)} đ</td>
                            </tr>`
                        })
                    append +=`
                        </tbody>
                    </table>`
                }

                    append += `<div class="bold text-right">`;
                    append += `<h3>Tổng tiền: ${ConvertMoney(data.total_money)} đ</h3>`
                    append += `</div>`;

        $("#orderDetail .modal-body").html(append);
    })
}
<?php echo '</script'; ?>
>


<?php }
}
