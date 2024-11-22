<?php

namespace App\Http\Services\PostCategory;

use App\Http\Controllers\Controller;
use App\Models\PostCategory;
use App\Models\Post;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class PostCategoryService 
{
    protected $postCategory;
    public function __construct(PostCategory $postCategory) {
        $this->postCategory = $postCategory;
    }

    public function getParent()
    {
        return PostCategory::where('parent_id', 0)->get();
    }

    public function list()
    {
        return PostCategory::orderbyDesc('id')->paginate(10);
    }

    public function store($request) 
    {
       try 
       {
            PostCategory::create([
                'name' => (string) $request->input('name'),
                'parent_id' => (int) $request->input('parent_id'),
                'description' => (string) $request->input('description'),
                'active' => (string) $request->input('active'),
            ]);

            Session::flash('success','Created a successful category');
       } catch(\Exception $err) 
       {
            Session::flash('error', $err->getMessage());
            return false;
       }
       return true;
    }

    public function update ($request,PostCategory $postCategory)
    {
        if($request->input('parent_id') != $postCategory->id) 
        {
            $postCategory->parent_id = (int) $request->input('parent_id');
        }
        $postCategory->name = (string) $request->input('name');
       
        $postCategory->description = (string) $request->input('description');
        $postCategory->active = (string) $request->input('active');
        $postCategory->save();

        Session::flash('success','Updated category successfully');
        return true;
    }

    public function destroy($request)
    {
        $id = (int) $request->input('id');
        $postCategory = PostCategory::where('id', $id)->first();
        if($postCategory)
        {
            return PostCategory::where('id', $id)->orWhere('parent_id', $id)->delete();
        }
        return false;
    }

    
//show blog
    public function getId($id)
    {
        return PostCategory::where('id',$id)->where('active', 1)->firstOrFail();
    }

    public function getPost(PostCategory $postCategory, $request)
    {
        // Lấy danh sách ID của danh mục cha và các danh mục con
        $childCategories = $postCategory->children()->pluck('id')->toArray();
        $childCategories[] = $postCategory->id; // Thêm ID của danh mục cha vào danh sách

        // Lấy sản phẩm từ danh mục cha và các danh mục con
        $query = \App\Models\Post::whereIn('post_category_id', $childCategories)
        ->select('id', 'title', 'abstract', 'thumb', 'author', 'content', 'updated_at')
        ->where('active', 1);

        return $query->orderByDesc('id')
            ->paginate(8)
            ->withQueryString();
    }

}