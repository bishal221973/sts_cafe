@extends('layouts.app')
@section('content')
    <x-breadcrumb :items="[['title' => 'Normal Report', 'url' => null]]" />

    <div class="px-3">
        <div class="d-flex justify-content-between align-items-center notPrint">
            @include('report.menu')
            <div class="d-flex">
                <a href="{{ route('report.productWise') }}?type=pdf" class="btn text-dark"><i
                        class="fa fa-file mr-2"></i>PDF</a>
                <button class="btn bg-transparent" id="btn-report-print"><i class="fa fa-file mr-2"></i>Print</button>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <div class="printOnly">
                    <h1 class="text-center m-0 p-0">{{ settings()->get('app_name_print', $default = 'STS Cinema') }}</h1>
                    <h5 class="text-center m-0 p-0">{{ settings()->get('address', $default = 'Dhangadhi') }}</h5>
                    <i class="d-block text-center mb-3">(Product wise Report)</i>
                </div>
                <x-table-component :headers="['S.N', 'Product', 'Product Count', 'Total Price']">
                    @foreach ($reports as $report)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $report->product->name }}</td>
                            <td>{{ $report->product_count }}</td>
                            <td>Rs. {{ $report->total_price }}</td>
                            {{-- <td>{{$report->created_at->format('Y/m/d')}}</td> --}}
                        </tr>
                    @endforeach
                </x-table-component>
                <x-pagination :data="$reports" />
            </div>
        </div>
    </div>
@endsection
