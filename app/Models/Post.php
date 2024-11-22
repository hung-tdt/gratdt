<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'abstract',
        'content',
        'thumb',
        'author',
        'active',
        'post_category_id',
    ];
    public function postCategory()
    {
        return $this->hasOne(PostCategory::class, 'id', 'post_category_id');  
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
