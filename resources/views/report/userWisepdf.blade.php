<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table {
            width: 100%;
            border: 1px solid #ccc;
            border-collapse: collapse;
        }

        table tr th,
        table tr td {
            text-align: center;
            border-left: 1px solid #ccc;
            padding: 7px
        }

        tr {
            border-bottom: 1px solid #ccc;
        }

        .text-center {
            text-align: center;
        }

        .m-0 {
            margin: 0;
        }

        .p-0 {
            padding: 0
        }

        i {
            display: block;
            text-align: center;
            margin-bottom: 10px
        }
    </style>
</head>

<body>
    <h1 class="text-center m-0 p-0">{{ settings()->get('app_name_print', $default = 'STS Cinema') }}</h1>
    <h5 class="text-center m-0 p-0">{{ settings()->get('address', $default = 'Dhangadhi') }}</h5>
    <i>(Daily Report)</i>
    <table>
        <tr>
            <th>S.N.</th>
            <th>User</th>
            <th>Product Count</th>
            <th>Total Price</th>
        </tr>
        @foreach ($reports as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->user->name }}</td>
                <td>{{ $item->product_count }}</td>
                <td>Rs. {{ $item->total_price }}</td>
            </tr>
        @endforeach
    </table>
</body>

</html>
