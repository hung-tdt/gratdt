@extends('admin.component.main')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Order Details</h2>             
    </div>
</div>         
<div class="wrapper wrapper-content animated fadeInRight ecommerce">
    <div class="ibox-content"> 
        <div>
            <p class="mt22" style="display: flex; gap: 100px;">
                <span><strong>Order Number:</strong> {{ $order->order_number }}</span>
                <span><strong>Customer:</strong> {{ $order->name }}</span>
                <span><strong>User name:</strong> {{ $order->username }}</span>
            </p>
            <p class="mt22" style="display: flex; gap: 70px;">
                <span><strong>Status:</strong> {{ $order->status }}</span>
                <span><strong>Phone:</strong> {{ $order->phone }}</span>
                <span><strong>Email:</strong> {{ $order->email }}</span>
            </p>
            <p class="mt22" style="display: flex; gap: 70px;">
                <span><strong>Payment status:</strong> {{ $order->payment_status }}</span>
                <span><strong>Payment method:</strong> {{ $order->payment_method }}</span>
                <span><strong>Total Amount:</strong>${{number_format($order->total_amount, 0, ',', '.'). "" }}</span>
            </p>
            <p class="mt22"><strong>Notes:</strong>{{ $order->notes }} </p>
            <p class="mt22"><strong>Order Date:</strong> {{ $order->order_date }}</p>
            <p class="mt22"><strong>Billing address:</strong> {{ $order->billing_address }}</p>
            <p class="mt22"><strong>Shipping address:</strong> {{ $order->shipping_address }}</p>
        </div>
    
        <h2 class="mt22">Products Ordered</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Image</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderDetails as $detail)
                <tr>
                    <td>{{ $detail->product->name }}</td>
                    <td><a href="{{ $detail->product->thumb }}" target="_blank">
                        <img src="{{ $detail->product->thumb }}" height="40px"></a>
                    </td>
                    <td>{{ $detail->quantity }}</td>
                    <td>{{number_format($detail->price, 0, ',', '.'). "" }}</td>
                    <td>{{number_format($detail->total, 0, ',', '.'). "" }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" class="text-right">Total</th>
                <td>${{ number_format($order->total_amount + $order->discount) }}</td>
            </tr>
            <tr>
                <th colspan="4" class="text-right">Discount</th>
                <td>- ${{ number_format($order->discount) }}</td>
            </tr>
            <tr>
                <th colspan="4" class="text-right">Total Amount</th>
                <td>${{ number_format($order->total_amount) }}</td>
            </tr>
        </tfoot>
    </table>

    <div style="display: flex; gap: 10px; margin-top: 20px;">
        <form action="{{ route('orders.updateOrderconfirmed', $order->id) }}" method="POST">
            @csrf
            <input type="hidden" name="status" value="orderconfirmed">
            <button type="submit" class="btn btn-primary">Order confirmed</button>   
        </form>
    
        <form action="{{ route('orders.exportOrderPdf', $order->id) }}" method="GET">
            <button type="submit" class="btn btn-success">Export PDF</button>
        </form>
    </div>
    </div>
</div>
@endsection()