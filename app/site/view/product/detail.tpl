

<div class="detail-product" id="product{$value.id}">
    <div class="col-md-5 col-sm-5 col-xs-12 mar-top">

        <ul id="etalage">
            <li>
                <img class="etalage_thumb_image" src="{$value.avatar}" width="100%">
                <img class="etalage_source_image target" src="{$value.avatar}" width="100%">
            </li>
            {if $images neq ""}
            {foreach from=$images item=list}
                <li>
                    <img class="etalage_thumb_image" src="{$list}" width="100%">
                    <img class="etalage_source_image target" src="{$list}" width="100%">
                </li>
            {/foreach}
            {/if}
        </ul>
        <img class="block-mobile" src="{$value.avatar}" width="100%" >
    </div>
    <div class="col-md-7 col-sm-7 col-xs-12">
        <div class="info_prd_detail">
            <h1 class="name">{$value.name}</h1>
            <p class="by"><i class="fa fa-barcode"></i> Mã Sản phẩm: <b>{$value.code}</b></p>
            {if $value.trademark neq NULL}<p><i class="fa fa-trophy"></i> Nhãn Hiệu: <b>{$value.trademark}</b></p>{/if}
            <div class="box">
                <div class="show-small-info">
                    <ul>
                        <li><i class="fa fa-clock-o"></i> Cập nhật lúc {$value.updated} </li>
                        <li><i class="fa fa-eye"></i> {$value.views} lượt</li>
                        <li><i class="fa fa-heart-o"></i> {$value.likes} lượt</li>
                    </ul>
                </div>
                <div class="show-small-info">
                    <p><i class="fa fa-tags"></i> {$value.category}</p>
                </div>

                <div class="show-small-info">
                    <p id="Star{$value.id}" class="star-big">
                        {$value.stars}
                        <span>{$value.number_point} đánh giá - {$value.avg_point} điểm</span>
                    </p>
                </div>
            </div>

            <div class="price">
                <p><label>Giá bán:</label> {$value.price_sale}</p>
            </div>

            <div class="addcart">
               Số Lượng: <input type="number" width="30" value="1" id="CartNumber{$value.id}"/>   <button onclick="addNumberToCart({$value.id});"><i class="fa fa-opencart" ></i> Đặt Mua Ngay</button>
                <button class="btn-like-big" type="button" onclick="likeProduct({$value.id});"><i class="fa fa-heart-o"></i> Yêu thích </button>
                <button type="button" class="btn-compare-big" onclick="compareProduct({$value.id}, {$value.category_id});"><i class="fa fa-files-o"></i> So sánh</button>
            </div>
            
            <div class="support-detail">
                <label>Tel: {$output.info_footer.phone}</label>
                
                <ul class="help-payal">
                    {foreach from=$output.menu_p4 item=list}
                        {foreach from=$list.child_menu key = k item=child}
                            <li><a href="{$child.link}">{$k+1}:  {$child.name}</a></li>
                        {/foreach}
                    {/foreach}
                </ul>

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
        <a href="javascript:void(0)" class="active" tab="tab0">Thống số kỹ thuật</a>
        <a href="javascript:void(0)" tab="tab1">Mô tả sản phẩm</a>
        <a href="javascript:void(0)" tab="tab2">Đánh giá (0)</a>

        <div class="tab_cont block bg_white" id="tab0">
            {$value.description}
        </div>
        <div class="tab_cont bg_white" id="tab1">
            {$value.content}
        </div>
        <div class="tab_cont bg_white" id="tab2">
            <div class="fb-comments" data-href="{$arg.this_link}" data-numposts="3"  data-width="100%" data-colorscheme="light"></div>	
        </div>
    </div>
    <br /><br />
</div>



<div class="sidebar_title full bg_34495e">
    <h3> Sản phẩm liên quan</h3>
</div>

<div class="row">
    {foreach from=$other item=list}
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="product_item">
                <div class="img">
                    <a href="{$list.link}"><img src="{$list.img}" width="100%"></a>
                </div>
                <div class="name">
                    <a href="{$list.link}">{$list.name}</a>
                </div>
                <div class="price">
                    {$list.price}
                    <p>
                        <span class="old"> </span><span class="aft">  </span>
                    </p>
                </div>
                <div class="num_star full">
                    <span></span> <span></span> <span></span> <span></span> <span></span>
                </div>
                <div class="btn_function">
                    <div class="col-md-8 col-sm-8 col-xs-8 col-df">
                        <button type="button" class="btn_prd cart" onclick="addToCart({$list.id});">
                            <i class="fa fa-opencart"></i> Thêm vào giỏ hàng
                        </button>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-2 col-df">
                        <button class="btn_prd like">
                            <i class="fa fa-heart-o"></i>
                        </button>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-2 col-df">
                        <button class="btn_prd btn-compare">
                            <i class="fa fa-picture-o"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    {/foreach}
</div>
<br />

<script src="{$arg.stylesheet}js/cart.js"></script>
{literal}
    <script type="text/javascript">
        $('#etalage').etalage({
            thumb_image_height: 300
        });

    </script>
{/literal}
