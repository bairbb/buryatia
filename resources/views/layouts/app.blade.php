<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $head_title ?? 'Buryatia.space' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <link rel="icon" href="/favicon.ico">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/main.js'])

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-MZXKTBSSNT"></script>

    <!-- Yandex map -->
    <script src="https://api-maps.yandex.ru/v3/?apikey={{ config('app.map_key') }}&lang=ru_RU"></script>
</head>

<body class="font-sans antialiased">
<div class="min-h-screen flex flex-col">
    @include('layouts.navigation')

    <!-- Page Heading -->
    @isset($title)
        <div class="shadow">
            <div class="container mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $title }}
            </div>
        </div>
    @endisset

    <!-- Page Content -->
    <main class="flex-grow">
        {{ $slot }}
    </main>

    @include('layouts.footer')
</div>

<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-MZXKTBSSNT');
</script>
</body>

</html>
