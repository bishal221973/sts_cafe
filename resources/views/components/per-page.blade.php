<style>
    .toolbar-card {
        background: #fff;
        border-radius: 12px;
        padding: 12px 16px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
    }

    .toolbar-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(0,0,0,0.12);
    }

    .toolbar-input {
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .toolbar-input:focus {
        box-shadow: 0 0 0 2px rgba(0,123,255,0.2);
        border-color: #007bff;
    }

    .btn-animate {
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .btn-animate:hover {
        transform: scale(1.05);
    }

    .fade-in {
        animation: fadeIn 0.4s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(5px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="toolbar-card d-flex flex-wrap justify-content-between align-items-center noPrint fade-in w-100 mb-3">

    <!-- Left: Per Page -->
    <div class="d-flex align-items-center mb-2">
        <span class="mr-2">Per page</span>
        <form action="{{ route(Route::currentRouteName()) }}">
            <select name="per_page" class="form-control toolbar-input" style="width:80px"
                onchange="this.form.submit()">
                @foreach([10,20,50,100,500] as $size)
                    <option value="{{ $size }}" {{ request('per_page',10)==$size ? 'selected' : '' }}>
                        {{ $size }}
                    </option>
                @endforeach
            </select>

            @if (request('search'))
                <input type="hidden" name="search" value="{{ request('search') }}">
            @endif
        </form>
    </div>

    <!-- Right: Filters -->
    <div class="d-flex flex-wrap align-items-center">

        @if (Route::currentRouteName() == 'report.monthly')
            <form action="{{ route(Route::currentRouteName()) }}" class="d-flex mr-2 mb-2">
                @if (request('per_page'))
                    <input type="hidden" name="per_page" value="{{ request('per_page') }}">
                @endif

                <input type="date" name="date" class="form-control toolbar-input">
                <button class="btn btn-secondary btn-animate ml-1">
                    <i class="fa-solid fa-filter"></i>
                </button>
            </form>
        @endif

        <!-- Search -->
        <form action="{{ route(Route::currentRouteName()) }}" class="d-flex mb-2">
            @if (request('per_page'))
                <input type="hidden" name="per_page" value="{{ request('per_page') }}">
            @endif

            <input type="text" name="search"
                value="{{ request('search') }}"
                class="form-control toolbar-input"
                placeholder="Search...">

            <button class="btn btn-primary btn-animate ml-1">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>

    </div>
</div>