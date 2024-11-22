<?php

namespace App\Http\Controllers;

use App\Models\Cancel;
use App\Models\Product;
use App\Models\Sold;
use Illuminate\Http\Request;

class SoldController extends Controller
{
    public function cancel ($sn_number){
        $reports=Sold::where('sn_number',$sn_number)->latest()->get();

        foreach($reports as $report){
            $product=Product::find($report->product_id);

            if($product->type=='combo'){
                foreach($product->sub as $sub){
                    $product->update([
                        'stock'=> ($product->stock+$sub->qty),
                    ]);
                }
            }else{
                $product->update([
                    'stock'=> ($product->stock+1),
                ]);
            }
            Cancel::create([
                'product_id'=>$report->product_id,
                'sn_number'=>$report->sn_number,
                'price'=>$report->price,
            ]);
            $report->delete();
        }

        return redirect()->back()->with('success',"Bill Canceled");
    }
}
