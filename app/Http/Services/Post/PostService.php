<?php

namespace App\Http\Services\Post;

use App\Http\Controllers\Controller;
use App\Models\PostCategory;
use App\Models\Post;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class PostService 
{
    public function list()
    {
        return Post::orderbyDesc('id')->paginate(10);
    }

    public function getPostCategory()
    {
        return PostCategory::where('active',1)->get();
    }
          
    public function store($request) 
    {        
         try{
            Post::create($request->all());
            Session::flash('success','Post created successfully');
        }catch(\Exception $err){
            Session::flash('error', $err->getMessage());               
            return false;
        }
    }

    public function update ($request, $post)
    {    
        try{
            $post->fill($request->input());
            $post->save();

        Session::flash('success','Post updated successfully');

        }catch(\Exception $err){
            Session::flash('error', $err->getMessage());               
            return false;
        }
        return true;  
   }

    public function delete($request)
    {        
        $post = Post::where('id', $request->input('id'))->first();
        if($post) {
            $post->delete();
            return true;
        }
        return false;    
    }
}