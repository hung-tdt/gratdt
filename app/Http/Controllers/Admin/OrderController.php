<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Notifications\OrderStatusNotification;

class OrderController extends Controller
{
    public function list()
    {
        $orders = Order::orderBy('created_at', 'desc')->paginate(10); 
        return view('admin.orders.list', compact('orders'));
    }

    public function pending()
    {
        $orders = Order::where('status', 'pending')
                   ->orderBy('created_at', 'desc')
                   ->paginate(10);
        return view('admin.orders.confirmer.pending', compact('orders'));
    }

    public function updateOrderconfirmed(Request $request, Order $order)
    {
        $order->status = $request->status;
        $order->save();

        // Gửi thông báo
        $this->sendOrderStatusNotification($order, 'has been confirmed');

        return redirect()->route('orders.pending')->with('success', 'Order confirmed successfully.');
    }

    public function orderconfirmedDetail(Order $order)
    {
        $order->load('orderDetails.product');
        
        return view('admin.orders.confirmer.order-comfirm-detail', compact('order'));
    }

    public function exportOrderPdf(Order $order)
    {
        $order->load('orderDetails.product'); 

        $pdf = new Dompdf();
    
        $html = view('admin.orders.confirmer.export', compact('order'))->render();

        $pdf->loadHtml($html);

        $pdf->setPaper('A4', 'portrait');

        $pdf->render();

        return $pdf->stream('order_details.pdf');
    }


    public function orderconfirmed()
    {
        $orders = Order::where('status', 'orderconfirmed')
                   ->orderBy('created_at', 'desc')
                   ->paginate(10);
        return view('admin.orders.sender.order-confirmed', compact('orders'));
    }

    public function shippingconfirmedDetail(Order $order)
    {
        $order->load('orderDetails.product');
        
        return view('admin.orders.sender.shipping-comfirm-detail', compact('order'));
    }

    public function updateshippingconfirmed(Request $request, Order $order)
    {
        $order->status = $request->status;
        $order->save();

        // Gửi thông báo
        $this->sendOrderStatusNotification($order, 'has been shipping');

        return redirect()->route('orders.orderconfirmed')->with('success', 'Shipping confirmed successfully.');
    }

    public function shipping()
    {
        $orders = Order::where('status', 'shipping')
                   ->orderBy('created_at', 'desc')
                   ->paginate(10);
        return view('admin.orders.shiper.shipping', compact('orders'));
    }


    public function received()
    {
        $orders = Order::where('status', 'received')
                   ->orderBy('created_at', 'desc')
                   ->paginate(10);
        return view('admin.orders.received', compact('orders'));
    }

    public function cancelled()
    {
        $orders = Order::where('status', 'cancelled')
                   ->orderBy('created_at', 'desc')
                   ->paginate(10);
        return view('admin.orders.cancelled', compact('orders'));
    }

    public function receivedupdate(Request $request, Order $order)
    {
        $order->status = 'received';
        $order->save();

        // Cập nhật số lượng bán
        foreach ($order->details as $detail) {
            $product = Product::find($detail->product_id);

            if ($product) {
                $product->sold_count += $detail->quantity;
                $product->save();
            }
        }

        // Gửi thông báo
        $this->sendOrderStatusNotification($order, 'delivered successfully');

        return redirect()->back()->with('success', 'Order received successfully, and product sold counts have been updated.');
    }

    public function canceledupdate(Request $request, Order $order)
{
        $order->status = 'cancelled';
        $order->save();

        // Khôi phục số lượng sản phẩm
        foreach ($order->details as $detail) {
            $product = Product::find($detail->product_id);

            if ($product) {
                $product->quantity += $detail->quantity;
                $product->save();
            }
        }

        // Gửi thông báo
        $this->sendOrderStatusNotification($order, 'has been cancelled');

        return redirect()->back()->with('success', 'Order has been cancelled successfully, and product quantities have been restored.');
    }

    public function detail(Order $order)
    {
        $order->load('orderDetails.product');
        
        return view('admin.orders.detail', compact('order'));
    }

    public function search(Request $request)
    {
        $query = Order::query();

        if ($request->order_number) {
            $query->where('order_number', 'like', '%' . $request->order_number . '%');
        }
        if ($request->phone) {
            $query->where('phone', 'like', '%' . $request->phone . '%');
        }
        if ($request->status) {
            $query->where('status', 'like', '%' . $request->status . '%');
        }
        if ($request->address) {
            $query->where('address', 'like', '%' . $request->address . '%');
        }

        if ($request->start_date) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->end_date) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $orders = $query->get();

        return view('admin.orders.order_table', compact('orders'))->render();
    }

    public function exportPdf(Request $request)
    {
        $query = Order::query();


        if ($request->order_number) {
            $query->where('order_number', 'like', '%' . $request->order_number . '%');
        }
        if ($request->phone) {
            $query->where('phone', 'like', '%' . $request->phone . '%');
        }
        if ($request->status) {
            $query->where('status', 'like', '%' . $request->status . '%');
        }
        if ($request->shipping_address) {
            $query->where('shipping_address', 'like', '%' . $request->shipping_address . '%');
        }
        if ($request->start_date) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->end_date) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $orders = $query->get();
 
        $pdf = PDF::loadHTML(view('admin.orders.export_pdf', compact('orders'))->render());

        return $pdf->download('orders_report.pdf');
    }

    protected function sendOrderStatusNotification(Order $order, string $statusMessage)
    {
        $customer = $order->customer;

        if ($customer) {
            $customer->notify(new OrderStatusNotification($order->id, $order->order_number, $statusMessage));
        }
    }
}


