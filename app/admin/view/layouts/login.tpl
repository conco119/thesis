<!DOCTYPE html>
<html lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Đăng nhập hệ thống</title>
<base href="{$arg.domain}">
<link href="./hlstar.ico" rel="shortcut icon">

<!-- Bootstrap core CSS -->

<link href="{$arg.stylesheet}css/bootstrap.min.css" rel="stylesheet">

<link href="{$arg.stylesheet}fonts/css/font-awesome.min.css" rel="stylesheet">
<link href="{$arg.stylesheet}css/animate.min.css" rel="stylesheet">

<!-- Custom styling plus plugins -->
<link href="{$arg.stylesheet}css/custom.css" rel="stylesheet">
<link href="{$arg.stylesheet}css/icheck/flat/green.css" rel="stylesheet">


<script src="{$arg.stylesheet}js/jquery.min.js"></script>

<!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>

<body style="background: #F7F7F7;">

	<!-- site content -->
	{include file=$tpl_file}
	<!-- /site content -->

</body>

</html>
