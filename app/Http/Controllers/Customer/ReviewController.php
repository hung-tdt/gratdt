<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Order;
use App\Models\Product;
use App\Http\Services\Product\ProductShowService;
use App\Http\Services\ProductCategory\ProductCategoryService;

use App\Models\ProductCategory;
use App\Models\Post;
use App\Models\OrderDetail;

use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    protected $productshowService;
    protected $productCategoryService;

    public function __construct(ProductShowService $productshowService, ProductCategoryService $productCategoryService)
    {
        $this->productshowService = $productshowService;
        $this->productCategoryService = $productCategoryService;
    }

    public function showReviewForm($order_detail_id, $product_id)
    {        
        $order_detail = OrderDetail::findOrFail($order_detail_id);
        $product = Product::findOrFail($product_id);

        $productCategoryId = $product->product_category_id;
        $productCategory = ProductCategory::where('id', $productCategoryId)->where('active', 1)->firstOrFail();
        $productRelate = $this->productCategoryService->getProduct($productCategory);

        // Lấy tất cả đánh giá của sản phẩm
        $reviews = Review::where('product_id', $product->id)->get();

        $averageRating = $reviews->avg('rating'); // Tính trung bình cộng của rating

        return view('customer.orders.review-form',[
            'title' => $product->name,
            'product' => $product,
            'productRelate' =>  $productRelate,
            'reviews' =>  $reviews,
            'averageRating' =>  $averageRating,
            'order_detail' => $order_detail
        ]); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'customer_id' => 'required|exists:customers,id',
            'review' => 'required|string',
        ]);

        $rating = $request->rating ?? 5;
        Review::create([
            'customer_id' => $request->customer_id,
            'product_id' => $request->product_id,
            'order_detail_id' => $request->order_detail_id,
            'rating' => $rating,
            'review' => $request->review,
        ]);

        OrderDetail::where('id', $request->order_detail_id)
        ->update(['isreview' => '1']);

        return back()->with('success', 'Your review has been submitted successfully.');
    }
}