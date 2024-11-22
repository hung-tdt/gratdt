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
	<!-- Breadcrumb Start -->
	<div class="breadcrumb-area mt-30">
		<div class="container">
			<div class="breadcrumb">
				<ul class="d-flex align-items-center">
					<li><a href="/">Home</a></li>
					<li><a href="shop.html">Shop</a></li>
					<li class="active"><a href="shop.html">{{ $title }}</a></li>
				</ul>
			</div>
		</div>
		<!-- Container End -->
	</div>

	<div class="main-shop-page pt-100 pb-100 ptb-sm-60">
		<div class="container">
			<!-- Row End -->
			<div class="row">
				<!-- Sidebar Shopping Option Start -->
				@include('customer.products.side')
				<!-- Sidebar Shopping Option End -->
				<!-- Product Categorie List Start -->
				<div class="col-lg-9 order-1 order-lg-2">
					<!-- Grid & List View Start -->
					<div class="grid-list-top border-default universal-padding d-md-flex justify-content-md-between align-items-center mb-30">
						<div class="grid-list-view  mb-sm-15">
							<ul class="nav tabs-area d-flex align-items-center">
								<li><a class="active" data-toggle="tab" href="#grid-view"><i class="fa fa-th"></i></a></li>
								<li><a data-toggle="tab" href="#list-view"><i class="fa fa-list-ul"></i></a></li>
							</ul>
						</div>
						<!-- Toolbar Short Area Start -->
						<div class="main-toolbar-sorter clearfix">
							<div class="toolbar-sorter d-flex align-items-center">
								<label>Sort By:</label>
								<select class="sorter wide" style="display: none;">
									<option value="Position">Relevance</option>
									<option value="Product Name">Neme, A to Z</option>
									<option value="Product Name">Neme, Z to A</option>
									<option value="Price">Price low to heigh</option>
									<option value="Price" selected="">Price heigh to low</option>
								</select><div class="nice-select sorter wide" tabindex="0"><span class="current">Price heigh to low</span><ul class="list"><li data-value="Position" class="option">Relevance</li><li data-value="Product Name" class="option">Neme, A to Z</li><li data-value="Product Name" class="option">Neme, Z to A</li><li data-value="Price" class="option">Price low to heigh</li><li data-value="Price" class="option selected">Price heigh to low</li></ul></div>
							</div>
						</div>
						<!-- Toolbar Short Area End -->
						<!-- Toolbar Short Area Start -->
						<div class="main-toolbar-sorter clearfix">
							<div class="toolbar-sorter d-flex align-items-center">
								<label>Show:</label>
								<select class="sorter wide" style="display: none;">
									<option value="12">12</option>
									<option value="25">25</option>
									<option value="50">50</option>
									<option value="75">75</option>
									<option value="100">100</option>
								</select><div class="nice-select sorter wide" tabindex="0"><span class="current">12</span><ul class="list"><li data-value="12" class="option selected">12</li><li data-value="25" class="option">25</li><li data-value="50" class="option">50</li><li data-value="75" class="option">75</li><li data-value="100" class="option">100</li></ul></div>
							</div>
						</div>
						<!-- Toolbar Short Area End -->
					</div>
					<!-- Grid & List View End -->
					<div class="main-categorie mb-all-40">
						<!-- Grid & List Main Area End -->
						<div class="tab-content fix">
							<div id="grid-view" class="tab-pane fade show active">
								<div class="row">

									@foreach($products as $key => $product)
									@php 
										$a =($product->price-$product->price_sale);
										$b =  $product->price;
										$c = ($a/$b) *100;
										$percent =round($c, 0) ;
									@endphp
									<!-- Single Product Start -->
									<div class="col-lg-4 col-md-4 col-sm-6 col-6">
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
									</div>
									<!-- Single Product End -->
									@endforeach	
								</div>
								<!-- Row End -->
							</div>
							<!-- #grid view End -->
							<div id="list-view" class="tab-pane fade">
								@foreach($products as $key => $product)
								@php 
									$a =($product->price-$product->price_sale);
									$b =  $product->price;
									$c = ($a/$b) *100;
									$percent =round($c, 0) ;
								@endphp
								<!-- Single Product Start -->
								<div class="single-product"> 
									<div class="row">        
										<!-- Product Image Start -->
										<div class="col-lg-4 col-md-5 col-sm-12">
											<div class="pro-img">
												<a href="product.html">
													<img class="primary-img" src="{{ $product->thumb }}" alt="single-product">
													<img class="secondary-img" src="{{ $product->thumb2 }}" alt="single-product">
												</a>
												<span 
													class="quick_view" title="" data-original-title="We will import soon">
													@if ($product->quantity == 0)
														<p class="out-of-stock">Out of stock</p>
													@endif
												</span>												 
											
											</div>
										</div>
										<!-- Product Image End -->
										<!-- Product Content Start -->
										<div class="col-lg-8 col-md-7 col-sm-12">
											<div class="pro-content hot-product2">
												<h4><a href="/product/{{ $product->id }}-{{\Str::slug($product->name,'-')}}.html">{{$product->name}}</a></h4>
												<p><span class="price">${{number_format($product->price_sale, 0, ',', '.'). "" }}</span></p>
												<del class="prev-price">${{number_format($product->price, 0, ',', '.'). ""}}</del></p>
													<div class="label-product l_sale">{{$percent}}<span class="symbol-percent">%</span></div>
												<p>{{$product->description}}</p>
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
										<!-- Product Content End -->
									</div>
								</div>
								<!-- Single Product End -->
								@endforeach	
							</div>
							<!-- #list view End -->
							<div class="pro-pagination">
								{{ $products->links('pagination::bootstrap-4') }}
							</div>
							<!-- Product Pagination Info -->
						</div>
						<!-- Grid & List Main Area End -->
					</div>
				</div>
				<!-- product Categorie List End -->
			</div>
			<!-- Row End -->
		</div>
		<!-- Container End -->
	</div>
@endsection()
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="customer/fix/wishlist.js"></script>
<script src="/customer/fix/addcart.js"></script>