<div class="full-content">
	<h1 class="title">{$out.category}</h1>


	<div class="category full-content">
		{foreach $products key=k item=list }
		<div class="col-md-3 col-sm-3 col-xs-3 col-default itm">
			<div class="items">
				<div class="img">
					<a href="javacsript:void(0);" title="{$list.name}"><img src="{$list.img}"></a>
				</div>
				<div class="name-price">
					<p class="name">
						<a href="javacsript:void(0);" title="{$list.name}">{$list.name}</a>
					</p>
					<p class="price">{$list.price}</p>
				</div>
				<div class="btn-test">
					<a href="{$list.link}" class="btn btn-tocart" title="{$list.name}">{$arg.trans.detail}</a>
					<button type="button" class="btn btn-test-prod" onclick="DisplayProduct({$list.id});">{$arg.trans.wearing}</button>
				</div>
			</div>
		</div>
		{/foreach}

		<div class="full-content">{$paging.paging}</div>
	</div>
</div>
<!--end .content-->

