<?php
/* Smarty version 3.1.30, created on 2018-05-24 10:04:28
  from "/Users/mtd/Sites/htaccess/app/admin/view/product/detail.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b062bbc08bd36_39174362',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c6763447dbc08627266733ca004d194c7d1e112c' => 
    array (
      0 => '/Users/mtd/Sites/htaccess/app/admin/view/product/detail.tpl',
      1 => 1527131044,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b062bbc08bd36_39174362 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="">
    <div class="row">
        <div class="x_panel">
            <div class="x_title">
                <h2>Thông tin nhập xuất của sản phẩm: <?php echo $_smarty_tpl->tpl_vars['product_info']->value['name'];?>
 [<?php echo $_smarty_tpl->tpl_vars['product_info']->value['code'];?>
]</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <div class="h_content">

                    <a href="./admin?mc=product&site=index" class="btn btn-primary left"><i
                                class="fa fa-bars"></i> Quản lý sản phẩm</a>
                    <div class="clearfix"></div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th colspan="6" class="text-center">Nhập hàng</th>
                            </tr>
                            <tr>
                                <th>Ngày</th>
                                <th>Mã hóa dơn</th>
                                <th class="text-right">Số lượng</th>
                                <th class="text-right">Đơn vị</th>
                                <th class="text-right">Tổng tiền</th>
                                <th class="text-center">Chi tiết hóa đơn</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['detail_import']->value, 'data_im');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['data_im']->value) {
?>
                                <tr>
                                    <td><?php echo $_smarty_tpl->tpl_vars['data_im']->value['date'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['data_im']->value['code'];?>
</td>
                                    <td class="text-right"><?php echo $_smarty_tpl->tpl_vars['data_im']->value['number_count'];?>
</td>
                                    <td class="text-right"><?php echo $_smarty_tpl->tpl_vars['data_im']->value['unit_name'];?>
</td>
                                    <td class="text-right"><?php echo $_smarty_tpl->tpl_vars['data_im']->value['total'];?>
</td>
                                    <td class="text-center">
                                        <button type="button" title="Chi tiết hóa đơn" data-toggle="modal"
                                                class="btn btn-default" data-target="#orderDetail"
                                                onclick="GetDetailImport(<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
);">
                                            <i class="fa fa-search-plus"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th colspan="6" class="text-center">Xuất hàng</th>
                            </tr>
                            <tr>
                                <th>Ngày</th>
                                <th>Mã hóa dơn</th>
                                <th class="text-right">Số lượng</th>
                                <th class="text-right">Đơn vị</th>
                                <th class="text-right">Tổng tiền</th>
                                <th class="text-center">Chi tiết hóa đơn</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['detail_export']->value, 'data');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
?>
                                <tr>
                                    <td><?php echo $_smarty_tpl->tpl_vars['data']->value['date'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['data']->value['code'];?>
</td>
                                    <td class="text-right"><?php echo $_smarty_tpl->tpl_vars['data']->value['number_count'];?>
</td>
                                    <td class="text-right"><?php echo $_smarty_tpl->tpl_vars['data']->value['unit_name'];?>
</td>
                                    <td class="text-right"><?php echo $_smarty_tpl->tpl_vars['data']->value['total'];?>
</td>
                                    <td class="text-center">
                                        <button type="button" title="Chi tiết hóa đơn" data-toggle="modal"
                                                class="btn btn-default" data-target="#orderDetail"
                                                onclick="GetDetailExport(<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
);">
                                            <i class="fa fa-search-plus"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                        </table>
                    </div>
                </div>
                
                
                
                
                
                

                </tbody>
                </table>

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

<!-- Modal Detail Products -->
<div class="modal fade" tabindex="-1" id="DetailProduct">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 class="modal-title">Thông tin chi tiết mua hàng</h4>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Print -->
<div class="modal fade" id="Print">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body modal-print">
                <iframe src="#" style="zoom: 0.60" width="99.6%" height="450" id="PrintContent"></iframe>
            </div>
        </div>
    </div>
</div>


<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/moment/moment.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript"
        src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/datepicker/daterangepicker.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
    var this_url = '<?php echo $_smarty_tpl->tpl_vars['out']->value['url'];?>
';
    var this_print = '<?php echo $_smarty_tpl->tpl_vars['out']->value['print'];?>
';
<?php echo '</script'; ?>
>

    <?php echo '<script'; ?>
>

        $(document).ready(function () {
            $('#date_from').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_4",
                format: 'DD-MM-YYYY'
            }, function () {
                $('#date_from').change();
            });
            $('#date_to').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_4",
                format: 'DD-MM-YYYY'
            }, function () {
                $('#date_to').change();
            });
        });
        function SetExportInfo(id) {
            $("#orderDetail .modal-body").load("?mod=exportAjax&site=ajax_get_export_info", {"id": id});
        }
        function SetImportInfo(id) {
            $("#orderDetail .modal-body").load("?mod=import&site=ajax_get_import_info", {"id": id});
        }

        function DetailProduct(customer_id, date) {
            $("#DetailProduct .modal-body").load("?mod=customer&site=ajax_load_products", {
                'id': customer_id,
                'date': date
            });
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
