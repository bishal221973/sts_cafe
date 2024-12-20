<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::latest()->with('product', 'supplier');
        $search = request()->search;
        if (request()->search) {
            $purchases = $purchases->whereHas('product', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            })->orWhereHas('supplier', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            })->orWhere('quantity', $search);
        }
        $purchases = $purchases->paginate(request()->per_page ?? 10);
        $purchase = new Purchase();
        $products = new Product();
        return view('purchase.index', compact('purchases', 'purchase', 'products'));
    }

    public function create()
    {
        $products = Product::whereNull('type')->latest()->get();
        $suppliers = Supplier::latest()->get();
        return view('purchase.create', compact('products', 'suppliers'));
    }

    public function store(Request $request)
    {
        foreach ($request->product_id as $index => $product) {
            Purchase::create([
                'product_id' => $request->product_id[$index],
                'supplier_id' => $request->supplier_id[$index],
                'quantity' => $request->quantity[$index],
            ]);
            $product = Product::where('id', $request->product_id[$index])->first();
            $stock = $product->stock + $request->quantity[$index];
            $product->update(['stock' => $stock]);
        }

        return redirect()->back()->with('success', 'New products purchased.');
    }

    public function delete(Purchase $purchase)
    {
        $purchase->delete();
        return redirect()->back()->with('success', 'Selected purchase have been removed.');
    }

    public function edit(Purchase $purchase)
    {
        $products = Product::whereNull('type')->latest()->get();
        $suppliers = Supplier::latest()->get();
        $purchases = Purchase::latest()->with('product', 'supplier')->paginate(request()->per_page ?? 10);
        return view('purchase.index', compact('purchases', 'purchase', 'products', 'suppliers'));
    }

    public function update(Request $request, Purchase $purchase)
    {
        $inStock = $purchase->quantity;
        $data = $request->validate([
            'product_id' => 'required',
            'supplier_id' => 'required',
            'quantity' => 'required',
        ]);

        $purchase->update($data);
        $product = Product::find($purchase->product_id);

        $oldStock = $product->stock;
        $oldStock = $oldStock - $inStock;
        $oldStock = $oldStock + $request->quantity;

        $product->update([
            'stock' => $oldStock
        ]);

        return redirect()->route('purchase.index')->with('success', "Selected purchase info have been changed.");
    }

    public function stock()
    {
        $products = Product::latest();
        if (request()->search) {
            $products = $products->where("name", "LIKE", "%" . request()->search . "%")->orWhere('stock', request()->search);
        }
        $products = $products->whereNull('type')->paginate(request()->per_page ?? 10);
        return view('purchase.stock', compact('products'));
    }
}
