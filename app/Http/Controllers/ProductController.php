<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $categories=Category::latest()->get();
        $subcategories=new SubCategory();
        $products=Product::with('category','subCategory')->latest()->paginate(request()->per_page ?? 10);
        $product=new Product();
        return view('product.index',compact('subcategories','categories','products','product'));
    }
    public function subCategory($id){
        $subcategories=SubCategory::where('category_id', $id)->get();

        return response()->json($subcategories);
    }

    public function store(Request $request){
        $data=$request->validate([
            'category_id'=>'required',
            'sub_category_id'=>'required',
            'name'=>'required',
            'price'=>'required|numeric',
            'image'=>'nullable',
        ]);

        if($request->has('image')){
            $data['image']=$request->file('image')->store('products');
        }

        Product::create($data);

        return redirect()->back()->with('success',"New product have been saved.");
    }

    public function edit(Product $product){
        $categories=Category::latest()->get();
        $subcategories=SubCategory::where("category_id", $product->category_id)->get();
        $products=Product::with('category','subCategory')->latest()->paginate(request()->per_page ?? 10);
        return view('product.index',compact('categories','products','product','subcategories'));
    }

    public function update(Request $request, Product $product){
        $data=$request->validate([
            'category_id'=>'required',
            'sub_category_id'=>'required',
            'name'=>'required',
            'price'=>'required|numeric',
            'image'=>'nullable',
        ]);

        if($request->has('image')){
            $data['image']=$request->file('image')->store('products');
        }
        $product->update($data);

        return redirect()->route('product.index')->with('success',"Your selected product have been changed.");
    }

    public function delete(Product $product){
        $product->delete();
        return redirect()->back()->with('success',"Selected product have been removed");
    }
}
