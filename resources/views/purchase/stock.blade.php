@extends('layouts.app')
@section('content')
    <x-breadcrumb :items="[['title' => 'Stock', 'url' => null]]" />

        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <x-per-page></x-per-page>
                </div>
                <x-table-component :headers="['S.N', 'Product', 'Stock']">
                    @foreach ($products as $item)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->stock }}</td>
                        </tr>
                    @endforeach
                </x-table-component>
                <x-pagination :data="$products" />
            </div>
        </div>
@endsection
