<div class="hot-deal-products pt-100 pt-sm-60 mb70">
    <div class="container">
        <div class="all-border">
           <!-- Product Title Start -->
           <div class="section-ttitle mb-30">
                <h2>hot deals  </h2>
           </div>
           <!-- Product Title End -->
            <!-- Hot Deal Product Activation Start -->
            <div class="hot-deal-active3 owl-carousel">
                @foreach($hotdealProducts as $key => $product)
                @php
                    $a =($product->price-$product->discounted_price);
                    $b =  $product->price;
                    $c = ($a/$b) *100;
                    $percent =round($c, 0) ;
            
                    $images = is_string($product->images) ? json_decode($product->images, true) : $product->images;
                @endphp
                <div class="row">
                    <!-- Main Thumbnail Image Start -->
                    <div class="col-lg-6 mb-all-40 hot-product2 ">
                        <!-- Thumbnail Large Image start -->
                        <div class="tab-content">
                            @if(is_array($images))
                                @foreach($images as $imgKey => $image)
                                    <div id="thumb{{$product->id}}{{$imgKey+1}}" class="tab-pane fade {{ $imgKey == 0 ? 'show active' : '' }}">
                                        <a data-fancybox="images" href="{{ asset($image) }}">
                                            <img src="{{ asset($image) }}" alt="product-view">
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <!-- Thumbnail Large Image End -->
                        <!-- Thumbnail Image End -->
                        <div class="product-thumbnail">
                            <div class="pro-tab-menu nav tabs-area" role="tablist">
                                @if(is_array($images))
                                    @foreach($images as $imgKey => $image)
                                        <a class="{{ $imgKey == 0 ? 'active' : '' }}" data-toggle="tab" href="#thumb{{$product->id}}{{$imgKey+1}}">
                                            <img src="{{ asset($image) }}" alt="product-thumbnail">
                                        </a>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <!-- Thumbnail image end -->
                    </div>
                    <!-- Main Thumbnail Image End -->
                    
                    <!-- Thumbnail Description Start -->
                    <div class="col-lg-6 hot-product2">
                        <div class="thubnail-desc fix">
                           
                            @if($product->active_promotion_end_date)
                                <div class="countdown" data-countdown="{{ $product->active_promotion_end_date }}"></div>
                            @else
                                <p>No active promotions for this product.</p>
                            @endif
                            <h3><a href="/product/{{ $product->id }}-{{ \Str::slug($product->name,'-') }}.html">{{ $product->name }}</a></h3>
                            <div class="pro-price mtb-30">

                                @if($product->discounted_price < $product->price)
                                <p><span class="price">${{ number_format($product->discounted_price, 0, ',', '.') }}</span>
                                    <del class="prev-price">${{ number_format($product->price, 0, ',', '.') }}</del></p>
                                <div class="label-product l_sale">{{ $percent }}<span class="symbol-percent">%</span></div>
                                @else
                                    <p><span class="price">${{number_format($product->price, 0, ',', '.'). "" }}</span></p>                  
                                @endif
                            </div>
                            <p class="mb-30 pro-desc-details">{{ $product->description }}</p>
                            <div class="pro-actions">
                                <div class="actions-primary">
                                    <a href="javascript:void(0);" class="add-to-cart-button" 
                                       data-product-id="{{ $product->id }}" 
                                       data-quantity="1" 
                                       title="Add to Cart" 
                                       data-original-title="Add to Cart">
                                       + Add To Cart
                                    </a>
                                </div>
                                <div class="actions-secondary">
                                    <a href="javascript:void(0);" class="add-to-wishlist" data-product-id="{{ $product->id }}" title="WishList">
                                        <i class="lnr lnr-heart"></i> <span style="margin-top: 5px">Add to WishList</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Thumbnail Description End -->
                </div>
            @endforeach
            
 
            </div>
            <!-- Hot Deal Product Active End -->
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Hot Deal Products End Here --> 
