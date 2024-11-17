<?php

namespace App\Http\Controllers;

use App\Models\Sold;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function normal()
    {
        $reports = Sold::latest()->with('product')->whereDate('created_at', today());
        if (request()->type) {
            if (request()->type == 'pdf') {
                $reports = $reports->get();
                $pdf = PDF::loadView('report.normalPdf', ['reports' => $reports])
                    ->setOptions(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true]);

                // Generate and download the PDF
                return $pdf->stream('file.pdf');
            }
        } else {
            $reports = $reports->paginate(request()->per_page ?? 10);
        }
        return view('report.normal', compact('reports'));
    }

    public function monthly()
    {
        $reports = Sold::latest()->with('product')->whereMonth('created_at', now()->month)  // Filters by current month
            ->whereYear('created_at', now()->year);
        if (request()->type) {
            if (request()->type == 'pdf') {
                $reports = $reports->get();
                $pdf = PDF::loadView('report.monthlyPdf', ['reports' => $reports])
                    ->setOptions(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true]);

                // Generate and download the PDF
                return $pdf->stream('file.pdf');
            }
        } else {
            $reports = $reports->paginate(request()->per_page ?? 10);
        }
        return view('report.monthly', compact('reports'));
    }

    public function normalPdf()
    {
        $reports = Sold::latest()->with('product')->paginate(request()->per_page ?? 10);
    }

    public function productWise()
    {
        $reports = Sold::select('product_id', DB::raw('SUM(price) as total_price'), DB::raw('COUNT(*) as product_count'))
            ->with('product') // Assuming you have a relationship 'product'
            ->groupBy('product_id')
            ->latest();

            if (request()->type) {
                if (request()->type == 'pdf') {
                    $reports = $reports->get();
                    $pdf = PDF::loadView('report.productWisepdf', ['reports' => $reports])
                        ->setOptions(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true]);

                    // Generate and download the PDF
                    return $pdf->stream('file.pdf');
                }
            } else {
                $reports = $reports->paginate(request()->per_page ?? 10);
            }
        return view('report.productWise', compact('reports'));
    }

    public function userWise()
    {
        $reports = Sold::whereNotNull('user_id')->select('user_id', 'product_id', DB::raw('SUM(price) as total_price'), DB::raw('COUNT(*) as product_count'))
            ->with('user')  // Assuming you have a relationship 'product'
            ->groupBy('user_id', 'product_id')  // Group by both user and product
            ->latest();
            if (request()->type) {
                if (request()->type == 'pdf') {
                    $reports = $reports->get();
                    $pdf = PDF::loadView('report.userWisepdf', ['reports' => $reports])
                        ->setOptions(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true]);

                    // Generate and download the PDF
                    return $pdf->stream('file.pdf');
                }
            } else {
                $reports = $reports->paginate(request()->per_page ?? 10);
            }
        return view('report.userWise', compact('reports'));
    }
}
