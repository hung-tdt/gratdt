@extends('customer.component.main')

@section('content')
	<div class="main-page-banner pb-50 off-white-bg">
		<div class="container">
			<div class="row">
				<!-- Vertical Menu Start Here -->
				@include('customer.component.navbar-nonactive')
				<!-- Vertical Menu End Here -->
			</div>
			<!-- Row End -->
		</div>
		<!-- Container End -->
	</div>

	<div class="breadcrumb-area mt-30">
		<div class="container">
			<div class="breadcrumb">
				<ul class="d-flex align-items-center">
					<li><a href="/">Home</a></li>
					<li><a href="posts.html">Blog</a></li>
					<li class="active"><a href="#">{{$post->title}}</a></li>

				</ul>
			</div>
		</div>
	</div>
	</div>
	<div class="single-blog ptb-100  ptb-sm-60">
		<div class="container">
			<div class="row">
				<!-- Single Blog Sidebar Start -->
				<div class="col-lg-3 order-2 order-lg-1">
					<aside>
						<!-- Product Top Start -->
						<div class="top-new mb-40">
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
						<div class="top-new mb-40">
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
						<div class="electronics mb-40">
							<h3 class="sidebar-title">Lastest blog</h3>
							<div id="shop-cate-toggle" class="category-menu sidebar-menu sidbar-style">
								@foreach($postLastest as $key => $postLast)
									<!-- Single Blog Start -->
									<div class="single-latest-blog">
										<div class="blog-img">
											<a href="/post/{{ $postLast->id }}-{{\Str::slug($postLast->title,'-')}}.html">
												<img src="{{ $postLast->thumb }}" alt="blog-image">
												</a>
										</div>
										<div class="blog-desc">
											<p>{{$postLast->title}}</p>
												
										</div>
										<div class="blog-date">
												<small class="month">{{ \Carbon\Carbon::parse($postLast->created_at)->format('F') }}</small>
												<span>{{ \Carbon\Carbon::parse($postLast->created_at)->format('d') }}</span>
											</div>
									</div>
									<!-- Single Blog End -->
								@endforeach
							
							</div>
							<!-- category-menu-end -->
						</div>
					</aside>
				</div>
				<!-- Single Blog Sidebar End -->
				<!-- Single Blog Sidebar Description Start -->
				<div class="col-lg-9 order-1 order-lg-2">
					<div class="single-sidebar-desc mb-all-40">
						<div class="sidebar-img">
							<img src="{{$post->thumb}}" alt="single-blog-img" style="height: 300px; overflow: hidden; ">
						</div>
						<div class="sidebar-post-content">
							<h3 class="sidebar-lg-title">{{$post->title}}</h3>
							<ul class="post-meta d-sm-inline-flex">
								<li><span>written by</span>  {{$post->author}}</li>
								<li><span> {{$post->updated_at}}</span></li>
							</ul>
						</div>
						
						<div>
							<p>{!!$post->content!!}</p>
						</div>
						<!-- Contact Email Area Start -->
						<div class="review border-default universal-padding">
							<div class="group-title">
								<h2>customer comment</h2>
							</div>
					
							@foreach($comments->where('parent_id', 0) as $comment)
								@include('customer.posts.comment', ['comment' => $comment])
							@endforeach

							@auth('customer')
							<form action="{{ url('posts/'.$post->id.'/comments') }}" method="POST">
								@csrf
								<div class="form-group">
									<label for="content">Comment:</label>
									<textarea class="form-control" rows="2" id="content" name="content"></textarea>
								</div>
								<div class="submit-review">
									<input value="Submit" class="return-customer-btn" type="submit">
								</div>
							</form>
							@else
								<p>You need to <a href="/login.html">login</a> to post a comment.</p>
							@endauth

						</div>
						<!-- Contact Email Area End -->
					</div>
				</div>
				<!-- Single Blog Sidebar Description End -->
			</div>
		</div>
		<!-- Container End -->
	</div>
@endsection()

<script>
	function toggleReplyForm(formId) {
		const replyForm = document.getElementById(formId);
		if (replyForm.style.display === 'none' || replyForm.style.display === '') {
			replyForm.style.display = 'block';
		} else {
			replyForm.style.display = 'none';
		}
	}
</script>