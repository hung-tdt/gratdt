<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function list()
    {
        $coupons = Coupon::all();
        return view('admin.coupons.list', compact('coupons'));
    }

    public function add()
    {
        return view('admin.coupons.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:coupons,code',
            'discount_type' => 'required',
            'discount_value' => 'required|min:0',
            'max_uses' => 'nullable|integer|min:1',
            'expiry_date' => 'nullable|date',
        ]);

        Coupon::create($request->all());

        return redirect()->route('coupons.list')->with('success', 'Coupon created successfully.');
    }

    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'code' => 'required|unique:coupons,code,' . $coupon->id,
            'discount_type' => 'required',
            'discount_value' => 'required|min:0',
            'max_uses' => 'nullable|integer|min:1',
            'expiry_date' => 'nullable|date',
        ]);

        $coupon->update($request->all());

        return redirect()->route('coupons.list')->with('success', 'Coupon updated successfully.');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('coupons.list')->with('success', 'Coupon deleted successfully.');
    }
}