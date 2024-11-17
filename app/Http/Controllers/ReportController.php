<?php

namespace App\Http\Controllers;

use App\Models\Sold;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function normal(){
        $reports=Sold::latest()->with('product');
        if(request()->type){
            if(request()->type == 'pdf'){
                $reports=$reports->get();
                $pdf = PDF::loadView('report.normalPdf', ['reports' => $reports])
    ->setOptions(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true]);

        // Generate and download the PDF
        return $pdf->stream('file.pdf');
            }
        }else{
            $reports=$reports->paginate(10);
        }
        return view('report.normal',compact('reports'));
    }

    public function normalPdf(){
        $reports=Sold::latest()->with('product')->paginate(10);

    }

    public function productWise(){
        $reports = Sold::select('product_id', DB::raw('SUM(price) as total_price'), DB::raw('COUNT(*) as product_count'))
        ->with('product') // Assuming you have a relationship 'product'
        ->groupBy('product_id')
        ->latest() // Order by latest, you can adjust this if needed
        ->paginate(10); // Paginate the results
        return view('report.productWise',compact('reports'));
    }
}
