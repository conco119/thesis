<h3>Ngày: {$out.date}</h3>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Mã HD</th>
			<th>Mã SP</th>
			<th>Sản phẩm</th>
			<th>Danh mục</th>
			<th>SL</th>
			<th class="text-right">Giá</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$result item=list}
		<tr>
			<td>{$list.excode}</td>
			<td>{$list.code}</td>
			<td>{$list.name}</td>
			<td>{$list.category}</td>
			<td>{$list.number}</td>
			<td class="text-right">{$list.price|number_format}</td>
		</tr>
		{/foreach}
	</tbody>
</table>

