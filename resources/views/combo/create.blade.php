@extends('layouts.app')

@section('content')
    <x-breadcrumb :items="[['title' => 'Combo', 'url' => null], ['title' => 'Create', 'url' => null]]" />

    <form action="{{ $combo->id ? route('combo.update',$combo) : route('combo.store') }}" method="POST">
        @csrf
        @isset($combo->id)
            @method('PUT')
        @endisset
        <div class="row px-3">
            <div class="{{ $combo->id ? 'col-lg-12' : 'col-lg-8' }}">
                <div class="card">
                    <div class="card-body">
                        <form action="">
                            <div class="row">
                                <div class="col-lg-6">

                                    <div class="form-group">
                                        <label>Combo Name</label>
                                        <input type="text" name="name" value="{{ old('name', $combo->name) }}" required
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="text" name="price" value="{{ old('price', $combo->price) }}"
                                            required class="form-control">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>category <span class="text-danger">*</span></label>
                                        <select name="category_id" id="category_id" required class="form-control" required>
                                            <option value="">Select category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id', $combo->category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Sub category <span class="text-danger">*</span></label>
                                        <select name="sub_category_id" required id="sub_category_id" class="form-control"
                                            required>
                                            <option value="">Select category</option>
                                            @if ($combo->id)
                                                @foreach ($subCategories as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ old('sub_category_id', $combo->sub_category_id) == $item->id ? 'selected' : '' }}>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('sub_category_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            @if (!$combo->id)
                                <div class="form-group">
                                    <label for="">Combo Items</label>

                                    <div class="row">
                                        @foreach ($products as $product)
                                            <div class="col-lg-4">
                                                <div class="card position-relative">
                                                    <img src="{{ asset('storage') . '/' . $product->image }}"
                                                        style="width: 100%; height: 100px;" alt="">
                                                    <div class="position-absolute top-0 left-0 h-100 w-100 d-flex justify-content-center align-items-center"
                                                        style="background-color: rgba(0,0,0, 0.5)">
                                                        <h5 class="text-white">
                                                            {{ $product->name }}
                                                        </h5>
                                                    </div>
                                                    <input type="checkbox" class="checkbox1"
                                                        data-name="{{ $product->name }}" data-id="{{ $product->id }}"
                                                        data-price="{{ $product->price }}">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            @if ($combo->id)
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-info">Update</button>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
            @if (!$combo->id)
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5>Selected Items</h5>
                            <div id="selected-items">
                                <p>No items selected.</p>
                            </div>

                            <button class="btn btn-info w-100">Save</button>
                        </div>
                    </div>
                </div>
            @endif
        </div>

    </form>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.checkbox1');
            const selectedItemsDiv = document.getElementById('selected-items');

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    updateSelectedItems();
                });
            });

            function updateSelectedItems() {
                selectedItemsDiv.innerHTML = ''; // Clear current items
                let selectedItems = [];
                let totalPrice = 0;

                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        const name = checkbox.getAttribute('data-name');
                        const id = checkbox.getAttribute('data-id');
                        const price = parseFloat(checkbox.getAttribute('data-price'));
                        selectedItems.push({
                            id,
                            name,
                            price,
                            qty: 1
                        });
                    }
                });

                if (selectedItems.length === 0) {
                    selectedItemsDiv.innerHTML = '<p>No items selected.</p>';
                    return;
                }

                selectedItems.forEach(item => {
                    const itemDiv = document.createElement('div');
                    itemDiv.classList.add('d-flex', 'justify-content-between', 'align-items-center',
                        'mb-2');
                    itemDiv.innerHTML = `
                        <span>${item.name}</span>
                        <input type="hidden" value="${item.id}" name="product_id[]"/>
                        <input type="hidden" id="textqty-${item.id}" value="${item.qty}" name="qty[]"/>
                        <div>
                            <button type="button" class="btn btn-sm btn-secondary" onclick="changeQuantity('${item.id}', -1)">-</button>
                            <span id="qty-${item.id}">${item.qty}</span>
                            <button type="button" class="btn btn-sm btn-secondary" onclick="changeQuantity('${item.id}', 1)">+</button>
                        </div>
                    `;
                    selectedItemsDiv.appendChild(itemDiv);
                });
            }

            window.changeQuantity = function(id, change) {
                const qtyElement = document.getElementById(`qty-${id}`);
                const textqtyElement = document.getElementById(`textqty-${id}`);
                let qty = parseInt(qtyElement.textContent);
                qty += change;

                if (qty < 0) qty = 0; // Prevent negative quantities
                qtyElement.textContent = qty;
                textqtyElement.value = qty;
            }
        });
    </script>
@endsection

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.7/axios.min.js"></script>
    <script>
        $("#category_id").change(() => {
            let id = $("#category_id").val();
            let url = "{{ route('product.subCategory', ':id') }}";

            url = url.replace(':id', id);
            axios.get(url).then((response) => {
                let selectElement = document.getElementById("sub_category_id");
                selectElement.innerHTML = "";
                let option = document.createElement("option");
                option.value = "";
                option.textContent = 'Select sub category';
                selectElement.appendChild(option);
                response.data.forEach(item => {
                    let option = document.createElement("option");
                    option.value = item.id;
                    option.textContent = item.name;
                    selectElement.appendChild(option);
                });
            })
        });


        $("#preview").click(() => {
            $("#fileInput").click();
        })


        const fileInput = document.getElementById('fileInput');
        const preview = document.getElementById('preview');

        // Event listener for file input change (when a user selects a file)
        fileInput.addEventListener('change', function(event) {
            const file = event.target.files[0]; // Get the first selected file

            if (file) {
                const reader = new FileReader();

                // Event listener for when the file is read
                reader.onload = function(e) {
                    // Create an image element and set its source to the file's data URL
                    const img = document.createElement('img');
                    img.src = e.target.result; // This is the base64 image data

                    // Clear any existing content and append the image to the preview
                    preview.innerHTML = ''; // Clear previous preview
                    preview.appendChild(img); // Show the image

                };

                // Read the image file as a data URL
                reader.readAsDataURL(file);
            } else {
                preview.innerHTML = '<p>No image selected.</p>'; // Display a message if no file is selected
            }
        });
    </script>
@endpush
