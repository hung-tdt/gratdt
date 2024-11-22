<?php

namespace App\Http\Controllers\Customer;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;

class CommentController extends Controller
{

    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|max:1000',
        ]);
    
        $parent_id = $request->parent_id ?? 0;
    
        Comment::create([
            'post_id' => $post->id,
            'customer_id' => Auth::guard('customer')->id(),
            'content' => $request->content,
            'parent_id' => $parent_id, 
        ]);
    
        return redirect()->back()->with('success', 'Comment added successfully.');
    }
}

