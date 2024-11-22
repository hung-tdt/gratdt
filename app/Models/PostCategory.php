<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'parent_id',
        'description',
        'showhome',
        'active'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'post_category_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(PostCategory::class, 'parent_id');
    }
}
