<div class="sidebar_title bg_34495e">
    <h3>Thanh toán đơn hàng</h3>
</div>
<div class="row bg_white col-df">
    <form class="form" role="form" method="POST" action="?mc=cart&site=order" id="validate">
        <div class="col-md-7 col-sm-7 col-xs-12" id="payment_form">
            <h3>Nhập thông tin đơn hàng</h3>

            <div class="form-group">
                <label for="cus_name">Họ tên <span style='color:red'>*</span></label>
                <input type="text" class="form-control required"  name="cus_name" value="{$arg.user.name}">
            </div>

            <div class="form-group">
                <label for="cus_name">Điện thoại <span style='color:red'>*</span></label>
                <input type="text" class="form-control required"  name="cus_phone" value="{$arg.user.phone}">
            </div>

            <div class="form-group">
                <label for="pwd">Email liên hệ <span style='color:red'>*</span></label>
                <input type="text" class="form-control required email"   name="cus_email" id="email" value="{$arg.user.email}">
            </div>

            <div class="form-group">
                <label for="pwd">Địa chỉ nhận hàng <span style='color:red'>*</span></label>
                <input type="text" class="form-control required"  name="cus_address" placeholder="Tên Phố"  value="{$arg.user.address}">
            </div>

            <div class="form-group">
                <h3 class="title">Thông tin thêm</h3>
                <textarea class="form-control" rows="5" name="content" placeholder="Ghi chú về đơn hàng, ví dụ: Lưu ý khi giao hàng"></textarea>
            </div>

        </div>

        <div class="col-md-5 col-sm-5 col-xs-12" id="order">
            <div class="order_info">
                <h3 class="title">Đơn hàng của bạn</h3>

                <ul>
                    <li class="line bor-bottom">
                        <div><b>SẢN PHẨM</b></div>
                        <div><b>TỔNG</b></div>
                    </li>

                    {foreach from=$cart.products item=list}
                        <li class="line bor-bottom itm_order">
                            <div>
                                <a href="javascript:void(0)"> {$list.name} <span>x{$list.number_count}</span></a>
                            </div>

                            <div class="price">
                                <p>
                                    {if $list.is_discount eq 1}
                                        {($list.price_sale*$list.number_count)|number_format}đ
                                    {else}
                                        {($list.price*$list.number_count)|number_format}đ
                                    {/if}
                                </p>
                            </div>
                        </li>
                    {/foreach}

                    <br>
                    <li class="line bor-bottom">
                        <div><b>DỊCH VỤ</b></div>
                        <div><b>TỔNG</b></div>
                    </li>

                    {foreach from=$cart.services item=list}
                        <li class="line bor-bottom itm_order">
                            <div>
                                <a href="javascript:void(0)"> {$list.name} <span>x{$list.number_count}</span></a>
                            </div>

                            <div class="price">
                                <p>
                                    {($list.price*$list.number_count)|number_format}đ
                                </p>
                            </div>
                        </li>
                    {/foreach}




                    <li class="line total">
                        <div>
                            <p>Tổng:</p>
                        </div>
                        <div class="obama-total">
                            <p>{$total|number_format}đ</p>
                        </div>
                    </li>

                </ul>

                <div class="radio">
                    <label><input type="radio" name="type"  value="1">Chuyển khoản ngân hàng</label>
                    <p class="bor-bottom">Chúng tôi sẽ gửi hàng ngay sau khi nhận được thanh toán chuyển khoản của bạn</p>
                    <label><input type="radio" name="type" value="0" checked>Trả tiền mặt khi nhận hàng (COD)</label>
                </div>

                <div class="button-btn text-center mar-top mar-btm">
                    <button class="btn-order bg_34495e" name="FrmSubmit" type="submit">Gửi thông tin đặt hàng</button>
                </div>

            </div>
        </div>
    </form>
</div>
<script src="{$arg.stylesheet}js/validate.js"></script>
<script>
    $("#validate").validate();
</script>