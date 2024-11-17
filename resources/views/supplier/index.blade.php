@extends('layouts.app')

@section('content')
    @if ($errors->any())
        @push('script')
            <script>
                $("#exampleModalCenter").modal('show')
            </script>
        @endpush
    @endif

    @if ($supplier->id)
        @push('script')
            <script>
                $("#exampleModalCenter").modal('show')
            </script>
        @endpush
    @endif
    <div class="d-flex justify-content-between align-items-center">
        <x-breadcrumb :items="[['title' => 'Supplier', 'url' => null]]" />

        <button type="button" class="btn btn-info btn-add" data-toggle="modal" data-target="#exampleModalCenter">
            <i class="fa fa-plus mr-2"></i>Add Supplier
        </button>
    </div>




    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add new supplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ $supplier->id ? route('supplier.update', $supplier) : route('supplier.store') }}"
                    method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        @isset($supplier->id)
                            @method('PUT')
                        @endisset
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="form-group ">
                                    <label>Supplier name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{ old('name', $supplier->name) }}"
                                        name="name" placeholder="Supplier name">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">

                                <div class="form-group ">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" value="{{ old('email', $supplier->email) }}"
                                        name="email" placeholder="Email">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">

                                <div class="form-group ">
                                    <label>Phone <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{ old('phone', $supplier->phone) }}"
                                        name="phone" placeholder="Phone">
                                    @error('phone')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">

                                <div class="form-group ">
                                    <label>Address <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control"
                                        value="{{ old('address', $supplier->address) }}" name="address"
                                        placeholder="Address">
                                    @error('address')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">

                                <div class="form-group ">
                                    <label>VAT number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control"
                                        value="{{ old('vat_number', $supplier->vat_number) }}" name="vat_number"
                                        placeholder="VAT number">
                                    @error('vat_number')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary">{{ $supplier->id ? 'Update' : 'Save' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>





    <div class="row px-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @if (!$supplier->id)
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
                    <x-table-component :headers="['S.N', 'Name', 'Email', 'Address', 'Vat number', 'Action']">
                        @foreach ($suppliers as $supplier)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $supplier->name }} <br>{{ $supplier->phone ?? '' }}</td>
                                <td>{{ $supplier->email ?? '' }}</td>
                                <td>{{ $supplier->address ?? '' }}</td>
                                <td>{{ $supplier->vat_number ?? '' }}</td>
                                <td>
                                    <x-edit-button url="{{ route('supplier.edit', $supplier) }}" />
                                    <x-delete-button url="{{ route('supplier.delete', $supplier) }}" />
                                </td>
                            </tr>
                        @endforeach
                    </x-table-component>
                    <x-pagination :data="$suppliers" />

                </div>
            </div>
        </div>
    </div>
@endsection
