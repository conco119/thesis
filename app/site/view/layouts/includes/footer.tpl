<div class="row col-df footer">
    <div class="container-fluid">
        <div class="col-md-3 col-sm-3 col-xs-12">
            <h3>Thông tin liên hệ</h3>

            <ul class="full">
                <li>{$info.info.name}</li>
                <li>{$info.info.address}</li>
                <li>Call {$info.info.phone}</li>
                <li>{$info.info.email}</li>
            </ul>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-12">
            {* <h3>Quy định - Chính sách</h3> *}

            {* <ul class="full">
                {foreach from=$output.menu_footer item=list}
                    <li><a href="{$list.url}">{$list.name}</a></li>
                {/foreach}
            </ul> *}
        </div>
        {* {foreach from=$output.menu_p3 item=list}
        <div class="col-md-3 col-sm-3 col-xs-12">
            <h3> {$list.name} </h3>
            <ul class="full">
                {foreach from=$list.child_menu item=child}
                    <li><a href="{$child.url}">{$child.name}</a></li>
                {/foreach}
            </ul>
        </div>
        {/foreach}
 *}
        <div class="col-md-3 col-sm-3 col-xs-12">
            <h3>Kết nối</h3>

            <ul class="full connect_footer">
                <li class="bg_3a599f">
                    <a href="{$arg.social.facebook}" target="_blank">
                        <div class="fb_icon"><i class="fa fa-facebook"></i></div>
                    </a>
                </li>

                <li class="bg_3096f1">
                    <a href="{$arg.social.twitter}" target="_blank">
                        <div class="fb_icon"><i class="fa fa-twitter"></i></div>
                    </a>
                </li>

                 <li class="bg_dd4e42">
                    <a href="{$arg.social.google}" target="_blank">
                        <div class="fb_icon"><i class="fa fa-google-plus"></i></div>
                    </a>
                </li>

                <li class="bg_f2802c">
                    <a href="{$arg.social.youtube}" target="_blank">
                        <div class="fb_icon"><i class="fa fa-youtube"></i></div>
                    </a>
                </li>

            </ul>

            <div class="mail_cont">
                <div class="form-group">
                    <input type="text" class="form-control" id="usr" placeholder="Email">
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-success">Subscribe</button>
                </div>
            </div>

        </div>
    </div>
</div>

{literal}
<script type="text/javascript">
(function(d,s,id){var z=d.createElement(s);z.type="text/javascript";z.id=id;z.async=true;z.src="//static.zotabox.com/7/e/7e6bd0dde9d6ef8fce0be070a1b9d6c5/widgets.js";var sz=d.getElementsByTagName(s)[0];sz.parentNode.insertBefore(z,sz)}(document,"script","zb-embed-code"));
</script>
{/literal}