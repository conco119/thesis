<link rel="stylesheet" href="{$arg.stylesheet}css/services.css">
<div id="domain">
	<div class="container">
		<div class="text-center">
			<h1>{$category.name}</h1>
			<div class="img">
				<img src="{$category.image}" title="{$category.name}">
			</div>
			<p class="description">{$category.description}</p>
		</div>
	</div>



	<div class="container" id="cont-domain">
		{foreach from=$services item=list}
		{if $list.products ne NULL}
		<div class="price-list">
			<h3 class="title">{$list.name}</h3>
			<p class="description">{$list.description}</p>
			<div>
				<table class="table table-bordered">
					<tr>
						<th>Tên Miền</th>
						<th class="text-center">Phí Khởi tạo</th>
						<th class="text-center">Phí Duy Trì (năm)</th>
						<th class="text-center">Đặt mua</th>
					</tr>
					{foreach from=$list.products item=data}
					<tr>
						<td>{$data.name}</td>
						<td class="text-center">{$data.price}</td>
						<td class="text-center">{$data.price}</td>
						<td class="text-center"><button type="button" class="btn">Đặt mua</button></td>
					</tr>
					{/foreach}
				</table>
			</div>
		</div>
		{/if}
		{/foreach}

		<div class="row get-price-list text-center">
			<p class="description">Mọi sự hợp tác tốt đều đến từ một cuộc nói chuyện. Hãy liên hệ với chúng tôi, để có được dịch vụ tốt nhất.</p>
		</div>

	</div>

</div>
