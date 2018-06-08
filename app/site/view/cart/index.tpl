<div class="sidebar_title bg_34495e">
    <h3>Quản lý giỏ hàng</h3>
</div>

<div class="row  mar-top">
    <div class="col-md-8 col-sm-8 col-xs-12" style="">
        <div class="bg_white pad-15">
            <div class="table-responsive">
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
                    {foreach from=$result key=k item=list}
                        <tr>
                            <td>{$k+1}</td>
                            <td><img src="{$list.img}" width="60" height="60"></td>
                            <td class="name">{$list.name}</td>

                            <td class="price">{$list.price}</td>
                            <td>
                            	<input type="number" min="0" step="1" class="number" value="{$list.number}" onchange="updateCart(this.value, {$list.id});" />
                            </td>
                            <td class="price">{$list.sum}</td>
                            <td><a href="javascript:void(0);"
                                   onclick="delateItemCart({$list.id});"><i
                                        class="fa fa-trash-o fa-2x"></i></a></td>
                        </tr>
                    {/foreach}

                </table>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-sm-4 col-xs-12 ">
        <div class="pad-15 bg_f4f4f4">
            <div class="num-money pad-15">
                <p>
                    Tổng tiền (<span>* Đã bao gồm VAT</span>): <strong
                        style="color: red;">{$sum_cart}</strong>
                </p>
            </div>
            <div class="update-cart">
                <a href="?mod=product&site=index" class="btn btn-primary">Tiếp
                    tục mua hàng</a> 
                <a href="javascript:void(0)" id="delete_cart"
                   class="btn btn-primary pull-right">Xóa hết</a> 
                <a href="?mod=cart&site=payment" class="btn btn-primary pull-right">Thanh toán đơn hàng</a>
                <div class="clear"></div>
            </div>
        </div>
    </div>

</div>





<script src="{$arg.stylesheet}js/cart.js"></script>