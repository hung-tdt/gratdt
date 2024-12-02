<?php
 
namespace App\Http\View\Composers;

use App\Models\Cart;
use Illuminate\View\View;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
 
class CartComposer
{
    
    public function __construct() 
    {

    }
     
    public function compose(View $view): void
    {
        if (Auth::guard('customer')->check()) {
            $customer = Auth::guard('customer')->user();
            $cart = Cart::where('customer_id', $customer->id)->with('items.product')->first();
        } else {
            $cart = null;
        }

        // Chia sẻ giỏ hàng với tất cả các view
        $view->with('cart', $cart); 
    }


}