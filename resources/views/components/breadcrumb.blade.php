<nav aria-label="breadcrumb " class="notPrint d-flex align-items-center">
    <ol class="breadcrumb bg-transparent d-flex align-items-center">
        <li class="breadcrumb-item">
        <a href="{{route('home')}}"><i class="fa fa-home pr-2"></i>Home</a>
        </li>
        @foreach ($items as $item)
            <li class="breadcrumb-item">
                @if ($item['url'])
                    <a href="{{ $item['url'] }}">{{ $item['title'] }}</a>
                @else
                    {{ $item['title'] }}
                @endif
            </li>
        @endforeach
    </ol>
</nav>
