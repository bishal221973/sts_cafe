@extends('layouts.app')

@section('content')
    {{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div> --}}
    <x-breadcrumb :items="[
        // ['title' => 'Products', 'url' => route('home')],
        ['title' => 'Dashboard', 'url' => null],
    ]" />

    <div class="row">
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body bg-info">
                    <label class="text-white">Products</label>
                    <h3 class="text-white font-weight-bold">{{App\Models\Product::count()}}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body bg-success">
                    <label class="text-white">Users</label>
                    <h3 class="text-white font-weight-bold">{{App\Models\User::count()}}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body bg-danger">
                    <label class="text-white">Supplier</label>
                    <h3 class="text-white font-weight-bold">{{App\Models\Supplier::count()}}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body bg-warning">
                    <label class="text-white">Category</label>
                    <h3 class="text-white font-weight-bold">{{App\Models\Category::count()}}</h3>
                </div>
            </div>
        </div>
    </div>
@endsection
