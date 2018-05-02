<h2>Danh sách thanh toán nợ của khách</h2>
<br>
<table class="table table-striped table-bordered table-bor-btm">
	<thead>
		<tr>
			<th>Ngày</th>
			<th class="align-right">Số tiền trả</th>
			<th>Người thu</th>
			<th class="align-right">Thời gian</th>
		</tr>
	</thead>
	<tbody>
	
		{foreach from=$result item=list}
		<tr>
			<td>{$list.date}</td>
			<td class="align-right">{$list.money}</td>
			<td>{$list.user}</td>
			<td class="align-right">{$list.created}</td>
		</tr>
		{/foreach}
		
	</tbody>
</table>

