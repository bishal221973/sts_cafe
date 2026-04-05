

<table class="table table-hover">
    <thead style="background-color: #f2f2f2">
        <tr class="text-center">
            @foreach ($headers as $header)
                <th>{{ $header }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
       
        {{$slot}}
    </tbody>
  </table>
