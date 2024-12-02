<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Promotion;
use App\Http\Controllers\Controller;

class PromotionController extends Controller
{
    public function add()
    {
        $products = Product::all(); 
        return view('admin.promotions.add', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'products' => 'required|array',
        ]);

        foreach ($request->products as $productId => $productData) {
            if (isset($productData['selected'])) {
                $conflictingPromotion = Promotion::whereHas('products', function ($query) use ($productId) {
                    $query->where('products.id', $productId);
                })
                ->where(function ($query) use ($request) {
                    $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                        ->orWhereBetween('end_date', [$request->start_date, $request->end_date])
                        ->orWhere(function ($query) use ($request) {
                            $query->where('start_date', '<', $request->start_date)
                                    ->where('end_date', '>', $request->end_date);
                        });
                })
                ->first();

                if ($conflictingPromotion) {
                    return back()->withErrors([
                        'products' => 'Product "' . Product::find($productId)->name . '" is already in another promotion during this time.',
                    ]);
                }
            }
        }

        $promotion = Promotion::create($request->only([
            'name', 'start_date', 'end_date', 'active'
        ]));

        if ($request->has('products')) {
            foreach ($request->products as $productId => $productData) {
                if (isset($productData['selected'])) {
                    $promotion->products()->attach($productId, [
                        'discount_price' => $productData['discount_price'],
                    ]);
                }
            }
        }

        return redirect()->route('promotions.list')->with('success', 'Promotion has been created.');
    }

    public function list()
    {      
        $promotions = Promotion::latest()->paginate(10); 
        return view('admin.promotions.list', compact('promotions'));
    }

    public function edit($id)
    {
        $promotion = Promotion::findOrFail($id);

        $selectedProducts = $promotion->products()->pluck('products.id')->toArray();

        $products = Product::all();

        return view('admin.promotions.edit', compact('promotion', 'products', 'selectedProducts'));
    }


    public function update(Request $request, $id)
    {
        $promotion = Promotion::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        foreach ($request->products as $productId => $productData) {
            if (isset($productData['selected'])) {
                $conflictingPromotion = Promotion::where('id', '!=', $promotion->id)
                    ->whereHas('products', function ($query) use ($productId) {
                        $query->where('products.id', $productId);
                    })
                    ->where(function ($query) use ($request) {
                        $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                            ->orWhereBetween('end_date', [$request->start_date, $request->end_date])
                            ->orWhere(function ($query) use ($request) {
                                $query->where('start_date', '<', $request->start_date)
                                        ->where('end_date', '>', $request->end_date);
                            });
                    })
                    ->first();

                if ($conflictingPromotion) {
                    return back()->withErrors([
                        'products' => 'Product "' . Product::find($productId)->name . '" is already in another promotion during this time.',
                    ]);
                }
            }
        }

        $promotion->update($request->only([
            'name', 'start_date', 'end_date', 'active'
        ]));

        if ($request->has('products')) {
            $products = [];
            foreach ($request->products as $productId => $productData) {
                if (isset($productData['selected'])) {
                    $products[$productId] = [
                        'discount_price' => $productData['discount_price'] ?? null,
                        'discount_percentage' => $productData['discount_percentage'] ?? null,
                    ];
                }
            }

            $promotion->products()->sync($products);
        } else {
            $promotion->products()->detach();
        }

        return redirect()->route('promotions.list')->with('success', 'Update successful.');
    }

    public function destroy(Request $request)
    {
        $promotion = Promotion::find($request->input('id'));

        if ($promotion) {
            $promotion->delete();
            return response()->json([
                'error' => false,
                'message' => 'Promotion deleted successfully'
            ]);
        } else {
            return response()->json([
                'error' => true
            ]);
        }
    }

}
