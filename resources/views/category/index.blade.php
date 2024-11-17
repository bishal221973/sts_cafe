@extends('layouts.app')

@section('content')
    <x-breadcrumb :items="[['title' => 'Category', 'url' => null]]" />

    <div class="row px-3">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <form action="{{ $category->id ? route('category.update',$category) : route('category.store') }}" method="POST">
                        @csrf
                        @isset($category->id)
                            @method('PUT')
                        @endisset
                        <div class="form-group">
                            <label>Category name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{old('name',$category->name)}}" name="name" placeholder="Category name">
                            @error('name')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <button class="btn btn-info w-100">{{$category->id ? 'Update' : 'Save'}}</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <x-table-component :headers="['S.N', 'Category Name', 'Action']">
                        @foreach ($categories as $category)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <x-edit-button url="{{route('category.edit',$category)}}"/>
                                    <x-delete-button url="{{route('category.delete',$category)}}"/>
                                </td>
                            </tr>
                        @endforeach
                    </x-table-component>
                    <x-pagination :data="$categories"/>

                </div>
            </div>
        </div>
    </div>
@endsection
