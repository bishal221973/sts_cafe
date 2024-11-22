@extends('layouts.app')

@section('content')
    <x-breadcrumb :items="[['title' => 'Combo', 'url' => null], ['title' => 'Create', 'url' => null]]" />

        <div class="row px-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <x-table-component :headers="['S.N', 'Combo','Price','Category','Sub Category','Total products', 'Action']">
                            @foreach ($combos as $combo)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $combo->name }}</td>
                                    <td>{{ $combo->price }}</td>
                                    <td>{{ $combo->category->name }}</td>
                                    <td>{{ $combo->subCategory->name }}</td>
                                    <td>{{ $combo->sub->count() }}</td>
                                    <td>
                                        <x-edit-button url="{{ route('combo.edit', $combo) }}" />
                                        <x-delete-button url="{{ route('combo.delete', $combo) }}" />
                                    </td>
                                </tr>
                            @endforeach
                        </x-table-component>
                        <x-pagination :data="$combos" />
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
