<div class="">
	<div class="row">
		<div class="x_panel">
			<div class="x_title">
				<h2>Top các dịch vụ được đăng kí nhiều nhất</h2>
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
						</select> {if $out.value.filter eq '2'}
							<select class="form-control" id="year" onchange="filter();">{$out.year}</select>
							<select class="form-control" id="month" onchange="filter();">{$out.month}</select>

						{else if $out.value.filter eq '1'}
							<div class='input-group date pull-right' id='date_t'>
								<input style="margin: 0px" type='text' class="form-control" id="" placeholder="Đến ngày"
									   onchange="filter();" value='{$out.date_to|date_format:"%m-%d-%Y %H:%M %p"}'><span
										class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                                </span>
							</div>
							<div class='input-group date pull-right' id='date_f'>
								<input type='text'style="margin: 0px" class="form-control" id="" placeholder="Từ ngày" onchange="filter();"
									   value='{$out.date_from|date_format:"%m-%d-%Y %H:%M %p"}'>
	                            <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar">
                                    </span>
                                </span>
							</div>

							<input id="date_from" onchange="filter();" value="{$out.date_from}" type="hidden">
							<input id="date_to" onchange="filter();" value="{$out.date_to}" type="hidden">
						{else}
							<select class="form-control" id="date_ex" onchange="filter();">
								<option value="0">Tất cả hóa đơn</option> {$out.select_export}
							</select>
						{/if}
						<form method="post" style="display: inline;">
							<button type="submit" name="export_request" class="left btn btn-success">
								<i class="fa fa-share-square-o"></i> Xuất file Excel
							</button>
						</form>


						<div class="clearfix"></div>
					</div>
				</div>

				<table class="table table-striped">
					<thead>
						<tr>
							<th><input type="checkbox" id="rowSelectAll"></th>
							<th>Mã</th>
							<th>Tên dịch vụ</th>
							<th class="text-right">Giá dịch vụ</th>
							<th class="text-right">Tổng số lượt</th>
							<th class="text-right">Tổng tiền</th>
						</tr>
					</thead>
					<tbody>

						{foreach from=$result item=list}
						<tr>
							<td><input type="checkbox" class="row-select" name="ckeck[]"
								value="{$list.id}"></td>
							<td>{$list.code}</td>
							<td>{$list.name}<span style="font-size: 11px;">{if $list.type eq 0}(Dịch vụ thường) {else} (Dịch vụ tính giờ) {/if}</span></td>
							<td class="text-right">{$list.price|number_format} đ</td>
							<td class="text-right">{$list.cout_sv} lượt {if $list.type eq 1}/ Tổng:{$list.h_custom}{/if}</td>
							<td class="text-right">{$list.money_sv|number_format} đ</td>
						</tr>
						{/foreach}

					</tbody>
				</table>

			</div>
		</div>


	</div>

</div>


<link href="{$arg.stylesheet}js/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet">
<script src="{$arg.stylesheet}js/moment/moment.min.js"></script>
<script type="text/javascript" src="{$arg.stylesheet}js/datepicker/daterangepicker.js"></script>
<script src="{$arg.stylesheet}js/datetimepicker/bootstrap-datetimepicker.min.js"></script>

{literal}
<script>
	$(document).ready(function() {

			$('#date_f').datetimepicker({}, function () {

			});
			$('#date_t').datetimepicker({}, function () {

			});

			if ($("input[name=type]:checked").val() == 2) {
				$('#product_show').hide();
				$('#product').hide();
			}
			$("#date_f").on("dp.hide", function (e) {
				var date = new Date(e.date._d).getTime();
				var new_time = date.toString().substring(0, 10);
				$("#date_from").val(new_time);
				$('#date_from').change();
			});
			$("#date_t").on("dp.hide", function (e) {
				var date = new Date(e.date._d).getTime();
				var new_time = date.toString().substring(0, 10);
				$("#date_to").val(new_time);
				$('#date_to').change();


			});

	});

	var money = 0;
	function GetSupplierInfo(value) {
		$.post('?mod=supplier&site=ajax_load_item', {
			'id' : value
		}).done(function(data) {
			var cus = JSON.parse(data);
			$("#code").val(cus.code);
			$("#name").val(cus.name);
			$("#phone").val(cus.phone);
			$("#address").val(cus.address);
			$("#owe").val(cus.owe);
			$("#money").val(0);
			money = cus.owe.replace(/,/gi, "");
			$("#group-payment").show();
		});
	}

	function GetAllMoney() {
		$.post('?mod=helps&site=ajax_get_number_format&id=', {
			'value' : money
		}).done(function(data) {
			$("#money").val(data);
		});
	}

	function CheckMoneyPayment(value) {
		var value = value.replace(/,/gi, "");
		if (parseInt(value) > parseInt(money)) {
			alert('So tien nhap vuot qua cong no');
			$.post('?mod=helps&site=ajax_get_number_format&id=', {
				'value' : money
			}).done(function(data) {
				$("#money").val(data);
			});
			return false;
		}
	}

	function filter() {
		var filter = $("#filter").val();
		var limit = $("input[name=limit]").val();
		var url = "./?mod=service&site=statistics";
		url += "&filter=" + filter;
		url += "&limit=" + limit;
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
</script>
{/literal}
