@extends('admin.component.main')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Orders</h2>             
    </div>  
</div>       
<div class="wrapper wrapper-content animated fadeInRight ecommerce">
    <div class="ibox-content"> 
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    
        <table class="table">
            <thead>
                <tr>
                    <th>Order Number</th>
                    <th>Customer</th>
                    <th>Phone</th>
                    <th style="width: 300px">Address</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th>Order Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->order_number }}</td>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->shipping_address }}</td>
                        <td>${{ $order->total_amount }}</td>
                        <td>{{ $order->status }}</td>
                        <td>{{ $order->order_date }}</td>
                        <td>
                            <a href="{{ route('orders.orderconfirmedDetail', $order->id) }}" class="btn btn-info">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    
        {{ $orders->links() }} <!-- Pagination -->
    </div>
</div>
@endsection()