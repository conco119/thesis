<div class="sidebar_title bg_34495e">
    <h3>Thanh toán đơn hàng</h3>
</div>
<div class="row bg_white col-df">
    <form class="form" role="form" method="POST" action="?mod=cart&site=payment" id="validate">
        <div class="col-md-7 col-sm-7 col-xs-12" id="payment_form">
            <h3>Nhập thông tin đơn hàng</h3>

            <div class="form-group">
                <label for="cus_name">Họ tên *</label>
                <input type="text" class="form-control required"  name="cus_name" value="{$customer.name}">
            </div>

            <div class="form-group">
                <label for="cus_name">Điện thoại *</label>
                <input type="text" class="form-control required"  name="cus_phone" value="{$customer.phone}">
            </div>

            <div class="form-group">
                <label for="pwd">Email liên hệ *</label>
                <input type="text" class="form-control required email"   name="cus_email" id="email" value="{$customer.email}">
            </div>

            <div class="form-group">
                <label for="pwd">Địa chỉ nhận hàng *</label>
                <input type="text" class="form-control required"  name="cus_address" placeholder="Tên Phố"  value="{$customer.address}">
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

                    {foreach from=$result item=list}
                        <li class="line bor-bottom itm_order">
                            <div>
                                <a href="javascript:void(0)"> {$list.name} <span>x{$list.number}</span></a>
                            </div>
                            <div class="price">
                                <p>{$list.price}</p>
                            </div>
                        </li>
                    {/foreach}



                    
                    <li class="line total">
                        <div>
                            <p>Tổng:</p>
                        </div>
                        <div class="obama-total">
                            <p>{$sum_cart}</p>
                        </div>
                    </li>

                </ul>

                <div class="radio">
                    <label><input type="radio" name="type" checked="" value="1">Chuyển khoản ngân hàng</label>
                    <p class="bor-bottom">Chúng tôi sẽ gửi hàng ngay sau khi nhận được thanh toán chuyển khoản của bạn</p>
                    <label><input type="radio" name="type" value="0">Trả tiền mặt khi nhận hàng (COD)</label>
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