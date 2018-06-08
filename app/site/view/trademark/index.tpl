<div class="remove-container-js container">
    {include file="../layouts/includes/breadcrumbs.tpl"}
    <div class="full-content">

        <div class="brand full-content">
            {foreach from=$result item=data}
                <div class="item-shop">
                    <img class="full" src="{$data.banner}">
                    <a href="{$data.link}"><img class="logo-shop" src="{$data.logo}"></a>
                </div>
            {/foreach}
        </div>

    </div>
</div>
