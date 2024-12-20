@extends('layouts.app')
@section('content')
    <x-breadcrumb :items="[['title' => 'Normal Report', 'url' => null]]" />

    <div class="px-3">
        <div class="d-flex justify-content-between align-items-center notPrint">
            @include('report.menu')
            <div class="d-flex">
                <a href="{{ route('report.cancelReport') }}?type=pdf" class="btn text-dark"><i class="fa fa-file mr-2"></i>PDF</a>
                <button class="btn bg-transparent" id="btn-report-print"><i class="fa fa-print mr-2"></i>Print</button>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <div class="printOnly">
                    <h1 class="text-center m-0 p-0">{{ settings()->get('app_name_print', $default = 'STS Cinema') }}</h1>
                    <h5 class="text-center m-0 p-0">{{ settings()->get('address', $default = 'Dhangadhi') }}</h5>
                    <i class="d-block text-center mb-3">(Daily Report)</i>
                </div>
                <div class="d-flex">
                    <x-per-page></x-per-page>
                </div>
                <x-table-component :headers="['S.N', 'Sn Number', 'Number of products', 'Price']">
                    @foreach ($reports as $index=>$report)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{$index}}</td>
                            <td>{{$report->count()}}</td>
                            <td>Rs. {{$report->sum('price')}}</td>
                            {{-- <td>{{ $report->product->name }}</td>
                            <td>Rs. {{ $report->price }}</td>
                            <td>{{ $report->sn_number }}</td> --}}
                        </tr>
                    @endforeach
                    <tr  class="text-center">
                        <td colspan="3">Total</td>
                        <td colspan="2">Rs.{{$totalPrice}}</td>
                    </tr>
                </x-table-component>
                <x-pagination :data="$reports" />
            </div>
        </div>
    </div>
@endsection
