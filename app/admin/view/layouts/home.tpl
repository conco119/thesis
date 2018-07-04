<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Meta, title, CxSS, favicons, etc. -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>{$arg.setting.info.name}</title>
<base href="{$arg.domain}">
<link href="./mtd.ico" rel="shortcut icon">

<!-- Bootstrap core CSS -->
<link href="{$arg.stylesheet}css/bootstrap.min.css" rel="stylesheet">
<link href="{$arg.stylesheet}fonts/css/font-awesome.min.css" rel="stylesheet">
<link href="{$arg.stylesheet}css/animate.min.css" rel="stylesheet">

<!-- Custom styling plus plugins -->
<link href="{$arg.stylesheet}css/custom.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{$arg.stylesheet}css/maps/jquery-jvectormap-2.0.3.css" />
<link href="{$arg.stylesheet}css/icheck/flat/green.css" rel="stylesheet">
<link href="{$arg.stylesheet}css/floatexamples.css" rel="stylesheet" />

<script src="{$arg.stylesheet}js/jquery.min.js"></script>
<script src="{$arg.stylesheet}js/notify/pnotify.core.js"></script>
<script src="{$arg.stylesheet}js/notify/pnotify.buttons.js"></script>
<script src="{$arg.stylesheet}js/bootstrap.min.js"></script>

<!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>
<body class="nav-md">
	<div class="container body">


		<div class="main_container">

			<div class="col-md-3 left_col">
			{include file="includes/sidebar.tpl"}
			</div>

			<!-- top navigation -->
			{include file="includes/header.tpl"}
			<!-- /top navigation -->


			<!-- page content -->
			<div class="right_col">

				<br />
				<!-- site content -->
				{include file=$tpl_file}
				<!-- /site content -->

				<!-- footer content -->
				{include file="includes/footer.tpl"}
				<!-- /footer content -->

			</div>
			<!-- /page content -->
		</div>


	</div>

	<div id="custom_notifications" class="custom-notifications dsp_none">
		<ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group"></ul>
		<div class="clearfix"></div>
		<div id="notif-group" class="tabbed_notifications"></div>
	</div>


	<script src="{$arg.stylesheet}js/nicescroll/jquery.nicescroll.min.js"></script>
	<script type="text/javascript" src="{$arg.stylesheet}js/moment/moment.min.js"></script>
	<script src="{$arg.stylesheet}js/custom.js"></script>

	<script type="text/javascript">
	</script>
</body>
</html>
