<?php
 
namespace App\Http\View\Composers;

use App\Models\PostCategory;
use Illuminate\View\View;
use App\Repositories\UserRepository;
 
class PostCategoryShowComposer
{    
    public function __construct() 
    {

    }
     
    public function compose(View $view): void
    {
       $postCategories= PostCategory::select('id', 'name', 'parent_id')->where('active', 1)->orderBydesc('id')->get();
       $view->with('postCategories', $postCategories);
    }
}