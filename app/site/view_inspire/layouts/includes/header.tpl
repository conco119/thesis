<header class="header-container">
    <div class="header-top">
        <div class="container">
            <div class="row">
                <!-- Header Language -->
                <div class="col-xs-6">
                </div>
                <div class="col-xs-6">
                    <!-- Header Top Links -->
                    <div class="toplinks">
                        <div class="links">
                            <div class="myaccount"><a title="My Account" href="login.html"><span class="hidden-xs">Tài khoản</span></a></div>
                            {* <div class="wishlist"><a title="My Wishlist" href="wishlist.html"><span class="hidden-xs">Wishlist</span></a></div> *}
                            <div class="check"><a title="Checkout" href="checkout.html"><span class="hidden-xs">Phương thức thanh toán</span></a></div>
                            <div class="phone hidden-xs">1 800 123 1234</div>
                        </div>
                    </div>
                    <!-- End Header Top Links -->
                </div>
            </div>
        </div>
    </div>
    <div class="header container">
        <div class="row">
            <div class="col-lg-2 col-sm-3 col-md-2 col-xs-12">
                <!-- Header Logo -->
                <a class="logo" title="Magento Commerce" href="index.html"><img alt="Magento Commerce" src="{$arg.stylesheet}images/logo.png"></a>
                <!-- End Header Logo -->
            </div>
            <div class="col-lg-7 col-sm-4 col-md-6 col-xs-12">
                <!-- Search-col -->
                <div class="search-box">
                    <form action="#" method="POST" id="search_mini_form" name="Categories">

                        <input type="text" placeholder="Tìm kiếm sản phẩm" value="" maxlength="70" class="" name="search" id="search">
                        <button id="submit-button" class="search-btn-bg"><span>Tìm kiếm</span></button>
                    </form>
                </div>
                <!-- End Search-col -->
            </div>
            <!-- Top Cart -->
            <div class="col-lg-3 col-sm-5 col-md-4 col-xs-12">
                <div class="top-cart-contain">
                    <div class="mini-cart">
                        <div data-toggle="dropdown" data-hover="dropdown" class="basket dropdown-toggle"> <a href="shopping_cart.html"> <i class="icon-cart"></i>
                <div class="cart-box"><span class="title">Giỏ hàng</span><span id="cart-total"> 2 </span></div>
                </a></div>
                        <div>
                            <div class="top-cart-content arrow_box">
                                <div class="block-subtitle">Recently added item(s)</div>
                                <ul id="cart-sidebar" class="mini-products-list">
                                    <li class="item even"> <a class="product-image" href="#" title="Downloadable Product "><img alt="Downloadable Product " src="products-images/product1.jpg" width="80"></a>
                                        <div class="detail-item">
                                            <div class="product-details"> <a href="#" title="Remove This Item" onClick="" class="glyphicon glyphicon-remove">&nbsp;</a> <a class="glyphicon glyphicon-pencil" title="Edit item" href="#">&nbsp;</a>
                                                <p class="product-name"> <a href="#" title="Downloadable Product">Downloadable Product </a> </p>
                                            </div>
                                            <div class="product-details-bottom"> <span class="price">$100.00</span> <span class="title-desc">Qty:</span> <strong>1</strong> </div>
                                        </div>
                                    </li>
                                    <li class="item last odd"> <a class="product-image" href="#" title="  Sample Product "><img alt="  Sample Product " src="products-images/product11.jpg" width="80"></a>
                                        <div class="detail-item">
                                            <div class="product-details"> <a href="#" title="Remove This Item" onClick="" class="glyphicon glyphicon-remove">&nbsp;</a> <a class="glyphicon glyphicon-pencil" title="Edit item" href="#">&nbsp;</a>
                                                <p class="product-name"> <a href="#" title="  Sample Product "> Sample Product </a> </p>
                                            </div>
                                            <div class="product-details-bottom"> <span class="price">$320.00</span> <span class="title-desc">Qty:</span> <strong>2</strong> </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="top-subtotal">Subtotal: <span class="price">$420.00</span></div>
                                <div class="actions">
                                    <button class="btn-checkout" type="button"><span>Checkout</span></button>
                                    <button class="view-cart" type="button"><span>View Cart</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="ajaxconfig_info" style="display:none"> <a href="#/"></a>
                        <input value="" type="hidden">
                        <input id="enable_module" value="1" type="hidden">
                        <input class="effect_to_cart" value="1" type="hidden">
                        <input class="title_shopping_cart" value="Go to shopping cart" type="hidden">
                    </div>
                </div>
                <div class="signup"><a title="Login" href="login.html"><span>Đăng ký</span></a></div>
                <span class="or"> | </span>
                <div class="signup"><a style='color:red' title="Login" href="login.html"><span>Đăng nhập</span></a></div>
            </div>
            <!-- End Top Cart -->
        </div>
    </div>
</header>