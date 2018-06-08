<div class="sidebar_title bg_34495e">
    <h1>{$category.name}</h1>
</div>

<div class="row">

    {foreach from=$products item=list}
    <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="product_item">
            <div class="img">
               <a href="?mc=product&site=detail&n={$list.link_name}"><img src="{$arg.product_folder_link}/{$list.image_name}" width="100%"></a>
            </div>
            <div class="name">
                <a href="?mc=product&site=detail&n={$list.link_name}">{$list.name}</a>
            </div>
            <p class="price">
                {$list.price}đ
                {if $list.is_discount eq 1}
                        <span>{$list.sale_price}đ </span>
                {/if}
            </p>
            <div class="num_star" id="Star{$list.id}">
            	 <i class="fa fa-star" onclick="SetStarProduct(32, 1);"></i>
                  <i class="fa fa-star" onclick="SetStarProduct(32, 1);"></i>
            	<span>{$list.number_point} x đánh giá - {$list.avg_point} x điểm</span>
            </div>
            <div class="btn_function">
                <div class="col-md-12 col-sm-12 col-xs-12 col-df">
                    <button type="button" class="btn_prd cart" title="Thêm vào giỏ hàng" onclick="addToCart({$list.id});"><i class="fa fa-opencart"></i> Thêm vào giỏ hàng </button>
                </div>
            </div>
        </div>
    </div>
    {/foreach}

    <div class="clear"></div>
</div>

<div class="mar-top">
    <ul class="paging">
        {$paging.paging}
    </ul>
</div>

<script src="{$arg.stylesheet}js/cart.js"></script>
