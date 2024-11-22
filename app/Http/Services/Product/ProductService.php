<?php

namespace App\Http\Services\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProductService 
{ 
    public function list()
    {
        return Product::with('productCategory')
        ->orderbyDesc('id')->paginate(10);
    }

    public function filterProducts(Request $request)
    {
        $name = $request->input('name');
        
        return Product::where('name', 'like', "%$name%")->paginate(10);
    }
    
    public function getProductCategory()
    {
        return ProductCategory::where('active',1)->get();
    }
    
    protected function isValidPrice($request)
    {
        if($request->input('price') != 0 && $request->input('price_sale') != 0
        && $request->input('price_sale') >= $request->input('price'))
        {
            Session::flash('error','Discount price must be less than original price');
            return false;
        } 
        if($request->input('price_sale') != 0 && (int)$request->input('price') == 0)
        {
            Session::flash('error','Please enter original price');
            return false;
        }

        return true;
    }

    public function store($request) 
    {
        $isValidPrice = $this->isValidPrice($request);
        if($isValidPrice == false) {
            return false;
        } else {
            try{
                $product = new Product;
                $product->name = $request->input('name');
                $product->product_category_id = $request->input('product_category_id');
                $product->description = $request->input('description');
                $product->content = $request->input('content');
                $product->price = $request->input('price');
                $product->price_sale = $request->input('price_sale');
                $product->active = $request->input('active');
                $product->thumb = $request->input('thumb');
                $product->thumb2 = $request->input('thumb2');
                $product->quantity = $request->input('quantity');
                $product->sold_count = $request->input('sold_count');
                $product->save();
                
                // Lưu ảnh vào storage và tạo mảng ảnh cho sản phẩm
                if ($request->hasFile('images')) {
                    $images = [];
                    foreach ($request->file('images') as $image) {
                        $name = $image->getClientOriginalName();
                        $path = 'images/' . date("Y/m/d");
                        $pathFull = $image->storeAs(
                            'public/' .$path, $name);
                        $images[] = 'storage/' . $path . '/' . $name;
                    }
                    $product->images = $images;
                    $product->save();
                }

                // Gán mảng ảnh cho sản phẩm
                $product->images = $images;
                $product->save();
                Session::flash('success','Create successful products');
            }catch(\Exception $err){
                Session::flash('error', $err->getMessage());               
                return false;
            }
            return true;
        }
    }
   
    public function update ($request, $product)
    {
        $isValidPrice = $this->isValidPrice($request);
        if($isValidPrice == false) {
            return false;
        } else {
            try{
                
                $product->name = $request->input('name');
                $product->product_category_id = $request->input('product_category_id');
                $product->description = $request->input('description');
                $product->content = $request->input('content');
                $product->price = $request->input('price');
                $product->price_sale = $request->input('price_sale');
                $product->active = $request->input('active');
                $product->thumb = $request->input('thumb');
                $product->thumb2 = $request->input('thumb2');
                $product->save();
                
                // Lưu ảnh vào storage và tạo mảng ảnh cho sản phẩm
                if ($request->hasFile('images')) {
                    $images = [];
                    foreach ($request->file('images') as $image) {
                        $name = $image->getClientOriginalName();
                        $path = 'images/' . date("Y/m/d");
                        $pathFull = $image->storeAs(
                            'public/' .$path, $name);
                        $images[] = 'storage/' . $path . '/' . $name;
                    }
                    $product->images = $images;
                    $product->save();
                }  
                Session::flash('success','Product update successful');

            }catch(\Exception $err){
                Session::flash('error', $err->getMessage());               
                return false;
            }
            return true;
        }    
        
   }

    public function delete($request)
    {        
        $product = Product::where('id', $request->input('id'))->first();
        if($product) {
            $product->delete();
            return true;
        }
        return false;      
    }
}