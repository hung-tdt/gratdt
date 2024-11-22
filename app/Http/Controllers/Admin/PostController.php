<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Post;
use App\Http\Requests\Post\CreateFormRequest;
use Illuminate\Http\Request;
use App\Http\Services\Post\PostService;


class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }
     
    public function add()
    {
        return view('admin.posts.add',[
            'title' => 'Create new post',
            'postCategories' => $this->postService->getPostCategory()
        ]);
    }

    public function store(CreateFormRequest $request)
    {
        $this->postService->store($request);
        return redirect()->route('posts.list');
    }

    public function list()
    {
        return view('admin.posts.list',[
            'title' => 'List of posts',
            'posts' => $this->postService->list(),
            'postCategories' => $this->postService->getPostCategory()       
        ]);
    }

    public function edit(Post $post)
    {       
        return view('admin.posts.edit',[
            'title' => 'Edit post ' .$post->name,
            'post' => $post,
            'postCategories' => $this->postService->getPostCategory()   
           
        ]);
    }

    public function update (Post $post,CreateFormRequest $request)
    {
        $result=$this->postService->update($request, $post);
        if($result){
            return redirect()->route('posts.list');
        }
        return redirect()->back();
    }

    public function destroy(Request $request)//: JsonResponse
    {
        $result = $this->postService->delete($request);
        if($result)
        {
            return response()->json([
                'error' => false,
                'message' => 'Post deleted successfully'
            ]);
        }
        return response()->json([
            'error' => true
           
        ]);
    }

    public function search(Request $request)
    {
        $query = Post::query();

        if ($request->title) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }
        if ($request->abstract) {
            $query->where('abstract', 'like', '%' . $request->abstract . '%');
        }
        if ($request->author) {
            $query->where('author', 'like', '%' . $request->author . '%');
        }

        if ($request->post_category_id) {
            $query->where('post_category_id', $request->post_category_id);
        }

        $posts = $query->get();

        $postCategories = $this->postService->getPostCategory();

        return view('admin.posts.post_table', compact(
            'posts', 'postCategories'
        ))->render();
    }
}   