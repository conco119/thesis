<?php
/* Smarty version 3.1.30, created on 2018-06-16 23:24:34
  from "/Users/mtd/Sites/htaccess/app/admin/view/export/statistics.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b2539c2cc6bb6_86736930',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4b1c5c7ef913fffd492807d76b0989963b3f0671' => 
    array (
      0 => '/Users/mtd/Sites/htaccess/app/admin/view/export/statistics.tpl',
      1 => 1529166273,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b2539c2cc6bb6_86736930 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="">
    <div class="row">
        <div class="col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Lưu trữ hóa đơn bán hàng</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="h_content">
                        <div class="form-group form-inline pull-left filter_form">
                            <select class="form-control" id="date_ex" onchange="filter();">
                                <option value="0">Tất cả hóa đơn</option> <?php echo $_smarty_tpl->tpl_vars['out']->value['select_export'];?>

                            </select>
                            <input class="form-control" id="key" value="<?php echo $_smarty_tpl->tpl_vars['out']->value['key'];?>
" name="key" onchange="filter()" placeholder="Mã hóa đơn,id, Tên khách hàng">
                        </div>
                        <a href="./admin?mc=export&site=index" class="btn btn-primary"><i class="fa fa-pencil"></i> Tạo hóa đơn</a>
                        <div class="clearfix"></div>
                    </div>
                    <!-- start project list -->
                    <div class="table-responsive">
                        <table class="table table-striped projects">
                            <thead>
                            <tr>
                                <th>Hóa đơn</th>
                                <th>Khách hàng</th>
                                <th class="text-right">Giá trị</th>
                                <th class="text-right">Chiết khấu</th>
                                <th class="text-right">Khách nợ</th>
                                <th>Người lập phiếu</th>
                                <th>Cập nhật bởi</th>
                                <th class=""></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['result']->value, 'list');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['list']->value) {
?>
                                <tr id="field<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
">
                                    <td><?php echo $_smarty_tpl->tpl_vars['list']->value['code'];?>
 <br>
                                        <small><?php echo $_smarty_tpl->tpl_vars['list']->value['date'];?>
</small>
                                    </td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['list']->value['customer'];?>
</td>
                                    <td class="text-right"> <b style='color:red'> <?php echo number_format($_smarty_tpl->tpl_vars['list']->value['must_pay']);?>
đ </b></td>
                                    <td class="text-right"><?php echo $_smarty_tpl->tpl_vars['list']->value['discount'];?>
</td>
                                    <td class="text-right"><?php echo number_format(($_smarty_tpl->tpl_vars['list']->value['must_pay']-$_smarty_tpl->tpl_vars['list']->value['payment']));?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['list']->value['user'];?>
</td>
                                    <td>
                                        <?php if (isset($_smarty_tpl->tpl_vars['list']->value['updater']['name'])) {?>
                                            <?php echo $_smarty_tpl->tpl_vars['list']->value['updater']['name'];?>
 <br>
                                            <small><?php echo $_smarty_tpl->tpl_vars['list']->value['updated_at'];?>
</small>
                                        <?php }?>
                                    </td>
                                    <td class="text-right">
                                        <button type="button" title="Chi tiết hóa đơn" data-toggle="modal"
                                                class="btn btn-default" data-target="#orderDetail"
                                                onclick="GetDetailExport(<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
);">
                                            <i class="fa fa-search-plus"></i>
                                        </button>
                                        <a href="./admin?mc=exportedit&site=modify&id=<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
" class="btn btn-default"><i
                                                    class="fa fa-edit"></i></a>
                                        
                                         <?php if ($_smarty_tpl->tpl_vars['arg']->value['user']['permission'] != 3) {?>
                                            <button type="button" title="Xóa hóa đơn" class="btn btn-default"
                                                    data-toggle="modal" data-target="#DeleteForm"
                                                    onclick="LoadDeleteItem('export', <?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
, '', 'hóa đơn bán', 'vì còn tồn tại trong hóa đơn');">
                                                <i class="fa fa-trash-o"></i>
                                            </button>
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
                                    Tổng
                                </th>
                                <td class="text-right" style="color:red;font-weight: bold">
                                    <?php echo number_format($_smarty_tpl->tpl_vars['out']->value['total']);?>
 đ
                                </td>
                                <td colspan="4"></td>
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

<!-- Print -->
<div class="modal fade" id="Print">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body modal-print">
                <iframe src="#" style="zoom:0.60" width="99.6%" height="450" id="PrintContent"></iframe>
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
                <button type="button" class="btn btn-danger" onclick="DeleteItem();" id="DeleteItem">Đồng ý</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy bỏ</button>
            </div>
        </div>
    </div>
</div>

<link href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet">
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/moment/moment.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/datepicker/daterangepicker.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/datetimepicker/bootstrap-datetimepicker.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
    var print = '<?php echo $_smarty_tpl->tpl_vars['out']->value['print'];?>
';
<?php echo '</script'; ?>
>

    <?php echo '<script'; ?>
>
        $(document).ready(function () {

            $(".mc_export").addClass('active');
            $(".mc_export ul").css('display', 'block');
            $("#export_statistics").addClass('current-page');

            $('#date_from').daterangepicker({singleDatePicker: true, calender_style: "picker_4", format: 'DD-MM-YYYY'}, function () {
                $('#date_from').change();
            });
            $('#date_to').daterangepicker({singleDatePicker: true, calender_style: "picker_4", format: 'DD-MM-YYYY'}, function () {
                $('#date_to').change();
            });
        });

        function filter() {
            var date = $("#date_ex").val();
            var key = $("#key").val();
            var url = "./admin?mc=export&site=statistics";
            url += "&date=" + date;
            url += "&key=" + key;
            window.location.href = url;
        }

        function SetPrint(id) {
            $("#PrintContent").attr("src", print + id);
            return false;
        }

        function GetDetailExport(id) {
            $.post("./admin?mc=exportajax&site=ajax_get_detail_export",{"id": id}).done(function(data){
                data = JSON.parse(data)
                console.log(data)
                let append = `
                        <h1 class="text-center">Hóa đơn bán hàng</h1>
                        <h2 class="text-center">[Mã: ${data.code} - Ngày ${data.date}]</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <p><span><i class="icon-user"></i> Lập phiếu:</span> ${data.user_name}</p>
                                <p><span><i class="icon-time"></i> Thời gian lập:</span> ${data.created_at}</p>
                            </div>
                            <div class="col-md-6">
                                <p><span><i class="icon-user-md"></i> Khách hàng:</span> ${data.customer_name}</p>
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

                    append += `
						<div class="bold text-right">`;
							append += `<h3>Tổng tiền: ${ConvertMoney(data.total_money)} đ</h3>`
                            if(data.total_money == data.must_pay)
                                append += `<h3>Chiết khấu: 0 đ</h3>`
                            else
                                append += `<h3>Chiết khấu: ${ConvertMoney(data.total_money - data.must_pay)} đ</h3>`
							append += `<h3> Khách cần trả: ${ConvertMoney(data.must_pay)} đ</h3>`
							append += '<hr>';
							append += `<h3>Khách trả: ${ConvertMoney(data.payment)} </h3>`;
						append += `</div>`;
                       // <div class="bold text-right">
                         //   <h3>Tiền thanh toán: 158,000 đ</h3>
                        //</div>

                $("#orderDetail .modal-body").html(append);
            })

        }
    <?php echo '</script'; ?>
>

<?php }
}
