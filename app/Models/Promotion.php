<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'start_date', 
        'end_date', 
        'active',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_promotion')
                    ->withPivot('discount_price', 'discount_percentage')
                    ->withTimestamps();
    }
    
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];
}
