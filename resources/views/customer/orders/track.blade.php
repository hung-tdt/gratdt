@extends('customer.component.main')
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
@section('content')
<div class="order-tracking-area pt-100 ptb-sm-60">
    <div class="container">
        <h5>Order Tracking: {{ $order->order_number }}</h5>

        <p class="mt12" style="display: flex; gap: 100px;">
            <span><strong>Customer:</strong> {{ $order->name }}</span>
            <span><strong>User name:</strong> {{ $order->username }}</span>
            <span><strong>Order Date:</strong> {{ $order->order_date }}</span>
        </p>
        <p class="mt12" style="display: flex; gap: 100px;">
            <span><strong>Status:</strong> {{ $order->status }}</span>
            <span><strong>Phone:</strong> {{ $order->phone }}</span>
            <span><strong>Email:</strong> {{ $order->email }}</span>
        </p>
        <p class="mt12" style="display: flex; gap: 70px;">
            <span><strong>Payment status:</strong> {{ $order->payment_status }}</span>
            <span><strong>Payment method:</strong> {{ $order->payment_method }}</span>
            <span><strong>Total Amount:</strong>${{number_format($order->total_amount, 0, ',', '.'). "" }}</span>
        </p>
        <p class="mt12"><strong>Notes:</strong>{{ $order->notes }} </p>

        <p class="mt12" style="display: flex; gap: 100px;">
            <span><strong>Billing address:</strong> {{ $order->billing_address }}</span>
            <span><strong>Shipping address:</strong> {{ $order->shipping_address }}</span>
        </p>

        <div class="table-content table-responsive mt12">
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->details as $detail)
                    <tr>
                        <td>{{ $detail->product->name }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>${{ number_format($detail->price) }}</td>
                        <td>${{ number_format($detail->quantity * $detail->price) }}</td>
                        @if($order->status === 'received')
                            @if($detail->isreview != 1)
                                <td><a style="font-size: 13px;" href="{{ route('order.review', ['product_id' => $detail->product->id, 'order_detail_id' => $detail->id]) }}" class="btn btn-primary">Review</a></td>
                            @else
                                <td><a style="font-size: 13px;" href="{{ route('order.review', ['product_id' => $detail->product->id, 'order_detail_id' => $detail->id]) }}" class="btn btn-primary">You have rated</a></td>
                            @endif
                        @endif
                    </tr> 
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-right">Total Amount</th>
                        <td>${{ number_format($order->total_amount) }}</td>
                    </tr>
                </tfoot>
            </table>
            <div class="col-md-8 col-sm-12 mt10">
                <div class="buttons-cart">
                    @if($order->status === 'pending')
                        <a href="javascript:void(0);" id="cancelOrderBtn" data-id="{{ $order->id }}">Cancel order</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="/customer/fix/cancel.js"></script>
