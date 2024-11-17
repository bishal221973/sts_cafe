@extends('layouts.app')
@section('content')
    <x-breadcrumb :items="[['title' => 'Normal Report', 'url' => null]]" />

        <div class="px-3">
            <div class="d-flex justify-content-between align-items-center notPrint">
                @include('report.menu')
                <div class="d-flex">
                    <a href="{{route('report.normal')}}?type=pdf" class="btn text-dark"><i class="fa fa-file mr-2"></i>PDF</a>
                    <button class="btn bg-transparent" id="btn-report-print"><i class="fa fa-print mr-2"></i>Print</button>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <div class="printOnly">
                        <div class="d-flex justify-content-center">
                            <img src="{{asset('logo.jpg')}}" width="250px" alt="">
                        </div>
                        <h5 class="text-center font-weight-bold m-0 p-0 mt-3">{{settings()->get('print_app_name', $default = null)}}</h5>
                        <label class="text-center d-block m-0 p-0">{{settings()->get('address', $default = null)}}</label>
                        <small class="text-center d-block mb-3"><i>({{now()->format('Y-m-d')}})</i></small>

                    </div>
                    <x-table-component :headers="['S.N', 'Product', 'Product', 'Date']">
                        @foreach ($reports as $report)
                            <tr class="text-center">
                                <td>{{$loop->iteration}}</td>
                                <td>{{$report->product->name}}</td>
                                <td>Rs. {{$report->price}}</td>
                                <td>{{$report->created_at->format('Y/m/d')}}</td>
                            </tr>
                        @endforeach
                    </x-table-component>
                    <x-pagination :data="$reports" />
                </div>
            </div>
        </div>
@endsection
