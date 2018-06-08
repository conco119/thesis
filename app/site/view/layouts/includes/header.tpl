<div class="container">
    <div class="top_link bg_white">
        <ul class="pull-left hide-mobile">
            {foreach from=$output.menu_top_link item=list}
                <li><a href="{$list.url}">{$list.name}</a></li> 
                {/foreach}
        </ul>
        <ul class="pull-right">
            {if $arg.login eq '0'}
                <li><a href="./cus/?site=login"><i class="fa fa-user"></i>
                        Đăng nhập</a></li>
                <li><a href="./cus/?site=register"><i class="fa fa-user"></i>
                        Đăng ký</a></li> {else}
                <li class="pull-right"><a href="./cus/?site=logout"><i
                            class="fa fa-user"></i> Đăng Xuất</a></li>
                <li class="pull-right"><a href="./cus/?site=detail"><i
                            class="fa fa-registered"></i> {$arg.user.name}</a></li> {/if}
            </ul>
            <div class="clear"></div>
        </div>
    </div>

    <div class="container">
        <div class="header">

            <div class="col-md-3 col-sm-3 col-xs-12 col-df">
                <div class="logo">
                    <a href=""><img src="{$output.logo}"> Máy tính đông tây</a>
                </div>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12 col-df">
                <div class="col-md-7 col-sm-7 col-xs-12">

                    <form action="./search/" method="get" id="search-form">
                        <input type="text" name="skey" class="form-control" placeholder="Tìm kiếm">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>

                </div>
                <div class="col-md-5 col-sm-5 col-xs-12 col-df hide-mobile">

                    <div class="col-md-12 col-sm-12 col-xs-12 col-df nav_header">
                        <div class="item_hd bg_a1aaaf">
                            {$output.info_footer.phone} <i class="fa fa-phone fa-2x"></i>
                            <p>Monday - satusday: 8am</p>
                        </div>
                        <ul class="phone">
                            <li class="bg_e84c3d">
                                <a href="./so-sanh/" id="compareItem">
                                    <i class="fa fa-files-o"></i> <span>{$arg.number_compare} item</span>
                                </a>
                            </li>
                            <li class="bg_3598db">
                                <a href="./yeu-thich/">
                                    <i class="fa fa-heart-o"></i> <span>{$arg.number_like} item</span>
                                </a>
                            </li>
                            <li class="bg_f5791f">
                                <a href="./gio-hang/">
                                    <i class="fa fa-cart-plus"></i> <span>{$arg.number_cart} item</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>