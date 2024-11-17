<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ settings()->get('app_name', $default = "STS") }}</title>
    @include('layouts.style')
    <link rel="stylesheet" href="{{ asset('pos.css') }}">
    @livewireStyles
</head>

<body>
    @if (session()->has('sold'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                window.print();
            });
        </script>
    @endif
    <livewire:pos />
</body>
@livewireScripts

</html>
