<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Services\Slider\SliderShowService;
use App\Http\Services\Product\ProductShowService;
use App\Http\Services\Post\PostShowService;
use Illuminate\Support\Facades\DB;

use App\Models\ProductCategory;
use App\Models\Product;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    protected $slider;
    protected $product;
    protected $post;

    public function __construct(SliderShowService $slider, ProductShowService $product, PostShowService $post)
    {
        $this->slider = $slider;
        $this->product = $product;
        $this->post = $post;
        
    }
   
 
    public function index()
    {
        $hotdealProducts = Product::with('promotions')
            ->get()
            ->filter(function ($product) {
                return $product->discounted_price < $product->price;
            })
            ->sortByDesc(function ($product) {
                return ($product->price - $product->discounted_price) / $product->price;
            })
            ->take(8);
        $newProducts = Product::orderbyDesc('id')->limit(10)->get();
        $bestSellerProducts = Product::orderbyDesc('sold_count')->limit(7)->get();
        $categories = ProductCategory::where('showhome', 1)->with('products')->get();
        return view('customer.component.home',[
            'sliders' =>$this->slider->show(),
            'posts' => $this->post->get(),
            'products' => $this->product->get(),
            'productslike' => $this->product->getlike(),
            'categories' =>  $categories,
            'hotdealProducts' =>  $hotdealProducts,
            'newProducts' =>  $newProducts,
            'bestSellerProducts' =>  $bestSellerProducts,
        ]);
    }


}
