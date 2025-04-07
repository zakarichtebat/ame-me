<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'AME Maintenance Engineering')</title>
    <meta name="description"
        content="@yield('description', 'AME Maintenance Engineering - Services de maintenance industrielle, automatisation et ingénierie')">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Open Graph / Social Media Meta Tags -->
    <meta property="og:title" content="@yield('title', 'AME Maintenance Engineering')">
    <meta property="og:description"
        content="@yield('description', 'AME Maintenance Engineering - Services de maintenance industrielle, automatisation et ingénierie')">
    <meta property="og:image" content="@yield('og_image', asset('images/ame-logo.png'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <style>
        body {
            font-family: 'Figtree', sans-serif;
            margin: 0;
            padding: 0;
            color: #1a202c;
            background-color: #f8fafc;
        }

        .page-container {
            width: 100%;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .content-container {
            width: 100%;
            flex: 1;
            margin: 0 auto;
            padding: 7rem 0 2rem;
        }

        @media (prefers-color-scheme: dark) {
            body {
                background-color: #0f172a;
                color: #f1f5f9;
            }
        }
    </style>

    @stack('styles')
</head>

<body class="antialiased">
    <div id="app" class="page-container">
        <animated-header></animated-header>

        <div class="content-container">
            @yield('content')
        </div>

        <animated-footer></animated-footer>
    </div>

    @stack('scripts')
</body>

</html>