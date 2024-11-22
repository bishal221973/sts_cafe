<?php

namespace App\Http\Controllers;

use App\Models\Cancel;
use App\Models\Sold;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class ReportController extends Controller
{
    public function normal()
    {
        // $search = request()->search;
        // $reports = Sold::latest()->with('product')->whereDate('created_at', today());
        // if (request()->search) {
        //     $reports = $reports->whereHas('product', function ($q) use ($search) {
        //         $q->where('name', 'like', '%' . $search . '%');
        //     })->orWhere('price', $search)->orWhere('sn_number', 'like', '%' . $search . '%');
        // }
        // if (request()->type) {
        //     if (request()->type == 'pdf') {
        //         $reports = $reports->get();
        //         $pdf = PDF::loadView('report.normalPdf', ['reports' => $reports])
        //             ->setOptions(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true]);


        //         return $pdf->stream('file.pdf');
        //     }
        // } else {
        //    return $reports = $reports->groupBy('sn_number')->paginate(request()->per_page ?? 10);
        // }
        // return view('report.normal', compact('reports'));

        // use Illuminate\Pagination\LengthAwarePaginator;

        $search = request()->search;
        $reports = Sold::latest()->with('product')->whereDate('created_at', today());

        if ($search) {
            $reports = $reports->whereHas('product', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            })->orWhere('price', $search)->orWhere('sn_number', 'like', '%' . $search . '%');
        }

        $totalPrice=$reports->sum('price');
        if (request()->type && request()->type == 'pdf') {
            if (request()->type == 'pdf') {
                $reports = $reports->get()->groupBy('sn_number');
                $pdf = PDF::loadView('report.normalPdf', ['reports' => $reports,'totalPrice'=> $totalPrice])
                    ->setOptions(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true]);


                return $pdf->stream('file.pdf');
            }
        } else {
            $reports = $reports->paginate(request()->per_page ?? 10);  // Paginate the results first
            $groupedReports = $reports->getCollection()->groupBy('sn_number');
        }

        $paginatedReports = new LengthAwarePaginator(
            $groupedReports->forPage($reports->currentPage(), $reports->perPage()),
            $groupedReports->count(),
            $reports->perPage(),
            $reports->currentPage(),
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );
        if (request()->type && request()->type == 'pdf') {
            return $paginatedReports;
        }
        return view('report.normal', [
            'reports' => $paginatedReports,
            'totalPrice'=>$totalPrice,
        ]);
    }

    public function monthly()
    {
        // $search = request()->search;
        // $reports = Sold::latest()->with('product');
        // if (request()->search) {
        //     $reports = $reports->whereHas('product', function ($q) use ($search) {
        //         $q->where('name', 'like', '%' . $search . '%');
        //     })->orWhere('price', $search)->orWhere('sn_number', 'like', '%' . $search . '%');
        // }
        // if (request()->type) {
        //     if (request()->type == 'pdf') {
        //         $reports = $reports->get();
        //         $pdf = PDF::loadView('report.monthlyPdf', ['reports' => $reports])
        //             ->setOptions(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true]);
        //         return $pdf->stream('file.pdf');
        //     }
        // } else {
        //     $reports = $reports->paginate(request()->per_page ?? 10);
        // }
        // return view('report.monthly', compact('reports'));

        $search = request()->search;
        $reports = Sold::latest()->with('product')->whereDate('created_at', today());

        if ($search) {
            $reports = $reports->whereHas('product', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            })->orWhere('price', $search)->orWhere('sn_number', 'like', '%' . $search . '%');
        }

        $totalPrice=$reports->sum('price');
        if (request()->type && request()->type == 'pdf') {
            if (request()->type == 'pdf') {
                $reports = $reports->get()->groupBy('sn_number');
                $pdf = PDF::loadView('report.monthlyPdf', ['reports' => $reports,'totalPrice'=> $totalPrice])
                    ->setOptions(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true]);


                return $pdf->stream('file.pdf');
            }
        } else {
            $reports = $reports->paginate(request()->per_page ?? 10);  // Paginate the results first
            $groupedReports = $reports->getCollection()->groupBy('sn_number');
        }

        $paginatedReports = new LengthAwarePaginator(
            $groupedReports->forPage($reports->currentPage(), $reports->perPage()),
            $groupedReports->count(),
            $reports->perPage(),
            $reports->currentPage(),
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );
        if (request()->type && request()->type == 'pdf') {
            return $paginatedReports;
        }
        return view('report.monthly', [
            'reports' => $paginatedReports,
            'totalPrice'=>$totalPrice,
        ]);
    }

    public function normalPdf()
    {
        $reports = Sold::latest()->with('product')->paginate(request()->per_page ?? 10);
    }

    public function productWise()
    {
        $search = request()->search;
        $reports = Sold::select('product_id', DB::raw('SUM(price) as total_price'), DB::raw('COUNT(*) as product_count'))
            ->with('product') // Assuming you have a relationship 'product'
            ->groupBy('product_id')
            ->latest();
        if (request()->search) {
            $reports = $reports->whereHas('product', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }
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
        $search = request()->search;
        $reports = Sold::whereNotNull('user_id')->select('user_id', 'product_id', DB::raw('SUM(price) as total_price'), DB::raw('COUNT(*) as product_count'))
            ->with('user')  // Assuming you have a relationship 'product'
            ->groupBy('user_id', 'product_id')  // Group by both user and product
            ->latest();
        if (request()->search) {
            $reports = $reports->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }
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

    public function cancelReport(){
        $search = request()->search;
        $reports = Cancel::latest()->with('product');

        if ($search) {
            $reports = $reports->whereHas('product', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            })->orWhere('price', $search)->orWhere('sn_number', 'like', '%' . $search . '%');
        }

        $totalPrice=$reports->sum('price');
        if (request()->type && request()->type == 'pdf') {
            if (request()->type == 'pdf') {
                $reports = $reports->get()->groupBy('sn_number');
                $pdf = PDF::loadView('report.cancelPdf', ['reports' => $reports,'totalPrice'=> $totalPrice])
                    ->setOptions(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true]);


                return $pdf->stream('file.pdf');
            }
        } else {
            $reports = $reports->paginate(request()->per_page ?? 10);  // Paginate the results first
            $groupedReports = $reports->getCollection()->groupBy('sn_number');
        }

        $paginatedReports = new LengthAwarePaginator(
            $groupedReports->forPage($reports->currentPage(), $reports->perPage()),
            $groupedReports->count(),
            $reports->perPage(),
            $reports->currentPage(),
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );
        if (request()->type && request()->type == 'pdf') {
            return $paginatedReports;
        }
        return view('report.cancel', [
            'reports' => $paginatedReports,
            'totalPrice'=>$totalPrice,
        ]);
    }
}
