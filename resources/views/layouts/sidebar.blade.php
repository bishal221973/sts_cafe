<a href="{{route('home')}}" class="text-white d-block px-3 rounded sidebar-menu">
    <i class="fa fa-home mr-1"></i>
    <span>Home</span>
</a>
@can('category')
    <a href="{{ route('category.index') }}" class="text-white d-block px-3 rounded sidebar-menu">
        <i class="fa-solid fa-boxes-stacked mr-1"></i>
        <span>Category</span>
    </a>
@endcan
@can('subcategory')
    <a href="{{ route('subCategory.index') }}" class="text-white d-block px-3 rounded sidebar-menu">
        <i class="fa-solid fa-shield-halved mr-1"></i>
        <span>Sub Category</span>
    </a>
@endcan
@can('product')
    <a href="{{ route('product.index') }}" class="text-white d-block px-3 rounded sidebar-menu">
        <i class="fa-solid fa-bread-slice mr-1"></i>
        <span>Product</span>
    </a>
@endcan
@can('supplier')
    <a href="{{ route('supplier.index') }}" class="text-white d-block px-3 rounded sidebar-menu">
        <i class="fa-solid fa-truck-field mr-1"></i>
        <span>Supplier</span>
    </a>
@endcan
@can('purchase')
    <a href="{{ route('purchase.index') }}" class="text-white d-block px-3 rounded sidebar-menu">
        <i class="fa-solid fa-cart-shopping mr-1"></i>
        <span>Purchase</span>
    </a>
@endcan
{{-- @can('purchase') --}}
    <a href="{{ route('combo.index') }}" class="text-white d-block px-3 rounded sidebar-menu">
        <i class="fa-solid fa-cart-shopping mr-1"></i>
        <span>Combo</span>
    </a>
{{-- @endcan --}}
@can('stock')
    <a href="{{ route('purchase.stock') }}" class="text-white d-block px-3 rounded sidebar-menu">
        <i class="fa-solid fa-money-bill-trend-up mr-1"></i>
        <span>Stock</span>
    </a>
@endcan
@can('user')
    <a href="{{ route('user.index') }}" class="text-white d-block px-3 rounded sidebar-menu">
        <i class="fa-solid fa-users mr-1"></i>
        <span>User</span>
    </a>
@endcan
@can('report')
    <a href="{{ route('report.normal') }}" class="text-white d-block px-3 rounded sidebar-menu">
        <i class="fa-solid fa-file mr-1"></i>
        <span>Report</span>
    </a>
@endcan
