<div class="container">
	{include file="includes/breadcrumbs.tpl"}
	<div class="row"></div>
	<div class="brand-baner">
		<div class="pos-logo"><a href=""><img src="{$result.logo}" class="img-logo" /></a></div>
		<div class="slogan">
			<div class="col-md-3"></div>
			<div class="col-md-9"> <h3>{$result.address}</h3></div>
		</div>
		<div class="name-brand"> {$result.name} </div>
		<div class="old">
			<div class="col-md-3"> </div>
			<div class="col-md-9 pad-left-30">{$result.description}</div>
		</div>
	</div>

	<div class="full-content">
		<h3 class="title-page">{$out.category}</h3>
		<div class="col-md-9 col-sm-9 col-xs-12 col-default">
			<div class="category full-content">
				{foreach from=$product item=data}
				<div class="col-md-4 col-sm-4 col-xs-4 col-default">
					<div class="items">
						<div class="img">
							<a href="javacsript:void(0);"><img src="{$data.avatar}"></a>
						</div>
						<div class="name-price">
							<p class="name">
								<a href="javacsript:void(0);">{$data.name}</a>
							</p>
							<p class="price">
								<span>{$data.price}</span>
							</p>
						</div>
						<div class="btn-test">
							<button type="button" class="btn btn-tocart" onclick="addToCart({$data.id});">{$arg.trans.buy}</button>
							<a href="{$data.link}" class="btn btn-test-prod">{$arg.trans.detail}</a>
						</div>
					</div>
				</div>
				{/foreach}
			</div>

			<div class="full-content"></div>
		</div>
		
		{include file="../layouts/includes/appsize.tpl"} 
		
	</div>
	<!--end .content-->



</div>