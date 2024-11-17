
<div class="d-flex">
    <x-per-page></x-per-page>
</div>
<table class="table table-hover">
    <thead>
        <tr class="text-center">
            @foreach ($headers as $header)
                <th>{{ $header }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        {{-- @foreach ($rows as $row)
            <tr>
                @foreach ($row as $cell)
                    <td>{{ $cell }}</td>
                @endforeach
            </tr>
        @endforeach --}}
        {{$slot}}
    </tbody>
  </table>
