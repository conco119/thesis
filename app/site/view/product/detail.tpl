<div class="detail-product" id="product{$value.id}">
    <div class="col-md-5 col-sm-5 col-xs-12 mar-top">
        <ul id="etalage">
            <li>
                <img class="etalage_thumb_image" src="{base_url($value.images[0].path)}/{$value.images[0].name}" width="90%">
                <img class="etalage_source_image target" src="{base_url($value.images[0].path)}/{$value.images[0].name}" width="90%">
            </li>

            {if $value.images neq ""}
                {foreach from=$value.images key=k item=list}
                {if $k  neq 0}
                    <li>
                        <img class="etalage_thumb_image" src="{base_url($list.path)}/{$list.name}" width="100%">
                        <img class="etalage_source_image target" src="{base_url($list.path)}/{$list.name}" width="100%">
                    </li>
                {/if}
                {/foreach}
            {/if}
        </ul>
        <img class="block-mobile" src="{base_url($value.images[0].path)}/{$value.images[0].name}" width="100%" >
    </div>
    <div class="col-md-7 col-sm-7 col-xs-12">
        <div class="info_prd_detail">
            <h1 class="name">{$value.name}</h1>
            <p class="by"><i class="fa fa-barcode"></i> Mã Sản phẩm: <b>{$value.code}</b></p>
            <p><i class="fa fa-trophy"></i> Nhãn Hiệu: <b>{$value.trademark_name}</b></p>
            <div class="box">
                <div class="show-small-info">
                    <ul>
                        {* <li><i class="fa fa-clock-o"></i> Cập nhật lúc {$value.updated} </li> *}
                        <li><i class="fa fa-eye"></i> <b>Lượt xem</b> {$value.views}</li>
                    </ul>
                </div>
                <div class="show-small-info">
                    <p><i class="fa fa-tags"></i> {$value.category_name}</p>
                </div>
                <div class="show-small-info">
                     <p><i class="fa fa-folder-open"></i> Tình trạng:
                        <b>
                        {if $value.imported-$value.exported  gt 0}
                            <span style='color:green'> Còn hàng </span>
                        {else}
                            <span style='color:red'>  Liên hệ  </span>
                        {/if}
                        </b>
                    </p>
                </div>
                <div class="show-small-info">
                    <div class="star-big" id="Star{$value.id}">
                        {for $index=1 to 5}
                            {if $value.number_user_rate neq 0}
                                {if (($value.total_rate/$value.number_user_rate)|round) - $index gte 0}
                                    <i class="fa fa-star checked" onclick="SetStarProduct({$value.id}, {$index});"></i>
                                {else}
                                    <i class="fa fa-star" onclick="SetStarProduct({$value.id}, {$index});"></i>
                                {/if}
                            {else}
                                    <i class="fa fa-star" onclick="SetStarProduct({$value.id}, {$index});"></i>
                            {/if}
                        {/for}

                        <span>{$value.number_user_rate} đánh giá -
                            {if $value.number_user_rate neq 0}
                                {($value.total_rate/$value.number_user_rate)|round}
                            {else}
                                0
                            {/if}
                        điểm</span>
                    </div>
                </div>
            </div>

            <div class="price">
                <p>
                <label>Giá bán:</label>
                    {if $value.is_discount eq 1}
                        {$value.sale_price}đ
                        <span>{$value.price}đ </span>
                    {else}
                        {$value.price}đ
                    {/if}
                </p>
            </div>
            <div class="show-small-info">
                <p>Bảo hành:  <b style='color:red'> {$value.warranty} tháng </b></p>
            </div>


            <div class="addcart">
               {* Số Lượng: <input type="number" width="30" value="1" id="CartNumber{$value.id}"/>    *}
               <button onclick="addToCart({$value.id});"><i class="fa fa-opencart" ></i> Đặt Mua Ngay</button>
            </div>

            <div class="support-detail">
                <label>Tel: {$info.info.phone}</label>

                {* <ul class="help-payal">
                    {foreach from=$output.menu_p4 item=list}
                        {foreach from=$list.child_menu key = k item=child}
                            <li><a href="{$child.link}">{$k+1}:  {$child.name}</a></li>
                        {/foreach}
                    {/foreach}
                </ul> *}
            </div>


            <!--<div class="pro-show-btn mar-top mar-btm">
                <button class="btn-like-big" type="button" onclick="likeProduct({$value.id});"><i class="fa fa-heart-o"></i> Yêu thích </button>
                <button type="button" class="btn-compare-big" onclick="compareProduct({$value.id}, {$value.category_id});"><i class="fa fa-files-o"></i> So sánh</button>
            </div>
            -->

        </div>
    </div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 col-df">
    <div class="btn_tab_event">
        <a href="javascript:void(0)" class="active" tab="tab0">Mô tả sản phẩm</a>
        <div class="tab_cont block bg_white" id="tab0">
             {$value.content}
        </div>
    </div>
    <br /><br />
</div>



<div class="sidebar_title full bg_34495e">
    <h3> Sản phẩm liên quan</h3>
</div>

<div class="row">
    {foreach from=$relate_product item=list}
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="product_item">
                <div class="img">
                    <a href="./?mc=product&site=detail&n={$list.link_name}">
                        <img src="{base_url($list.image_path)}/{$list.image_name}" width="100%">
                    </a>
                </div>
                <div class="name">
                    <a href="{$list.link}">{$list.name}</a>
                </div>
                <div class="price">
                    {if $list.is_discount eq 1}
                        {$list.sale_price}đ
                        <span>{$list.price}đ </span>
                    {else}
                        {$list.price}đ
                    {/if}
                </div>
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
                        <button type="button" class="btn_prd cart" onclick="addToCart({$list.id});">
                            <i class="fa fa-opencart"></i> Thêm vào giỏ hàng
                        </button>
                    </div>
                </div>
            </div>
        </div>
    {/foreach}
</div>
<br />

<script src="{$arg.stylesheet}js/cart.js"></script>
<script src="{$arg.stylesheet}js/hoverZoomjquery.etalage.min.js"></script>
{literal}
    <script type="text/javascript">
        $('#etalage').etalage({
            thumb_image_height: 300
        });

    </script>
{/literal}
