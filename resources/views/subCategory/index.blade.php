@extends('layouts.app')

@section('content')
    <x-breadcrumb :items="[['title' => 'Category', 'url' => null]]" />

    <div class="row px-3">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <form
                        action="{{ $subCategory->id ? route('subCategory.update', $subCategory) : route('subCategory.store') }}"
                        method="POST">
                        @csrf
                        @isset($subCategory->id)
                            @method('PUT')
                        @endisset
                        <div class="form-group">
                            <label>category <span class="text-danger">*</span></label>
                            <select name="category_id" class="form-control">
                                <option value="">Select category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category', $subCategory->category_id == $category->id ? 'selected' : '') }}>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Category name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{ old('name', $subCategory->name) }}"
                                name="name" placeholder="Category name">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <button class="btn btn-info w-100">{{ $subCategory->id ? 'Update' : 'Save' }}</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    @if (!$subCategory->id)
                        <div class="d-flex">
                            <x-per-page></x-per-page>
                        </div>
                    @else
                        <div class="d-flex justify-content-end mb-3">
                            <button class="btn btn-secondary" onclick="window.history.back()">
                                <i class="fa-solid fa-arrow-left"></i> Back
                            </button>
                        </div>
                    @endif
                    <x-table-component :headers="['S.N', 'Category', 'Sub Category', 'Action']">
                        @foreach ($subcategories as $subcategory)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $subcategory->category->name }}</td>
                                <td>{{ $subcategory->name }}</td>
                                <td>
                                    <x-edit-button url="{{ route('subCategory.edit', $subcategory) }}" />
                                    <x-delete-button url="{{ route('subCategory.delete', $subcategory) }}" />
                                </td>
                            </tr>
                        @endforeach
                    </x-table-component>
                    <x-pagination :data="$subcategories" />

                </div>
            </div>
        </div>
    </div>
@endsection
