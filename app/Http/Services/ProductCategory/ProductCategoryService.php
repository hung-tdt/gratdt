<?php

namespace App\Http\Services\ProductCategory;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ProductCategoryService 
{
    protected $productCategory;
    public function __construct(ProductCategory $productCategory) {
        $this->productCategory = $productCategory;
    }

    public function getParent()
    {
        return ProductCategory::where('parent_id', 0)->get();
    }

    public function list()
    {
        return ProductCategory::select('id', 'name', 'parent_id', 'description', 'showhome', 'active')->get();
    }

    public function store($request) 
    {
       try 
       {
             ProductCategory::create([
                'name' => (string) $request->input('name'),
                'parent_id' => (int) $request->input('parent_id'),
                'description' => (string) $request->input('description'),
                'thumb' => (string) $request->input('thumb'),
                'showhome' => (string) $request->input('showhome'),
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

    public function update ($request, $productCategory)
    {
        if($request->input('parent_id') != $productCategory->id) 
        {
            $productCategory->parent_id = (int) $request->input('parent_id');
        }
        $productCategory->name = (string) $request->input('name');
        $productCategory->description = (string) $request->input('description');
        $productCategory->thumb = (string) $request->input('thumb');
        $productCategory->showhome = (string) $request->input('showhome');
        $productCategory->active = (string) $request->input('active');
        $productCategory->save();

        Session::flash('success','Updated category successfully');
        return true;
    }

    public function destroy($request)
    {
        $id = (int) $request->input('id');
        $productCategory = ProductCategory::where('id', $id)->first();
        if($productCategory)
        {
            return ProductCategory::where('id', $id)->orWhere('parent_id', $id)->delete();
        }
        return false;
    }

    
    public function getId($id)
    {
        return ProductCategory::where('id',$id)->where('active', 1)->firstOrFail();
    }
    
    
    public function getProduct($productCategory)
    {
        // Lấy danh sách ID của danh mục cha và các danh mục con
        $childCategories = $productCategory->children()->pluck('id')->toArray();
        $childCategories[] = $productCategory->id; // Thêm ID của danh mục cha vào danh sách

        // Lấy sản phẩm từ danh mục cha và các danh mục con
        $query = \App\Models\Product::whereIn('product_category_id', $childCategories)
            ->select('id', 'name', 'price', 'thumb', 'thumb2', 'description')
            ->where('active', 1);

        return $query->orderByDesc('id')
            ->paginate(12)
            ->withQueryString();
    }


}