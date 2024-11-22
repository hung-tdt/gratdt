<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Services\ProductCategory\ProductCategoryService;
use App\Models\ProductCategory;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProductCategoryController extends Controller
{
    protected $productCategoryService;
    public function __construct(ProductCategoryService $productCategoryService)
    {
        $this->productCategoryService = $productCategoryService;
    }

    public function categoryProduct($id, $slug)
    {
        $postLastest = Post::select('id', 'title', 'abstract', 'thumb', 'author', 'active', 'post_category_id', 'created_at','updated_at')
            ->orderbyDesc('id')
            ->limit(3)
            ->get();
        $hotdealProducts = Product::select('*', DB::raw('price / price_sale as discount_ratio'))
        ->orderByDesc('discount_ratio')
        ->limit(2)
        ->get();
        $bestSellerProducts = Product::orderbyDesc('sold_count')->limit(2)->get();
        $productCategory = $this->productCategoryService->getId($id);
        $products = $this->productCategoryService->getProduct($productCategory);

        return view('customer.products.productcategory',[
            'title' => $productCategory->name,
            'products' => $products,
            'productCategory' => $productCategory,
            'bestSellerProducts' =>  $bestSellerProducts,   
            'hotdealProducts' =>  $hotdealProducts,  
            'postLastest' =>  $postLastest
        ]);
    }
    
}
