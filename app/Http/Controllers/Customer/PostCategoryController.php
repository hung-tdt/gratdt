<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Services\PostCategory\PostCategoryService;
use App\Models\PostCategory;
use App\Http\Controllers\Controller;

class PostCategoryController extends Controller
{
    protected $postCategoryService;
    public function __construct(PostCategoryService $postCategoryService)
    {
        $this->postCategoryService = $postCategoryService;
    }

    public function index(Request $request, $id, $slug)
    {
        $postCategory = $this->postCategoryService->getId($id);
        $post = $this->postCategoryService->getPost($postCategory, $request);
        // dd($post);
        return view('customer.posts.post-category',[
            'title' => $postCategory->name,
            'posts' => $post,
            'postCategory' => $postCategory
        ]);
    }
    
}
