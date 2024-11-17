@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <x-breadcrumb :items="[['title' => 'Purchase', 'url' => null], ['title' => 'Create', 'url' => null]]" />
    </div>

    <div class="card">
        <div class="card-body">
            <!-- List of cloned products -->
            <form action="{{route('purchase.store')}}" method="POST">
                @csrf
                <div id="product-list" class="">
                    <div class="product-item row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="m-0 p-0">Product</label>
                                <select name="product_id[]" required class="form-control" id="">
                                    <option value="">Select product</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="m-0 p-0">Supplier</label>
                                <select name="supplier_id[]" required class="form-control" id="">
                                    <option value="">Select product</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="m-0 p-0">Quantity</label>
                                <input type="number" required name="quantity[]" class="form-control">
                            </div>
                        </div>
                        <!-- Column 3: Buttons -->
                        <div class="col-lg-3 d-flex  justify-content-between align-items-center">
                            <button class="btn btn-danger btn-remove">Remove</button>
                            <button class="btn btn-success btn-add">Add</button>
                        </div>
                        <div class="col-12">
                            <hr class="m-0 p-0">
                        </div>
                    </div>
                </div>
                <button  class="btn btn-primary mt-3">Add Product</button>
            </form>

            <!-- Button to add new products -->
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            // Function to hide or show remove button based on last product
            function updateButtonsVisibility() {
                // Hide the Add button for all but the last product
                $('#product-list .product-item').each(function(index) {
                    if ($(this).is(':last-child')) {
                        // Show the "Add" button in the last product div
                        $(this).find('.btn-add').show();
                        // Hide the "Remove" button in the last product div
                        $(this).find('.btn-remove').hide();
                    } else {
                        // Hide the "Add" button in all other product divs
                        $(this).find('.btn-add').hide();
                        // Show the "Remove" button in all product divs except the last one
                        $(this).find('.btn-remove').show();
                    }
                });
            }

            // Handle the Add Product button click
            $('#btn-add').click(function() {
                // Find the last .product-item and clone it
                var clonedProduct = $('#product-list .product-item').last().clone();

                // Reset input fields in the cloned product
                clonedProduct.find('input').val(''); // Reset the input fields

                // Append the cloned product to the #product-list
                $('#product-list').append(clonedProduct);

                // After appending, update the visibility of the buttons
                updateButtonsVisibility();
            });

            // Handle the Remove button click
            $(document).on('click', '.btn-remove', function() {
                $(this).closest('.product-item')
                    .remove(); // Remove the product div that contains the clicked Remove button

                // After removal, update the visibility of the buttons
                updateButtonsVisibility();
            });

            // Handle the Add button inside each product (optional for inner functionality)
            $(document).on('click', '.btn-add', function() {
                var clonedProduct = $(this).closest('.product-item').clone();

                // Reset the input fields for the cloned product
                clonedProduct.find('input').val('');

                // Append the cloned product next to the current product
                $(this).closest('.product-item').after(clonedProduct);

                // Update the visibility of the buttons
                updateButtonsVisibility();
            });

            // Initialize visibility of the buttons based on the initial product list
            updateButtonsVisibility();
        });
    </script>
@endpush
