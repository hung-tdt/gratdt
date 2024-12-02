<div class="hot-deal-products off-white-bg pt-100 pb-90 pt-sm-60 pb-sm-50">
	<div class="container">
		<!-- Product Title Start -->
		<div class="post-title pb-30">
			<h2>Realted Products</h2>
		</div>
		<!-- Product Title End -->
		<!-- Hot Deal Product Activation Start -->
		<div class="hot-deal-active owl-carousel">

			@foreach($productRelate as $key => $product)
			@php 
				$a =($product->price-$product->discounted_price);
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
			<!-- Single Product End --> 
			@endforeach	                       
		</div>                
		<!-- Hot Deal Product Active End -->

	</div>
	<!-- Container End -->
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="customer/fix/wishlist.js"></script>
<script src="/customer/fix/addcart.js"></script>