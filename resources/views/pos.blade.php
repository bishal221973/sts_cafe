<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ settings()->get('app_name', $default = 'STS') }}</title>
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
<script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
@stack('script')
</html>
