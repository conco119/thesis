<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>{$arg.setting.name}</title>
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="{$arg.stylesheet}css/bootstrap.min.css" rel="stylesheet">
<link href="{$arg.stylesheet}css/bootstrap-responsive.min.css"
	rel="stylesheet">
<link href="{$arg.stylesheet}css/font-awesome.css" rel="stylesheet">
<link href="{$arg.stylesheet}css/style.css" rel="stylesheet">
<link href="{$arg.stylesheet}css/pages/dashboard.css" rel="stylesheet">
<link href="{$arg.stylesheet}css/pages/reports.css" rel="stylesheet">
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{$arg.stylesheet}js/jquery-1.7.2.min.js"></script>
<script src="{$arg.stylesheet}js/bootstrap.js"></script>
<script src="{$arg.stylesheet}js/base.js"></script>
<script type="text/javascript">var config = {$js_config};</script>
<script src="{$arg.stylesheet}js/notify/pnotify.core.js"></script>
<script src="{$arg.stylesheet}js/notify/pnotify.buttons.js"></script>

</head>
<body>

	{include file="includes/header.tpl"} {include file="includes/menu.tpl"}

	<div class="main">
		<div class="main-inner">
			<div class="container">
				<div class="row">

					
					{include file=$content}


				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /main-inner -->
	</div>
	<!-- /main -->

	{include file="includes/footer.tpl"}

</body>
</html>
