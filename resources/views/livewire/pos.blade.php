<div>
    <div class="printable-bill">
        <div class="d-flex justify-content-center">
            <img src="{{ asset('logo.jpg') }}" width="250px" alt="">
        </div>
        <b class="d-block text-center">{{ settings()->get('print_app_name', $default = null) }}</b>
        <label class="d-block text-center print-font-size1">{{ settings()->get('address', $default = null) }}</label>
        <label class="d-block text-center print-font-size1 mt-1">Tax Invoice</label>

        <div class="d-flex justify-content-between">
            <label class="print-font-size1">S.No.:
                <b>{{ settings()->get('sn_prefix', $default = null) }}-{{ session()->get('snNumber') }}</b></label>
            <label class="print-font-size1">Vat no. <span>{{ settings()->get('vat', $default = null) }}</span></label>
        </div>
        <div class="d-flex justify-content-between">
            <label class="print-font-size1">Cus. Name: <b></b></label>
        </div>
        <div class="d-flex justify-content-between">
            <label class="print-font-size1">Pan/VAT No.: <b></b></label>
        </div>
        @php
            $total = 0;
        @endphp
        <table class="pos-table">
            <thead>
                <tr>
                    <td>Particulars</td>
                    <td>Qty</td>
                    <td>Unit Price</td>
                    <td>Unit Total</td>
                </tr>
            </thead>
            <tbody>
                @if (session()->get('data'))

                    @foreach (session()->get('data') as $item1)
                        <tr>
                            <td>{{ $item1['product']->name }}</td>
                            <td>{{ $item1['quantity'] }}</td>
                            <td>{{ $item1['product']->price }}</td>
                            <td>{{ $item1['product']->price * $item1['quantity'] }}</td>
                        </tr>

                        @php
                            $total += $item1['product']->price * $item1['quantity'];
                        @endphp
                    @endforeach
                @endif
            </tbody>
        </table>
        @php
            $taxAmt = 0;
            $taxAmt = $total * (13 / 100);
        @endphp
        <div class="d-flex justify-content-end">
            <label class="print-font-size1">Subtotal: Rs {{ round($total - $taxAmt, 2) }}</label>
        </div>
        <div class="d-flex justify-content-end">

            <label class="print-font-size1">VAT (13%): Rs {{ round($taxAmt, 2) }}</label>
        </div>
        <div class="d-flex justify-content-end">
            <label class="print-font-size1">Total: Rs {{ round($total, 2) }}</label>
        </div>
        <div class="d-flex">
            <label class="print-font-size1">Printed By: <b>{{ auth()->user()->name }}</b></label>
        </div>

        <div class="d-flex justify-content-between">
            <div>
                <label class="print-font-size1">{{ now()->format('Y/m/d') }} {{ date('h:i A') }}</label>
            </div>
            <div>
                <small class="text-small">Warning: Restriction of Permission by Management</small>
            </div>
        </div>

    </div>
    <div class="d-flex noPrint">
        <div class="pos-sidebar">
            <div class="p-2 mb-3">
                <div class="bg-white rounded pos-sidebar-logo">
                    <img src="{{ asset('logo.jpg') }}" width="100%" alt="">
                </div>
            </div>
            <div class="sidebar-menu-pos">
                <button
                    class="text-white d-block px-3 rounded pos-sidebar-menu mb-1 {{ !$selectedCategory ? 'active' : '' }}"
                    wire:click="selectCategory(null)">All</button>
                @foreach ($categories as $category)
                    <button
                        class="text-white d-block px-3 rounded pos-sidebar-menu mb-1 {{ $selectedCategory == $category->id ? 'active' : '' }}"
                        wire:click="selectCategory({{ $category->id }})">{{ $category->name }}</button>
                @endforeach
            </div>
        </div>
        <div class="pos-content">
            <div class="px-5 py-2">
                <div class="bg-white pos-nav mb-3 d-flex justify-content-between">
                    <div></div>
                    <div>{{ auth()->user()->name }}</div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="d-flex sub-menus">
                            @if (!$subCategories)
                                <a href="#" class="bg-info btn text-white"
                                    wire:click.prevent="filterProducts">All</a>
                            @else
                                <button class="btn mr-1 {{ !$selectedSubCategory ? 'bg-info  text-white' : '' }}"
                                    wire:click="selectSubCategory(null)">All</button>
                                @foreach ($subCategories as $subCategory)
                                    <button
                                        class="text-dark btn text-white mr-1 {{ $selectedSubCategory == $subCategory->id ? 'bg-info  text-white' : '' }}"
                                        wire:click="selectSubCategory({{ $subCategory->id }})">{{ $subCategory->name }}</button>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-7">
                        <div class="products-list row">
                            @foreach ($products as $product)
                                <div class="col-lg-4">
                                    <div class="product-item mb-3">
                                        <img src="{{ asset('storage') . '/' . $product->image }}" alt="">
                                        <div class="hover-img">
                                            <span
                                                class=" px-2 rounded m-2  text-center bg-danger text-white">{{ $product->stock }}</span>
                                        </div>
                                        <div class="product-hover">
                                            <h5 class=" px-2 rounded m-0 p-0 text-center text-white">
                                                {{ $product->name }}</h5>
                                            <p class="d-block text-center m-0 p-0 text-white">Price:
                                                {{ $product->price }}</p>
                                            <div class="d-flex mt-3 justify-content-center purchase-btn">
                                                <button wire:click="incrementPurchase({{ $product->id }})"
                                                    class=""><i class="fa fa-plus"></i></button>
                                                <span class="px-2 text-white"></span>
                                                <button wire:click="decrementPurchase({{ $product->id }})"
                                                    class=""><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <h5 class="font-weight-bold">Selected items</h5>

                        <div style="height:60vh">
                            @foreach ($purchasedItems as $purchasedItem)
                                <div
                                    class="d-flex justify-content-between m-0 p-3 bg-white align-items-center rounded mb-2">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <h5 class=" m-0">{{ $purchasedItem['product']->name }}</h5>
                                        </div>


                                        <div class="d-flex pl-4">
                                            Rs. {{ $purchasedItem['quantity'] * $purchasedItem['product']->price }}
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center ml-3">
                                        <button wire:click="incrementPurchase({{ $purchasedItem['product']->id }})"
                                            class="btn btn-light btn-sm">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                        <span class="px-3 ">{{ $purchasedItem['quantity'] }}</span>
                                        <button wire:click="decrementPurchase({{ $purchasedItem['product']->id }})"
                                            class="btn btn-light btn-sm">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    @php
                                        $totalPrice = 0;
                                        foreach ($purchasedItems as $item) {
                                            for ($i = 0; $i < $item['quantity']; $i++) {
                                                $totalPrice += $item['product']->price;
                                            }
                                        }
                                    @endphp
                                    <h5>Total</h5>
                                    <span>Rs. {{ $totalPrice }}</span>
                                </div>
                                <button wire:click='sold()' class="btn btn-info w-100 mt-3"
                                    {{ $totalPrice <= 0 ? 'disabled' : '' }}>Sold</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
