@extends('admin.component.main')

@section('content')

    <div class="row mt10">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>To do list today</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">

                        <a href="{{ route('orders.pending') }}" class="btn btn-outline btn-default w200 mr8">
                            Waiting for confirmation
                            <div><small>{{ $waitingForConfirmationCount }}</small></div>
                        </a>

                        <a href="{{ route('orders.orderconfirmed') }}" class="btn btn-outline btn-primary w200 mr10">
                            Waiting for pickup
                            <div><small>{{ $waitingForPickupCount }}</small></div>
                        </a>
                        <a href="{{ route('orders.shipping') }}" class="btn btn-outline btn-success w200 mr10">
                            Shipping
                            <div><small>{{ $shipping }}</small></div>
                        </a>
                        <a href="{{ route('orders.cancelled') }}" class="btn btn-outline btn-warning w200 mr10">
                            Cancellation
                            <div><small>{{ $cancellationCount }}</small></div>
                        </a>
                        <a href="{{ route('products.outOfStock') }}" class="btn btn-outline btn-info w200 mr10">
                            Out of stock
                            <div><small>{{ $outOfStockCount }}</small></div>
                        </a>
              

                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="ibox-title">
            <div>
                <div class="btn-group">
                    <button id="today" type="button" class="btn btn-xs btn-white">Today</button>
                    <button id="monthly" type="button" class="btn btn-xs btn-white active">Monthly</button>
                    <button id="annual" type="button" class="btn btn-xs btn-white">Annual</button>
                    <button id="all" type="button" class="btn btn-xs btn-white">All</button>
                </div>
            </div>
        </div>

        <div class="row mt10" id="today-div">
            <!-- Thu nhập hàng tháng -->
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-success pull-right">Today</span>
                        <h5>Income</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">${{ number_format($totalIncomeToday) }}</h1>
                        <small>Total income today</small>
                    </div>
                </div>
            </div>
        
            <!-- Số đơn hàng hàng năm -->
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-info pull-right">Today</span>
                        <h5>Orders</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{ $totalOrdersToday }}</h1>
                        <small>Total orders today</small>
                    </div>
                </div>
            </div>
        
            <!-- Thu nhập trong ngày -->
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-primary pull-right">Today</span>
                        <h5>Revenue</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">${{ number_format($dailyRevenue) }}</h1>
                        <small>Revenue today</small>
                    </div>
                </div>
            </div>
        
            <!-- Số lượng sản phẩm bán ra trong tháng -->
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-danger pull-right">Today</span>
                        <h5>Products Sold</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{ $totalProductsSoldToday }}</h1>
                        <small>Products sold today</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt10" id="monthly-div" style="display:none;">
            <!-- Thu nhập hàng tháng -->
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-success pull-right">Monthly</span>
                        <h5>Income</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">${{ number_format($totalIncomeThisMonth) }}</h1>
                        <small>Total income this month</small>
                    </div>
                </div>
            </div>
        
            <!-- Số đơn hàng hàng năm -->
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-info pull-right">Monthly</span>
                        <h5>Orders</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{ $totalOrdersThisMonth }}</h1>
                        <small>Total orders this month</small>
                    </div>
                </div>
            </div>
        
            <!-- Thu nhập trong ngày -->
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-primary pull-right">Monthly</span>
                        <h5>Revenue</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">${{ number_format($monthlyRevenue) }}</h1>
                        <small>Revenue Monthly</small>
                    </div>
                </div>
            </div>
        
            <!-- Số lượng sản phẩm bán ra trong tháng -->
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-danger pull-right">Monthly</span>
                        <h5>Products Sold</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{ $totalProductsSoldThisMonth }}</h1>
                        <small>Products sold this month</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt10" id="annual-div" style="display:none;">
            <!-- Thu nhập hàng tháng -->
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-success pull-right">This Year</span>
                        <h5>Income</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">${{ number_format($totalIncomeThisYear) }}</h1>
                        <small>Total income this year</small>
                    </div>
                </div>
            </div>
        
            <!-- Số đơn hàng hàng năm -->
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-info pull-right">This Year</span>
                        <h5>Orders</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{ $totalOrdersThisYear }}</h1>
                        <small>Total orders this year</small>
                    </div>
                </div>
            </div>
        
            <!-- Thu nhập trong ngày -->
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-primary pull-right">This Year</span>
                        <h5>Revenue this year</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">${{ number_format($yearlyRevenue) }}</h1>
                        <small>Revenue this year</small>
                    </div>
                </div>
            </div>
        
            <!-- Số lượng sản phẩm bán ra trong tháng -->
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-danger pull-right">This Year</span>
                        <h5>Products Sold</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{ $totalProductsSoldThisYear }}</h1>
                        <small>Products sold this year</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt10" id="all-div" style="display:none;">
            <!-- Thu nhập hàng tháng -->
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-success pull-right">All</span>
                        <h5>Income</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">${{ number_format($totalIncomeAll) }}</h1>
                        <small>Total income all</small>
                    </div>
                </div>
            </div>
        
            <!-- Số đơn hàng hàng năm -->
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-info pull-right">All</span>
                        <h5>Orders</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{ $totalOrdersAll }}</h1>
                        <small>Total orders all</small>
                    </div>
                </div>
            </div>
        
            <!-- Thu nhập trong ngày -->
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-primary pull-right">All</span>
                        <h5>Revenue</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">${{ number_format($allRevenue) }}</h1>
                        <small>Revenue all</small>
                    </div>
                </div>
            </div>
        
            <!-- Số lượng sản phẩm bán ra trong tháng -->
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-danger pull-right">All</span>
                        <h5>Products Sold</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{ $totalProductsSoldAll }}</h1>
                        <small>Products sold all</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5 id="chart-heading"></h5>
                    <div class="pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-xs btn-white active" id="revenue-btn">Revenue</button>
                            <button type="button" class="btn btn-xs btn-white" id="income-btn">Income</button>                           
                            <button type="button" class="btn btn-xs btn-white" id="orders-btn">Orders</button>
                            <button type="button" class="btn btn-xs btn-white" id="product-sold-btn">Product sold</button>
                        </div>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="flot-chart-content" id="flot-dashboard-chart" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt10">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Look up sales information over time</h5>
                    <div class="col-sm-4 ml20">
                        <input type="date" id="date_start">
                        <span>to</span>
                        <input type="date" id="date_end">
                    </div>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row mt10" id="today-div">
                        <div class="col-lg-3 income">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <span class="label label-success pull-right" id="income-label" style="margin-bottom: 10px">Today</span>
                                    <h5>Income</h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins" id="income-value">${{ number_format($totalIncomeToday) }}</h1>
                                    <small>Total income</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 orders">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <span class="label label-info pull-right" id="orders-label" style="margin-bottom: 10px">Today</span>
                                    <h5>Orders</h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins" id="orders-value">{{ $totalOrdersToday }}</h1>
                                    <small>Total orders</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 revenue">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <span class="label label-primary pull-right" id="revenue-label" style="margin-bottom: 10px">Today</span>
                                    <h5>Revenue</h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins" id="revenue-value">${{ number_format($dailyRevenue) }}</h1>
                                    <small>Revenue</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 products-sold">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <span class="label label-danger pull-right" id="products-sold-label" style="margin-bottom: 10px">Today</span>
                                    <h5>Products Sold</h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins" id="products-sold-value">{{ $totalProductsSoldToday }}</h1>
                                    <small>Products sold</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr style="margin: 20px 0; border-top: 1px solid #ddd;">

                    <div class="table-responsive">
                        <table id="orderSearchDate" class="tbf table" style="border: 1px solid #ddd; border-collapse: collapse;">
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
                                @foreach($OrdersToday as $order)
                                    <tr>
                                        <td>{{ $order->order_number }}</td>
                                        <td>{{ $order->name }}</td>
                                        <td>{{ $order->phone }}</td>
                                        <td>{{ $order->shipping_address }}</td>
                                        <td>{{ $order->total_amount }}</td>
                                        <td>{{ $order->status }}</td>
                                        <td>{{ $order->order_date }}</td>
                                        <td>
                                            <a href="{{ route('orders.detail', $order->id) }}" class="btn btn-info">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>            
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-lg-12">
        <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Best selling products </h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>   
            </div>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-sm-9 m-b-xs">
                    <div>
                        <div class="btn-group">
                            <button id="todayProductBestSelling" type="button" class="btn btn-xs btn-white">Today</button>
                            <button id="monthlyProductBestSelling" type="button" class="btn btn-xs btn-white active">Monthly</button>
                            <button id="annualProductBestSelling" type="button" class="btn btn-xs btn-white">Annual</button>
                            <button id="allProductBestSelling" type="button" class="btn btn-xs btn-white">All</button>
                        </div>
                    </div>
                </div>
               
            </div>
            <div class="table-responsive" id="todayProductBestSelling-div">
                <div class="ibox-content">

                    <table id="productBestSelling" class="tbf table mg10 mt20">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Catalog</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th width='320px'>Quantity</th>
                                <th>Sold</th>              
                                <th>Active</th>              
                                <th width='120px'>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bestSellProductToday as $key => $product) 
        
                            <tr>
                                <td>{{ $product->id }}</td>                                    
                                <td>{{ $product->name }}</td>                                    
                                <td>{{ $product->productCategory->name }}</td>                                                                       
                                <td><a href="{{ $product->thumb }}" target="_blank">
                                    <img src="{{ $product->thumb }}" height="40px"></a>
                                </td>
                                <td>${{ $product->price }}</td>                                    
                                <td>{{ $product->quantity }} 
                                    <div class="icon-add-quantity">
                                        <i class="fa fa-plus"></i>
                                        <a class="font-white" href="{{ route('products.addStock', ['product' => $product->id]) }}">
                                            Add quantity
                                        </a>
                                    </div>
        
                                    <div class="icon-add-quantity">
                                        <a class="font-white" href="{{ route('products.stockHistory', ['product' => $product->id]) }}">
                                            View Stock History
                                        </a>
                                    </div>
                                    
                                </td> 
                                <td>{{ $product->sold_count }}</td>
                                <td style="text-align: center">{!! \App\Helpers\Helper::active($product->active) !!}</td>   
                                <td>                    
                                    <div class="button-row1">                       
                                        <a style="margin: 1px" class="btn btn-success dim" 
                                            href="{{ route('products.edit', ['product' => $product->id]) }}">
                                            <i class="fa fa-edit (alias)"></i>
                                        </a>    
                                    </div>  
                                </td>
                            </tr>
                            @endforeach               
                        </tbody>      
                    </table>

                </div>
            </div>

            <div class="table-responsive" id="monthlyProductBestSelling-div">
                <div class="ibox-content">

                    <table id="productBestSelling" class="tbf table mg10 mt20">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Catalog</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th width='320px'>Quantity</th>
                                <th>Sold</th>
                                <th>Active</th>              
                                <th width='120px'>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bestSellProductThisMonth as $key => $product) 
        
                            <tr>
                                <td>{{ $product->id }}</td>                                    
                                <td>{{ $product->name }}</td>                                    
                                <td>{{ $product->productCategory->name }}</td>                                                                       
                                <td><a href="{{ $product->thumb }}" target="_blank">
                                    <img src="{{ $product->thumb }}" height="40px"></a>
                                </td>
                                <td>${{ $product->price }}</td>                                    
                                <td>{{ $product->quantity }} 
                                    <div class="icon-add-quantity">
                                        <i class="fa fa-plus"></i>
                                        <a class="font-white" href="{{ route('products.addStock', ['product' => $product->id]) }}">
                                            Add quantity
                                        </a>
                                    </div>
        
                                    <div class="icon-add-quantity">
                                        <a class="font-white" href="{{ route('products.stockHistory', ['product' => $product->id]) }}">
                                            View Stock History
                                        </a>
                                    </div>
                                    
                                </td> 
                                <td>{{ $product->sold_count }}</td>
                                <td style="text-align: center">{!! \App\Helpers\Helper::active($product->active) !!}</td>   
                                <td>                    
                                    <div class="button-row1">                       
                                        <a style="margin: 1px" class="btn btn-success dim" 
                                            href="{{ route('products.edit', ['product' => $product->id]) }}">
                                            <i class="fa fa-edit (alias)"></i>
                                        </a>    
                  
                                    </div>  
                                </td>
                            </tr>
                            @endforeach               
                        </tbody>      
                    </table>

                </div>
            </div>

            <div class="table-responsive" id="annualProductBestSelling-div">
                <div class="ibox-content">

                    <table id="productBestSelling" class="tbf table mg10 mt20">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Catalog</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th width='320px'>Quantity</th>
                                <th>Sold</th>
                                <th>Active</th>              
                                <th width='120px'>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bestSellProductThisYear as $key => $product) 
        
                            <tr>
                                <td>{{ $product->id }}</td>                                    
                                <td>{{ $product->name }}</td>                                    
                                <td>{{ $product->productCategory->name }}</td>                                                                       
                                <td><a href="{{ $product->thumb }}" target="_blank">
                                    <img src="{{ $product->thumb }}" height="40px"></a>
                                </td>
                                <td>${{ $product->price }}</td>                                    
                                <td>{{ $product->quantity }} 
                                    <div class="icon-add-quantity">
                                        <i class="fa fa-plus"></i>
                                        <a class="font-white" href="{{ route('products.addStock', ['product' => $product->id]) }}">
                                            Add quantity
                                        </a>
                                    </div>
        
                                    <div class="icon-add-quantity">
                                        <a class="font-white" href="{{ route('products.stockHistory', ['product' => $product->id]) }}">
                                            View Stock History
                                        </a>
                                    </div>
                                    
                                </td> 
                                <td>{{ $product->sold_count }}</td>
                                <td style="text-align: center">{!! \App\Helpers\Helper::active($product->active) !!}</td>   
                                <td>                    
                                    <div class="button-row1">                       
                                        <a style="margin: 1px" class="btn btn-success dim" 
                                            href="{{ route('products.edit', ['product' => $product->id]) }}">
                                            <i class="fa fa-edit (alias)"></i>
                                        </a>    
                            
                                    </div>  
                                </td>
                            </tr>
                            @endforeach               
                        </tbody>      
                    </table>

                </div>
            </div>

            <div class="table-responsive" id="allProductBestSelling-div">
                <div class="ibox-content">

                    <table id="productBestSelling" class="tbf table mg10 mt20">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Catalog</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th width='320px'>Quantity</th>
                                <th>Sold</th>
                                <th>Active</th>              
                                <th width='120px'>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bestSellProductAll as $key => $product) 
        
                            <tr>
                                <td>{{ $product->id }}</td>                                    
                                <td>{{ $product->name }}</td>                                    
                                <td>{{ $product->productCategory->name }}</td>                                                                       
                                <td><a href="{{ $product->thumb }}" target="_blank">
                                    <img src="{{ $product->thumb }}" height="40px"></a>
                                </td>
                                <td>${{ $product->price }}</td>                                    
                                <td>{{ $product->quantity }} 
                                    <div class="icon-add-quantity">
                                        <i class="fa fa-plus"></i>
                                        <a class="font-white" href="{{ route('products.addStock', ['product' => $product->id]) }}">
                                            Add quantity
                                        </a>
                                    </div>
        
                                    <div class="icon-add-quantity">
                                        <a class="font-white" href="{{ route('products.stockHistory', ['product' => $product->id]) }}">
                                            View Stock History
                                        </a>
                                    </div>
                                    
                                </td> 
                                <td>{{ $product->sold_count }}</td>
                                <td style="text-align: center">{!! \App\Helpers\Helper::active($product->active) !!}</td>   
                                <td>                    
                                    <div class="button-row1">                       
                                        <a style="margin: 1px" class="btn btn-success dim" 
                                            href="{{ route('products.edit', ['product' => $product->id]) }}">
                                            <i class="fa fa-edit (alias)"></i>
                                        </a>    
                                    </div>  
                                </td>
                            </tr>
                            @endforeach               
                        </tbody>      
                    </table>

                </div>
            </div>

        </div>
        </div>
        </div>

    </div>

    <div class="row">

        <div class="col-lg-12">
        <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Top customers </h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>   
            </div>
        </div>
        <div class="ibox-content">
            <div class="table-responsive">
                <div class="ibox-content">
                    <table class="tbf table mg10 mt20">
                        <thead>
                            <tr>
                                <th>Customer code</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Avatar</th>                            
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Amount order</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topCustomers as $key => $customer) 

                        <tr>
                            <td>{{ $customer->id }}</td>                                    
                            <td>{{ $customer->name }}</td>                                    
                            <td>{{ $customer->username }}</td> 
                            @if($customer->thumb == null)
                            <td></td>
                            @else
                                <td>
                                    <a href="{{ $customer->thumb }}" target="_blank">
                                        <img src="{{ $customer->thumb }}" height="30px">
                                    </a>
                                </td>
                            @endif                                   
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->email }}</td>
                            <td style="text-align: center">{!! \App\Helpers\Helper::active($customer->active) !!}</td>   
                            <td>{{ $customer->orders->count() }}</td>
                            <td>                    
                                <div class="button-row1">                       
                                    <a style="margin: 1px" class="btn btn-success dim" 
                                        href="{{ route('customers.edit', ['id' => $customer->id]) }}">
                                        <i class="fa fa-edit (alias)"></i>
                                    </a>    
                                    <a style="margin: 1px" class="btn btn-danger  dim " href="#"
                                        onclick="removeRow({{ $customer->id }}, '{{ route('customers.destroy', ['id' => $customer->id]) }}')">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>  
                            </td>
                        </tr>
                        @endforeach
  
                        </tbody>      
                    </table>

                </div>
            </div>

        </div>
        </div>
        </div>

    </div>



@endsection()
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.min.js"></script>

<script src="/admin/js/home.js"></script>
<script src="/admin/js/homebestsellproduct.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flot.tooltip/0.9.0/jquery.flot.tooltip.min.js"></script>

<script>
    $(function() {
        let incomeData = {!! json_encode($incomeData) !!};
        let revenueData = {!! json_encode($revenueData) !!};
        let orderData = {!! json_encode($orderData) !!};
        let productSoldData = {!! json_encode($productSoldData) !!};

        incomeData = Array.isArray(incomeData) ? incomeData : JSON.parse(incomeData);
        revenueData = Array.isArray(revenueData) ? revenueData : JSON.parse(revenueData);
        orderData = Array.isArray(orderData) ? orderData : JSON.parse(orderData);
        productSoldData = Array.isArray(productSoldData) ? productSoldData : JSON.parse(productSoldData);

        function preparePlotData(data) {
            return data.map((value, index) => [index + 1, value]);
        }

        function updatePlot(data, label) {
            const plotData = preparePlotData(data);

            if ($.plot) {
                $.plot("#flot-dashboard-chart", [
                    {
                        data: plotData,
                        label: label,
                        color: "#1ab394"
                    }
                ], {
                    series: {
                        lines: { show: true, fill: true },
                        points: { show: true }
                    },
                    xaxis: {
                        ticks: [[1, "Jan"], [2, "Feb"], [3, "Mar"], [4, "Apr"], [5, "May"], [6, "Jun"], [7, "Jul"], [8, "Aug"], [9, "Sep"], [10, "Oct"], [11, "Nov"], [12, "Dec"]]
                    },
                    yaxis: {
                        tickFormatter: function(val) { return "" + val; }
                    },
                    grid: {
                        hoverable: true,
                        clickable: true,
                        borderWidth: 1,
                        borderColor: "#ddd"
                    },
                    tooltip: true,
                    tooltipOpts: {
                        content: "%s: %y",
                        shifts: {
                            x: -60,
                            y: 25
                        },
                        defaultTheme: false
                    }
                });
            } else {
                console.error("Flot library is not loaded.");
            }
            $("#chart-heading").text(label);
        }

        updatePlot(revenueData, "Revenue($)");

        $('#income-btn').click(function() {
            $(this).addClass('active').siblings().removeClass('active');
            updatePlot(incomeData, "Income($)");
        });

        $('#revenue-btn').click(function() {
            $(this).addClass('active').siblings().removeClass('active');
            updatePlot(revenueData, "Revenue($)");
        });

        $('#orders-btn').click(function() {
            $(this).addClass('active').siblings().removeClass('active');
            updatePlot(orderData, "Orders");
        });

        $('#product-sold-btn').click(function() {
            $(this).addClass('active').siblings().removeClass('active');
            updatePlot(productSoldData, "Product Sold");
        });
    });
</script>

