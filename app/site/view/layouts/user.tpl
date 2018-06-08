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

        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <link rel="icon" href="/dtc.ico" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="{$arg.stylesheet}css/style.css">
        <link rel="stylesheet" type="text/css" href="{$arg.stylesheet}css/login.css">
        <link rel="stylesheet" type="text/css" href="{$arg.stylesheet}css/mobile.css">
        <link rel="stylesheet" href="{$arg.stylesheet}libs/font-awesome-4.4.0/css/font-awesome.min.css">

        <link rel="stylesheet" type="text/css" href="{$arg.stylesheet}libs/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="{$arg.stylesheet}libs/bootstrap/css/bootstrap-theme.min.css">

        <link rel="stylesheet" type="text/css" href="{$arg.stylesheet}libs/jquery.bxslider/jquery.bxslider.css">
        <link type="text/css" rel="stylesheet" href="{$arg.stylesheet}libs/jQuery.mmenu-master/dist/css/jquery.mmenu.all.css" />

        <script src="{$arg.stylesheet}js/jquery-2.1.3.min.js"></script>
        <script src="{$arg.stylesheet}js/main.js"></script>
        <script src="{$arg.stylesheet}libs/bootstrap/js/bootstrap.min.js"></script>
        <script src="{$arg.stylesheet}libs/jquery.bxslider/plugins/jquery.fitvids.js"></script>
        <script src="{$arg.stylesheet}libs/jquery.bxslider/jquery.bxslider.min.js"></script>
        <script src="{$arg.stylesheet}js/cart.js"></script>
        <script src="{$arg.stylesheet}libs/jQuery.mmenu-master/dist/js/jquery.mmenu.min.all.js"></script>
    </head>
    <body>
        <div class="" id="page"><!--page-desktop (min-width:1200px)-->

            <div class="row header">{include file="includes/header.tpl"}</div>
            <div class="row header-mobile">{include file="includes/header-mobile.tpl"}</div>
            <!--end .header-->

            <div class="menu">{include file="includes/menu.tpl"}</div>

            <!--end .menu-->

            <div class="row user_detail">
                <div class="container remove-container-js">
                    <div class="col-md-2 col-sm-2 col-default">
                        <div class="sidebar_detal_user full-content">
                            <div class="user-inf-top full-content">
                                <img src="site/home/webroot/images/avatar_default.jpg">
                                <p class="name"><a href="./cus/?site=detail">{$arg.user.name}</a></p>
                                <p class="change"><a href="./cus/?site=detail">Chỉnh sửa tài khoản</a></p>
                            </div>
                            <ul>
                                <li><h3>Quản lý tài khoản</h3></li>
                                <li><a href="./cus/?site=detail"><i class="fa fa-file-text-o"></i> Thông tin tài khoản</a></li>
                                <li><a href="./cus/?site=changePass"><i class="fa fa-file-text-o"></i> Đổi mật khẩu</a></li>
                            </ul>
                            <ul>
                                <li><h3>Quản lý giao dịch</h3></li>
                                <li><a href="./order/?site=index"><i class="fa fa-file-text-o"></i> Đơn hàng Mới</a></li>
                                <li><a href="./order/?site=inprogress"><i class="fa fa-file-text-o"></i> Đang chờ xử lý</a></li>
                                <li><a href="./order/?site=done"><i class="fa fa-file-text-o"></i> Đơn hàng thành công</a></li>
                                <li><a href="./order/?site=cancel"><i class="fa fa-file-text-o"></i> Đơn hàng hủy bỏ</a></li>
                                <li><a href="./order/?site=returns"><i class="fa fa-file-text-o"></i> Đơn hàng trả về</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-10 col-sm-10">
                        {include file=$content}
                    </div>
                </div>
            </div>
            <!--end .wrapper-->

            <div class="row trademark-slide">
                <!--{include file="includes/trademarks.tpl"}-->
            </div>
            <!--end .trademark-slide-->

            <div class="row footer">{include file="includes/footer.tpl"}</div>
            <!--end .footer-->

        </div>
    </body>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
        (function () {
            var s1 = document.createElement("script"), s0 = document
                    .getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/566e316a870a7f813e42a220/default';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
</html>