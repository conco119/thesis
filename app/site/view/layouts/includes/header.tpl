<div class="container">
    <div class="top_link bg_white">
        <ul class="pull-left hide-mobile">
        </ul>
        <ul class="pull-right">
            {if $arg.user.id eq 0}
                <li><a href="./?mc=customer&site=login"><i class="fa fa-user"></i>
                        Đăng nhập </a></li>
                <li><a href="./?mc=customer&site=register"><i class="fa fa-register"></i>
                        Đăng ký</a></li>
            {else}
                <li class="pull-right"><a href="./?mc=customer&site=logout"><i
                            class="fa fa-user"></i> Đăng Xuất</a></li>
                <li class="pull-right"><a href="../?mc=customer&site=detail"><i
                            class="fa fa-user"></i> {$arg.user.name}</a></li>
            {/if}
            </ul>
            <div class="clear"></div>
        </div>
    </div>

    <div class="container">
        <div class="header">

            <div class="col-md-3 col-sm-3 col-xs-12 col-df">
                <div class="logo">
                    <a href=""><img src="{$arg.logo_folder_link}/{$info.logo}"> Máy tính đông tây</a>
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
                            Call 12893543 <i class="fa fa-phone fa-2x"></i>
                            <p>Thứ 2 - Thứ 7: 8h đến 18h</p>
                        </div>
                        <ul class="phone">
                            <li class="bg_f5791f">
                                <a href="./?mc=cart">
                                    <i class="fa fa-cart-plus"></i> <span id='cart-number'>{$number_item} sản phẩm</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>