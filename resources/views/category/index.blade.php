@extends('layouts.app')

@section('content')
    <x-breadcrumb :items="[['title' => 'Category', 'url' => null]]" />

    <div class="row px-3">
        <div class="col-lg-4">
            <div class="card border-0 card-animate">
                <div class="card-body">
                    <form action="{{ $category->id ? route('category.update', $category) : route('category.store') }}"
                        method="POST">
                        @csrf
                        @isset($category->id)
                            @method('PUT')
                        @endisset
                        <div class="form-group">
                            <div style="line-height:10px" class="mb-3">
                                <label>Category name <span class="text-danger">*</span></label>
                                <small class="d-block text-secondary">Category name helps group related items
                                    together.</small>
                            </div>
                            <input type="text" class="form-control" value="{{ old('name', $category->name) }}"
                                name="name" placeholder="Category name">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <button class="btn btn-info w-100">{{ $category->id ? 'Update' : 'Save' }}</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card border-0 card-animate">
                <div class="card-body">
                    @if (!$category->id)
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
                    <x-table-component :headers="[
                        'id' => 'S.N',
                        'name' => 'Category Name',
                        'subCategories' => 'Sub Categories',
                        'action' => 'Action',
                    ]" :sortable="['name']">
                        @foreach ($categories as $category)
                            <tr class="text-center {{ $loop->even ? 'bg-light' : '' }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category?->sub_categories?->count() ?? 0 }}</td>
                                <td>
                                    <x-edit-button url="{{ route('category.edit', $category) }}" />
                                    <x-delete-button url="{{ route('category.delete', $category) }}" />
                                </td>
                            </tr>
                        @endforeach
                    </x-table-component>
                    <x-pagination :data="$categories" />

                </div>
            </div>
        </div>
    </div>
@endsection
