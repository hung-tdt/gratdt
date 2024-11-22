<?php
 
namespace App\Http\View\Composers;

use App\Models\ProductCategory;
use Illuminate\View\View;
use App\Repositories\UserRepository;
 
class ProductCategoryShowComposer
{
    
    public function __construct() 
    {

    }
     
    public function compose(View $view): void
    {
       $productCategories= ProductCategory::select('id', 'name', 'parent_id')->where('active', 1)->orderBydesc('id')->get();
       $view->with('productCategories', $productCategories);
    }
}