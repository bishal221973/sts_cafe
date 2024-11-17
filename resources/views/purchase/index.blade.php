@extends('layouts.app')
@section('content')
    @if ($errors->any())
        @push('script')
            <script>
                $("#exampleModalCenter").modal('show')
            </script>
        @endpush
    @endif

    @if ($purchase->id)
        @push('script')
            <script>
                $("#exampleModalCenter").modal('show')
            </script>
        @endpush
    @endif

    <div class="d-flex justify-content-between align-items-center">
        <x-breadcrumb :items="[['title' => 'Purchase', 'url' => null]]" />
        <a href="{{ route('purchase.create') }}" class="btn btn-info btn-add">
            <i class="fa fa-plus mr-2"></i>Purchase Products
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            @if (!$purchase->id)
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
            <x-table-component :headers="['S.N', 'Product', 'Supplier', 'Quantity', 'Action']">
                @foreach ($purchases as $item)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->supplier->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>
                            <x-edit-button url="{{ route('purchase.edit', $item) }}" />
                            <x-delete-button url="{{ route('purchase.delete', $item) }}" />
                        </td>
                    </tr>
                @endforeach
            </x-table-component>
            <x-pagination :data="$purchases" />
        </div>
    </div>


    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Update purchase</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


                @if ($purchase->id)
                    <form action="{{ $purchase->id ? route('purchase.update', $purchase) : route('purchase.store') }}"
                        method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            @csrf
                            @isset($purchase->id)
                                @method('put')
                            @endisset

                            <div class="form-group">
                                <label class="m-0 p-0">Product</label>
                                <select name="product_id" required class="form-control" id="">
                                    <option value="">Select product</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}"
                                            {{ $purchase->product_id == $product->id ? 'selected' : '' }}>
                                            {{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="m-0 p-0">Supplier</label>
                                <select name="supplier_id" required class="form-control" id="">
                                    <option value="">Select product</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}"
                                            {{ $supplier->id == $purchase->supplier_id ? 'selected' : '' }}>
                                            {{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="m-0 p-0">Quantity</label>
                                <input type="number" required name="quantity"
                                    value="{{ old('wuantity', $purchase->quantity) }}" class="form-control">
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary">Update</button>
                        </div>
                    </form>
                @endif

            </div>
        </div>
    </div>
@endsection
