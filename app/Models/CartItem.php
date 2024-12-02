<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = ['cart_id', 'product_id', 'quantity', 'price', 'total'];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getDiscountedPriceAttribute()
    {
        return $this->product->discounted_price ?? $this->product->price;
    }

    public function getTotalAttribute()
    {
        return $this->discounted_price * $this->quantity;
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function ($cartItem) {
            $price = $cartItem->product->discounted_price ?? $cartItem->product->price;
            $cartItem->total = $cartItem->discounted_price * $cartItem->quantity;
        });
    }

}
