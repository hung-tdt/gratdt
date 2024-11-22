<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\ProductCategory;
use App\Http\Requests\Menu\CreateFormRequest;

use Illuminate\Http\Request;

use Illuminate\Http\JsonResponse;
use App\Http\Services\ProductCategory\ProductCategoryService;

use LDAP\Result;

class ProductCategoryController extends Controller
{
    protected $productCategoryService;

    public function __construct(ProductCategoryService $productCategoryService)
    {
        $this->productCategoryService = $productCategoryService;
    }

    public function add()
    {
        return view('admin.productcategories.add',[
            'title' => 'Add new category',
            'productCategories' => $this->productCategoryService->getParent()
        ]);
    }

    public function store(CreateFormRequest $request)
    {
        $result=$this->productCategoryService->store($request);
        if($result){
            return redirect()->route('product_categories.list');
        }
        return redirect()->back();
    }

    public function list()
    {
        return view('admin.productcategories.list',[
            'title' => 'List of Catalog product',
            'productCategories' => $this->productCategoryService->list()
        ]);
    }

    public function edit(ProductCategory $productCategory)
    {  
        return view('admin.productcategories.edit',[
            'title' => 'Edit category ' .$productCategory->name,
            'productCategory' => $productCategory,
            'productCategories' => $this->productCategoryService->getParent()
           
        ]);
    }

    public function update (ProductCategory $productCategory,CreateFormRequest $request)
    {
        $this->productCategoryService->update($request, $productCategory);
        return redirect()->route('product_categories.list');
    }

    public function destroy(Request $request): JsonResponse
    {
        $result = $this->productCategoryService->destroy($request);
        if($result)
        {
            return response()->json([
                'error' => false,
                'message' => 'Category deleted successfully'
            ]);
        }
        return response()->json([
            'error' => true
           
        ]);
    }
}   
