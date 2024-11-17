<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table{
            width: 100%;
        }
        table tr th,table tr td{
            text-align: center;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <th>S.N.</th>
            <th>Product</th>
            <th>Price</th>
            <th>Date</th>
        </tr>
        @foreach ($reports as $item)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->product->name}}</td>
                <td>Rs. {{$item->price}}</td>
                <td>{{$item->created_at->format('Y/m/d')}}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>
