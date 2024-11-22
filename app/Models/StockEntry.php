<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockEntry extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'quantity_added', 'import_price', 'total', 'sold_count'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
