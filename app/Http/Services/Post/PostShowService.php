<?php

namespace App\Http\Services\Post;

use App\Http\Controllers\Controller;
use App\Models\PostCategory;
use App\Models\Post;

class PostShowService 
{
    const LIMIT=5;
    
    public function get()
        {
            return Post::select('id', 'title', 'abstract', 'thumb', 'author', 'active', 'post_category_id', 'created_at','updated_at', 'content')
            ->orderbyDesc('id')
            ->limit(self::LIMIT)
            ->get();
        }

    public function show($id)
    {
        return Post::where('id', $id)
        ->where('active', 1)
        ->with('postCategory')
        ->firstOrFail();
    }

    public function getAll()
    {
        return Post::select('id', 'title', 'abstract', 'thumb', 'author', 'active', 'post_category_id', 'created_at','updated_at', 'content')
        ->orderbyDesc('id')
        ->paginate(8);
    }

    public function more($id)
    {
        return Post::select('id', 'title', 'abstract', 'thumb', 'author', 'active', 'post_category_id', 'created_at','updated_at')
        ->where('active', 1)
        ->where('id','!=', $id)
        ->orderbyDesc('id')
        ->limit(8)
        ->get();
    }  
}

    
