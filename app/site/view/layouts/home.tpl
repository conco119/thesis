<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Thiết bị nhà thông minh</title>
        <base href="{$domain}">
        <meta name="keywords" content="{$seo.keyword}" />
        <meta name="description" content="{$seo.description}" />
        <meta name="robots" content="noodp,index,follow" />
        <meta name='revisit-after' content='1 days' />
        <meta name="og:image" content="http://sanchoi.net/upload/log/sharingan.png"/>
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="icon" href="/dtc.ico" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="{$arg.stylesheet}css/style.css" >
        <link rel="stylesheet" type="text/css" href="{$arg.stylesheet}css/mobile.css" >
        <link rel="stylesheet" href="{$arg.stylesheet}js/font-awesome-4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="{$arg.stylesheet}js/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="{$arg.stylesheet}js/bootstrap/css/bootstrap-theme.min.css">
        <link rel="stylesheet" type="text/css" href="{$arg.stylesheet}js/jquery.bxslider/jquery.bxslider.css">
        <link rel="stylesheet" type="text/css" href="{$arg.stylesheet}css/hoverZoomEtalage.css" >
        <link rel="stylesheet" href="{$arg.stylesheet}css/services.css">

        <script src="{$arg.stylesheet}js/jquery-2.1.3.min.js"></script>
        <script src="{$arg.stylesheet}js/jquery.bxslider/plugins/jquery.fitvids.js"></script>
        <script src="{$arg.stylesheet}js/jquery.bxslider/jquery.bxslider.min.js"></script>
        <script src="{$arg.stylesheet}js/bootstrap/js/bootstrap.min.js"></script>


        <script src="{$arg.stylesheet}js/main.js"></script>
    </head>
    <body>


        {include file="includes/header.tpl"}

        {include file="includes/menu.tpl"}


		<div class="container">
	        <div class="row mar-btm">
	            <div class="col-md-3 col-sm-3 col-xs-12 hide-mobile">
	                 {include file="includes/sidebar.tpl"}
	             </div>
	             <div class="col-md-9 col-sm-9 col-xs-12">
	                 {include file=$tpl_file}
	             </div>
	        </div>
        </div>

        {include file="includes/footer.tpl"}

		<!-- Small message modal -->
		<div class="modal fade bs-example-modal-sm" id="MessageModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Message box</h4>
					</div>
					<div class="modal-body">
						<p></p>
					</div>
				</div>
			</div>
		</div>

    </body>
</html>