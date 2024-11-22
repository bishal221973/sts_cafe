<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubProduct;
use Illuminate\Http\Request;

class ComboController extends Controller
{
    public function index()
    {
        $combos=Product::with('sub','category','subCategory')->where('type','combo')->latest()->paginate(10);
        return view('combo.index',[
            'combos'=>$combos,
        ]);
    }

    public function create()
    {
        $products = Product::latest()->get();
        $categories = Category::latest()->get();
        return view('combo.create', [
            'products' => $products,
            'categories' => $categories,
            'combo'=>new Product(),
            'subCategories'=>new SubCategory(),
        ]);
    }

    public function store(Request $request)
    {
        $combo = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'type'=>'combo',
        ]);

        foreach ($request->product_id as $index => $product_id) {
            SubProduct::create([
                'combo_id' => $combo->id,
                'product_id'=>$product_id,
                'qty'=>$request->qty[$index]
            ]);
        }
        return redirect()->back()->with('success',"New combo product saved.");
    }

    public function edit(Product $combo)
    {
        $products = Product::latest()->get();
        $categories = Category::latest()->get();
        $subCategories=SubCategory::where('category_id',$combo->category_id)->latest()->get();
        return view('combo.create', [
            'products' => $products,
            'categories' => $categories,
            'combo'=>$combo,
            'subCategories'=>$subCategories,
        ]);
    }

    public function update(Request $request, Product $combo)
{
    // Validate the incoming request data
    $data = $request->validate([
        'name' => 'required|string|max:255', // Example validation rule
        'price' => 'required|numeric|min:0', // Example validation rule
        'category_id' => 'required|exists:categories,id', // Example validation rule
        'sub_category_id' => 'required|exists:sub_categories,id', // Example validation rule
    ]);

    // Update the product combo with validated data
    $combo->update($data);

    return redirect()->route('combo.index')->with('success', "Selected combo updated.");
}

public function delete(Product $combo){
    $combo->delete();
    return redirect()->back()->with('success',"Selected combo removed.");
}
}
