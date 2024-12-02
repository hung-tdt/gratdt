@extends('customer.component.main') 

@section('content')


<div class="main-page-banner pb-50 off-white-bg">
    <div class="container">
        <div class="row">
            <!-- Vertical Menu Start Here -->
            @include('customer.component.navbar')
            <!-- Vertical Menu End Here -->
            <!-- Slider Area Start Here -->
            <div class="col-xl-9 col-lg-8 slider_box">
                <div class="slider-wrapper theme-default">
                    <div id="slider" class="nivoSlider">
                        <!-- Slider Background  Image Start-->
                        {{-- @if(isset($sliders) && count($sliders) > 0) --}}
                            @foreach($sliders as $slider)                      
                                <a href="#"><img src="{{ $slider->thumb }}" alt="" title="#htmlcaption"></a>
                            @endforeach
                        {{-- @endif --}}
                        <!-- Slider Background  Image End-->
                    </div>
                </div>
            </div>
            <!-- Slider Area End Here -->
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</div>
<!-- Categorie Menu & Slider Area End Here -->

<!-- Hot Deal Products Start Here -->
{{-- <div class="hot-deal-products off-white-bg pb-90 pb-sm-50">
    <div class="container">
       <!-- Product Title Start -->
       <div class="post-title pb-30">
           <h2>Coupons</h2>
       </div>
       <!-- Product Title End -->
        <!-- Hot Deal Product Activation Start -->
        <div class="hot-deal-active owl-carousel">
            <!-- Single Product Start -->
            <div class="single-product">
                <!-- Product Content Start -->
                <div class="pro-content">
                    <div class="pro-info">
                        <h4><a href="product.html">Poly and Bark Vortex Side</a></h4>
                        <p><span class="price">$84.45</span><del class="prev-price">$105.50</del></p>
                        <div class="label-product l_sale">20<span class="symbol-percent">%</span></div>
                    </div>
                    <div class="pro-actions">
                        <div class="actions-primary mt10">
                            <a href="cart.html" title="Add to Cart">+ Save coupon</a>
                        </div> 
                    </div>
                </div>
                <!-- Product Content End -->
            </div>
            <!-- Single Product End -->
        </div>
        <!-- Hot Deal Product Active End -->

    </div>
    <!-- Container End -->
</div> --}}
{{-- @include('customer.homes.coupon') --}}
<!-- Hot Deal Products End Here -->
@include('customer.homes.hot-deal')
@include('customer.homes.best-seller')

<!-- Big Banner Start Here -->
<div class="big-banner mt-100 pb-85 mt-sm-60 pb-sm-45">
    <div class="container banner-2">
        <div class="banner-box">
            <div class="col-img fixed-frame">
                <a>
                    <img src="customer/img/banner/mission.jpg" alt="Sứ mệnh của chúng tôi">
                    <div class="banner-text">
                        <h5>Our Mission</h5>
                        <p>Bring customers the best quality products and dedicated services.</p>
                    </div>
                </a>
            </div>
        </div>
        <div class="banner-box">
            <div class="col-img fixed-frame ml25">
                <a>
                    <img src="customer/img/banner/service.png">
                    <div class="banner-text">
                        <h5>Perfect service</h5>
                        <p>Free return within 7 days, fast delivery within 24 hours.</p>
                    </div>
                </a>
            </div>
        </div>
        <div class="banner-box">
            <div class="col-img fixed-frame ml25">
                <a>
                    <img src="customer/img/banner/quality.webp">
                    <div class="banner-text">
                        <h5>Quality commitment</h5>
                        <p>100% genuine products, thoughtful warranty.</p>
                    </div>
                </a>
            </div>
        </div>
        <div class="banner-box">
            <div class="col-img fixed-frame ml25">
                <a>
                    <img src="customer/img/banner/team.jpg">
                    <div class="banner-text">
                        <h5>Professional team</h5>
                        <p>Always ready to support and advise customers.</p>
                    </div>
                </a>
            </div>
        </div>
        <div class="banner-box">
            <div class="col-img fixed-frame ml25">
                <a>
                    <img src="customer/img/banner/thank.webp">
                    <div class="banner-text">
                        <h5>Thank you customers</h5>
                        <p>We appreciate for your support, companionship over the past time.</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Big Banner End Here -->

@include('customer.homes.new-arrival')


@include('customer.homes.home-menu-product')

@include('customer.homes.home-list-like')

<div class="big-banner pb-100 pb-sm-60 mt70">
    <div class="container big-banner-box">
        <div class="col-img">
            <a href="/shop.html">
            <img src="customer\img\banner\5.jpg" alt="">
            </a>
        </div>
        <div class="col-img">
            <a href="/shop.html">
            <img src="customer\img\banner\h1-banner3.jpg" alt="">
            </a>
        </div>
    </div>
    <!-- Container End -->
</div>

@include('customer.homes.lastest-blog')


<!-- Support Area Start Here -->
<div class="support-area bdr-top">
    <div class="container">
        <div class="d-flex flex-wrap text-center">
            <div class="single-support">
                <div class="support-icon">
                    <i class="lnr lnr-gift"></i>
                </div>
                <div class="support-desc">
                    <h6>Great Value</h6>
                    <span>Nunc id ante quis tellus faucibus dictum in eget.</span>
                </div>
            </div>
            <div class="single-support">
                <div class="support-icon">
                    <i class="lnr lnr-rocket"></i>
                </div>
                <div class="support-desc">
                    <h6>Worlwide Delivery</h6>
                    <span>Quisque posuere enim augue, in rhoncus diam dictum non</span>
                </div>
            </div>
            <div class="single-support">
                <div class="support-icon">
                   <i class="lnr lnr-lock"></i>
                </div>
                <div class="support-desc">
                    <h6>Safe Payment</h6>
                    <span>Duis suscipit elit sem, sed mattis tellus accumsan.</span>
                </div>
            </div>
            <div class="single-support">
                <div class="support-icon">
                   <i class="lnr lnr-enter-down"></i>
                </div>
                <div class="support-desc">
                    <h6>Shop Confidence</h6>
                    <span>Faucibus dictum suscipit eget metus. Duis  elit sem, sed.</span>
                </div>
            </div>
            <div class="single-support">
                <div class="support-icon">
                   <i class="lnr lnr-users"></i>
                </div>
                <div class="support-desc">
                    <h6>24/7 Help Center</h6>
                    <span>Quisque posuere enim augue, in rhoncus diam dictum non.</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Support Area End Here -->
<!-- Footer Area Start Here -->


@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="customer/fix/wishlist.js"></script>
<script src="/customer/fix/addcart.js"></script>


