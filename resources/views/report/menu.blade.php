<div class="d-flex">
    <a href="{{route('report.normal')}}" class="btn {{Route::currentRouteName() == 'report.normal' ? 'btn-info text-white' : ''}}">Normal Report</a>
    <a href="{{route('report.productWise')}}" class="btn {{Route::currentRouteName() == 'report.productWise' ? 'btn-info text-white' : ''}}">Product wise Report</a>
    {{-- <a href="#">SN wise Report</a> --}}
</div>
