<h2>Danh sách hóa đơn ghi nợ</h2>
<br>
<table class="table table-striped table-bordered table-bor-btm">
	<thead>
		<tr>
			<th>Ngày</th>
			<th>Mã</th>
			<th class="align-right">Số tiền nợ</th>
			<th>Bán hàng</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	
		{foreach from=$result item=list}
		<tr>
			<td>{$list.date}</td>
			<td>{$list.code}</td>
			<td class="align-right">{$list.owe}</td>
			<td>{$list.user}</td>
			<td class="align-cen">
				<button type="button" data-toggle="modal" class="btn btn-small" data-target="#orderDetail" data-dismiss="modal" onclick="SetExportInfo({$list.id});">
					<i class="btn-icon-only icon-eye-open"></i>
				</button>
			</td>
		</tr>
		{/foreach}
		
	</tbody>
</table>

