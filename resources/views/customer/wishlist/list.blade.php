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
					<li class="active"><a href="/cart">Wishlist</a></li>
				</ul>
			</div>
		</div>
		<!-- Container End -->
	</div>
	<div class="breadcrumb-area mt-30">
		<div class="container">		
			@include('admin.component.alert')
		</div>
	</div>
	
	<!-- Wish List Start -->
	<div class="cart-main-area wish-list ptb-100 ptb-sm-60">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<!-- Form Start -->
					<form action="#">
						<!-- Table Content Start -->
						<div class="table-content table-responsive">
							<table>
								<thead>
									<tr>
										<th class="product-remove">Remove</th>
										<th class="product-thumbnail">Image</th>
										<th class="product-name">Product</th>
										<th class="product-price">Unit Price</th>
										<th class="product-quantity">Stock Status</th>
										<th class="product-subtotal">add to cart</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($wishlists as $item)
									<tr data-product-id="{{ $item->product_id }}">
										<td class="product-remove"> 
											<a href="javascript:void(0);" class="remove-from-wishlist" data-product-id="{{ $item->product_id }}">
												<i class="fa fa-times" aria-hidden="true"></i>
											</a>
										</td>
										<td class="product-thumbnail">
											<a href="#"><img src="{{ $item->product->thumb }}" alt="cart-image"></a>
										</td>
										<td class="product-name"><a href="#">{{ $item->product->name }}</a></td>
										<td class="product-price"><span class="amount">${{ $item->product->price }}</span></td>
										<td class="product-stock-status"><span>{{ $item->product->quantity }}</span></td>
										<td class="product-add-to-cart">
											<a href="javascript:void(0);" class="add-to-cart-button" 
											data-product-id="{{ $item->product->id }}" 
											data-quantity="1" 
											title="Add to Cart" 
											data-original-title="Add to Cart">
											+ Add To Cart
										 	</a>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<!-- Table Content Start -->
					</form>
					<!-- Form End -->
				</div>
			</div>
			<!-- Row End -->
		</div>
	</div>
	<!-- Wish List End -->
	
@endsection()

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/customer/fix/listwishlist.js"></script>
<script src="/customer/fix/addcart.js"></script>