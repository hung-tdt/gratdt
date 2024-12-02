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

    public function promotions()
    {
        return $this->belongsToMany(Promotion::class, 'product_promotion')
                    ->withPivot('discount_price', 'discount_percentage')
                    ->where('start_date', '<=', now())
                    ->where('end_date', '>=', now())
                    ->where('active', true);
    }

    public function getActivePromotionEndDateAttribute()
    {
        $promotion = $this->promotions()->first(); 

        if ($promotion) {
            return $promotion->end_date; 
        }   
        return null; 
    }

    public function getDiscountedPriceAttribute()
    {
        $promotion = $this->promotions->first();

        if ($promotion) {
            if ($promotion->pivot->discount_price) {
                return $promotion->pivot->discount_price;
            }

            if ($promotion->pivot->discount_percentage) {
                return $this->price - ($this->price * $promotion->pivot->discount_percentage / 100);
            }
        }
        return $this->price;
    }
}
