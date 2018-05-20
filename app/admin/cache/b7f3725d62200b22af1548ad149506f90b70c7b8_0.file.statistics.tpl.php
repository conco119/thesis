<?php
/* Smarty version 3.1.30, created on 2018-05-21 19:41:58
  from "/Users/mtd/Sites/htaccess/app/admin/view/import/statistics.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b02be961cdf24_34309286',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b7f3725d62200b22af1548ad149506f90b70c7b8' => 
    array (
      0 => '/Users/mtd/Sites/htaccess/app/admin/view/import/statistics.tpl',
      1 => 1526906516,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b02be961cdf24_34309286 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="">
    <div class="row">
        <div class="col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Lưu trữ hóa đơn nhập hàng</h2>
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
" name="key" onchange="filter()" placeholder="Mã phiếu nhập,Id, Tên nhà cung cấp">
                        </div>

                        <a href="./admin?mc=import&site=index" class="btn btn-primary"><i class="fa fa-pencil"></i> Tạo hóa đơn</a>
                        <div class="clearfix"></div>
                    </div>
                    <!-- start project list -->
                    <div class="table-responsive">
                        <table class="table table-striped projects">
                            <thead>
                                <tr>
                                    <th>Hóa đơn</th>
                                    <th>Nhà Cung cấp</th>
                                    <th class="text-right">Giá trị</th>
                                    <th class="text-right">Chiết khấu</th>
                                    <th class="text-right">Công nợ</th>
                                    <th>Nhân viên bán</th>
                                    <th class=""></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['result']->value, 'list');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['list']->value) {
?>
                                    <tr>
                                        <td><?php echo $_smarty_tpl->tpl_vars['list']->value['code'];?>
 <br> <small><?php echo $_smarty_tpl->tpl_vars['list']->value['date'];?>
</small></td>
                                        <td><?php echo $_smarty_tpl->tpl_vars['list']->value['supplier'];?>
</td>
                                        <td class="text-right"><?php echo number_format($_smarty_tpl->tpl_vars['list']->value['must_pay']);?>
</td>
                                        <td class="text-right"><?php echo $_smarty_tpl->tpl_vars['list']->value['discount'];?>
</td>
                                        <td class="text-right"><?php echo number_format(($_smarty_tpl->tpl_vars['list']->value['payment']-$_smarty_tpl->tpl_vars['list']->value['must_pay']));?>
</td>
                                        <td><?php echo $_smarty_tpl->tpl_vars['list']->value['user'];?>
</td>
                                        <td class="text-right">
                                            <button type="button" data-toggle="modal" class="btn btn-default" data-target="#orderDetail" onclick="DisplayDetail(<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
);">
                                                <i class="fa fa-search-plus"></i>
                                            </button>
                                           <!--<?php if ($_smarty_tpl->tpl_vars['list']->value['is_auto'] != 1) {?>-->
                                                <a href="<?php echo $_smarty_tpl->tpl_vars['list']->value['modify'];?>
" class="btn btn-default">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            <!--<?php }?>-->
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

        function filter()
        {
            var date = $("#date_ex").val();
            var key = $("#key").val();

            var url = "./admin?mc=import&site=statistics";
            url += "&date=" + date;
            url += "&key=" + key;

            window.location.href = url;
        }

        function SetPrint(id) {
            $("#PrintContent").attr("src", "?mod=import&site=cprint&id=" + id);
            return false;
        }

        function DisplayDetail(id) {
            $("#orderDetail .modal-body").load("./admin?mc=import&site=ajax_get_import_info", {"id": id});
        }
    <?php echo '</script'; ?>
>

<?php }
}
