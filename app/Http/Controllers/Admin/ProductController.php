<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\StockEntry;
use App\Http\Requests\Product\CreateFormRequest;

use Illuminate\Http\Request;
use App\Http\Services\ProductCategory\ProductCategoryService;
use Illuminate\Http\JsonResponse;
use App\Http\Services\Product\ProductService;

use LDAP\Result;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    
    public function add()
    {
        return view('admin.products.add',[
            'title' => 'Add new product',
            'productCategories' => $this->productService->getProductCategory()
        ]);
    }

    public function store(CreateFormRequest $request)
    {
        $result=$this->productService->store($request);
        if($result){
            return redirect()->route('products.list');
        }
        return redirect()->back();    
    }

    public function list()
    {
        return view('admin.products.list',[
            'title' => 'List of products',
            'products' => $this->productService->list(),
            'productCategories' => $this->productService->getProductCategory()
        ]);
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit',[
            'title' => 'Edit product ' .$product->name,
            'product' => $product,
            'productCategories' => $this->productService->getProductCategory()      
           
        ]);
    }

    public function update (Product $product,CreateFormRequest $request)
    {
        $result=$this->productService->update($request, $product);
        if($result){
            return redirect()->route('products.list');
        }
        return redirect()->back();
    }

    public function destroy(Request $request)//: JsonResponse
    {
        $result = $this->productService->delete($request);
        if($result)
        {
            return response()->json([
                'error' => false,
                'message' => 'Product deleted successfully'
            ]);
        }
        return response()->json([
            'error' => true
           
        ]);
    }

    public function addStock(Product $product)
    {
        return view('admin.products.addStock',[
            'title' => 'Add quantity product ' .$product->name,
            'product' => $product         
        ]);
    }

    public function storeStock(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        $product->quantity += $request->input('quantity');
        $product->save();

        $quantity = $request->input('quantity');
        $entryPrice = $request->input('import_price');
        $total = $quantity * $entryPrice;
        StockEntry::create([
            'product_id' => $product->id,
            'quantity_added' => $quantity,
            'import_price' => $entryPrice,
            'total' => $total, 
        ]);

        return redirect()->route('products.list')->with('success', 'Stock updated successfully.');
    }

    public function showStockHistory($productId)
    {
        $product = Product::findOrFail($productId);

        $stockEntries = $product->stockEntries()->orderBy('created_at', 'desc')->get();

        return view('admin.products.stock-history', compact('product', 'stockEntries'));
    }

    public function showAllStockHistory()
    {
        $stockEntries = StockEntry::with('product')->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.products.all-stock-history', compact('stockEntries'));
    }


    public function search(Request $request)
    {
        $query = Product::query();

        if ($request->id) {
            $query->where('id', 'like', '%' . $request->id . '%');
        }
        if ($request->name) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->quantity_min && $request->quantity_max) {
            $query->whereBetween('quantity', [$request->quantity_min, $request->quantity_max]);
        } elseif ($request->quantity_min) {
            $query->where('quantity', '>=', $request->quantity_min);
        } elseif ($request->quantity_max) {
            $query->where('quantity', '<=', $request->quantity_max);
        }

        if ($request->product_category_id) {
            $parentCategory = ProductCategory::find($request->product_category_id);
            
            if ($parentCategory) {
                $childCategories = $parentCategory->children()->pluck('id')->toArray();

                $childCategories[] = $parentCategory->id;
        
                \Log::info('Filtering by categories: ', $childCategories);

                $query->whereIn('product_category_id', $childCategories);
            } else {
                \Log::warning('Parent category not found: ' . $request->product_category_id);
            }
        }

        $products = $query->get();

        $productCategories = $this->productService->getProductCategory();

        return view('admin.products.product_table', compact(
            'products', 'productCategories'
        ))->render();
    }

    public function outOfStock(Request $request)
    {
        $products = Product::query()->where('quantity', 0)->orderbyDesc('id')->paginate(10); 
        $productCategories = $this->productService->getProductCategory();

        $title = 'Out Of Stock';

        return view('admin.products.list', compact('products', 'productCategories', 'title'));
    }
}   