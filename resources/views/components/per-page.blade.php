<div class="d-flex align-items-center mb-3">
    Per page
    <form action="{{ route(Route::currentRouteName()) }}">
        @if (request('per_page'))
        <select name="per_page" id="" class="ml-2 form-control" onchange="this.form.submit()" style="width:70px">
            <option {{request('per_page') == 10 ? 'selected' : ''}} value="10">10</option>
            <option {{request('per_page') == 20 ? 'selected' : ''}} value="20">20</option>
            <option {{request('per_page') == 50 ? 'selected' : ''}} value="50">50</option>
            <option {{request('per_page') == 100 ? 'selected' : ''}} value="100">100</option>
            <option {{request('per_page') == 500 ? 'selected' : ''}} value="500">500</option>
        </select>
        @else

        <select name="per_page" id="" class="ml-2 form-control" onchange="this.form.submit()" style="width:70px">
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
            <option value="500">500</option>
        </select>
        @endif
    </form>
</div>
