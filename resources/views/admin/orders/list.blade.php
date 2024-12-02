@extends('admin.component.main')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Orders</h2>             
    </div>  
</div>       
<div class="wrapper wrapper-content animated fadeInRight ecommerce">
    <div class="ibox-content m-b-sm border-bottom">
        <div class="row mt20">
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="control-label" for="title">Order code</label>
                    <input type="text" id="order_number" name="order_number" class="form-control">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="control-label" for="abstract">Phone</label>
                    <input type="text" id="phone" name="phone" class="form-control">
                </div>
            </div>
            <div class="col-sm-1">
                <div class="form-group">
                    <label class="control-label" for="abstract">Status</label>
                    <input type="text" id="status" name="status" class="form-control">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label class="control-label" for="shipping_address">Address</label>
                    <input type="text" id="shipping_address" name="shipping_address" class="form-control">
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                    <label for="start_date">Start Date</label>
                    <input type="date" id="start_date" name="start_date" class="form-control">
                </div>
            </div>
            
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="end_date">End Date</label>
                    <input type="date" id="end_date" name="end_date" class="form-control">
                </div>
            </div>
            <button type="button" class="btn btn-primary" id="searchBtn"> <i class="fa fa-search"></i> Search</button>
            <button type="button" class="btn btn-w-m btn-default" id="resetBtn"> <i class="fa fa-refresh"></i> Reset</button>
        </div>
    </div>
    <div class="ibox-content"> 
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    
        <table id="orderTable" class="tbf table">
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
                            <a href="{{ route('orders.detail', $order->id) }}" class="btn btn-info">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    
        <div class="pro-pagination">
            {{ $orders->links('pagination::bootstrap-4') }}
        </div>
        <a href="" id="exportPdfBtn" class="btn btn-info">Export pdf</a>
    </div>
</div>
@endsection()

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="/admin/search/order.js"></script>