@extends('customer.component.main')
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
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
					<li class="active"><a href="/cart">Cart</a></li>
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
	
	<div class="cart-main-area ptb-100 ptb-sm-60">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12">
					
					<!-- Form Start -->
					<form action="#">
						<!-- Table Content Start -->
						<div class="table-content table-responsive mb-45">
							<table>
								<thead>
									<tr>
										<th class="product-thumbnail">Image</th>
										<th class="product-name">Product</th>
										<th class="product-price">Price</th>
										<th class="product-quantity">Quantity</th>
										<th class="product-subtotal">Total</th>
										<th class="product-remove">Remove</th>
									</tr>
								</thead>
								<tbody>
									@if($cart && $cart->items->count() > 0)
										@foreach($cart->items as $item)
											<tr>
												<td class="product-thumbnail">
													<a href="#">
														<img src="{{ $item->product->thumb }}" alt="cart-image">
													</a>
												</td>
												<td class="product-name">
													<a href="#">{{ $item->product->name }}</a>
												</td>
												<td class="product-price">
													<span class="amount">${{ number_format($item->price) }}</span>
												</td>
												<td class="product-quantity">
													<input type="number" class="quantity-input" value="{{ $item->quantity }}" data-id="{{ $item->id }}" min="1">
												</td>
												<td class="product-subtotal">
													${{ number_format($item->total) }}
												</td>
												<td class="product-remove">
													<a href="javascript:void(0);" class="remove-item" data-id="{{ $item->id }}">
														<i class="fa fa-times" aria-hidden="true"></i>
													</a>
												</td>
											</tr>
										@endforeach
									@else
										<tr>
											<td colspan="6" class="text-center">Giỏ hàng của bạn trống</td>
										</tr>
									@endif
								</tbody>
							</table>
						</div>
						<!-- Table Content End -->
						<div class="row">
						   <!-- Cart Button Start -->
							<div class="col-md-8 col-sm-12">
								<div class="buttons-cart">
									<a href="/shop.html">Continue Shopping</a>
								</div>
							</div>
							<!-- Cart Button End -->
							<!-- Cart Totals Start -->
							<div class="col-md-4 col-sm-12">
								<div class="cart_totals float-md-right text-md-right">
									<h2>Cart Totals</h2>
									<br>
									<table class="float-md-right">
										<tbody>
											
											<tr class="order-total">
												<th>Total</th>
												<td>
													<strong><span class="amount">${{ number_format($subtotal) }}</span></strong>
												</td>
											</tr>
										</tbody>
									</table>
									<div class="wc-proceed-to-checkout">
										<a href="{{ route('checkout') }}">Proceed to Checkout</a>
									</div>
								</div>
							</div>
							<!-- Cart Totals End -->
						</div>
						<!-- Row End -->
					</form>
					<!-- Form End -->
				</div>
			</div>
			 <!-- Row End -->
		</div>
	</div>
	
@endsection()
<script>
    var checkoutUrl = "{{ route('checkout') }}";
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/customer/fix/cartjs/cartitem.js"></script>