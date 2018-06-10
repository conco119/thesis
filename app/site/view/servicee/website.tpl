<link rel="stylesheet" href="{$arg.stylesheet}css/services.css">

<img src="{$category.image}" width="100%">	

<div id="web-feature">
	<div class="container">
		<h2 class="title">Các tính năng của website</h2>
		<div class="row">
			{foreach from=$service_info item=data}
			<div class="col-md-4 col-sm-4 col-xs-12">
				<div class="item">
					<img src="{$data.image}" class="img"/>
					<h3>{$data.name}</h3>
					<p>{$data.description}</p>
				</div>
			</div>
			{/foreach}
		</div>
	</div>
</div>


<div id="web-service">
	<div class="container">
		<h2 class="title">Dịch vụ thiết kế</h2>
		<div class="row ">
			{foreach from=$services item=data}
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="item">
					<img src="{$data.image}">
					<h3><a href="{$data.url}">{$data.name}</a></h3>
					<div>{$data.description}</div>
					<hr class="clear">
				</div>
			</div>
			{/foreach}
		</div>
	</div>
</div>

<div id="web-prod">
	<div class="container">
		<h2 class="title">Sản phẩm</h2>
		<div class="row">
			{foreach from=$hot_product item=data}
			<div class="col-md-3 col-sm-3 col-xs-6">
				<div class="item">
					<a href="{$data.link}" title="{$data.name}"><img src="{$data.image}" width="100%"></a>
					<h3><a href="">{$data.name}</a></h3>
				</div>
			</div>
			{/foreach}
		</div>
	</div>
</div>

