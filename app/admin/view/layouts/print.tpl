<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>In hóa đơn</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes">

        <link href="{$arg.stylesheet}css/bootstrap.min.css" rel="stylesheet">

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
              <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
            <![endif]-->

        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        {* <script type="text/javascript">var config = {$js_config};</script> *}

    </head>
    <body onload="window.print()" onfocus="window.close()" style="background: #fff; font-size: 12px;">
    {* <body style="background: #fff; font-size: 12px;"> *}

        <div id="Print">
            {include file=$tpl_file}
        </div>

    </body>
</html>
