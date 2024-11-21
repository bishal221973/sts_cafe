<?php

namespace App\Livewire;

use App\Models\Sold;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;


class Pos extends Component
{
    public $categories;
    public $subCategories = [];
    public $products = [];
    public $selectedCategory = null;
    public $selectedSubCategory = null;
    public $purchasedItems = [];
    public $purchasedItems1 = [];
    public $snNumber = null;

    public $receivedAmt;

    public function mount()
    {
        $this->categories = Category::all(); // Fetch all categories
        $this->products = Product::all(); // Fetch all products by default
    }

    public function selectCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
        $this->selectedSubCategory = "";
        $this->subCategories = SubCategory::where('category_id', $categoryId)->get(); // Fetch subcategories for the selected category
        $this->filterProducts();
    }
    // Method to handle category selection
    public function updatedSelectedCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
        $this->subCategories = SubCategory::where('category_id', $categoryId)->get(); // Fetch subcategories for the selected category
        $this->filterProducts();
    }

    // Method to handle subcategory selection
    public function updatedSelectedSubCategory($subCategoryId)
    {
        $this->selectedSubCategory = $subCategoryId;
        $this->filterProducts();
    }

    public function selectSubCategory($subCategoryId)
    {
        $this->selectedSubCategory = $subCategoryId;
        $this->filterProducts();
    }
    // Method to filter products based on selected category and subcategory
    public function filterProducts()
    {
        $query = Product::query();

        if ($this->selectedCategory) {
            $query->where('category_id', $this->selectedCategory);
        }

        if ($this->selectedSubCategory) {
            $query->where('sub_category_id', $this->selectedSubCategory);
        }

        $this->products = $query->get(); // Apply the filter and fetch the products
    }
    // public function render()
    // {
    //     $categories=Category::latest()->get();
    //     $subCategories=SubCategory::where('category_id',$categories[0]->id)->latest()->get();
    //     return view('livewire.pos',compact('categories','subCategories'));
    // }
    public function incrementPurchase($productId)
    {
        // Find the product by ID
        $product = Product::find($productId);

        if ($product) {
            // Check if the product is already in the purchased items
            if (isset($this->purchasedItems[$productId])) {
                // Check if there is enough stock to increment the quantity
                if ($this->purchasedItems[$productId]['quantity'] < $product->stock) {
                    $this->purchasedItems[$productId]['quantity']++;
                } else {
                    // Optionally handle case where stock is insufficient
                    session()->flash('error', 'Insufficient stock for ' . $product->name);
                }
            } else {
                // If the product is not yet in the purchasedItems array, add it with quantity 1
                if ($product->stock > 0) {
                    $this->purchasedItems[$productId] = [
                        'product' => $product, // Store the entire product object
                        'quantity' => 1 // Set initial quantity to 1
                    ];
                } else {
                    // Optionally handle case where product has no stock
                    session()->flash('error', 'Product ' . $product->name . ' is out of stock');
                }
            }
        }
    }

    // Decrement the purchased quantity for a product
    public function decrementPurchase($productId)
    {
        if (isset($this->purchasedItems[$productId]) && $this->purchasedItems[$productId]['quantity'] > 0) {
            // Decrement the quantity
            $this->purchasedItems[$productId]['quantity']--;

            // If quantity becomes 0, remove the product from the purchased items
            if ($this->purchasedItems[$productId]['quantity'] == 0) {
                unset($this->purchasedItems[$productId]);
            }
        }
    }


    public function sold()
    {
        $this->snNumber = Str::random(8);
        session()->put('snNumber', $this->snNumber);
        $uniqueStr = settings()->get('sn_prefix', $default = null) . '-' . $this->snNumber;
        foreach ($this->purchasedItems as $item) {
            for ($i = 0; $i < $item['quantity']; $i++) {
                $returned_amount=$this->receivedAmt - $item['product']->price;
                Sold::create([
                    'product_id' => $item['product']->id,
                    'price' => $item['product']->price,
                    'sn_number' => $uniqueStr,
                    'user_id'=>auth()->user()->id,
                    'received_amount'=>$this->receivedAmt,
                    'returned_amount'=> $returned_amount > 0 ? $returned_amount : 0,
                ]);
                $product = Product::find($item['product']->id);

                $product->update([
                    'stock' => ($product->stock - 1),
                ]);
            }
        }
        // $this->emit('saleCompleted');
        // session()->flash('sold', 'Sale completed successfully!');

        // Optionally clear purchased items after sale
        session()->put('data', $this->purchasedItems);
        $this->purchasedItems1 = session()->get('data');
        $this->purchasedItems = [];
        return redirect()->route('purchase.pos')->with('sold', 'Success');
    }

    // Decrement the purchased quantity for a product
    public function render()

    {

        return view('livewire.pos');
    }
}
