<div class="d-flex">
    <a href="{{route('report.normal')}}" class="btn {{Route::currentRouteName() == 'report.normal' ? 'btn-info text-white' : ''}}">Daily Report</a>
    <a href="{{route('report.monthly')}}" class="btn {{Route::currentRouteName() == 'report.monthly' ? 'btn-info text-white' : ''}}">Monthly Report</a>
    <a href="{{route('report.productWise')}}" class="btn {{Route::currentRouteName() == 'report.productWise' ? 'btn-info text-white' : ''}}">Product wise Report</a>
    <a href="{{route('report.userWise')}}" class="btn {{Route::currentRouteName() == 'report.userWise' ? 'btn-info text-white' : ''}}">User wise Report</a>
    {{-- <a href="#">SN wise Report</a> --}}
</div>
