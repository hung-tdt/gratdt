<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Coupon;

use App\Models\Province;
use App\Models\District;
use App\Models\Ward;

use App\Http\Requests\Order\PlaceOrderRequest;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    public function checkout()
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('customer.login')->with('error', 'You need to login to checkout.');
        }

        $customer = auth()->guard('customer')->user();

        if (!$customer->address || !$customer->ward || !$customer->district || !$customer->province) {
            return redirect()->route('customer.profile', ['id' => $customer->id])
                ->with('error', 'Please complete your profile with a full address before proceeding to checkout.');
        }

        $province = $customer->province ? str_pad($customer->province->id, 2, '0', STR_PAD_LEFT) : 'Not provided';
        $district = $customer->district ? str_pad($customer->district->id, 3, '0', STR_PAD_LEFT) : 'Not provided';
        $ward = $customer->ward ? str_pad($customer->ward->id, 5, '0', STR_PAD_LEFT) : 'Not provided';

        $cart = $customer ? $customer->cart : null;
        $subtotal = 0;

        if ($cart) {
            $subtotal = $cart->items->sum('total'); 
        }

        $provinces = Province::all();
        $districts = District::all();
        $wards = Ward::all();

        return view('customer.orders.checkout', compact('cart', 'customer', 'subtotal','province', 'district', 'ward', 'provinces', 'districts', 'wards'));
    }

    public function createOrderNumber()
    {
   
        $today = date('Ymd');

        $orderCount = Order::whereDate('created_at', today())->count() + 1;
        $orderNumber = 'ORD-' . $today . '-' . str_pad($orderCount, 3, '0', STR_PAD_LEFT);

        return $orderNumber;
    }


    public function placeOrder(PlaceOrderRequest $request)
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('customer.login')->with('error', 'You need to login to place Order.');
        }

        foreach ($request->cart_items as $item) {
            $product = Product::find($item['product_id']);
            if ($item['quantity'] > $product->quantity) {
                return redirect()->back()->with('error', 'The product "' . $product->name . '" does not have enough stock. Available quantity: ' . $product->quantity);
            }
        }

        $data = $request->validated();

        if ($request->input('shipToDifferentAddress')) {
            $name = $request->input('other_name');
            $username = $request->input('other_username');
            $email = $request->input('other_email');
            $phone = $request->input('other_phone');

            $provinceId = str_pad((string) $request->province_id, 2, '0', STR_PAD_LEFT);
            $districtId = str_pad((string) $request->district_id, 3, '0', STR_PAD_LEFT);
            $wardId = str_pad((string) $request->ward_id, 5, '0', STR_PAD_LEFT);

            $ward = Ward::where('id', $wardId)->first();
            $district = District::where('id', $districtId)->first();
            $province = Province::where('id', $provinceId)->first();

            $shippingAddress = $request->input('other_address') . ', ' .
                ($ward ? $ward->full_name : '') . ', ' .
                ($district ? $district->full_name : '') . ', ' .
                ($province ? $province->full_name : '');
        } else {
            $name = $request->input('name');
            $username = $request->input('username');
            $email = $request->input('email');
            $phone = $request->input('phone');
            $shippingAddress = $request->input('shipping_address');
        }

        $orderNumber = $this->createOrderNumber();

        $totalAmount = 0;
        $totalImport = 0;
        foreach ($request->cart_items as $item) {
            $totalAmount += $item['quantity'] * $item['price'];

            $product = Product::find($item['product_id']);
            $quantityNeeded = $item['quantity'];

            $stockEntries = $product->stockEntries()->orderBy('created_at')->get();
            foreach ($stockEntries as $stockEntry) {
                if ($quantityNeeded <= 0) {
                    break;
                }

                $availableQuantity = $stockEntry->quantity_added - $stockEntry->sold_count;
                $deductibleQuantity = min($availableQuantity, $quantityNeeded);

                $totalImport += $deductibleQuantity * $stockEntry->import_price;

                $stockEntry->sold_count += $deductibleQuantity;
                $stockEntry->save();

                $quantityNeeded -= $deductibleQuantity;
            }
        }
        $discount = $request->input('discount');
        if (is_null($discount)) {
            $discount = 0;
        }
        $totalAmount -= $discount;

        $order = Order::create([
            'customer_id' => auth()->guard('customer')->id(),
            'order_number' => $orderNumber,
            'discount' => $discount,
            'total_amount' => $totalAmount,
            'total_import' => $totalImport,
            'status' => 'pending',
            'shipping_address' => $shippingAddress,
            'billing_address' => $request->input('billing_address'),
            'name' => $name,
            'username' => $username,
            'phone' => $phone,
            'email' => $email,
            'notes' => $request->input('notes'),
            'payment_method' => 'Cash on Delivery',
            'payment_status' => 'Not Paid',
            'order_date' => now(),
        ]);

        $couponCode = $request->input('code'); 
        $coupon = Coupon::where('code', $couponCode)->first(); // Tìm coupon theo mã
        $coupon->max_uses -= 1;
        $coupon->save();


        foreach ($request->cart_items as $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'total' => $item['quantity'] * $item['price'],
            ]);

            $product = Product::find($item['product_id']);
            $product->quantity -= $item['quantity'];
            $product->save();
        }

        $cart = auth()->guard('customer')->user()->cart;
        if ($cart) {
            $cart->items()->delete();
        }

        return redirect()->route('order.track', ['order' => $order]);
    }

    public function applyCoupon(Request $request)
    {
        $request->validate([
            'code' => 'required|string'
        ]);

        $coupon = Coupon::where('code', $request->input('code'))
            ->where('active', 1)
            ->where(function ($query) {
                $query->whereNull('expiry_date')->orWhere('expiry_date', '>=', now());
            })
            ->where('max_uses', '>', 0)  
            ->first();

        if (!$coupon) {
            return response()->json(['error' => 'Invalid or expired coupon code.'], 400);
        }

        $discount = 0;
        $subtotal = $request->input('subtotal'); 

        if ($coupon->discount_type == 1) { 
            $discount = ($subtotal * $coupon->discount_value) / 100;
        } elseif ($coupon->discount_type == 0) { 
            $discount = min($subtotal, $coupon->discount_value);
        }
        
        $total = $subtotal - $discount;

        return response()->json([
            'discount' => $discount,
            'total' => $total
        ]);
    }

    public function orderHistory()
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('customer.login')->with('error', 'You need to login to watch.');
        }
        $customerId = auth()->guard('customer')->id();
        $orders = Order::where('customer_id', $customerId)->orderBy('order_date', 'desc')->get();

        return view('customer.orders.history', compact('orders'));
    }

    public function trackOrder($id)
    {
        $order = Order::with('details.product')->findOrFail($id);

        if ($order->customer_id != auth()->guard('customer')->id()) {
            return redirect()->route('order.history')->with('error', 'You do not have permission to track this order.');
        }

        return view('customer.orders.track', compact('order'));
    }

    public function filterOrders(Request $request)
    {
        $query = Order::where('customer_id', auth()->guard('customer')->id()); 

        if ($request->status) {
            $query->where('status', $request->status); 
        }
        $orders = $query->get();
        return view('customer.orders.order_table', compact('orders'))->render();
    }

    public function cancelOrder($id)
    {
        $order = Order::find($id);

        if ($order && $order->status === 'pending') {
            foreach ($order->details as $detail) {
                $product = Product::find($detail->product_id);

                if ($product) {
                    $product->quantity += $detail->quantity;
                    $product->save();
                }
            }

            $order->status = 'cancelled';
            $order->save();

            return response()->json([
                'success' => true,
                'message' => 'The order has been cancelled successfully and the product quantities have been updated.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'You can only cancel pending orders.'
            ]);
        }
    }


}

