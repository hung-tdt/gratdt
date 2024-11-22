<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Services\Post\PostShowService;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Product;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    protected $postshowService;
    public function __construct(PostShowService $postshowService)
    {
        $this->postshowService = $postshowService;
    }

    public function detail($id='', $slug='')
    {
        $postLastest = Post::select('id', 'title', 'abstract', 'thumb', 'author', 'active', 'post_category_id', 'created_at','updated_at')
            ->orderbyDesc('id')
            ->limit(3)
            ->get();
        $hotdealProducts = Product::select('*', DB::raw('price / price_sale as discount_ratio'))
        ->orderByDesc('discount_ratio')
        ->limit(3)
        ->get();
        $bestSellerProducts = Product::orderbyDesc('sold_count')->limit(3)->get();
        
        $post = $this->postshowService->show($id);
        $comments = Comment::where('post_id', $post->id)->get();
        $post->load('comments.replies');
        return view('customer.posts.detail',[
            'bestSellerProducts' =>  $bestSellerProducts,   
            'hotdealProducts' =>  $hotdealProducts, 
            'postLastest' =>  $postLastest,  
            'post' => $post,
            'comments' => $comments
        ]);
    }

    
    public function showList(Request $request)
    {
        $post = $this->postshowService->getAll();
        return view('customer.posts.showlist',[
            'posts' => $post
        ]);
    }
}
