<!-- Navbar -->
<nav>
    <div class="container">
        <div class="nav-inner">
            <!-- mobile-menu -->
            <div class="hidden-desktop" id="mobile-menu">
                <ul class="navmenu">
                    <li>
                        <div class="menutop">
                            <div class="toggle"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></div>
                            <h2>Menu</h2>
                        </div>
                        <ul style="display:none;" class="submenu">
                            <li>
                                <ul class="topnav">
                                    <li class="level0 nav-6 level-top first parent"> <a class="level-top" href="index.html"> <span>Home</span> </a>
                                        <ul class="level0">
                                            <li class="level1"><a href="http://htmldemo.magikcommerce.com/ecommerce/inspire-html-template/fashion/index.html"><span>Fashion Store</span></a> </li>
                                            <li class="level1"><a href="index.html"><span>Digital Store</span></a> </li>
                                            <li class="level1"><a href="http://htmldemo.magikcommerce.com/ecommerce/inspire-html-template/furniture/index.html"><span>Furniture Store</span></a> </li>
                                            <li class="level1"><a href="http://htmldemo.magikcommerce.com/ecommerce/inspire-html-template/jewellery/index.html"><span>Jewellery Store</span></a> </li>
                                        </ul>
                                    </li>
                                    <li class="level0 nav-6 level-top"> <a class="level-top" href="#"> <span>Pages</span> </a>
                                        <ul class="level0">
                                            <li class="level1 first"><a href="grid.html"><span>Grid</span></a></li>
                                            <li class="level1 nav-10-2"> <a href="list.html"> <span>List</span> </a> </li>
                                            <li class="level1 nav-10-3"> <a href="product_detail.html"> <span>Product Detail</span> </a> </li>
                                            <li class="level1 nav-10-4"> <a href="shopping_cart.html"> <span>Shopping Cart</span> </a> </li>
                                            <li class="level1 first parent"><a href="checkout.html"><span>Checkout</span></a>
                                                <ul class="level2">
                                                    <li class="level2 nav-2-1-1 first"><a href="checkout_method.html"><span>Checkout Method</span></a></li>
                                                    <li class="level2 nav-2-1-5 last"><a href="checkout_billing-info.html"><span>Checkout Billing Info</span></a></li>
                                                </ul>
                                            </li>
                                            <li class="level1 nav-10-4"> <a href="wishlist.html"> <span>Wishlist</span> </a> </li>
                                            <li class="level1"> <a href="dashboard.html"> <span>Dashboard</span> </a> </li>
                                            <li class="level1"> <a href="multiple_addresses.html"> <span>Multiple Addresses</span> </a> </li>
                                            <li class="level1"> <a href="about.html"> <span>About us</span> </a> </li>
                                            <li class="level1"><a href="compare.html"><span>Compare</span></a></li>
                                            <li class="level1"><a href="delivery.html"><span>Delivery</span></a> </li>
                                            <li class="level1"><a href="faq.html"><span>FAQ</span></a> </li>
                                            <li class="level1"><a href="quick_view.html"><span>Quick View</span></a> </li>
                                            <li class="level1"><a href="newsletter.html"><span>Newsletter</span></a> </li>
                                            <li class="level1"><a href="contact_us.html"><span>Contact us</span></a> </li>
                                            <li class="level1"><a href="sitemap.html"><span>Sitemap</span></a> </li>
                                            <li class="level1"><a href="404error.html"><span>404 Error Page</span></a> </li>
                                        </ul>
                                    </li>
                                    <li class="level0 nav-7 level-top parent"> <a class="level-top" href="grid.html"> <span>Fashion</span> </a> </li>
                                    <li class="level0 nav-8 level-top parent"> <a class="level-top" href="grid.html"> <span>Women</span> </a> </li>
                                    <li class="level0 parent drop-menu"><a href="blog.html"><span>Blog</span> </a>
                                        <ul class="level1">
                                            <li class="level1 first"><a href="blog_posts_table_view.html"><span>Table View</span></a></li>
                                            <li class="level1 nav-10-2"> <a href="blog_single_post.html"> <span>Single Post</span> </a> </li>
                                        </ul>
                                    </li>
                                    <li class="level0 nav-9 level-top last parent "> <a class="level-top" href="contact.html"> <span>Contact</span> </a> </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!--navmenu-->
            </div>
            <!--End mobile-menu -->
            <a class="logo-small" title="Magento Commerce" href="index.html"><img alt="Magento Commerce" src="{$arg.stylesheet}images/logo-small.png"></a>
            <ul id="nav" class="hidden-xs">
                <li class="level0 parent drop-menu"><a href="index.html" class="active1"><span>Trang chủ</span> </a>
                    <ul class="level1">
                        <li class="level1"><a href="http://htmldemo.magikcommerce.com/ecommerce/inspire-html-template/fashion/index.html"><span>Fashion Store</span></a> </li>
                        <li class="level1"><a href="index.html"><span>Digital Store</span></a> </li>
                        <li class="level1"><a href="http://htmldemo.magikcommerce.com/ecommerce/inspire-html-template/furniture/index.html"><span>Furniture Store</span></a> </li>
                        <li class="level1"><a href="http://htmldemo.magikcommerce.com/ecommerce/inspire-html-template/jewellery/index.html"><span>Jewellery Store</span></a> </li>
                    </ul>
                </li>


                <li class="level0 nav-5 level-top parent"><a href="grid.html"><span>Danh mục sản phẩm </span> </a>
                    <div class="level0-wrapper dropdown-6col" style="display: none;">
                        <div class="level0-wrapper2">
                            <div class="nav-block nav-block-center">
                                <ul class="level0">
                                    {foreach from=$categories item=category}
                                        <li class="level1 nav-6-1 parent item"> <a href="./?mc=category&site=index&c={$category.link}"><span>{$category.name}</span></a>
                                        {foreach from=$category.child item=child}
                                            <!--sub sub category-->
                                            <ul class="level1">
                                                <li class="level2 nav-6-1-1"> <a href="./?mc=category&site=index&c="<span>{$child.name}</span></a> </li>

                                            </ul>
                                            <!--sub sub category-->
                                        {/foreach}
                                        </li>
                                    {/foreach}
                                </ul>
                            </div>
                        </div>
                        <!--level0-wrapper2-->
                    </div>
                </li>

                <li class="level0 parent drop-menu"><a href="index.html" class="active1"><span>Giới thiệu</span> </a>
                </li>
                <li class="level0 parent drop-menu"><a href="index.html" class="active1"><span>Liên hệ</span> </a>
                </li>
                <li class="level0 parent drop-menu"><a href="index.html" class="active1"><span>Tin tức</span> </a>
                </li>



            </ul>
        </div>
    </div>
</nav>
<!-- end nav -->