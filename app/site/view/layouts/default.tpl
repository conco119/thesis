<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{$seo.title}</title>
    <base href="{$domain}">
    <meta name="keywords" content="{$seo.keyword}"/>
    <meta name="description" content="{$seo.description}"/>
    <meta name="robots" content="noodp,index,follow"/>
    <meta name='revisit-after' content='1 days'/>


    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/dtc.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="{$arg.stylesheet}css/defaul.css">
    <link rel="stylesheet" type="text/css" href="{$arg.stylesheet}css/mobile.css">
    <link rel="stylesheet" href="{$arg.stylesheet}js/font-awesome-4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{$arg.stylesheet}js/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{$arg.stylesheet}js/bootstrap/css/bootstrap-theme.min.css">
    <script src="{$arg.stylesheet}js/jquery-2.1.3.min.js"></script>
    <script src="{$arg.stylesheet}js/bootstrap/js/bootstrap.min.js"></script>
    <script src="{$arg.stylesheet}js/main.js"></script>
</head>
<body>
<div class="row col-df">
    <div class="container">
        <div class="col-md-8 col-sm-8 col-xs-12 col-df">
            <div class="name-cty">
                <h1>{$output.info_footer.name}</h1>
            </div>
            <div class="address">
                <p>Địa Chỉ: {$output.info_footer.address}</p>

                <p>{$output.info_footer.phone}</p>
            </div>
        </div>
        <div class="col-md- 4 col-sm-4 col-xs-12 col-df">
            <div class="name-cty">
                <img src="{$output.logo}" class="pull-right">
            </div>

        </div>
    </div>
</div>

<br/><br/><br/>

<div class="row col-df">
    <div class="container">
        {foreach from=$menu1 item=list}
            <div class="defaul_item">
                <div class="box big text-center">
                    <div class="box-cont pad-top-15 bg_06d2fc">
                        <img src="{$list.img_cate}" width="70" height="50">
                    </div>
                </div>
                <div class="box big text-center">
                    <div class="box-cont pad-top-15 bg_1262d9">
                        <p>
                            {$list.description}
                        </p>
                    </div>
                </div>
                {foreach from=$list.child_menu key=k item=subList}
                    <div class="box {$subList.size} text-center">
                        <a href="{$subList.url}">
                            <div class="box-cont pad-top-15 {if $k eq 0}bg_ca3a18{/if} {if $k eq 1}bg_06d2fc{/if}">
                                <img src="{$subList.img}" width="70" height="50">

                                <p href="" class="absolute">{$subList.name}</p>
                            </div>
                        </a>
                    </div>
                {/foreach}
            </div>
        {/foreach}

        {foreach from=$menu2 item=list}
            <div class="defaul_item">
                {foreach from=$list.child_menu key=k item=subList}
                    {$bg_ = ""}
                    {if $k eq 0}{$bg_ = bg_ca3a18}{/if}
                    {if $k eq 1}{$bg_ = bg_FF5C36}{/if}
                    {if $k eq 2}{$bg_ = bg_009a00}{/if}
                    {if $k eq 3}{$bg_ = bg_8c0a92}{/if}
                    <div class="box {$subList.size} text-center">
                        <a href="{$subList.url}">
                            <div class="box-cont pad-top-15 {$bg_}">
                                <img src="{$subList.img}" class="" width="70" height="50">

                                <p href="" class="absolute">{$subList.name}</p>
                            </div>
                        </a>
                    </div>
                {/foreach}
                <div class="box big text-center">
                    <div class="box-cont bg_06d2fc">
                        <img src="{$list.img_cate}" width="100%" height="100%">
                    </div>
                </div>
            </div>
        {/foreach}

        {foreach from=$menu3 item=list}
            <div class="defaul_item">
                <div class="box height_double text-center">
                    <div class="box-cont bg_06d2fc">
                        <img src="{$list.img_cate}" width="100%" height="100%">
                    </div>
                </div>

                {foreach from=$list.child_menu key = k item=subList}
                    {$bg_ = ""}
                    {if $k eq 0}{$bg_ = bg_ca3a18}{/if}
                    {if $k eq 1}{$bg_ = bg_06d2fc}{/if}
                    <div class="box lag text-center">
                        <a href="{$subList.url}">
                            <div class="box-cont pad-top-15 {$bg_}">
                                <img src="{$subList.img}" class="" width="70" height="50">

                                <p href="" class="absolute">Phụ Kiện</p>
                            </div>
                        </a>
                    </div>
                {/foreach}
            </div>
        {/foreach}

        {foreach from=$menu4 item=list}
            <div class="defaul_item">
                {foreach from=$list.child_menu key = k item=subList}
                    {$bg_ = ""}
                    {if $k eq 0}{$bg_ = bg_6436d7}{/if}
                    {if $k eq 1}{$bg_ = bg_009a00}{/if}
                    {if $k eq 1}{$bg_ = bg_06d2fc}{/if}
                    <div class="box {$subList.size} text-center">
                        <a href="{$subList.url}">
                            <div class="box-cont pad-top-15 {$bg_}">
                                <img src="{$subList.img}" width="50" height="50">

                                <p class="absolute">{$subList.name}</p>
                            </div>
                        </a>
                    </div>
                {/foreach}

                <div class="box big text-center">
                    <div class="box-cont bg_06d2fc">
                        <img src="{$list.img_cate}" width="100%" height="100%">
                    </div>
                </div>
            </div>
        {/foreach}

        {foreach from=$menu5 item=list}
            <div class="defaul_item">
                <div class="box big text-center">
                    <div class="box-cont bg_06d2fc">
                        <img src="{$list.img_cate}" width="100%" height="100%">
                    </div>
                </div>

                {foreach from=$list.child_menu key=k item=subList}
                    {$bg_ = ""}
                    {if $k eq 0}{$bg_ = bg_009a00}{/if}
                    {if $k eq 1}{$bg_ = bg_6436d7}{/if}
                    {if $k eq 2}{$bg_ = bg_8c0a92}{/if}
                    <div class="box {$subList.size} text-center">
                        <a href="{$subList.url}">
                            <div class="box-cont pad-top-15 {$bg_}">
                                <img src="{$subList.img}" width="70" height="50">

                                <p href="" class="absolute">{$subList.name}</p>
                            </div>
                        </a>
                    </div>
                {/foreach}
            </div>
        {/foreach}

    </div>
</div>
</body>
</html>