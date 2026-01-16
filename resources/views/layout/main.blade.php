<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    @vite('resources/css/app.css')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/icon.png') }}">
</head>
<body>
    @yield('content');
</body>
</html>