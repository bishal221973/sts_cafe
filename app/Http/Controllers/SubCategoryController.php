<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        $search = request()->search;

        $subcategories = SubCategory::with('category', 'products')
            ->select('sub_categories.*')
            ->join('categories', 'categories.id', '=', 'sub_categories.category_id')
            ->latest('sub_categories.created_at');

        // 🔍 Search
        if ($search) {
            $subcategories->where(function ($query) use ($search) {
                $query->where('sub_categories.name', 'LIKE', "%{$search}%")
                    ->orWhere('categories.name', 'LIKE', "%{$search}%");
            });
        }

        // 🔄 Sorting
        $sortBy = request('sort_by', 'sub_categories.created_at');
        $sortOrder = request('sort_order', 'desc');

        $allowedSorts = [
            'name' => 'sub_categories.name',
            'category' => 'categories.name',
            'created_at' => 'sub_categories.created_at',
        ];

        if (isset($allowedSorts[$sortBy])) {
            $subcategories->orderBy($allowedSorts[$sortBy], $sortOrder);
        } else {
            $subcategories->orderBy('sub_categories.created_at', 'desc');
        }

        // 📄 Pagination
        $subcategories = $subcategories->paginate(request()->per_page ?? 10)
            ->appends(request()->query());
        return view('subCategory.index', [
            'categories' => $categories,
            'subCategory' => new SubCategory(),
            'subcategories' => $subcategories
        ]);
    }

    public function store(Request $request)
    {
        SubCategory::create($request->validate([
            'category_id' => 'required',
            'name' => 'required',
        ]));

        return redirect()->back()->with('success', 'New sub-category have been saved.');
    }
    public function edit(SubCategory $subCategory)
    {
        $search = request()->search;
        $categories = Category::latest()->get();
        $subcategories = SubCategory::with('category','products')->latest();
        if (request()->search) {
            $subcategories = $subcategories->where('name', 'LIKE', '%' . request()->search . '%')->orWhereHas('category', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        }
        $subcategories = $subcategories->paginate(request()->per_page ?? 10);
        return view('subCategory.index', [
            'categories' => $categories,
            'subCategory' => $subCategory,
            'subcategories' => $subcategories
        ]);
    }

    public function update(Request $request, SubCategory $subCategory)
    {
        $subCategory->update($request->validate([
            'category_id' => 'required',
            'name' => 'required',
        ]));

        return redirect()->route('subCategory.index')->with('success', "Selected sub-category have been changed.");
    }

    public function delete(SubCategory $subCategory)
    {
        $subCategory->delete();

        return redirect()->back()->with('success', "Selected sub-category have been removed");
    }
}
