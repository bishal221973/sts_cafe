<div>

    <div class="content-wrapper printable-bill">

        <section class="content">
            <div class="my-div">
                <div class="row">
                    <div class="row px-1" style="overflow: hidden">
                        <div class="invoice" style="width: 550px;">
                            <div class="card" style="width: 550px">
                                <div class="card-body" id="printThis">
                                    {{-- <div class="col-12"> --}}
                                    <img src="{{ asset('logo.jpg') }}" style="margin-left:20px" alt=""
                                        class="logo-img-print">
                                    {{-- </div> --}}
                                    <h4 class="main-title text-center" style="width:360px">
                                        <b>{{ settings()->get('print_app_name', $default = 'STS Cinema') }}</b>
                                    </h4>
                                    <label style="position:relative;left:180px"
                                        class="col-12 p-0 font-weight-normal">{{ settings()->get('address', $default = 'Dhangadhi, Kailali') }}</label>
                                    <label style="position:relative;left:210px"
                                        class="col-12 m-0 p-0 font-weight-normal">Tax
                                        Invoice</label>

                                    <div class="d-flex justify-content-between mt-2 mb-0" style="width: 500px">
                                        <div class="d-flex">
                                            <label class="fs-20 font-weight-normal">S.No. :&nbsp;</label>
                                            <h5 class="fs-20">
                                                {{ settings()->get('sn_prefix', $default = null) }}-{{ session()->get('snNumber') }}
                                            </h5>
                                        </div>
                                        <div class="d-flex">
                                            <label class="fs-20 font-weight-normal">Vat No. &nbsp;</label>
                                            <h5 class="fs-20">{{ settings()->get('vat', $default = null) }}</h5>
                                        </div>
                                    </div>

                                    <div class="col-12 d-flex justify-content-between m-0 p-0">
                                        <div class="d-flex">
                                            <label class="fs-20 font-weight-normal">Cus Name :&nbsp;</label>
                                            <h5 class="fs-20 font-weight-bold"></h5>
                                        </div>

                                    </div>

                                    <div class="d-flex justify-content-between" style="width: 500px">
                                        <div class="d-flex">
                                            <label class="fs-20 font-weight-normal">Pan/VAT No.:&nbsp;</label>
                                            <h5 class="fs-20"></h5>
                                        </div>

                                    </div>
                                    <div class="d-flex justify-content-between py-1 broder-b" style="width: 500px">
                                        <div class="d-block">
                                            <h5 class="fs-20 font-weight-normal m-0 p-0 col-12">Particulars</h5>
                                        </div>
                                        <div class="d-block">
                                            <h5 class="fs-20 font-weight-normal m-0 p-0 col-12 text-center">Qty</h5>
                                        </div>

                                        <div class="d-block">
                                            <h5 class="fs-20 font-weight-normal m-0 p-0 col-12 text-center">Unit Price
                                            </h5>
                                        </div>
                                        <div class="d-block">
                                            <h5 class="fs-20 font-weight-normal m-0 p-0 col-12 text-center">Unit Total
                                            </h5>
                                        </div>
                                    </div>

                                    @php
                                        $total = 0;
                                    @endphp

                                    @if (session()->get('data'))

                                        @foreach (session()->get('data') as $item1)
                                            <div class="d-flex justify-content-between broder-b py-2"
                                                style="width: 500px">
                                                <div class="d-block">
                                                    <h5 class="fs-20">{{ $item1['product']->name }}
                                                    </h5>
                                                </div>
                                                <div class="d-block">
                                                    <h5 class="fs-20" style="margin-left: 80px">
                                                        {{ $item1['quantity'] }}</h5>
                                                </div>

                                                <div class="d-block">
                                                    <div class="col-12 d-flex justify-content-center">
                                                        <h4 class="fs-20 text-center" style="margin-left: 60px">Rs.
                                                            {{ $item1['product']->price }}
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="d-block">
                                                    <div class="col-12 d-flex justify-content-center">
                                                        <h4 class="fs-20">Rs.
                                                            {{ $item1['product']->price * $item1['quantity'] }}
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- @if ($item1['product']->type == 'combo')
                                                @foreach ($item1['product']->sub as $sub)

                                                @endforeach
                                            @endif --}}
                                            @php
                                                $total += $item1['product']->price * $item1['quantity'];
                                            @endphp
                                        @endforeach
                                    @endif

                                    @php
                                        $taxAmt = 0;
                                        $taxAmt = $total * (13 / 100);
                                    @endphp

                                    {{-- <h3 class="text-center font-weight-bold mt-3">Copy of Original -1</h3> --}}
                                    <div class="d-flex justify-content-end pr-2">
                                        <label class="fs-20">Sub Total: Rs {{ round($total - $taxAmt, 2) }}</label>
                                    </div>
                                    <div class="d-flex justify-content-end pr-2">
                                        <label class="fs-20">VAT (13%): Rs {{ round($taxAmt, 2) }}</label>
                                    </div>
                                    <div class="d-flex justify-content-end pr-2">
                                        <label class="fs-20">Total: Rs {{ round($total, 2) }}</label>
                                    </div>

                                    <div class="" style="width: 500px">
                                        <div class="d-block">
                                            <span class="fs-20">Printed By : {{ Auth()->user()->name }}</span> <br>

                                        </div>
                                        <div class="d-flex justify-content-between">
                                            {{ now()->format('Y/m/d') }}
                                            {{ Carbon\Carbon::now('Asia/Kathmandu')->format('h:i A') }}
                                            <small class="">Warning: Restriction of Permission by
                                                Management</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- /.container-fluid -->
        </section>


    </div>















    {{-- <div class="printable-bill">
        <div class="d-flex justify-content-center">
            <img src="{{ asset('logo.jpg') }}" width="700px" alt="">
        </div>
        <b class="d-block text-center" style="font-size:50px">{{ settings()->get('print_app_name', $default = null) }}</b>
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

    </div> --}}
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
                                <div class="col-lg-4 mb-1" style="height:150px">
                                    <div class="product-item  mb-3">
                                        @if ($product->sub->count() > 0)
                                            <div class="pos-imgs">
                                                @foreach ($product->sub as $index => $sub)
                                                    @php
                                                        $subProduct = App\Models\Product::find($sub->product_id);
                                                    @endphp
                                                    <img src="{{ asset('storage') . '/' . $subProduct->image }}"
                                                        alt=""
                                                        class="product-image{{ $product->sub->count() }}">
                                                    @if ($index >=3)
                                                        @php
                                                            break;
                                                        @endphp
                                                    @endif
                                                        @endforeach
                                            </div>
                                        @else
                                            <img src="{{ asset('storage') . '/' . $product->image }}" alt="">
                                        @endif
                                        <div class="hover-img">
                                            <span
                                                class=" px-2 rounded m-2  text-center bg-danger text-white">
                                                {{-- {{ $product->stock }} --}}
                                                @if ($product->type == "combo")
                                                    combo
                                                @else
                                                {{ $product->stock }}
                                                @endif
                                            </span>
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

                        <div style="height:45vh;overflow-y:scroll">
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
                                    <h5>Net Total</h5>
                                    <span id="totalPrice" data-totalPrice="{{ $totalPrice }}">Rs.
                                        {{ $totalPrice }}</span>
                                </div>
                                <input type="hidden" value="{{ $totalPrice }}" name="" id="totalAmt">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label>Received Amt</label>
                                    <input type="text" class="form-control" wire:model="receivedAmt"
                                        style="width: 150px" id="paidAmt">
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <label>Return</label>
                                    <label><span>Rs.</span><span id="returnAmt"></span></label>
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

@push('script')
    <script>
        $("#paidAmt").on('input', function() {
            let totalAmt = $("#totalAmt").val();
            let receivedAmt = $(this).val();
            if (receivedAmt.length <= 0) {
                receivedAmt = 0;
            }
            let remainAmt = parseInt(receivedAmt) - parseInt(totalAmt);
            if (parseInt(remainAmt) > 0) {
                $("#returnAmt").text(remainAmt);
            } else {
                $("#returnAmt").text('0');
            }
        });
    </script>
@endpush
