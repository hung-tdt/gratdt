@extends('customer.component.main')

@section('content')

	<div class="main-page-banner pb-50 off-white-bg">
		<div class="container">
			<div class="row">
				<!-- Vertical productCategory Start Here -->
				@include('customer.component.navbar-nonactive')
				<!-- Vertical productCategory End Here -->
			</div>
			<!-- Row End -->
		</div>
		<!-- Container End -->
	</div>

	<!-- Breadcrumb Start -->
	<div class="breadcrumb-area mt-30">
		<div class="container">
			<div class="breadcrumb">
				<ul class="d-flex align-items-center">
					<li><a href="index.html">Home</a></li>
					<li><a href="shop.html">Shop</a></li>
					<li><a href="/danh-muc/{{$product->productCategory->id}}-{{\Str::slug($product->productCategory->name)}}.html">{{$product->productCategory->name}}</a></li>
					<li class="active"><a href="#">{{$title}}</a></li>
				</ul>
			</div>
		</div>
		<!-- Container End -->
	</div>
	<!-- Breadcrumb End -->
	<div class="breadcrumb-area mt-30">
		<div class="container">		
			@include('admin.component.alert')
		</div>
	</div>
	<!-- Product Thumbnail Start -->
	<div class="main-product-thumbnail ptb-100 ptb-sm-60">
		<div class="container">
			<div class="thumb-bg">
				<div class="row">
					<!-- Main Thumbnail Image Start -->
					<div class="col-lg-5 mb-all-40">
						@php
							$images = is_string($product->images) ? json_decode($product->images, true) : $product->images;
						@endphp
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
						<div class="product-thumbnail mt-15">
							<div class="thumb-menu owl-carousel nav tabs-area" role="tablist">
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
					<div class="col-lg-7">
						<div class="thubnail-desc fix">
							<h3 class="product-header">{{ $product->name }}</h3>
							<div class="rating-summary fix mtb-10">
								<div class="rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o"></i>
									<i class="fa fa-star-o"></i>
									<i class="fa fa-star-o"></i>
								</div>
								<div class="rating-feedback">
									<a href="#">(1 review)</a>
									<a href="#">add to your review</a>
								</div>
							</div>
							@php 
								$a =($product->price-$product->price_sale);
								$b =  $product->price;
								$c = ($a/$b) *100;
								$percent =round($c, 0) ;
							@endphp
							<div class="pro-price mtb-30">
								<p class="d-flex align-items-center"><span class="prev-price">
									{{number_format($product->price, 0, ',', '.') . "₫"}}</span><span class="price">
									{{number_format($product->price_sale, 0, ',', '.') . "₫"}}</span><span class="saving-price">save {{$percent}}%</span>
								</p>
							</div>
							<p class="mb-20 pro-desc-details">{{$product->description}}</p>
							
							<div class="product-size mb-20 clearfix">
								<label>Size</label>
								<select class="">
									<option>S</option>
									<option>M</option>
									<option>L</option>
								</select>
							</div>
							<div class="color clearfix mb-20">
								<label>color</label>
								<ul class="color-list">
									<li>
										<a class="orange active" href="#"></a>
									</li>
									<li>
										<a class="paste" href="#"></a>
									</li>
								</ul>
							</div>
							
								<div class="box-quantity d-flex hot-product2 mb10">
									<div>
										<input class="quantity mr-15" id="num_product" type="number" min="1" value="1">
									</div>
									<div class="pro-actions">						
										<div class="actions-primary">
											<a href="javascript:void(0);" class="add-to-cart-button" 
											   data-product-id="{{ $product->id }}" 
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
							
							<div class="pro-ref mt-20">

								<?php if ($product->quantity > 0): ?>
									<p><span class="in-stock"><i class="ion-checkmark-round"></i> IN STOCK</span></p>
								<?php else: ?>
									<p><span class="in-stock"><i class="fa fa-times" style="color: brown"></i> OUT OF STOCK</span></p>
								<?php endif; ?>

							</div>
							<div class="socila-sharing mt-25">
								<ul class="d-flex">
									<li>share</li>
									<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-google-plus-official" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- Thumbnail Description End -->
				</div>
				<!-- Row End -->
			</div>
		</div>
		<!-- Container End -->
	</div>
	<!-- Product Thumbnail End -->
	<!-- Product Thumbnail Description Start -->
	<div class="thumnail-desc pb-100 pb-sm-60">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<ul class="main-thumb-desc nav tabs-area" role="tablist">
						<li><a data-toggle="tab" href="#dtail">Product Details</a></li>
						<li><a class="active" data-toggle="tab" href="#review">Reviews</a></li>
					</ul>
					<!-- Product Thumbnail Tab Content Start -->
					<div class="tab-content thumb-content border-default">
						<div id="dtail" class="tab-pane fade">
							<p>{!! $product->content !!}</p>
						</div>
						<div id="review" class="tab-pane fade show active">
							<!-- Reviews Start -->
							<div class="review border-default universal-padding">
								<div class="mt10">
									<h3>Customer Review</h3>
									<ul class="review-list" style="margin-left : 480px">
										<!-- Single Review List Start -->
										<li>
											<span>Quality</span>
								
											@php
												$fullStars = floor($averageRating); // Số sao đầy đủ
												$halfStar = $averageRating - $fullStars >= 0.5 ? true : false; // Nửa sao nếu có
											@endphp
								
											<!-- Hiển thị số sao đầy đủ -->
											@for ($i = 0; $i < $fullStars; $i++)
												<i class="fa fa-star"></i>
											@endfor
								
											<!-- Hiển thị nửa sao nếu có -->
											@if($halfStar)
												<i class="fa fa-star-half-o"></i>
											@endif
								
											<!-- Hiển thị sao rỗng nếu cần -->
											@for ($i = $fullStars + ($halfStar ? 1 : 0); $i < 5; $i++)
												<i class="fa fa-star-o"></i>
											@endfor
										</li>
										<!-- Single Review List End -->
									</ul>
								</div>
								@forelse($reviews as $review)
									<div class="review border-default universal-padding mt-30">		
										<div class="single-review">
											<ul class="review-list">
												<li>
													<p><strong>{{ $review->customer->name }}:</strong></p>
													
													@php
														$fullStars = floor($review->rating); // Số sao đầy đủ
														$halfStar = $review->rating - $fullStars >= 0.5 ? true : false; // Nửa sao nếu có
													@endphp
								
													<!-- Hiển thị số sao đầy đủ -->
													@for ($i = 0; $i < $fullStars; $i++)
														<i class="fa fa-star"></i>
													@endfor
								
													<!-- Hiển thị nửa sao nếu có -->
													@if($halfStar)
														<i class="fa fa-star-half-o"></i>
													@endif
								
													<!-- Hiển thị sao rỗng nếu cần -->
													@for ($i = $fullStars + ($halfStar ? 1 : 0); $i < 5; $i++)
														<i class="fa fa-star-o"></i>
													@endfor
													
													<!-- Nội dung đánh giá -->
													<p>{{ $review->review }}</p>
													
													<!-- Thời gian đánh giá -->
													<label>{{ $review->created_at->format('d-m-Y H:i') }}</label>
												</li>
											</ul>
										</div>
										
									</div>
								@empty
									<p>No reviews yet.</p>
								@endforelse
													
							</div>
							
							@auth('customer')
								@if($order_detail->isreview != 1)
									<form action="{{ route('reviews.store') }}" method="POST">
										@csrf
										<!-- Review Form Start -->
										<div class="review border-default universal-padding mt-30">
											<h2 class="review-title mb-30">You're reviewing: <span>{{ $product->name }}</span></h2>
											<p class="review-mini-title">Your Rating</p>
											<ul class="review-list">
												<!-- Single Review List Start -->
												<li>
													<span>Quality</span>
													
													<!-- Rating selection for the form -->
													<input type="radio" name="rating" value="1" id="star1">
													<label for="star1"><i class="fa fa-star"></i></label>
												
													<input type="radio" name="rating" value="2" id="star2">
													<label for="star2"><i class="fa fa-star"></i></label>
												
													<input type="radio" name="rating" value="3" id="star3">
													<label for="star3"><i class="fa fa-star"></i></label>
												
													<input type="radio" name="rating" value="4" id="star4">
													<label for="star4"><i class="fa fa-star"></i></label>
												
													<input type="radio" name="rating" value="5" id="star5">
													<label for="star5"><i class="fa fa-star"></i></label>
												</li>                                                                        
											</ul>
									
											<!-- Reviews Field Start -->
											<div class="riview-field mt-40">
												
												<!-- Hidden fields to store product and user info -->
												<input type="hidden" name="product_id" value="{{ $product->id }}">
												<input type="hidden" name="order_detail_id" value="{{ $order_detail->id }}">
												<input type="hidden" name="customer_id" value="{{ auth('customer')->user()->id }}">
												
												<div class="form-group">
													<label class="req" for="comments">Review</label>
													<textarea class="form-control" name="review" rows="2" id="comments" required="required"></textarea>
												</div>
												<button type="submit" class="customer-btn">Submit Review</button>
											</div>
											<!-- Reviews Field End -->
										</div>
										<!-- Review Form End -->
									</form>
								@endif
							@endauth

						</div>
						
					</div>
					<!-- Product Thumbnail Tab Content End -->
				</div>
			</div>
			<!-- Row End -->
		</div>
		<!-- Container End -->
	</div>
	<!-- Product Thumbnail Description End -->
	<!-- Realted Products Start Here -->
	
	@include('customer.products.relate-productcategory')
	<!-- Realated Products End Here -->
@endsection()
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/customer/fix/wishlist.js"></script>
<script src="/customer/fix/addcart.js"></script>
