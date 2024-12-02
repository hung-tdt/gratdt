<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id', 'order_number', 'discount', 'total_amount', 'total_import', 'status',
        'name', 'username', 'phone', 'email',
        'shipping_address', 'billing_address', 'payment_method',
        'payment_status', 'order_date', 'shipping_date', 'delivered_date', 'notes'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    protected $casts = [
        'order_date' => 'datetime', 
    ];
}

