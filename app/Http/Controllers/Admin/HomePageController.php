<?php

namespace App\Http\Controllers\Admin;

use App\Http\Services\ProductCategory\ProductCategoryService;
use App\Http\Services\PostCategory\PostCategoryService;
use App\Models\ProductCategory;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Http\Controllers\Controller;

class HomePageController extends Controller
{
    protected $productCategoryService;
    protected $postCategoryService;

    public function __construct(ProductCategoryService $productCategoryService, PostCategoryService $postCategoryService)
    {
        $this->productCategoryService = $productCategoryService;
        $this->postCategoryService = $postCategoryService;
    }

    public function showCatalog()
    {
        return view('admin.homepages.show-catalog',[
            'productCategories' => $this->productCategoryService->list(),
            'title' => 'Edit show Catalog'
        ]);
    }

    public function updateMultipleStatus(Request $request)
    {
        $categories = $request->categories;

        foreach ($categories as $categoryId => $values) {
            $productCategory = ProductCategory::find($categoryId);
            if ($productCategory) {
                $productCategory->active = isset($values['active']) ? 1 : 0;
                $productCategory->showhome = isset($values['showhome']) ? 1 : 0;
                $productCategory->save();
            }
        }

        return response()->json(['success' => true, 'message' => 'Categories updated successfully!']);
    }

    public function showPostCategories()
    {
        return view('admin.homepages.show-postcategory',[
            'postCategories' => $this->postCategoryService->list(),
            'title' => 'Edit show Catalog'
        ]);
    }

    public function updateshowPostCategories(Request $request)
    {
        $categories = $request->categories;

        foreach ($categories as $categoryId => $values) {
            $postCategory = PostCategory::find($categoryId);
            if ($postCategory) {
                $postCategory->active = isset($values['active']) ? 1 : 0;
                $postCategory->showhome = isset($values['showhome']) ? 1 : 0;
                $postCategory->save();
            }
        }

        return response()->json(['success' => true, 'message' => 'Categories updated successfully!']);
    }
}
