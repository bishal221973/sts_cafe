@extends('layouts.app')
@section('content')
    <x-breadcrumb :items="[['title' => 'Setting', 'url' => null]]" />
    <div class="p-3">
        <div class="row">
            <div class="col-lg-7">
                <h5>Personal Information</h5>
                <small>Update your personal information.</small>
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('user.update', auth()->user()) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{ old('name', auth()->user()->name) }}"
                                    name="name">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" value="{{ old('email', auth()->user()->email) }}"
                                    name="email">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <input type="hidden" value="redirect" name="redirect">
                            <div class="form-group d-flex justify-content-end">
                                <button class="btn btn-info">Change</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-7">
                <h5>Password Information</h5>
                <small>Update your system password to improve security.</small>
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('user.changePassword', auth()->user()) }}" method="POST">
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
                            <input type="hidden" value="redirect" name="redirect">
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-info">Change</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-7">
                <h5>System Information</h5>
                {{-- <small>Update your system information like system name.</small> --}}
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('setting.syncSetting') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>System name</label>
                                <input type="text" class="form-control" value="{{old('app_name', settings()->get('app_name', $default = null) )}}" name="app_name">
                                @error('app_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>System name <i>(Print)</i></label>
                                <input type="text" class="form-control" value="{{old('print_app_name', settings()->get('print_app_name', $default = null) )}}" name="print_app_name">
                                @error('print_app_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="test" class="form-control" value="{{old('address', settings()->get('address', $default = null) )}}" name="address">
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Vat/Pan number</label>
                                <input type="text" class="form-control" value="{{old('vat', settings()->get('vat', $default = null) )}}" name="vat">
                                @error('vat')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Sn number prefix</label>
                                <input type="text" class="form-control" value="{{old('sn_prefix', settings()->get('sn_prefix', $default = null) )}}" name="sn_prefix">
                                @error('sn_prefix')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <input type="hidden" value="redirect" name="redirect">
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
