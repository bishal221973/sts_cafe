@extends('layouts.app')
@section('content')
    @if ($errors->any())
        @push('script')
            <script>
                $("#exampleModalCenter").modal('show')
            </script>
        @endpush
    @endif

    @if ($product->id)
        @push('script')
            <script>
                $("#exampleModalCenter").modal('show')
            </script>
        @endpush
    @endif

    <div class="d-flex justify-content-between align-items-center">
        <x-breadcrumb :items="[['title' => 'Product', 'url' => null]]" />

        <button type="button" class="btn btn-info btn-add" data-toggle="modal" data-target="#exampleModalCenter">
            <i class="fa fa-plus mr-2"></i>Add Product
        </button>
    </div>



    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add new product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ $product->id ? route('product.update', $product) : route('product.store') }}" method="POST"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        @isset($product->id)
                            @method('put')
                        @endisset
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>category <span class="text-danger">*</span></label>
                                    <select name="category_id" id="category_id" class="form-control" required>
                                        <option value="">Select category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
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
                                    <select name="sub_category_id" id="sub_category_id" class="form-control" required>
                                        <option value="">Select category</option>
                                        @if ($product->id)
                                            @foreach ($subcategories as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('sub_category_id', $product->sub_category_id) == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('sub_category_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">

                                <div class="form-group">
                                    <label>Product name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ old('name', $product->name) }}" required>
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">

                                <div class="form-group">
                                    <label>Product Price <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{ old('price', $product->price) }}"
                                        name="price" required>
                                    @error('price')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <input type="file" id="fileInput" name="image" accept="image/*">

                                <!-- Preview area where the image will be shown -->
                                <div id="preview" class="img-preview">
                                    @if ($product->id)
                                        <img src="{{ asset('storage') . '/' . $product->image }}" alt="">
                                    @else
                                        <p>No image selected.</p>
                                    @endif
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary">{{ $product->id ? 'Update' : 'Save' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row p-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <x-table-component :headers="['S.N', 'Image', 'Name', 'Price', 'Category', 'Sub Category', 'Action']">
                        @foreach ($products as $product)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td><img src="{{ asset('storage') . '/' . $product->image }}" width="40px"
                                        alt="">
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>Rs. {{ $product->price }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ $product->subCategory->name }}</td>
                                <td>
                                    <x-edit-button url="{{ route('product.edit', $product) }}" />
                                    <x-delete-button url="{{ route('product.delete', $product) }}" />
                                </td>
                            </tr>
                        @endforeach
                    </x-table-component>
                    <x-pagination :data="$products" />
                </div>
            </div>
        </div>
    </div>
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
