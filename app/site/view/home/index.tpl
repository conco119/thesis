{if $output.slider neq NULL}
    <div class="img_cate_bg mar-btm">
        <ul class="bxslider">
            {foreach from=$output.slider item=list}
                <li><img src="{$list.img}"></li>
            {/foreach}
        </ul>

    </div>
{/if}

{foreach from=$category item=parent}
    <div class="sidebar_title bg_34495e mar-btn-20">
        <h1>{$parent.name}</h1>
    </div>
    <div class="row">
        {if $parent.sub neq NULL}
            <ul class="prod-slider">
                {foreach from=$parent.sub item=list}
                    <li>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="product_item">
                                <div class="img">
                                    <a href="{$list.link}">
                                        <img src="{$list.img}" width="100%">
                                    </a>
                                </div>
                                <div class="name">
                                    <a href="{$list.link}">{$list.name}</a>
                                </div>
                                <p class="price">{$list.price}</p>

                                <div class="num_star" id="Star{$list.id}">
                                    {$list.stars}
                                    <span>{$list.number_point} đánh giá - {$list.avg_point} điểm</span>
                                </div>
                                <div class="btn_function">
                                    <div class="col-md-8 col-sm-8 col-xs-8 col-df">
                                        <button type="button" class="btn_prd cart" title="Thêm vào giỏ hàng"
                                                onclick="addToCart({$list.id});"><i class="fa fa-opencart"></i> Thêm vào
                                            giỏ hàng
                                        </button>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-2 col-df">
                                        <button type="button" class="btn_prd like" title="Yêu thích sản phẩm"
                                                onclick="likeProduct({$list.id});"><i class="fa fa-heart-o"></i>
                                        </button>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-2 col-df">
                                        <button class="btn_prd btn-compare" title="Thêm vào so sánh"
                                                onclick="compareProduct({$list.id}, {$list.category_id});"><i
                                                    class="fa fa-files-o"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                {/foreach}
            </ul>
        {/if}
        <div class="clear"></div>
    </div>
{/foreach}

<div class="trademark full">
    <div class="sidebar_title bg_34495e">
        <h3>thương hiệu sản phẩm</h3>
    </div>

    <ul class="trade_slider">
        {foreach from=$trademark item=list}
            <li><a href="#"><img src="{$list.logo}"></a></li>
        {/foreach}
    </ul>

</div>

<script src="{$arg.stylesheet}js/cart.js"></script>
