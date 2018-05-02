<link href="{$arg.stylesheet}css/custom.css" rel="stylesheet">
<div class="x_panel">
	<div class="">
		<h2 class="text-center">Thông tin mua hàng từ nhà cung cấp</h2>
		<p>Nhà cung cấp: <b>{$supplier.name}</b></p>
		<p>Số điện thoại: <b>{$supplier.phone}</b></p>
		<p>Địa chỉ: <b>{$supplier.address}</b></p>
		<ul class="nav navbar-right panel_toolbox">
			<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
		</ul>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">

		<table class="table table-bordered">
			<thead>
			<tr>
				<th>Ngày</th>
				<th>Chi tiết mua hàng</th>
				<th class="text-right">Tổng tiền</th>
				<th class="text-right">Chiết khấu</th>
				<th class="text-right">Công nợ</th>
				<th class="text-right">Nạp tiền</th>
				<th class="text-right">Số dư</th>
			</tr>
			</thead>
			<tbody>

			{foreach from=$detail key=date item=data}
				<tr>
					<td>{gmdate("d-m-Y", strtotime($date) + 7 * 3600)}</td>
					<td class="padding-none">
						<table class="table">
							{foreach $data.content item=list}
								{if $list.number > 0}
									<tr>
										<td width="65%">{$list.name}</td>
										<td width="10%" class="align-right">{$list.number}</td>
										<td width="25%"
											class="align-right">{($list.number*$list.price)|number_format}
											đ
										</td>
									</tr>
								{/if}
							{/foreach}
						</table>
					</td>
					<td class="text-right">{$data.money|number_format} đ</td>
					<td class="text-right">{$data.discount|number_format} đ</td>
					<td class="text-right"> {$data.payment|number_format}đ</td>
					<td class="text-right">{$data.debt|number_format} đ</td>
					<td class="text-right">{($data.debt-$data.payment)|number_format} đ</td>
				</tr>
			{/foreach}
			<tr>
				<th colspan="2" class="text-right">Tổng chi tiết các khoản:</th>
				<td class="text-right">{$out.total_money|number_format} đ</td>
				<td class="text-right">{$out.total_discount|number_format} đ</td>
				<td class="text-right"> {$out.total_payment|number_format} đ</td>
				<td class="text-right">{$out.total_debt|number_format} đ</td>
				<td class="text-right">{($out.total_debt-$out.total_payment)|number_format} đ</td>
			</tr>

			</tbody>
		</table>
	</div>
</div>


