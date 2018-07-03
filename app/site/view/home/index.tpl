{if $random_product neq NULL}
    <div class="img_cate_bg mar-btm">
        <ul class="bxslider">
            {foreach from=$random_product item=list}
                <li><img src="{base_url($list.image_path)}/{$list.image_name}"></li>
            {/foreach}
        </ul>
    </div>
{/if}

<div class="sidebar_title bg_34495e mar-btn-20">
    <h1>Đèn thông minh</h1>
</div>
<div class="row">
        <ul class="prod-slider">
            {foreach from=$smart_light item=list}
                <li>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="product_item">
                            <div class="img">
                                <a href="./?mc=product&site=detail&n={$list.link_name}">
                                    <img src="{base_url($list.image_path)}/{$list.image_name}" width="100%">
                                </a>
                            </div>
                            <div class="name">
                                <a href="./?mc=product&site=detail&n={$list.link_name}">{$list.name}</a>
                            </div>
                            <p class="price">
                                {if $list.is_discount eq 1}
                                    {$list.sale_price}đ
                                    <span>{$list.price}đ </span>
                                {else}
                                    {$list.price}đ
                                {/if}
                            </p>

                            <div class="num_star" id="Star{$list.id}">
                                {for $index=1 to 5}
                                    {if $list.number_user_rate neq 0}
                                        {if (($list.total_rate/$list.number_user_rate)|round) - $index gte 0}
                                            <i class="fa fa-star checked" onclick="SetStarProduct({$list.id}, {$index});"></i>
                                        {else}
                                            <i class="fa fa-star" onclick="SetStarProduct({$list.id}, {$index});"></i>
                                        {/if}
                                    {else}
                                            <i class="fa fa-star" onclick="SetStarProduct({$list.id}, {$index});"></i>
                                    {/if}
                                {/for}

                                <span>{$list.number_user_rate} đánh giá -
                                    {if $list.number_user_rate neq 0}
                                        {($list.total_rate/$list.number_user_rate)|round}
                                    {else}
                                        0
                                    {/if}
                                điểm</span>
                            </div>
                            <div class="btn_function">
                                <div class="col-md-12 col-sm-12 col-xs-12 col-df">
                                    <button type="button" class="btn_prd cart" title="Thêm vào giỏ hàng"
                                            onclick="addToCart({$list.id});"><i class="fa fa-opencart"></i> Thêm vào
                                        giỏ hàng
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            {/foreach}
        </ul>
    <div class="clear"></div>
</div>

<div class="sidebar_title bg_34495e mar-btn-20">
    <h1>Ổ cắm thông minh</h1>
</div>
<div class="row">
        <ul class="prod-slider">
            {foreach from=$plugin item=list}
                <li>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="product_item">
                            <div class="img">
                                <a href="./?mc=product&site=detail&n={$list.link_name}">
                                    <img src="{base_url($list.image_path)}/{$list.image_name}" width="100%">
                                </a>
                            </div>
                            <div class="name">
                                <a href="{$list.link}">{$list.name}</a>
                            </div>
                            <p class="price">
                                {if $list.is_discount eq 1}
                                    {$list.sale_price}đ
                                    <span>{$list.price}đ </span>
                                {else}
                                    {$list.price}đ
                                {/if}
                            </p>

                            <div class="num_star" id="Star{$list.id}">
                                {for $index=1 to 5}
                                    {if $list.number_user_rate neq 0}
                                        {if (($list.total_rate/$list.number_user_rate)|round) - $index gte 0}
                                            <i class="fa fa-star checked" onclick="SetStarProduct({$list.id}, {$index});"></i>
                                        {else}
                                            <i class="fa fa-star" onclick="SetStarProduct({$list.id}, {$index});"></i>
                                        {/if}
                                    {else}
                                            <i class="fa fa-star" onclick="SetStarProduct({$list.id}, {$index});"></i>
                                    {/if}
                                {/for}

                                <span>{$list.number_user_rate} đánh giá -
                                    {if $list.number_user_rate neq 0}
                                        {($list.total_rate/$list.number_user_rate)|round}
                                    {else}
                                        0
                                    {/if}
                                điểm</span>
                            </div>
                            <div class="btn_function">
                                <div class="col-md-12 col-sm-12 col-xs-12 col-df">
                                    <button type="button" class="btn_prd cart" title="Thêm vào giỏ hàng"
                                            onclick="addToCart({$list.id});"><i class="fa fa-opencart"></i> Thêm vào
                                        giỏ hàng
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            {/foreach}
        </ul>
    <div class="clear"></div>
</div>

<div class="sidebar_title bg_34495e mar-btn-20">
    <h1>Thiết bị an ninh</h1>
</div>
<div class="row">
        <ul class="prod-slider">
            {foreach from=$security item=list}
                <li>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="product_item">
                            <div class="img">
                                <a href="./?mc=product&site=detail&n={$list.link_name}">
                                    <img src="{base_url($list.image_path)}/{$list.image_name}" width="100%">
                                </a>
                            </div>
                            <div class="name">
                                <a href="{$list.link}">{$list.name}</a>
                            </div>
                            <p class="price">
                                {if $list.is_discount eq 1}
                                    {$list.sale_price}đ
                                    <span>{$list.price}đ </span>
                                {else}
                                    {$list.price}đ
                                {/if}
                            </p>

                            <div class="num_star" id="Star{$list.id}">
                                {for $index=1 to 5}
                                    {if $list.number_user_rate neq 0}
                                        {if (($list.total_rate/$list.number_user_rate)|round) - $index gte 0}
                                            <i class="fa fa-star checked" onclick="SetStarProduct({$list.id}, {$index});"></i>
                                        {else}
                                            <i class="fa fa-star" onclick="SetStarProduct({$list.id}, {$index});"></i>
                                        {/if}
                                    {else}
                                            <i class="fa fa-star" onclick="SetStarProduct({$list.id}, {$index});"></i>
                                    {/if}
                                {/for}

                                <span>{$list.number_user_rate} đánh giá -
                                    {if $list.number_user_rate neq 0}
                                        {($list.total_rate/$list.number_user_rate)|round}
                                    {else}
                                        0
                                    {/if}
                                điểm</span>
                            </div>
                            <div class="btn_function">
                                <div class="col-md-12 col-sm-12 col-xs-12 col-df">
                                    <button type="button" class="btn_prd cart" title="Thêm vào giỏ hàng"
                                            onclick="addToCart({$list.id});"><i class="fa fa-opencart"></i> Thêm vào
                                        giỏ hàng
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            {/foreach}
        </ul>
    <div class="clear"></div>
</div>

<script src="{$arg.stylesheet}js/cart.js"></script>
