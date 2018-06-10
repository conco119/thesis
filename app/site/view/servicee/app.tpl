<link rel="stylesheet" href="{$arg.stylesheet}css/services.css">

<div id="app-banner">
	<img src="{$category.image}" width="100%">
	<div class="item">
		<h1 class="slo slo1">Tối ưu hóa</h1>
		<h2 class="slo slo2">Quản lý bán hàng</h2>
		<h3 class="slo slo3">Giúp tăng hiệu quả công việc</h3>

		<div class="container form-cont">
			<form>
				<div class="form-group">
					<input type="email" class="form-control" id="email">
				</div>
				<button type="button" class="btn btn-success">Success</button>
			</form>
		</div>
	</div>
</div>

<div id="products">
	<div class="container">
		<div class="relative">
			<h2 class="title">Sản phẩm nổi bật</h2>
			<p class="description">Rất nhiều các sản phẩm của chúng tôi đem
				lại tiện ích tối đa cho người sử dụng</p>
			<a class="btn-view">Xem thêm sản phẩm khác</a>
		</div>
		<div class="row sml">
			{foreach from=$products item=data}
			<div class="col-md-110 col-sm-15 col-xs-6">
				<div class="item">
					<a href="{$data.url}" title="{$data.name}"> <img alt=""
						src="{$data.avatar}">
					</a>
				</div>
			</div>
			{/foreach}
		</div>
	</div>
</div>

<div id="app-service">
	<div class="container">
		<h2 class="title">Danh sách các gói phần mềm</h2>
			{foreach from=$services key=k item=data}
			<div class="item">
				<div class="col-md-5 col-sm-5 col-xs-12">
					<a href="{$data.url}" title="{$data.name}" class="img"> <img
						src="{$data.image}" class="baner-srvc">
					</a>
				</div>
				<div class="col-md-7 col-sm-7 col-xs-12">
					<h3 class="text-uppercase"><a href="{$data.url}" title="{$data.name}">{$data.name}</a></h3>
					<div>{$data.description}</div>
					<div class="row">
						{foreach from=$data.products key=k item=prod}
						<div class="col-md-3 col-sm-3 col-xs-12">
							<div class="item-sub">
								<a href="{$prod.link}" title="{$prod.name}"><img
										src="{$prod.avatar}"></a>
								<p><a href="{$prod.link}" title="{$prod.name}">{$prod.name}</a></p>
							</div>
						</div>
						{/foreach}
					</div>
				</div>
				<hr class="clear">
			</div>
			{/foreach}

	</div>
</div>


<div id="app-services">
	<div class="container">
		<div class="row">
			{foreach from=$service_info item=data}
			<div class="col-md-4 col-sm-4 col-xs-12">
				<div class="item text-center">
					<img src="{$data.image}" width="40%">
					<h3>{$data.name}</h3>
					<p>{$data.description}</p>
				</div>
			</div>
			{/foreach}
		</div>
	</div>
</div>

