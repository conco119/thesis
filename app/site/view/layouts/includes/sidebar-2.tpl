<div class="sidebar_title bg_34495e">
    <h3><i class="fa fa-tasks"></i> Danh Mục</h3>
</div>
<div class="category bg_white mar-btm">
    <ul>
        {foreach from=$output.article_category item=list} 
        <li><a href="{$list.link}"> {$list.name} {if $list.sub neq NULL}<i class="fa fa-caret-right"></i>{/if}</a>
            {if $list.sub neq NULL}
                <ul>
                    {foreach from=$list.sub item=subList}
                        <li><a href="{$subList.link}">{$subList.name}</a></li>
                    {/foreach}
                </ul>
            {/if}
        </li>
        {/foreach}
    </ul>
</div>

<div class="sidebar_title bg_e84c3d">
    <h3><i class="fa fa-tasks"></i> So sảnh sản phẩm</h3>
</div>
<div class="compare_product bg_white mar-btm">
    <ul>
    	{foreach from=$output.compare_product item=data}
        <li id="compare{$data.id}">
            <div class="img">
                <img src="{$data.avatar}">
            </div>

            <div class="prd_compare">
                <a href="{$data.url}" title="{$data.name}">{$data.name}</a>
            </div>

            <i class="fa fa-times close" onclick="removeCompareProduct({$data.id});"></i>
        </li>
        {/foreach}
    </ul>
    <div class="clear"></div>
</div>

<div class="slider bg_white mar-btm">
    <ul class="sidebar_slider">
        {foreach from=$output.gallery_p6 item=list}
        <li><a href="{$list.link}" title="{$list.name}"><img src="{$list.img}" width="100%;"></a></li>
        {/foreach}
    </ul>
</div>
<br>

<div class="bestseller bg_white mar-btm">
    <div class="sidebar_title bg_e84c3d">
        <h3><i class="fa fa-tasks"></i> Bán chạy nhất</h3>
    </div>
    <ul>
        {foreach from=$output.product_highlight item=list}
        <li>
            <div class="col-md-4 col-sm-4 col-xs-12 col-df text-center">
                <a href="{$list.link}" title="{$list.name}"><img src="{$list.img}" width="100%;"></a>
            </div>
            <div class="col-md-8 col-sm-8 col-xs-12 col-df">
                <div class="info_prd">
                    <a href="{$list.link}" title="{$list.name}">{$list.name}</a>
                </div>
                <div class="price">{$list.price_sale}</div>
            </div>
        </li>
        {/foreach}
        
    </ul>
    <div class="clear"></div>
</div>

