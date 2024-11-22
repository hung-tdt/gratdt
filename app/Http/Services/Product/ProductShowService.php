<?php

namespace App\Http\Services\Product;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Product;

class ProductShowService 
{
    const LIMIT=10;
    
    public function get()
    {
        return Product::select('id', 'name', 'price', 'price_sale', 'thumb', 'thumb2', 'quantity', 'description')
        ->orderBy('created_at', 'desc')
        ->limit(self::LIMIT)
        ->get();
    }

    public function getlike()
    {
        return Product::select('id', 'name', 'price', 'price_sale', 'thumb', 'thumb2', 'quantity', 'description')
        ->inRandomOrder()->limit(10)->get();
    }

    public function getAll()
    {
        return Product::select('id', 'name', 'price', 'price_sale', 'thumb', 'thumb2', 'quantity', 'description')
        ->orderbyDesc('id')
        ->paginate(12);
    }

    public function filterProductName($request)
    {
        $name = $request->input('name');
        return Product::select('id', 'name', 'price', 'price_sale', 'thumb', 'quantity', 'description')
        ->where('name', 'like', "%$name%")
        ->paginate(12);
    }


    public function show($id)
    {
        return Product::where('id', $id)
        ->where('active', 1)
        ->with('productCategory')
        ->firstOrFail();
    }

}