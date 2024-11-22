<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MainController extends Controller
{

    public function index()
    {
        $waitingForConfirmationCount = Order::where('status', 'pending')->count();
        $waitingForPickupCount = Order::where('status', 'orderconfirmed')->count();
        $shipping = Order::where('status', 'shipping')->count();
        $cancellationCount = Order::where('status', 'cancelled')->count();
        $outOfStockCount = Product::where('quantity', 0)->count();
        $warningCount = Order::where('status', 'warning')->count();

        //Revenue
        $monthlyTotalAmount = Order::whereMonth('order_date', now()->month)->where('status', 'received')->sum('total_amount');
        $monthlyTotalImport = Order::whereMonth('order_date', now()->month)->where('status', 'received')->sum('total_import');
        $monthlyRevenue = $monthlyTotalAmount - $monthlyTotalImport;

        $yearlyTotalAmount = Order::whereYear('order_date', now()->year)->where('status', 'received')->sum('total_amount');
        $yearlyTotalImport = Order::whereYear('order_date', now()->year)->where('status', 'received')->sum('total_import');
        $yearlyRevenue = $yearlyTotalAmount - $yearlyTotalImport;

        $dailyTotalAmount = Order::whereDate('order_date', today())->where('status', 'received')->sum('total_amount');
        $dailyTotalImport = Order::whereDate('order_date', today())->where('status', 'received')->sum('total_import');
        $dailyRevenue = $dailyTotalAmount - $dailyTotalImport;

        $allRevenue = Order::where('status', 'received')->sum('total_amount') - Order::where('status', 'received')->sum('total_import');

        // Income
        $totalIncomeThisMonth = Order::whereMonth('order_date', now()->month)->where('status', 'received')->sum('total_amount');
        $totalIncomeThisYear = Order::whereYear('order_date', now()->year)->where('status', 'received')->sum('total_amount');
        $totalIncomeToday = Order::whereDate('order_date', today())->where('status', 'received')->sum('total_amount');
        $totalIncomeAll = Order::where('status', 'received')->sum('total_amount');

        // Orders
        $totalOrdersThisMonth = Order::whereMonth('order_date', now()->month)->count();
        $totalOrdersThisYear = Order::whereYear('order_date', now()->year)->count();
        $totalOrdersToday = Order::whereDate('order_date', today())->count();       
        $totalOrdersAll = Order::count();

        $OrdersToday = Order::whereDate('order_date', today())->get(); 

        // Product sold_count
        $totalProductsSoldThisMonth = OrderDetail::whereHas('order', function ($query) {
            $query->whereMonth('created_at', now()->month)->where('status', 'received');
        })->sum('quantity');

        $totalProductsSoldThisYear = OrderDetail::whereHas('order', function ($query) {
            $query->whereYear('created_at', now()->year)->where('status', 'received');
        })->sum('quantity');

        $totalProductsSoldToday = OrderDetail::whereHas('order', function ($query) {
            $query->whereDate('created_at', today())->where('status', 'received');
        })->sum('quantity');

        $totalProductsSoldAll = OrderDetail::whereHas('order', function ($query) {
            $query->where('status', 'received');
        })->sum('quantity');

        //product best selling
        $bestSellProductToday = Product::join('order_details', 'products.id', '=', 'order_details.product_id')
            ->whereDate('order_details.created_at', today())
            ->select('products.*', DB::raw('SUM(order_details.quantity) as total_sold'))
            ->groupBy('products.id', 'products.name', 'products.price', 'products.price_sale', 'products.quantity', 
            'products.description', 'products.content', 'products.thumb', 'products.product_category_id', 'products.thumb2', 
            'products.images',  'products.active', 'products.sold_count', 'products.created_at', 'products.updated_at')  
            ->orderByDesc('total_sold')
            ->take(10)
            ->get();

        $bestSellProductThisMonth = Product::join('order_details', 'products.id', '=', 'order_details.product_id')
            ->whereMonth('order_details.created_at', now()->month)
            ->whereYear('order_details.created_at', now()->year)
            ->select('products.*', DB::raw('SUM(order_details.quantity) as total_sold'))
            ->groupBy('products.id', 'products.name', 'products.price', 'products.price_sale', 'products.quantity', 
            'products.description', 'products.content', 'products.thumb', 'products.product_category_id', 'products.thumb2', 
            'products.images',  'products.active', 'products.sold_count', 'products.created_at', 'products.updated_at')  
            ->orderByDesc('total_sold')
            ->take(10)
            ->get();

        $bestSellProductThisYear = Product::join('order_details', 'products.id', '=', 'order_details.product_id')
            ->whereYear('order_details.created_at', now()->year)
            ->select('products.*', DB::raw('SUM(order_details.quantity) as total_sold'))
            ->groupBy('products.id', 'products.name', 'products.price', 'products.price_sale', 'products.quantity', 
            'products.description', 'products.content', 'products.thumb', 'products.product_category_id', 'products.thumb2', 
            'products.images',  'products.active', 'products.sold_count', 'products.created_at', 'products.updated_at')  
            ->orderByDesc('total_sold')
            ->take(10)
            ->get();

        $bestSellProductAll = Product::join('order_details', 'products.id', '=', 'order_details.product_id')
            ->select('products.*', DB::raw('SUM(order_details.quantity) as total_sold'))
            ->groupBy('products.id', 'products.name', 'products.price', 'products.price_sale', 'products.quantity', 
            'products.description', 'products.content', 'products.thumb', 'products.product_category_id', 'products.thumb2', 
            'products.images',  'products.active', 'products.sold_count', 'products.created_at', 'products.updated_at')  
            ->orderByDesc('total_sold')
            ->take(10)
            ->get();


        //income chart
        $monthlyIncomeData = Order::whereYear('order_date', now()->year)
            ->where('status', 'received')
            ->selectRaw('MONTH(order_date) as month, SUM(total_amount) as total')
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        $incomeData = array_fill(1, 12, 0); 
        foreach ($monthlyIncomeData as $data) {
            $incomeData[$data->month] = $data->total;
        }

        //revenue chart 
        $monthlyRevenueData = Order::whereYear('order_date', now()->year)
            ->where('status', 'received')
            ->selectRaw('MONTH(order_date) as month, SUM(total_amount) - SUM(total_import) as total')
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        $revenueData = array_fill(1, 12, 0); 

        foreach ($monthlyRevenueData as $data) {
            $revenueData[$data->month] = $data->total; 
        }

        // orders chart
        $monthlyOrderData = Order::whereYear('order_date', now()->year)
            ->selectRaw('MONTH(order_date) as month, COUNT(id) as total') 
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();
      
        $orderData = array_fill(1, 12, 0); 
        foreach ($monthlyOrderData as $data) {
            $orderData[$data->month] = $data->total;
        }

        // products sold chart
        $monthlyProductData = OrderDetail::whereHas('order', function($query) {
            $query->where('status', 'received');
        })
            ->whereYear('created_at', now()->year)
            ->selectRaw('MONTH(created_at) as month, SUM(quantity) as total')
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();
            
        $productSoldData = array_fill(1, 12, 0); 
        foreach ($monthlyProductData as $data) {
            $productSoldData[$data->month] = $data->total;
        }

        return view('admin.component.home', [
            'title' => 'Dashboard Admin',
            'waitingForConfirmationCount' => $waitingForConfirmationCount,
            'waitingForPickupCount' => $waitingForPickupCount,
            'shipping' => $shipping,
            'cancellationCount' => $cancellationCount,
            'outOfStockCount' => $outOfStockCount,
            'warningCount' => $warningCount,

            'monthlyRevenue' => $monthlyRevenue,
            'yearlyRevenue' => $yearlyRevenue,
            'dailyRevenue' => $dailyRevenue,
            'allRevenue' => $allRevenue,

            'totalIncomeAll' => $totalIncomeAll,
            'totalIncomeThisMonth' => $totalIncomeThisMonth,
            'totalIncomeThisYear' => $totalIncomeThisYear,
            'totalIncomeToday' => $totalIncomeToday,

            'totalOrdersThisMonth' => $totalOrdersThisMonth,
            'totalOrdersThisYear' => $totalOrdersThisYear,
            'totalOrdersToday' => $totalOrdersToday,
            'totalOrdersAll' => $totalOrdersAll,
            
            'OrdersToday' => $OrdersToday,

            'bestSellProductThisMonth' => $bestSellProductThisMonth,
            'bestSellProductToday' => $bestSellProductToday,
            'bestSellProductThisYear' => $bestSellProductThisYear,
            'bestSellProductAll' => $bestSellProductAll,

            'totalProductsSoldThisMonth' => $totalProductsSoldThisMonth,
            'totalProductsSoldThisYear' => $totalProductsSoldThisYear,
            'totalProductsSoldToday' => $totalProductsSoldToday,
            'totalProductsSoldAll' => $totalProductsSoldAll,

            'incomeData' => json_encode(array_values($incomeData)),
            'revenueData' => json_encode(array_values($revenueData)),
            'orderData' => json_encode(array_values($orderData)),
            'productSoldData' => json_encode(array_values($productSoldData)),
        ]);
    }


    public function getSalesData(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        // Query data for the specified date range
        $income = Order::whereBetween('order_date', [$startDate, $endDate])->sum('total_amount');
        $import = Order::whereBetween('order_date', [$startDate, $endDate])->sum('total_import');
        $revenue = $income - $import;
        $orders = Order::whereBetween('order_date', [$startDate, $endDate])->count();
        $productsSold = OrderDetail::whereHas('order', function($query) use ($startDate, $endDate) {
            $query->whereBetween('order_date', [$startDate, $endDate]);
        })->sum('quantity');

        // Retrieve filtered orders
        $filteredOrders = Order::whereBetween('order_date', [$startDate, $endDate])->get();

        // Return data as JSON
        return response()->json([
            'status' => 'success',
            'income' => $income,
            'revenue' => $revenue,
            'orders' => $orders,
            'products_sold' => $productsSold,
            'filtered_orders' => $filteredOrders, // Include the filtered orders
        ]);
    }


}
