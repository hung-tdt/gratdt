

<h2 class="section-ttitle2 mb-30 mt70">Favorite product categories </h2>

@foreach($categories as $category)

<div class="arrivals-product pb-sm-45">
    <div class="container mt70">   
        <!-- Tab Contetn Start -->
        <div class="tab-content">
            
            <div id="category-{{ $category->id }}" class="tab-pane fade show active">
                <div class="row">
                    <div class="col-lg-5 order-2 order-lg-1">
                        <div class="banner-site-box mt-10">
                            <div class="col-img" style="position: relative;">
                                <h1 class="mb-30 dd"> 
                                    {{ $category->name }}
                                </h1>
                                <a href="#">
                                    <img src="{{ $category->thumb }}" alt="{{ $category->name }}" class="category-img">
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7 order-1 order-lg-2">
                        <div class="electronics-pro-active2 owl-carousel owl-loaded owl-drag">
                            @foreach($category->products as $product)
                            @php 
                                $a =($product->price-$product->discounted_price);
                                $b =  $product->price;
                                $c = ($a/$b) *100;
                                $percent =round($c, 0) ;
                            @endphp
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
                                        
                                        @if($product->discounted_price < $product->price)
                                            <p><span class="price">${{number_format($product->discounted_price, 0, ',', '.'). "" }}</span>
                                                <del class="prev-price">${{number_format($product->price, 0, ',', '.'). ""}}</del></p>
                                            <div class="label-product l_sale">{{$percent}}<span class="symbol-percent">%</span></div>
                                        @else

                                            <p><span class="price">${{number_format($product->price, 0, ',', '.'). "" }}</span></p>                  
                                        @endif

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
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <!-- Tab Content End -->
    </div>
            <!-- main-product-tab-area-->
    <!-- Container End -->
</div>
@endforeach

