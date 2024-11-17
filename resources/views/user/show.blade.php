@extends('layouts.app')
@section('content')
    <x-breadcrumb :items="[['title' => 'User', 'url' => route('user.index')], ['title' => 'Show', 'url' => null]]" />

    <div class="p-3">
        <div class="row">
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center mb-3">
                            <img src="{{asset('user.png')}}" width="100px" alt="">
                        </div>
                        <h5 class="text-center">{{ $user->name }}</h5>
                        <label class="d-block text-center">{{ $user->email }}</label>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="card mb-3">
                    <div class="card-body">
                        <b>Change Password</b>
                        <form action="{{ route('user.changePassword', $user) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label>Current Password</label>
                                <input type="password" class="form-control" name="current_password">
                                @error('current_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>New Password</label>
                                <input type="password" class="form-control" name="password">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-info">Change</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <b>User Permissions</b>
                        <form action="{{ route('user.permission', $user) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="form-check py-2">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="category"
                                    id="category" {{ $user->hasPermissionTo('category') ? 'checked' : '' }}>
                                <label class="form-check-label" for="category">
                                    Category
                                </label>
                            </div>
                            <div class="form-check py-2">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="subcategory"
                                    id="subcategory" {{ $user->hasPermissionTo('subcategory') ? 'checked' : '' }}>
                                <label class="form-check-label" for="subcategory">
                                    Sub Category
                                </label>
                            </div>
                            <div class="form-check py-2">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="product"
                                    id="product" {{ $user->hasPermissionTo('product') ? 'checked' : '' }}>
                                <label class="form-check-label" for="product">
                                    Product
                                </label>
                            </div>
                            <div class="form-check py-2">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="supplier"
                                    id="supplier" {{ $user->hasPermissionTo('supplier') ? 'checked' : '' }}>
                                <label class="form-check-label" for="supplier">
                                    Supplier
                                </label>
                            </div>
                            <div class="form-check py-2">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="purchase"
                                    id="purchase" {{ $user->hasPermissionTo('purchase') ? 'checked' : '' }}>
                                <label class="form-check-label" for="purchase">
                                    Purchase
                                </label>
                            </div>
                            <div class="form-check py-2">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="stock"
                                    id="stock" {{ $user->hasPermissionTo('stock') ? 'checked' : '' }}>
                                <label class="form-check-label" for="stock">
                                    Stock
                                </label>
                            </div>
                            <div class="form-check py-2">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="user"
                                    id="user" {{ $user->hasPermissionTo('user') ? 'checked' : '' }}>
                                <label class="form-check-label" for="user">
                                    User
                                </label>
                            </div>
                            <div class="form-check py-2">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="report"
                                    id="report" {{ $user->hasPermissionTo('report') ? 'checked' : '' }}>
                                <label class="form-check-label" for="report">
                                    Report
                                </label>
                            </div>
                            <div class="form-check py-2">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="pos"
                                    id="pos" {{ $user->hasPermissionTo('pos') ? 'checked' : '' }}>
                                <label class="form-check-label" for="pos">
                                    POS
                                </label>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-info">Change</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
