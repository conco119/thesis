<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>{$seo.title}</title>
        <base href="{$domain}">
        <meta name="keywords" content="{$seo.keyword}" />
        <meta name="description" content="{$seo.description}" />
        <meta name="robots" content="noodp,index,follow" />
        <meta name='revisit-after' content='1 days' />

        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="icon" href="/dtc.ico" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="{$arg.stylesheet}css/style.css" >
        <link rel="stylesheet" type="text/css" href="{$arg.stylesheet}css/mobile.css" >
        <link rel="stylesheet" href="{$arg.stylesheet}js/font-awesome-4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="{$arg.stylesheet}js/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="{$arg.stylesheet}js/bootstrap/css/bootstrap-theme.min.css">
        <link rel="stylesheet" type="text/css" href="{$arg.stylesheet}js/jquery.bxslider/jquery.bxslider.css">
        <link rel="stylesheet" type="text/css" href="{$arg.stylesheet}css/hoverZoomEtalage.css">

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
            {include file=$tpl_file}
        </div>

        {include file="includes/footer.tpl"}

    </body>
</html>