<div class="col-lg-3 order-2 order-lg-1">
    <div class="sidebar">
        <div class="electronics mb-40">
            <h3 class="sidebar-title">Lastest blog</h3>
            <div id="shop-cate-toggle" class="category-menu sidebar-menu sidbar-style">
                @foreach($postLastest as $key => $post)
                    <!-- Single Blog Start -->
                    <div class="single-latest-blog">
                        <div class="blog-img">
                            <a href="/post/{{ $post->id }}-{{\Str::slug($post->title,'-')}}.html">
                                <img src="{{ $post->thumb }}" alt="blog-image">
                                </a>
                        </div>
                        <div class="blog-desc">
                            <p>{{$post->title}}</p>
                                
                        </div>
                        <div class="blog-date">
                                <small class="month">{{ \Carbon\Carbon::parse($post->created_at)->format('F') }}</small>
                                <span>{{ \Carbon\Carbon::parse($post->created_at)->format('d') }}</span>
                            </div>
                    </div>
                    <!-- Single Blog End -->
                    @endforeach
            
            </div>
            <!-- category-menu-end -->
        </div>

         

        <!-- Product Top Start -->
        <div class="top-new mb-40 mt100">
            <h3 class="sidebar-title">Hot deals</h3>
            <div class="side-product-active owl-carousel owl-loaded owl-drag">

            <div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all; width: 810px;"><div class="owl-item active" style="width: 270px;"><div class="side-pro-item">
                @foreach($hotdealProducts as $key => $product)
                @php 
                    $a =($product->price-$product->discounted_price);
                    $b =  $product->price;
                    $c = ($a/$b) *100;
                    $percent =round($c, 0) ;
                @endphp
                    <!-- Single Product Start -->
                    <div class="single-product single-product-sidebar mt10">
                        <!-- Product Image Start -->
                        <div class="pro-img">
                            <a href="/product/{{ $product->id }}-{{\Str::slug($product->name,'-')}}.html">
                                <img class="primary-img" src="{{ $product->thumb }}" alt="{{$product->name}}">
                                <img class="secondary-img" src="{{ $product->thumb2 }}" alt="{{$product->name}}">
                            </a>
                            @if($product->discounted_price < $product->price)
                                <div class="label-product l_sale">{{$percent}}<span class="symbol-percent">%</span></div>                
                            @endif
                            
                        </div>
                        <!-- Product Image End -->
                        <!-- Product Content Start -->
                        <div class="pro-content">
                            <h4><a href="product.html">{{$product->name}}</a></h4>
                            @if($product->discounted_price < $product->price)
                                <p><span class="price">${{number_format($product->discounted_price, 0, ',', '.'). "" }}</span>
                                    <del class="prev-price">${{number_format($product->price, 0, ',', '.'). ""}}</del></p>											
                            @else
                            <p><span class="price">${{number_format($product->price, 0, ',', '.'). "" }}</span></p>                  
                            @endif
                        </div>
                        <!-- Product Content End -->
                    </div>
                    <!-- Single Product End -->  
                @endforeach                        
                </div></div></div></div><div class="owl-nav disabled"><div class="owl-prev"><i class="lnr lnr-arrow-left"></i></div><div class="owl-next"><i class="lnr lnr-arrow-right"></i></div></div><div class="owl-dots disabled"></div></div>
        </div>
        <!-- Product Top End --> 
       

        <!-- Product Top Start -->
        <div class="top-new mb-40 mt100">
            <h3 class="sidebar-title">Best seller</h3>
            <div class="side-product-active owl-carousel owl-loaded owl-drag">

            <div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all; width: 810px;"><div class="owl-item active" style="width: 270px;"><div class="side-pro-item">
                @foreach($bestSellerProducts as $key => $product)
                @php 
                    $a =($product->price-$product->discounted_price);
                    $b =  $product->price;
                    $c = ($a/$b) *100;
                    $percent =round($c, 0) ;
                @endphp
                    <!-- Single Product Start -->
                    <div class="single-product single-product-sidebar mt10">
                        <!-- Product Image Start -->
                        <div class="pro-img">
                            <a href="/product/{{ $product->id }}-{{\Str::slug($product->name,'-')}}.html">
                                <img class="primary-img" src="{{ $product->thumb }}" alt="{{$product->name}}">
                                <img class="secondary-img" src="{{ $product->thumb2 }}" alt="{{$product->name}}">
                            </a>
                            @if($product->discounted_price < $product->price)
                                <div class="label-product l_sale">{{$percent}}<span class="symbol-percent">%</span></div>                
                            @endif
                            
                        </div>
                        <!-- Product Image End -->
                        <!-- Product Content Start -->
                        <div class="pro-content">
                            <h4><a href="product.html">{{$product->name}}</a></h4>
                            @if($product->discounted_price < $product->price)
                                <p><span class="price">${{number_format($product->discounted_price, 0, ',', '.'). "" }}</span>
                                    <del class="prev-price">${{number_format($product->price, 0, ',', '.'). ""}}</del></p>											
                            @else
                            <p><span class="price">${{number_format($product->price, 0, ',', '.'). "" }}</span></p>                  
                            @endif
                        </div>
                        <!-- Product Content End -->
                    </div>
                    <!-- Single Product End -->  
                @endforeach                        
                </div></div></div></div><div class="owl-nav disabled"><div class="owl-prev"><i class="lnr lnr-arrow-left"></i></div><div class="owl-next"><i class="lnr lnr-arrow-right"></i></div></div><div class="owl-dots disabled"></div></div>
        </div>
        <!-- Product Top End -->                            
        <!-- Single Banner Start -->
        <div class="col-img">
            <a><img src="customer\img\banner\banner-sidebar.jpg" alt="slider-banner"></a>
        </div>
        <!-- Single Banner End -->
    </div>
</div>

