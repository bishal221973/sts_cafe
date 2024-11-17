<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index(){
        $categories=Category::latest()->get();
        $subcategories=SubCategory::with('category')->latest()->paginate(10);
        return view('subCategory.index',[
            'categories'=>$categories,
            'subCategory'=>new SubCategory(),
            'subcategories'=>$subcategories
        ]);
    }

    public function store(Request $request){
        SubCategory::create($request->validate([
            'category_id'=>'required',
            'name'=>'required',
        ]));

        return redirect()->back()->with('success','New sub-category have been saved.');
    }
    public function edit(SubCategory $subCategory){
        $categories=Category::latest()->get();
        $subcategories=SubCategory::with('category')->latest()->paginate(10);
        return view('subCategory.index',[
            'categories'=>$categories,
            'subCategory'=>$subCategory,
            'subcategories'=>$subcategories
        ]);
    }

    public function update(Request $request, SubCategory $subCategory){
        $subCategory->update($request->validate([
            'category_id'=> 'required',
            'name'=> 'required',
        ]));

        return redirect()->route('subCategory.index')->with('success',"Selected sub-category have been changed.");
    }

    public function delete(SubCategory $subCategory){
        $subCategory->delete();

        return redirect()->back()->with('success',"Selected sub-category have been removed");
    }
}