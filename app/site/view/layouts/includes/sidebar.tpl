<div class="sidebar_title bg_34495e">
    <h3><i class="fa fa-tasks"></i> Danh Mục</h3>
</div>
<div class="category bg_white mar-btm">
    <ul>
        {foreach from=$menu item=list}
            <li><a href="./?mc=category&n={$list.menu_link}"> {$list.name} {if $list.child_menu neq NULL}<i class="fa fa-caret-right"></i>{/if}</a>
                {if $list.child_menu neq NULL}
                    <ul>
                        {foreach from=$list.child_menu item=subList}
                            <li><a href="./?mc=category&n={$subList.menu_link}">{$subList.name}</a></li>
                        {/foreach}
                    </ul>
                {/if}
            </li>
        {/foreach}
    </ul>
</div>

<br>

<div class="bestseller bg_white mar-btm">
    <div class="sidebar_title bg_e84c3d">
        <h3><i class="fa fa-tasks"></i> Bán chạy nhất</h3>
    </div>
    <ul>
        {foreach from=$best_seller item=list}
            <li>
                <div class="col-md-4 col-sm-4 col-xs-12 col-df text-center">
                    <a href="./?mc=product&site=detail&n={$list.link_name}" title="{$list.name}"><img src="{base_url($list.image_path)}/{$list.image_name}" width="100%;"></a>
                </div>
                <div class="col-md-8 col-sm-8 col-xs-12 col-df">
                    <div class="info_prd">
                        <a href="./?mc=product&site=detail&n={$list.link_name}" title="{$list.name}">{$list.name}</a>
                    </div>
                    <div class="price">
                        {if $list.is_discount eq 1}
                            {$list.sale_price}đ
                            <span>{$list.price}đ </span>
                        {else}
                            {$list.price}đ
                        {/if}
                    </div>
                </div>
            </li>
        {/foreach}

    </ul>
    <div class="clear"></div>
</div>


<div class="bestseller bg_white mar-btm">
    <div class="sidebar_title bg_e84c3d">
        <h3><i class="fa fa-tasks"></i> Sản phẩm khuyến mãi</h3>
    </div>
    <ul>
        {foreach from=$sale_products item=list}
            <li>
                <div class="col-md-4 col-sm-4 col-xs-12 col-df text-center">
                    <a href="./?mc=product&site=detail&n={$list.link_name}" title="{$list.name}"><img src="{base_url($list.image_path)}/{$list.image_name}" width="100%;"></a>
                </div>
                <div class="col-md-8 col-sm-8 col-xs-12 col-df">
                    <div class="info_prd">
                        <a href="./?mc=product&site=detail&n={$list.link_name}" title="{$list.name}">{$list.name}</a>
                    </div>
                    <div class="price">
                        {if $list.is_discount eq 1}
                            {$list.sale_price}đ
                            <span>{$list.price}đ </span>
                        {else}
                            {$list.price}đ
                        {/if}
                    </div>
                </div>
            </li>
        {/foreach}
    </ul>

    <div class="clear"></div>
</div>

{* <div class="slider bg_white mar-btm">
    <ul class="sidebar_slider">
        {foreach from=$output.gallery_p6 item=list}
            <li><a href="{$list.link}" title="{$list.name}"><img src="{$list.img}" width="100%;"></a></li>
                {/foreach}
    </ul>
</div> *}


