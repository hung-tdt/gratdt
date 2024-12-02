<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Services\Product\ProductShowService;
use App\Http\Services\ProductCategory\ProductCategoryService;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Post;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Review;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class ProductController extends Controller
{
    protected $productshowService;
    protected $productCategoryService;

    public function __construct(ProductShowService $productshowService, ProductCategoryService $productCategoryService)
    {
        $this->productshowService = $productshowService;
        $this->productCategoryService = $productCategoryService;
    }

    public function detail($id='', $slug='')
    {
        $product = $this->productshowService->show($id); 

        $productCategoryId = $product->product_category_id;
        $productCategory = ProductCategory::where('id', $productCategoryId)->where('active', 1)->firstOrFail();
        $productRelate = $this->productCategoryService->getProduct($productCategory);

        $productId = $product->id;
        // Lấy tất cả đánh giá của sản phẩm
        $reviews = Review::where('product_id', $product->id)->get();
        $reviewCount = Review::where('product_id', $product->id)->count();

        $averageRating = $reviews->avg('rating'); // Tính trung bình cộng của rating

        return view('customer.products.detail',[
            'title' => $product->name,
            'product' => $product,
            'productRelate' =>  $productRelate,
            'reviews' =>  $reviews,
            'averageRating' =>  $averageRating,
            'reviewCount' =>  $reviewCount,

        ]);
    }

    public function showAllShop() 
    {
        $postLastest = Post::select('id', 'title', 'abstract', 'thumb', 'author', 'active', 'post_category_id', 'created_at','updated_at')
            ->orderbyDesc('id')
            ->limit(3)
            ->get();
        $hotdealProducts = Product::with('promotions')
            ->get()
            ->filter(function ($product) {
                return $product->discounted_price < $product->price;
            })
            ->sortByDesc(function ($product) {
                return ($product->price - $product->discounted_price) / $product->price;
            })
            ->take(3);
        $bestSellerProducts = Product::orderbyDesc('sold_count')->limit(2)->get();
        $product = $this->productshowService->getAll();
        return view('customer.products.listAll',[
            'title' => 'Cửa hàng',
            'products' => $product,  
            'bestSellerProducts' =>  $bestSellerProducts,   
            'hotdealProducts' =>  $hotdealProducts,  
            'postLastest' =>  $postLastest,  
        ]);
    }

    public function search(Request $request)
    {
        $postLastest = Post::select('id', 'title', 'abstract', 'thumb', 'author', 'active', 'post_category_id', 'created_at','updated_at')
            ->orderbyDesc('id')
            ->limit(3)
            ->get();
        $hotdealProducts = Product::with('promotions')
            ->get()
            ->filter(function ($product) {
                return $product->discounted_price < $product->price;
            })
            ->sortByDesc(function ($product) {
                return ($product->price - $product->discounted_price) / $product->price;
            })
            ->take(3);
        $bestSellerProducts = Product::orderbyDesc('sold_count')->limit(2)->get();
       
        $query = $request->input('search');
        $products = Product::where('name', 'like', '%' . $query . '%')->paginate(12);
        
        return view('customer.products.listAll',[
            'title' => 'Cửa hàng',
            'products' => $products,  
            'bestSellerProducts' =>  $bestSellerProducts,   
            'hotdealProducts' =>  $hotdealProducts,  
            'postLastest' =>  $postLastest,  
        ]);
    }

    public function filterByPrice(Request $request)
    {
        $minPrice = $request->input('min_price', 0);  
        $maxPrice = $request->input('max_price', 1000);  

        $products = Product::whereBetween('price', [$minPrice, $maxPrice])->get();

        return view('customer.products.filterprice', compact('products'));
    }

    public function filterasc()
    {
        $products = Product::orderBy('price', 'asc')->get();
        return view('customer.products.index', ['products' => $products]);
    }
   
}
