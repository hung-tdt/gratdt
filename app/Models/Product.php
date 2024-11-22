<?php

namespace App\Models;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'content',
        'product_category_id',
        'price',
        'price_sale',
        'active',
        'thumb',
        'thumb2',
        'images',
        'quantity',
        'sold_count'
    ];
    
    protected $casts = [
        'images' => 'json',
    ];

    public function productCategory()
    {
        return $this->hasOne(ProductCategory::class, 'id', 'product_category_id');  
    }

    public function attributes()
    {
        return $this->hasMany(Attribute::class, 'product_id', 'id');
    }

    public function stockEntries()
    {
        return $this->hasMany(StockEntry::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
