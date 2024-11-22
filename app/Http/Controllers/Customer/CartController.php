<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    
    public function addToCart(Request $request)
    {
        if (!Auth::guard('customer')->check()) {
            return response()->json(['success' => false, 'message' => 'You need to login to add products to cart.']);
        }

        $customer = Auth::guard('customer')->user();
        $product = Product::findOrFail($request->product_id);
        $quantity = $request->num_product ?? 1;

        if ($quantity > $product->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'The product "' . $product->name . '" does not have enough stock. Available quantity: ' . $product->quantity
            ]);
        }
    
        $cart = Cart::firstOrCreate(['customer_id' => $customer->id]);
    
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();
    
        if ($cartItem) {
            
            if ($cartItem->quantity + $quantity > $product->quantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'The product "' . $product->name . '" does not have enough stock to fulfill this quantity. Available quantity: ' . $product->quantity
                ]);
            }
    
            $cartItem->quantity += $quantity;
            $cartItem->total = $cartItem->quantity * $cartItem->price;
            $cartItem->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $product->price_sale,
                'total' => $quantity * $product->price_sale,
            ]);
        }
    
        $cart->load('items.product'); 
        return response()->json(['success' => true, 'message' => 'Product has been added to cart.', 'cart' => $cart]);
    }



    public function showCart()
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('customer.login')->with('error', 'You need to login to go to cart.');
        }

        $customerId = Auth::guard('customer')->id();

        $cart = Cart::where('customer_id', $customerId)->with('items.product')->first();

        $subtotal = $cart ? $cart->items->sum('total') : 0;

        return view('customer.carts.list', compact('cart', 'subtotal'));
    }

    public function removeItem($id)
    {
        try {
            $cartItem = CartItem::findOrFail($id); 

            $cart = Cart::find($cartItem->cart_id); 

            if (!$cart) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Cart not found'
                ], 404); 
            }

            $cartItem->delete(); 
            
            $cartTotal = $cart->items->sum('total');
            
            $cartsmall = Cart::with('items.product')->where('customer_id', Auth::guard('customer')->id())->first();

            return response()->json([
                'status' => 'success',
                'message' => 'Item removed successfully',
                'cartsmall' => $cartsmall,
                'cartTotal' => $cartTotal
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong',
            ], 500);
        }
    }

    public function updateQuantity(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        try {
            $cartItem = CartItem::findOrFail($id);
            $product = $cartItem->product;

            // Kiểm tra nếu số lượng yêu cầu vượt quá tồn kho
            if ($request->quantity > $product->quantity) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'The product "' . $product->name . '" does not have enough stock. Available quantity: ' . $product->quantity,
                ]);
            }

            // Cập nhật số lượng và tổng tiền nếu số lượng hợp lệ
            $cartItem->quantity = $request->quantity;
            $cartItem->total = $product->price_sale * $cartItem->quantity; 
            $cartItem->save();

            // Lấy lại giỏ hàng sau khi cập nhật
            $cartsmall = Cart::with('items.product')->where('customer_id', Auth::guard('customer')->id())->first();

            return response()->json([
                'status' => 'success',
                'message' => 'Quantity updated successfully',
                'total' => number_format($cartItem->total),
                'subtotal' => number_format($cartItem->cart->items->sum('total')), 
                'cartsmall' => $cartsmall,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong',
            ], 500);
        }
    }

}

