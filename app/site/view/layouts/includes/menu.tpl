{*<div class="container mar-btm">
	<div class="menu">
		<div class="col-md-12 col-sm-12 col-xs-12 col-df left">
			<ul>
				{foreach from=$output.menu_main item=list}
				<div class="col-md-2 col-sm-2 col-xs-12 col-df">
					<li class="" color="{$list.color}"><i class="fa {$list.icon}"></i>
						<a href="{$list.url}" title="{$list.name}">{$list.name}
							<p>{$list.description}</p>
					</a></li>
				</div>
				{/foreach}
			</ul>
		</div>
		
	</div>
</div>*}
<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">{*<img src="" class="img-responsive">*}MÁY TÍNH ĐÔNG TÂY</a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menubar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id="menubar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                {*<li><a href="#">Home</a></li>*}
                {foreach from=$output.menu_main item=list}
                    <li><a href="{$list.url}" title="{$list.name}">{$list.name}</a></li>
                {/foreach}
            </ul>
        </div>
    </div>
</nav>