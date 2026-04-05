<table class="table table-hover">
    <thead style="background-color: #f2f2f2">
        <tr class="text-center">
            @foreach ($headers as $key => $header)
                <th>
                    @if(in_array($key, $sortable))
                        <a href="{{ request()->fullUrlWithQuery([
                            'sort_by' => $key,
                            'sort_order' => request('sort_by') == $key && request('sort_order') == 'asc' ? 'desc' : 'asc'
                        ]) }}" class="text-dark text-decoration-none">

                            {{ $header }}

                            {{-- Indicator --}}
                            @if(request('sort_by') == $key)
                                @if(request('sort_order') == 'asc')
                                    <i class="fa fa-arrow-up"></i>
                                @else
                                    <i class="fa fa-arrow-down"></i>
                                    @endif
                                    @else
                                    <i class="fa fa-arrows-up-down"></i>
                            @endif

                        </a>
                    @else
                        {{ $header }}
                    @endif
                </th>
            @endforeach
        </tr>
    </thead>

    <tbody>
        {{ $slot }}
    </tbody>
</table>
