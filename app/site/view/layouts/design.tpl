<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{$seo.title}</title>
    <base href="{$arg.domain}"></base>  
    
    <meta name="keywords" content="{$seo.keyword}" />
    <meta name="description" content="{$seo.description}" />
    <meta name="robots" content="noodp,index,follow" />
    <meta name='revisit-after' content='1 days' />
    <meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="icon" href="/dtc.ico" type="image/x-icon">
    <link rel="stylesheet" href="{$arg.stylesheet}js/font-awesome-4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{$arg.stylesheet}js/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{$arg.stylesheet}js/bootstrap/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="{$arg.stylesheet}css/ga.css">
    <link rel="stylesheet" href="{$arg.stylesheet}css/style.css">
    
    <script src="{$arg.stylesheet}js/jquery-2.1.3.min.js"></script>
    <script src="{$arg.stylesheet}js/bootstrap/js/bootstrap.min.js"></script>
    <script src="{$arg.stylesheet}js/main.js"></script>
    
</head>
<body>
    <div id="support">
        <div class="wrap">
            <div class="title">
                <img src="site/home/webroot/images/support_btn.png">
            </div>
            <div class="content">Need help? We're here for you.
                <ul>
                    <li><i class="fa fa-phone"></i> <a href="">{$output.info_footer.phone}</a></li>
                    <li><i class="fa fa-envelope-o"></i> <a href="">{$output.info_footer.email}</a></li>
                    <li><i class="fa fa-skype"></i> {$arg.social.twitter}</li>
                </ul>
            </div>
        </div>
    </div>
    <div id="header">
		{include file="includes/header.tpl"}    
    </div>

	<div id="banner">
		<div class="container">
			<h1>{$out.products} Sản phẩm công nghệ và ứng dụng chuyên nghiệp</h1>
			<div class="label_search">
            For
				<a href="">HTML</a>,
				<a href="">Email</a>,
				<a href="">WordPress</a>,
				<a href="">PSD</a>,
				<a href="">Joomla</a>,
				<a href="">Magento</a>
				and more
			</div>
			<div class="search_form">
				<div class="wap">
					<form>
						<input type="text" class="" placeholder="Tìm kiếm các sản phẩm ..." />
						<button type="submit">
						    <i class="fa fa-search fa-2x"></i>
						</button>
					</form>
				</div>
			</div>

			<div class="search_button">
		          <a href="" class="btn btn-default">Browse Popular Items</a>
		          <a href="" class="btn btn-default">Browse Top New Items</a>
		          <a href="" class="btn btn-default">Browse Latest Items</a>
		    </div>

		</div>
	</div>
	
	<div id="products">
		<div class="container">
			<div class="relative">
				<h2 class="title">Sản phẩm nổi bật</h2>
				<p class="description">Rất nhiều các sản phẩm của chúng tôi đem lại tiện ích tối đa cho người sử dụng</p>
				<a class="btn-view">Xem thêm sản phẩm khác</a>
			</div>
			<div class="row sml">
				{foreach from=$products item=data}
				<div class="col-md-110 col-sm-15 col-xs-6">
					<div class="item">
						<a href="{$data.url}" title="{$data.name}">
							<img alt="" src="{$data.avatar}">
						</a>
						<div class="tooltips">
							<img alt="" src="{$data.avatar}">
							<p class="name">{$data.name}</p>
							<p class="price text-right">{$data.price}</p>
						</div>
					</div>
				</div>	             
				{/foreach}
			</div>
		</div>
	</div>
	
	<div id="services">
	    <div class="container">
	    	<div>
	    	<h2 class="title">Dịch vụ</h2>
	    	<p class="description">Các dịch vụ công nghệ, website, ứng dụng chất lượng.</p>
	    	<a class="btn-view">Xem tất cả các dịch vụ</a>
	    	</div>
	    	
	        <div class="row">
	        	{foreach from=$services item=data}
				<div class="col-md-4 col-sm-4 col-xs-12">
					<div class="item img">
						<a href="{$data.url}" title="{$data.name}"><img alt="" src="{$data.avatar}"></a>
						<h3><a href="{$data.url}" title="{$data.name}">{$data.name}</a></h3>
						<p>{$data.description}</p>
					</div>
				</div>
				{/foreach}            
	        </div>
	    </div>
		
	</div>
	
    <div id="suppoter">
	    <div class="container">
	        <div class="row">
	        	{foreach from=$supporters item=data}
				<div class="col-md-3 col-sm-3 col-xs-12">
					<div class="item">
						<div class="text-center">
							<img class="avt" src="{$data.image}">
							<h3>{$data.name}</h3>
							<p><i class="fa fa-tty"></i> {$data.phone}</p>
							<p><i class="fa fa-envelope-o"></i> {$data.email}</p>
						</div>
						<ul>
							{foreach from=$data.supporter item=supp}
							<li>
								<i class="fa fa-life-ring"></i>&nbsp;{$supp.name} <br> 
								<i class="fa fa-phone-square"></i>&nbsp; {$supp.phone}
								<a href="skype:t{$supp.skype}?chat" class="pull-right"><img src="site/home/webroot/images/icon_skype.png"></a>
							</li>
							{/foreach}
						</ul>
					</div>
				</div>	   
				{/foreach}          
	        </div>
	    </div>
    </div>
    
    {include file="includes/footer.tpl"}

</body>
</html>