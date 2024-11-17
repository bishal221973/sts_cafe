<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories=Category::latest();
        if(request()->search){
            $categories = $categories->where("name","LIKE","%".request()->search."%");
        }
        $categories = $categories->paginate(request()->per_page ?? 10);
        return view('category.index',[
            'categories'=>$categories,
            'category'=>new Category(),
        ]);
    }

    public function store(Request $request){
        Category::create($request->validate([
            'name'=>'required|unique:categories,name',
        ]));

        return redirect()->back()->with('success','New category have been saved');
    }

    public function edit(Category $category){
        $categories=Category::latest();
        if(request()->search){
            $categories = $categories->where("name","LIKE","%".request()->search."%");
        }
        $categories = $categories->paginate(request()->per_page ?? 10);
        return view('category.index',[
            'categories'=>$categories,
            'category'=>$category,
        ]);
    }

    public function update(Request $request, Category $category){
        $category->update($request->validate([
            'name'=>'required|unique:categories,name,'.$category->id,
        ]));


        return redirect()->route('category.index')->with('success',"Selected category removed.");
    }

    public function delete(Category $category){
        $category->delete();

        return redirect()->back()->with("success","Selected category have been removed.");
    }
}
