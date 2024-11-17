<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'category_id'=>1,
            'sub_category_id'=>1,
            'name'=>'Americano',
            'price'=>'300',
            'image'=>'products/Lkj69Gr3Xudbxs4B082eDELOwFHfcTde12OAtLfM.png',
        ]);
        Product::create([
            'category_id'=>3,
            'sub_category_id'=>5,
            'name'=>'Avocado Toast',
            'price'=>'200',
            'image'=>'products/v7qFDng0FlwYqQW7rnoMbi9pBxvZWhgkHaS5bp1N.png',
        ]);
        Product::create([
            'category_id'=>1,
            'sub_category_id'=>2,
            'name'=>'Black Tea',
            'price'=>'250',
            'image'=>'products/VUPdHA0LDDVQkCMticOfF22e725OIM1768CKUUAn.png',
        ]);
        Product::create([
            'category_id'=>1,
            'sub_category_id'=>1,
            'name'=>'Americano',
            'price'=>'300',
            'image'=>'products/Lkj69Gr3Xudbxs4B082eDELOwFHfcTde12OAtLfM.png',
        ]);
        Product::create([
            'category_id'=>2,
            'sub_category_id'=>3,
            'name'=>'Croissants',
            'price'=>'100',
            'image'=>'products/b74OAffj6rYcuB1FTCkDR0YzyhRAJz805gaB9wNl.jpg',
        ]);
        Product::create([
            'category_id'=>1,
            'sub_category_id'=>1,
            'name'=>'Americano',
            'price'=>'300',
            'image'=>'products/Lkj69Gr3Xudbxs4B082eDELOwFHfcTde12OAtLfM.png',
        ]);
    }
}
