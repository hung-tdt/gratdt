
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
					<li class="active"><a href="/cart">Order</a></li>
				</ul>
			</div>
		</div>
		<!-- Container End -->
	</div>
	
    <div class="order-history-area pt-100 ptb-sm-60">
        <div class="container">
            <h4>Your Orders</h4>
            <div class="ibox-content m-b-sm border-bottom mt10">
                <div class="row mt20 mb20">       
                    <button type="button" class="btn btn-w-m btn-default" id="resetBtn" style="margin-left: 14px; font-size: 14px"> <i class="fa fa-refresh"></i> All your orders</button>
                    <button type="button" class="btn btn-primary" id="searchBtn-pending" style="margin-left: 40px; font-size: 14px"> Pending</button>    
                    <button type="button" class="btn btn-primary" id="searchBtn-confirmed" style="margin-left: 40px; font-size: 14px"> Confirmed</button>    
                    <button type="button" class="btn btn-primary" id="searchBtn-shipping" style="margin-left: 40px; font-size: 14px"> Shipping</button>    
                    <button type="button" class="btn btn-primary" id="searchBtn-received" style="margin-left: 40px; font-size: 14px"> Received</button>    
                    <button type="button" class="btn btn-primary" id="searchBtn-cancelled" style="margin-left: 40px; font-size: 14px"> Cancelled</button>    
                </div>
            </div>
            <div class="table-content table-responsive mt10">
                <table>
                    <thead>
                        <tr>
                            <th>Order Number</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Total Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($orders->count() > 0)
                            @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->order_number }}</td>
                                <td>{{ $order->order_date->format('d M Y') }}</td>
                                <td>{{ $order->status }}</td>
                                <td>${{ number_format($order->total_amount) }}</td>
                                <td>
                                    <a style="font-size: 13px;" href="{{ route('order.track', ['order' => $order->id]) }}" class="btn btn-primary">Track Order</a>
                                </td>
                            </tr>
                            @endforeach

                        @else
                            <tr>
                                <td colspan="5" class="text-center">You have no orders yet.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
	
@endsection()

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="/customer/fix/orderfilter.js"></script>

