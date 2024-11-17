<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubCategory::create([
            'category_id'=>1,
            'name'=>'Coffee',
        ]);
        SubCategory::create([
            'category_id'=>1,
            'name'=>'Tea',
        ]);
        SubCategory::create([
            'category_id'=>2,
            'name'=>'Pastries',
        ]);
        SubCategory::create([
            'category_id'=>2,
            'name'=>'Breakfast Items',
        ]);
        SubCategory::create([
            'category_id'=>3,
            'name'=>'Vegan',
        ]);
    }
}
