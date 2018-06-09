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

        <meta name="viewport" content="width=device-width,initial-sacle=1">

        <link rel="stylesheet" type="text/css" href="{$arg.stylesheet}css/login.css" >
        <link rel="stylesheet" type="text/css" href="{$arg.stylesheet}css/mobile.css" >
        <link rel="stylesheet" href="{$arg.stylesheet}js/font-awesome-4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="{$arg.stylesheet}js/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="{$arg.stylesheet}js/bootstrap/css/bootstrap-theme.min.css">
        <link rel="stylesheet" type="text/css" href="{$arg.stylesheet}js/jquery.bxslider/jquery.bxslider.css">

        <script src="{$arg.stylesheet}js/jquery-2.1.3.min.js"></script>
        <script src="{$arg.stylesheet}js/jquery.bxslider/plugins/jquery.fitvids.js"></script>
        <script src="{$arg.stylesheet}js/jquery.bxslider/jquery.bxslider.min.js"></script>
        <script src="{$arg.stylesheet}js/bootstrap/js/bootstrap.min.js"></script>

        <script src="{$arg.stylesheet}js/main.js"></script>
    </head>
    <body>

    <div class="container">
        <div class="login_box" style="margin-top: 70px;">
            {include file=$tpl_file}
            <div class="log_footer">
            {foreach from=$errors item=item }
                <p >{$item}</p>
            {/foreach}

                <p class="text-center"><a href="./">Trở về trang chủ</a></p>
            </div>
        </div>
    </div>

</html>