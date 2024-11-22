
<!-- Like Products Area Start Here -->
<div class="like-product ptb-95 ptb-sm-55 off-white-bg">
    <div class="container">
        <div class="like-product-area"> 
            <h2 class="section-ttitle2 mb-30">New Arrivals </h2>
            <!-- Like Product Activation Start Here -->
            <div class="like-pro-active owl-carousel">

                @foreach($newProducts as $key => $product)
                @php 
                    $a =($product->price-$product->price_sale);
                    $b =  $product->price;
                    $c = ($a/$b) *100;
                    $percent =round($c, 0) ;
                @endphp
                <!-- Single Product Start -->
                <div class="single-product">
                    <!-- Product Image Start -->
                    <div class="pro-img">
                        <a href="/product/{{ $product->id }}-{{\Str::slug($product->name,'-')}}.html">
                            <img class="primary-img" src="{{ $product->thumb }}" alt="{{$product->name}}">
                            <img class="secondary-img" src="{{ $product->thumb2 }}" alt="{{$product->name}}">
                        </a>
                        <span 
                            class="quick_view" title="" data-original-title="We will import soon">
                            @if ($product->quantity == 0)
                                <p class="out-of-stock">Out of stock</p>
                            @endif
                        </span>
                    </div>
                    <!-- Product Image End -->
                    <!-- Product Content Start -->
                    <div class="pro-content">
                        <div class="pro-info">
                            <h4><a href="/product/{{ $product->id }}-{{\Str::slug($product->name,'-')}}.html">{{$product->name}}</a></h4>
                            <p><span class="price">${{number_format($product->price_sale, 0, ',', '.'). "" }}</span>
                                <del class="prev-price">${{number_format($product->price, 0, ',', '.'). ""}}</del></p>
                            <div class="label-product l_sale">{{$percent}}<span class="symbol-percent">%</span></div>
                        </div>
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
                    <!-- Product Content End -->
                </div>
                <!-- Single Product End -->
                @endforeach	                        
            </div>                    
            <!-- Like Product Activation End Here -->
        </div>
        <!-- main-product-tab-area-->
    </div>
    <!-- Container End -->
</div>
<!-- Like Products Area End Here --> 
