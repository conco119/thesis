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
						<option value="0">Tất cả hóa đơn</option> {$out.select_export}
					</select>
					<a href="{$arg.prefix_admin}mc=export&site=index" class="btn btn-primary"><i class="fa fa-pencil"></i> Tạo hóa đơn</a>
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
								{$perform.total|number_format} đ</td>
						</tr>
						<tr>
							<td class="padding-none">
								<table class="table">
									<tr>
										<td class="text-left">- Doanh thu sản phẩm</td>
										<td class="text-right">
											{$perform.total_product|number_format} đ</td>
									</tr>
									<tr>
										<td class="text-left">- Vốn sản phẩm</td>
										<td class="text-right">
											{$perform.total_cost|number_format} đ</td>
									</tr>
									<tr>
										<td class="text-left">- Lợi nhuận sản phẩm</td>
										<td class="text-right">
											{($perform.total_product - $perform.total_cost)|number_format} đ</td>
									</tr>
									<tr>
										<td class="text-left">- Doanh thu dịch vụ</td>
										<td class="text-right">
											{$perform.total_service|number_format} đ</td>
									</tr>

								</table>
							</td>
						</tr>
						<tr>
							<th class="text-left">Doanh thu khác</th>
							<td class="text-right">
								{$perform.money_imp|number_format} đ</td>
						</tr>
						<tr>
							<th class="text-left">Chi phí khác</th>
							<td class="text-right">
								{$perform.money_exp|number_format} đ</td>
						</tr>
						{*<tr>*}
							{*<th class="text-left">Chi phí</th>*}
							{*<td class="text-right">-{$perform.fees|number_format} đ</td>*}
						{*</tr>*}
						<tr>
							<th class="text-left">Lợi nhuận</th>
							<td class="text-right">{$perform.money_get|number_format}
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

<script src="{$arg.stylesheet}js/moment/moment.min.js"></script>
<script type="text/javascript"
	src="{$arg.stylesheet}js/datepicker/daterangepicker.js"></script>
{literal}
<script>
	$(document).ready(function() {

		$(".mc_report").addClass('active');
		$(".mc_report ul").css('display', 'block');
		$("#report_performance").addClass('current-page');

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
</script>
{/literal}
