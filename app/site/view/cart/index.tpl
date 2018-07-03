<div class="sidebar_title bg_34495e">
    <h3>Quản lý giỏ hàng</h3>
</div>

<div class="row  mar-top">
    <div class="col-md-8 col-sm-8 col-xs-12" style="">
        <div class="bg_white pad-15">
        {if $cart.products|@count gt 0}
            <h2>Sản phẩm </h2>
            <div class="table-responsive ">
                <table class="table">
                    <tr class="th">
                        <td>TT</td>
                        <td>Ảnh sản phẩm</td>
                        <td>Tên sản phẩm</td>

                        <td>Giá</td>
                        <td>Số lượng</td>
                        <td>Thành tiền</td>
                        <td>Xử lý</td>
                    </tr>
                    {foreach from=$cart.products key=k item=list}
                        <tr>
                            <td>{$k+1}</td>
                            <td><img src="{base_url($list.image_path)}/{$list.image_name}" width="60" height="60"></td>
                            <td class="name">{$list.name}</td>

                            <td class="price">
                            {if $list.is_discount eq 1}
                                {$list.price_sale|number_format}đ
                            {else}
                                 {$list.price|number_format}đ
                            {/if}
                            </td>
                            <td>
                            	<input type="number" min="0" step="1" class="number" value="{$list.number_count}" onchange="updateCart(this.value, {$list.id});" />
                            </td>
                            <td class="price">
                            {if $list.is_discount eq 1}
                                {($list.price_sale*$list.number_count)|number_format}đ
                            {else}
                                {($list.price*$list.number_count)|number_format}đ
                            {/if}
                            </td>
                            <td><a href="javascript:void(0);"
                                   onclick="delateItemCart({$list.id});"><i
                                        class="fa fa-trash-o fa-2x"></i></a></td>
                        </tr>
                    {/foreach}

                </table>
            </div>
        {/if}

            <br>
        {if $cart.services|@count gt 0}
            <h2>Dịch vụ </h2>
            <div class="table-responsive">
                <table class="table">
                    <tr class="th">
                        <td>TT</td>
                        <td>Dịch vụ</td>
                        <td>Giá</td>
                        <td>Số lượng</td>
                        <td>Thành tiền</td>
                        <td>Xử lý</td>
                    </tr>
                    {foreach from=$cart.services key=k item=list}
                        <tr>
                            <td>{$k+1}</td>
                            <td class="name">{$list.name}</td>

                            <td class="price">
                                 {$list.price|number_format}đ
                            </td>
                            <td>
                            	<input type="number" min="0" step="1" class="number" value="{$list.number_count}" onchange="updateService(this.value, {$list.id});" />
                            </td>
                            <td class="price">
                                {($list.price*$list.number_count)|number_format}đ
                            </td>
                            <td><a href="javascript:void(0);"
                                   onclick="deleteService({$list.id});"><i
                                        class="fa fa-trash-o fa-2x"></i></a></td>
                        </tr>
                    {/foreach}

                </table>
            </div>
        {/if}
        </div>
    </div>

    <div class="col-md-4 col-sm-4 col-xs-12 ">
        <div class="pad-15 bg_f4f4f4">
            <div class="num-money pad-15">
                <p>
                    Tổng tiền: <strong
                        style="color: red;">{$total|number_format}đ</strong>
                </p>
            </div>
            <div class="update-cart">
                <a href="?mod=product&site=index" class="btn btn-primary">Tiếp
                    tục mua hàng</a>
                <a href="#" onclick="DeleteAll()"
                   class="btn btn-primary pull-right">Xóa hết</a>
                <a href="./?mc=cart&site=payment" class="btn btn-primary pull-right">Thanh toán đơn hàng</a>
                <div class="clear"></div>
            </div>
        </div>
    </div>

</div>





<script src="{$arg.stylesheet}js/cart.js"></script>