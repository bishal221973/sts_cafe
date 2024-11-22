@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <x-breadcrumb :items="[['title' => 'Combo', 'url' => '/combo'], ['title' => 'manage combo item', 'url' => null]]" />

        <button type="button" class="btn btn-info btn-add" data-toggle="modal" data-target="#exampleModalCenter">
            <i class="fa fa-plus mr-2"></i>Add Combo Item
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
                <form action="{{route('combo.addProduct')}}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="">Product</label>
                            <select name="product_id" class="form-control" id="">
                                <option value="">Select product</option>
                                @foreach ($products as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Qty</label>
                           <input type="number" class="form-control" name="qty" id="">
                        </div>
                        <input type="text" name="combo_id" value="{{$combo->id}}">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row px-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-uppercase font-weight-bold">{{$combo->name}}</h5>
                    <small class="text-danger d-block mb-4">Editing the item is not allowed. If you make a mistake, please delete the item and add it again.</small>
                    <x-table-component :headers="['S.N', 'Product name', 'Qty', 'Action']">
                        @foreach ($combo->sub as $combo)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $combo->product->name }}</td>
                                <td>{{ $combo->qty }}</td>
                                <td>
                                    {{-- <x-edit-button url="{{ route('combo.productEdit', $combo) }}" /> --}}
                                    <x-delete-button url="{{ route('combo.productDelete', $combo) }}" />
                                </td>
                                {{-- <td>{{ $combo->name }}</td>
                                    <td>{{ $combo->price }}</td>
                                    <td>{{ $combo->category->name }}</td>
                                    <td>{{ $combo->subCategory->name }}</td>
                                    <td><a href="{{route('combo.products',$combo)}}">{{ $combo->sub->count() }} Product(s)</a></td>
                                     --}}
                            </tr>
                        @endforeach
                    </x-table-component>
                    {{-- <x-pagination :data="$combos" /> --}}
                </div>
            </div>
        </div>
    </div>
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
