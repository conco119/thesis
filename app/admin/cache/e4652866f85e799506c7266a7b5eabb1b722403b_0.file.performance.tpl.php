<?php
/* Smarty version 3.1.30, created on 2018-05-26 16:28:17
  from "/Users/mtd/Sites/htaccess/app/admin/view/report/performance.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b0928b1713ca8_92245613',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e4652866f85e799506c7266a7b5eabb1b722403b' => 
    array (
      0 => '/Users/mtd/Sites/htaccess/app/admin/view/report/performance.tpl',
      1 => 1527326896,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b0928b1713ca8_92245613 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="row">
	<div class="x_panel">
		<div class="x_title">
			<h2>Báo cáo lợi nhuận</h2>
			<ul class="nav navbar-right panel_toolbox">
				<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
			</ul>
			<div class="clearfix"></div>
		</div>
		<div class="x_content">
			<div class="form-group form-inline">
				<div class="h_content">
					<select class="form-control" id="date_ex" onchange="filter();">
						<option value="0">Tất cả hóa đơn</option> <?php echo $_smarty_tpl->tpl_vars['out']->value['select_export'];?>

					</select>
					<a href="<?php echo $_smarty_tpl->tpl_vars['arg']->value['prefix_admin'];?>
mc=export&site=index" class="btn btn-primary"><i class="fa fa-pencil"></i> Tạo hóa đơn</a>
				</div>

			</div>
			<br>
			<h1 class="text-center">Báo cáo lợi nhuận</h1>
			<br>
			<div class="col-md-8 col-sm-offset-2">
				<!-- start project list -->
				<table class="table table-bordered" style="font-size: 24px;">
					<tbody>
						<tr>
							<th class="text-left">Doanh thu bán hàng</th>
							<td class="text-right" rowspan="2" valign="middle">
								<?php echo number_format($_smarty_tpl->tpl_vars['perform']->value['total']);?>
 đ</td>
						</tr>
						<tr>
							<td class="padding-none">
								<table class="table">
									<tr>
										<td class="text-left">- Doanh thu sản phẩm</td>
										<td class="text-right">
											<?php echo number_format($_smarty_tpl->tpl_vars['perform']->value['total_product']);?>
 đ</td>
									</tr>
									<tr>
										<td class="text-left">- Vốn sản phẩm</td>
										<td class="text-right">
											<?php echo number_format($_smarty_tpl->tpl_vars['perform']->value['total_cost']);?>
 đ</td>
									</tr>
									<tr>
										<td class="text-left">- Lợi nhuận sản phẩm</td>
										<td class="text-right">
											<?php echo number_format(($_smarty_tpl->tpl_vars['perform']->value['total_product']-$_smarty_tpl->tpl_vars['perform']->value['total_cost']));?>
 đ</td>
									</tr>
									<tr>
										<td class="text-left">- Doanh thu dịch vụ</td>
										<td class="text-right">
											<?php echo number_format($_smarty_tpl->tpl_vars['perform']->value['total_service']);?>
 đ</td>
									</tr>

								</table>
							</td>
						</tr>
						<tr>
							<th class="text-left">Doanh thu khác</th>
							<td class="text-right">
								<?php echo number_format($_smarty_tpl->tpl_vars['perform']->value['money_imp']);?>
 đ</td>
						</tr>
						<tr>
							<th class="text-left">Chi phí khác</th>
							<td class="text-right">
								<?php echo number_format($_smarty_tpl->tpl_vars['perform']->value['money_exp']);?>
 đ</td>
						</tr>
						
							
							
						
						<tr>
							<th class="text-left">Lợi nhuận</th>
							<td class="text-right"><?php echo number_format($_smarty_tpl->tpl_vars['perform']->value['money_get']);?>

								đ</td>
						</tr>
					</tbody>
				</table>
				<br>
				<br>
				<br>
				<!-- end project list -->
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
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
 type="text/javascript"
	src="<?php echo $_smarty_tpl->tpl_vars['arg']->value['stylesheet'];?>
js/datepicker/daterangepicker.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
>
	$(document).ready(function() {
		$('#date_from').daterangepicker({
			singleDatePicker : true,
			calender_style : "picker_4",
			format : 'DD-MM-YYYY'
		}, function() {
			$('#date_from').change();
		});
		$('#date_to').daterangepicker({
			singleDatePicker : true,
			calender_style : "picker_4",
			format : 'DD-MM-YYYY'
		}, function() {
			$('#date_to').change();
		});
	});

	function filter() {

		var date = $("#date_ex").val();
		var url = "./admin?mc=report&site=performance";
		url += "&date=" + date;

		window.location.href = url;
	}

	function PerformDetail(date) {
		$("#orderDetail .modal-body").load(
				"?mod=report&site=ajax_perform_detail", {
					'date' : date
				});
	}
<?php echo '</script'; ?>
>

<?php }
}
