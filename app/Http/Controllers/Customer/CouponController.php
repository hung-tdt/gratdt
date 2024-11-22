<?php

namespace App\Http\Controllers\Customer; 

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function showAvailableCoupons()
    {
        $availableCoupons = Coupon::where('active', 1)
            ->where('expiry_date', '>', now())
            ->get();

        return view('customer.coupons.available', compact('availableCoupons'));
    }

    public function saveCoupon(Request $request)
    {
        if (auth()->check()) {
            $customer = auth()->customer();

            $coupon = Coupon::where('code', $request->coupon_code)->first();

            if ($coupon) {
                $alreadySaved = SavedCoupon::where('customer_id', $customer->id)
                    ->where('coupon_id', $coupon->id)
                    ->exists();

                if (!$alreadySaved) {
                    SavedCoupon::create([
                        'customer_id' => $customer->id,
                        'coupon_id' => $coupon->id,
                    ]);

                    return redirect()->back()->with('success', 'Coupon saved successfully.');
                } else {
                    return redirect()->back()->with('error', 'You have already saved this coupon.');
                }
            }

            return redirect()->back()->with('error', 'Coupon not found.');
        }

        return redirect()->route('login')->with('error', 'You need to log in first.');
    }

}