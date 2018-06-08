<div class="remove-container-js container">
    <div class="col-md-9 col-sm-9 col-default">
        {include file="includes/breadcrumbs.tpl"}
        <div class="row"></div>

        <div class="brand-baner">
            <div class="pos-logo"><a href="{$result.link}" title="{$result.name}"><img src="{$result.logo}" class="img-logo" /></a></div>
            <div class="slogan">
                <div class="col-md-3"></div>
                <div class="col-md-9"> <h3>{$result.address}</h3></div>
            </div>
            <div class="name-brand" data-color="#4D6087"> {$result.name} </div>
            <div class="old">
                <div class="col-md-3"> </div>
                <div class="col-md-9 pad-left-30">{$result.description}</div>
            </div>
        </div>

        <div class="full-content">
            <div id="prod-category">
                <div id="prod-cate-content">
                    <h2>Faschoi.com</h2>
                    <ul>
                        {foreach from=$categories item=data}
                            <li><a href="{$data.link}" title="{$data.name}"><i class="fa fa-caret-right"></i> {$data.name}</a>
                            {if $data.categories ne NULL}
                                <ul>
                                    {foreach from=$data.categories item=sub}
                                    <li><a href="{$sub.link}" title="{$sub.name}"><i class="fa fa-caret-right"></i> {$sub.name}</a></li>
                                    {/foreach}
                                </ul>
                            {/if}
                            </li>
                        {/foreach}
                    </ul>
                </div>
            </div>
            <div id="prod-content">
                <div class="category full-content">
                    {foreach from=$products key =k item=list}
                        <div class="col-md-4 col-sm-4 col-xs-6 col-default itm">
                            <div class="items">
                                <div class="img">
                                    <a href="javacsript:void(0);" title="{$list.name}"><img src="{$list.img}"></a>
                                </div>
                                <div class="name-price">
                                    <p class="name">
                                        <a href="javacsript:void(0);" title="{$list.name}">{$list.name}</a>
                                    </p>
                                    <p class="price">{$list.price}</p>
                                </div>
                                <div class="btn-test">
                                    <a href="{$list.link}" class="btn btn-tocart" title="{$list.name}">{$arg.trans.detail}</a>
                                    <button type="button" class="btn btn-test-prod" onclick="DisplayProduct({$list.id});">{$arg.trans.wearing}</button>
                                </div>
                            </div>
                        </div>
                    {/foreach}

                    <div class="full-content">{$paging.paging}</div>
                </div>
            </div>
        </div>

        <!--end .content-->
    </div>

    {include file="includes/appsize.tpl"}

</div>