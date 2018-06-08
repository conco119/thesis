<div class="sidebar_title bg_34495e">
	<h1>{$out.category}</h1>
</div>

<div class="row">
	{if $products neq NULL}
	{foreach $products key=k item=list }
	<div class="col-md-3 col-sm-3" id="compare{$list.id}">
		<div class="compare">
			<button type="button" onclick="removeCompareProduct({$list.id});"><i class="fa fa-times-circle"></i></button>
			<div class="img">
				<a href="{$list.link}" title="{$list.name}"><img class="img-responsive" src="{$list.img}"></a>
			</div>
			<div class="compare-content">
				<h3 class="name">
					<a href="{$list.link}" title="{$list.name}">{$list.name}</a>
				</h3>
				<p class="price">{$list.price}</p>
				<div class="description">
					{$list.description}
				</div>
			</div>
		</div>
	</div>
	{/foreach}
	{else}
	<div class="col-md-12">
		<div class="compare-content">
			<p>Chưa có sản phẩm nào được thêm vào so sánh</p>
		</div>
	</div>
	{/if}
</div>

