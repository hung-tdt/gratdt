<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $table = 'coupons';

    protected $fillable = [
        'code',
        'discount_type',
        'discount_value',
        'max_uses',
        'expiry_date',
        'active'
    ];

    protected $casts = [
        'expiry_date' => 'date',
    ];

    public function isValid()
    {

        if ($this->expiry_date && $this->expiry_date->isPast()) {
            return false;
        }

        return $this->active;
    }

    public function savedByUser($customer)
    {
        if (!$customer) {
            return false;
        }

        return SavedCoupon::where('customer_id', $customer->id)
                          ->where('coupon_id', $this->id)
                          ->exists();
    }
}
