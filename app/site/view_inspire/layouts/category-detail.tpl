<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from htmldemo.magikcommerce.com/ecommerce/inspire-html-template/digital/grid.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 13 Aug 2015 08:05:17 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
<meta charset="utf-8">
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<title>Inspire, premium HTML5 &amp; CSS3 template</title>

<!-- Favicons Icon -->
<link rel="icon" href="http://demo.magikthemes.com/skin/frontend/base/default/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="http://demo.magikthemes.com/skin/frontend/base/default/favicon.ico" type="image/x-icon" />

<!-- Mobile Specific -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS Style -->

<link rel="stylesheet" href="{$arg.stylesheet}css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="{$arg.stylesheet}css/style.css" type="text/css">
<link rel="stylesheet" href="{$arg.stylesheet}css/revslider.css" type="text/css">
<link rel="stylesheet" href="{$arg.stylesheet}css/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="{$arg.stylesheet}css/owl.theme.css" type="text/css">
<link rel="stylesheet" href="{$arg.stylesheet}css/font-awesome.css" type="text/css">

<!-- Google Fonts -->
<link href='https://fonts.googleapis.com/css?family=Roboto:400,500,700' rel='stylesheet' type='text/css'>
</head>

<body>
<div class="page">
  <!-- Header -->
  {include file="includes/header.tpl"}
  <!-- end header -->
  <!-- Navbar -->
  {include file="includes/nav.tpl"}
  <!-- end nav -->
  <!-- breadcrumbs -->
  <div class="breadcrumbs">
    <div class="container">
      <div class="row">
        <ul>
          <li class="home"> <a href="index.html" title="Go to Home Page">Trang chủ</a><span>&mdash;›</span></li>
          <li class=""> <a href="grid.html" title="Go to Home Page">Women</a><span>&mdash;›</span></li>
          <li class="category13"><strong>Tops &amp; Tees</strong></li>
        </ul>
      </div>
    </div>
  </div>
  <!-- End breadcrumbs -->

  <!-- Two columns content -->
  <section class="main-container col2-left-layout">
    <div class="main container">
      <div class="row">
        <section class="col-main col-sm-9 col-sm-push-3 wow">
          <div class="category-title">
            <h1>{$parent.name}</h1>
          </div>
          <!-- category banner -->
          <div class="category-description std">
            <div class="slider-items-products">
              <div id="category-desc-slider" class="product-flexslider hidden-buttons">
                <div class="slider-items slider-width-col1">

                  {foreach from=$random_product item=item}
                    <div class="item"> <a href="#"><img alt="category-banner" src="{$arg.product_folder_link}/{$item.image_name}"></a>
                      <div class="cat-img-title cat-bg cat-box">
                        <h2 class="cat-heading" style='color:red'>{$item.name}</h2>
                        {* <p>{$item.description}</p> *}
                      </div>
                    </div>
                  {/foreach}
                  <!-- End Item -->


                  <!-- Item -->
                  <div class="item"> <a href="#x"><img alt="category-banner" src="images/category-banner-img1.jpg"></a> </div>
                  <!-- End Item -->

                </div>
              </div>
            </div>
          </div>
          <!-- category banner -->
          <div class="category-products">
            <div class="toolbar">
              <div class="sorter">
                <div class="view-mode"> <span title="Grid" class="button button-active button-grid">Grid</span><a href="list.html" title="List" class="button button-list">List</a> </div>
              </div>
              <div id="sort-by">
                <label class="left">Sort By: </label>
                <ul>
                  <li><a href="#">Position<span class="right-arrow"></span></a>
                    <ul>
                      <li><a href="#">Name</a></li>
                      <li><a href="#">Price</a></li>
                      <li><a href="#">Position</a></li>
                    </ul>
                  </li>
                </ul>
                <a class="button-asc left" href="#" title="Set Descending Direction"><span style="color:#999;font-size:11px;" class="glyphicon glyphicon-arrow-up"></span></a> </div>
              <div class="pager">
                <div id="limiter">
                  <label>View: </label>
                  <ul>
                    <li><a href="#">15<span class="right-arrow"></span></a>
                      <ul>
                        <li><a href="#">20</a></li>
                        <li><a href="#">30</a></li>
                        <li><a href="#">35</a></li>
                      </ul>
                    </li>
                  </ul>
                </div>
                <div class="pages">
                  {$paging.paging}

                </div>
              </div>
            </div>
            <ul class="products-grid">
            {foreach from=$products item=product}
              <li class="item col-lg-4 col-md-4 col-sm-6 col-xs-6" style='height:50%;'>
                <div class="col-item">
                  {if $product.is_discount eq 1}
                    <div class="sale-label sale-top-right">Khuyến mãi</div>
                  {/if}
                  <div class="images-container"> <a class="product-image" title="{$product.name}" href="./?mc=productdetail&n={$product.slug_name}"> <img src="{$arg.product_folder_link}/{$product.image_name}" class="img-responsive" alt="a" /> </a>
                    <div class="actions">
                      <div class="actions-inner">
                        <button type="button" title="Add to Cart" class="button btn-cart"><span>Thêm vào giỏ</span></button>
                      </div>
                    </div>
                    <div class="qv-button-container"> <a class="qv-e-button btn-quickview-1" href="quick_view.html"><span><span>Quick View</span></span></a> </div>
                  </div>
                  <div class="info">
                    <div class="info-inner">
                      <div class="item-title"> <a title=" Sample Product" href="product_detail.html"> {$product.name}</a> </div>
                      <!--item-title-->
                      <div class="item-content">
                        <div class="ratings">
                          <div class="rating-box">
                            <div style="width:{(20*$item.total_rate/$item.number_user_rate)}%" class="rating"></div>
                          </div>
                        </div>
                        <div class="price-box">
                          {if $product.is_discount eq 1}
                              <p class="special-price"> <span class="price">{$product.sale_price}đ</span> </p>
                              <p class="old-price"> <span class="price-sep">-</span> <span class="price">{$product.price}đ</span> </p>
                          {else}
                              <p class="special-price"> <span class="price">{$product.price}đ</span> </p>
                          {/if}

                        </div>
                      </div>
                      <!--item-content-->
                    </div>
                    <!--info-inner-->

                    <!--actions-->
                    <div>
                    </div>
                    <div class="clearfix"> </div>
                  </div>
                </div>
              </li>
            {/foreach}


            </ul>
          </div>
        </section>
        <aside class="col-left sidebar col-sm-3 col-xs-12 col-sm-pull-9 wow">
          <div class="side-nav-categories">
            <div class="block-title"> Danh mục sản phẩm </div>
            <!--block-title-->
            <!-- BEGIN BOX-CATEGORY -->
            <div class="box-content box-category">
              <ul>
              {foreach from=$all_child item=child}
                <li> <a class="active" href="./?mc=category&site=index&c={$child.link}"> {$child.name} </a> <span class="subDropdown minus"></span>
                {foreach from=$child.child item=child_child}
                  <ul class="level0_415" style="display:block">
                    <li>
                      <a href="./?mc=category&site=index&c={$child_child.link}"> {$child_child.name} </a>
                    </li>
                  </ul>
                {/foreach}
                  <!--level0-->
                </li>
              {/foreach}
              </ul>
            </div>
            <!--box-content box-category-->
          </div>
          <div class="block block-layered-nav">
            <div class="block-title"><span>Shop By</span></div>
            <div class="block-content">
              <p class="block-subtitle">Shopping Options</p>
              <dl id="narrow-by-list">
                <dt class="odd">Price</dt>
                <dd class="odd">
                  <ol>
                    <li> <a href="#"><span class="price">$0.00</span> - <span class="price">$99.99</span></a> (6) </li>
                    <li> <a href="#"><span class="price">$100.00</span> and above</a> (6) </li>
                  </ol>
                </dd>
                <dt class="even">Manufacturer</dt>
                <dd class="even">
                  <ol>
                    <li> <a href="#">TheBrand</a> (9) </li>
                    <li> <a href="#">Company</a> (4) </li>
                    <li> <a href="#">LogoFashion</a> (1) </li>
                  </ol>
                </dd>
                <dt class="odd">Color</dt>
                <dd class="odd">
                  <ol>
                    <li> <a href="#">Green</a> (1) </li>
                    <li> <a href="#">White</a> (5) </li>
                    <li> <a href="#">Black</a> (5) </li>
                    <li> <a href="#">Gray</a> (4) </li>
                    <li> <a href="#">Dark Gray</a> (3) </li>
                    <li> <a href="#">Blue</a> (1) </li>
                  </ol>
                </dd>
                <dt class="last even">Size</dt>
                <dd class="last even">
                  <ol>
                    <li> <a href="#">S</a> (6) </li>
                    <li> <a href="#">M</a> (6) </li>
                    <li> <a href="#">L</a> (4) </li>
                    <li> <a href="#">XL</a> (4) </li>
                  </ol>
                </dd>
              </dl>
            </div>
          </div>
          <div class="block block-cart">
            <div class="block-title"><span>My Cart</span></div>
            <div class="block-content">
              <div class="summary">
                <p class="amount">There are <a href="#">2 items</a> in your cart.</p>
                <p class="subtotal"> <span class="label">Cart Subtotal:</span> <span class="price">$27.99</span> </p>
              </div>
              <div class="ajax-checkout">
                <button type="submit" title="Submit" class="button button-checkout"><span>Checkout</span></button>
              </div>
              <p class="block-subtitle">Recently added item(s) </p>
              <ul>
                <li class="item"> <a class="product-image" title="Fisher-Price Bubble Mower" href="#"><img width="80" alt="Fisher-Price Bubble Mower" src="products-images/product1.jpg"></a>
                  <div class="product-details">
                    <div class="access"> <a class="btn-remove1" title="Remove This Item" href="#"> <span class="icon"></span> Remove </a> </div>
                    <p class="product-name"> <a href="#">Skater Dress In Leaf Print Grouped Product</a> </p>
                    <strong>1</strong> x <span class="price">$19.99</span> </div>
                </li>
                <li class="item last"> <a class="product-image" title="Prince Lionheart Jumbo Toy Hammock" href="#"><img width="80" alt="Prince Lionheart Jumbo Toy Hammock" src="products-images/product8.jpg"></a>
                  <div class="product-details">
                    <div class="access"> <a class="btn-remove1" title="Remove This Item" href="#"> <span class="icon"></span> Remove </a> </div>
                    <p class="product-name"> <a href="#"> Sample Fashion Product Prince Lionheart </a> </p>
                    <strong>1</strong> x <span class="price">$8.00</span>
                    <!--access clearfix-->
                  </div>
                </li>
              </ul>
            </div>
          </div>
          <div class="block block-subscribe">
            <div class="block-title"><span>Newsletter</span></div>
            <form action="#" method="post" id="newsletter-validate-detail">
              <div class="block-content">
                <div class="form-subscribe-header"> Sign up for our newsletter:</div>
                <input type="text" name="email" id="newsletter" title="" class="input-text required-entry validate-email" placeholder="Enter your email address">
                <div class="actions">
                  <button type="submit" title="Submit" class="subscribe"><span>Subscribe</span></button>
                </div>
              </div>
            </form>
          </div>
          <div class="block block-compare">
            <div class="block-title "><span>Compare Products (2)</span></div>
            <div class="block-content">
              <ol id="compare-items">
                <li class="item odd">
                  <input type="hidden" class="compare-item-id" value="2173">
                  <a href="#" title="Remove This Item" class="btn-remove1"></a> <a class="product-name" href="#"> Sofa with Box-Edge Polyester Wrapped Cushions</a> </li>
                <li class="item last even">
                  <input type="hidden" class="compare-item-id" value="2174">
                  <a href="#" title="Remove This Item" class="btn-remove1"></a> <a class="product-name" href="#"> Sofa with Box-Edge Down-Blend Wrapped Cushions</a> </li>
              </ol>
              <div class="ajax-checkout">
                <button class="button button-compare" title="Submit" type="submit"><span>Compare</span></button>
                <button class="button button-clear" title="Submit" type="submit"><span>Clear</span></button>
              </div>
            </div>
          </div>
          <div class="block block-list block-viewed">
            <div class="block-title"><span>Recently Viewed</span> </div>
            <div class="block-content">
              <ol id="recently-viewed-items">
                <li class="item odd">
                  <p class="product-name"><a href="#"> Armchair with Box-Edge Upholstered Arm</a></p>
                </li>
                <li class="item even">
                  <p class="product-name"><a href="#"> Pearce Upholstered Slee pere</a></p>
                </li>
                <li class="item last odd">
                  <p class="product-name"><a href="#"> Sofa with Box-Edge Down-Blend Wrapped Cushions</a></p>
                </li>
              </ol>
            </div>
          </div>
          <div class="block block-poll">
            <div class="block-title"><span>Community Poll</span> </div>
            <form onSubmit="return validatePollAnswerIsSelected();" method="post" action="#" id="pollForm">
              <div class="block-content">
                <p class="block-subtitle">What is your favorite Magento feature?</p>
                <ul id="poll-answers">
                  <li class="odd">
                    <input type="radio" value="5" id="vote_5" class="radio poll_vote" name="vote">
                    <span class="label">
                    <label for="vote_5">Layered Navigation</label>
                    </span> </li>
                  <li class="even">
                    <input type="radio" value="6" id="vote_6" class="radio poll_vote" name="vote">
                    <span class="label">
                    <label for="vote_6">Price Rules</label>
                    </span> </li>
                  <li class="odd">
                    <input type="radio" value="7" id="vote_7" class="radio poll_vote" name="vote">
                    <span class="label">
                    <label for="vote_7">Category Management</label>
                    </span> </li>
                  <li class="last even">
                    <input type="radio" value="8" id="vote_8" class="radio poll_vote" name="vote">
                    <span class="label">
                    <label for="vote_8">Compare Products</label>
                    </span> </li>
                </ul>
                <div class="actions">
                  <button class="button button-vote" title="Vote" type="submit"><span>Vote</span></button>
                </div>
              </div>
            </form>
          </div>
          <div class="block block-tags">
            <div class="block-title"><span>Popular Tags</span></div>
            <div class="block-content">
              <ul class="tags-list">
                <li><a style="font-size:98.3333333333%;" href="#tagId/23/">Camera</a></li>
                <li><a style="font-size:86.6666666667%;" href="#tagId/109/">Hohoho</a></li>
                <li><a style="font-size:145%;" href="#tagId/27/">SEXY</a></li>
                <li><a style="font-size:75%;" href="#tagId/61/">Tag</a></li>
                <li><a style="font-size:110%;" href="#tagId/29/">Test</a></li>
                <li><a style="font-size:86.6666666667%;" href="#tagId/17/">bones</a></li>
                <li><a style="font-size:110%;" href="#tagId/12/">cool</a></li>
                <li><a style="font-size:86.6666666667%;" href="#tagId/184/">cool t-shirt</a></li>
                <li><a style="font-size:86.6666666667%;" href="#tagId/173/">crap</a></li>
                <li><a style="font-size:86.6666666667%;" href="#tagId/41/">good</a></li>
                <li><a style="font-size:86.6666666667%;" href="#tagId/16/">green</a></li>
                <li><a style="font-size:86.6666666667%;" href="#tagId/5/">hip</a></li>
                <li><a style="font-size:75%;" href="#tagId/51/">laptop</a></li>
                <li><a style="font-size:75%;" href="#tagId/20/">mobile</a></li>
                <li><a style="font-size:75%;" href="#tagId/70/">nice</a></li>
                <li><a style="font-size:86.6666666667%;" href="#tagId/42/">phone</a></li>
                <li><a style="font-size:98.3333333333%;" href="#tagId/30/">red</a></li>
                <li><a style="font-size:86.6666666667%;" href="#tagId/28/">tight</a></li>
                <li><a style="font-size:75%;" href="#tagId/2/">trendy</a></li>
                <li><a style="font-size:86.6666666667%;" href="#tagId/4/">young</a></li>
              </ul>
              <div class="actions"> <a class="view-all" href="#">View All Tags</a> </div>
            </div>
          </div>
          <div class="block block-banner"><a href="#"><img src="images/block-banner.png" alt="block-banner"></a></div>
        </aside>
      </div>
    </div>
  </section>
  <!-- End Two columns content -->

  <!-- Footer -->
  {include file='./includes/footer.tpl'}
  <!-- End Footer -->
</div>
<div class="social">
  <ul>
    <li class="fb"><a href="#"></a></li>
    <li class="tw"><a href="#"></a></li>
    <li class="googleplus"><a href="#"></a></li>
    <li class="rss"><a href="#"></a></li>
    <li class="pintrest"><a href="#"></a></li>
    <li class="linkedin"><a href="#"></a></li>
    <li class="youtube"><a href="#"></a></li>
  </ul>
</div>

<!-- JavaScript -->
<script type="text/javascript" src="{$arg.stylesheet}js/jquery.min.js"></script>
<script type="text/javascript" src="{$arg.stylesheet}js/bootstrap.min.js"></script>

<script type="text/javascript" src="{$arg.stylesheet}js/common.js"></script>
<script type="text/javascript" src="{$arg.stylesheet}js/owl.carousel.min.js"></script>
</body>

<!-- Mirrored from htmldemo.magikcommerce.com/ecommerce/inspire-html-template/digital/grid.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 13 Aug 2015 08:05:41 GMT -->
</html>