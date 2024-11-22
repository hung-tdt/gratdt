<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function addToWishlist(Request $request, $productId)
    {

        if (Auth::guard('customer')->check()) { 
            $customerId = Auth::guard('customer')->id();

            $exists = Wishlist::where('customer_id', $customerId)->where('product_id', $productId)->exists();

            if (!$exists) {
                Wishlist::create([
                    'customer_id' => $customerId,
                    'product_id' => $productId
                ]);

                return response()->json(['success' => true, 'message' => 'The product has been added to your wishlist.']);
            } else {

                return response()->json(['success' => false, 'message' => 'The product is already in your wishlist.']);
            }
        } else {

            return response()->json(['success' => false, 'message' => 'You need to login to add products to your wishlist.']);
        }
    }

    public function list()
    {

        if (auth('customer')->check()) {

            $wishlists = Wishlist::where('customer_id', auth('customer')->id())
                                ->with('product') 
                                ->get();


            return view('customer.wishlist.list', compact('wishlists'));
        } else {
        
            return redirect()->route('customer.login')->with('error', 'You need to login to view your favorites list.');
        }
    }

    public function removeFromWishlist(Request $request, $productId)
    {
        if (Auth::guard('customer')->check()) { 
            $customerId = Auth::guard('customer')->id();

            $wishlistItem = Wishlist::where('customer_id', $customerId)->where('product_id', $productId)->first();

            if ($wishlistItem) {
                $wishlistItem->delete();
                return response()->json(['success' => true, 'message' => 'The product has been removed from your wishlist.']);
            } else {
                return response()->json(['success' => false, 'message' => 'Product does not exist in wishlist.']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'You need to login to remove products from your wishlist.']);
        }
    }
}

