<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')   {{-- сюда переедут стили страницы --}}
    <title>@yield('title')</title>
</head>
<body>

@include('components.header')    {{-- шапка --}}

<main>
    @yield('content')            {{-- ← сюда ложится контент из @section('content') --}}
</main>

@include('components.footer')    {{-- подвал --}}

@yield('scripts')
</body>
</html>


