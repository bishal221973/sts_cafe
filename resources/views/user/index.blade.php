@extends('layouts.app')
@section('content')
    <x-breadcrumb :items="[['title' => 'User', 'url' => null]]" />
        <div class="p-3">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{$user->id ? route('user.update',$user) : route('user.store')}}" method="POST">
                                @csrf
                                @isset($user->id)
                                    @method('put')
                                @endisset
                                <div class="form-group">
                                    <label>Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" value="{{old('name',$user->name)}}">
                                    @error('name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" value="{{old('email',$user->email)}}">
                                    @error('email')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="password">
                                    @error('password')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Confirmed password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="password_confirmation">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-info w-100">{{$user->id ? 'Update' : 'Save'}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <x-table-component :headers="['S.N', 'Name', 'Action']">
                                @foreach ($users as $user)
                                    <tr class="text-center">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }} <br> {{ $user->email ?? '' }}</td>
                                        <td>
                                            <a href="{{route('user.show',$user)}}" class="btn btn-info btn-sm">View</a>
                                            <x-edit-button url="{{ route('user.edit', $user) }}" />
                                            <x-delete-button url="{{ route('user.delete', $user) }}" />
                                        </td>
                                    </tr>
                                @endforeach
                            </x-table-component>
                            <x-pagination :data="$users" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
