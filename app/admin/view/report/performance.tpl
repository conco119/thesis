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
					<select class="form-control" id="filter" onchange="filter();">
						{$out.filter}
					</select> 
					{if $out.value.filter eq '2'} 
					<select class="form-control" id="year" onchange="filter();">{$out.year}</select> 
					<select class="form-control" id="month" onchange="filter();">{$out.month}</select> 
					{else if $out.value.filter eq '1'} 
					<input type="text" class="form-control" id="date_from" placeholder="Từ ngày" onchange="filter();" value="{$out.date_from}"> 
					<input type="text" class="form-control" id="date_to" placeholder="Đến ngày" onchange="filter();" value="{$out.date_to}"> 
					{else} 
					<select class="form-control" id="date_ex" onchange="filter();">
						<option value="0">Tất cả hóa đơn</option> {$out.select_export}
					</select> 
					{/if} 
					<a href="?mod=import&site=create" class="btn btn-primary"><i class="fa fa-pencil"></i> Tạo hóa đơn</a>
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
											{$perform.total_products|number_format} đ</td>
									</tr>
									<tr>
										<td class="text-left">- Vốn sản phẩm</td>
										<td class="text-right">
											{$perform.cost|number_format} đ</td>
									</tr>
									<tr>
										<td class="text-left">- Lợi nhuận sản phẩm</td>
										<td class="text-right">
											{($perform.total_products - $perform.cost)|number_format} đ</td>
									</tr>
									<tr>
										<td class="text-left">- Doanh thu dịch vụ</td>
										<td class="text-right">
											{$perform.total_services|number_format} đ</td>
									</tr>

								</table>
							</td>
						</tr>
						<tr>
							<th class="text-left">Doanh thu khác</th>
							<td class="text-right">
								{$perform.money_im|number_format} đ</td>
						</tr>
						<tr>
							<th class="text-left">Chi phí khác</th>
							<td class="text-right">
								{$perform.money_ex|number_format} đ</td>
						</tr>
						{*<tr>*}
							{*<th class="text-left">Chi phí</th>*}
							{*<td class="text-right">-{$perform.fees|number_format} đ</td>*}
						{*</tr>*}
						<tr>
							<th class="text-left">Lợi nhuận</th>
							<td class="text-right">{$perform.total|number_format}
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
		var filter = $("#filter").val();
		var supp = $("#supp").val();
		var date = $("#date_ex").val();
		var url = "./?mod=report&site=performance";
		url += "&filter=" + filter;
		url += "&supp=" + supp;
		url += "&date=" + date;

		if (filter == "1") {
			var date_from = $("#date_from").val();
			var date_to = $("#date_to").val();
			url += "&date_from=" + date_from;
			url += "&date_to=" + date_to;
		} else if (filter == "2") {
			var year = $("#year").val();
			var month = $("#month").val();
			url += "&year=" + year;
			url += "&month=" + month;
		}

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
