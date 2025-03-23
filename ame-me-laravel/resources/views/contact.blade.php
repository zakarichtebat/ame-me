<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>AME Maintenance Engineering - Contact Us</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

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
        }

        .content-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 7rem 1rem 2rem;
        }

        @media (prefers-color-scheme: dark) {
            body {
                background-color: #0f172a;
                color: #f1f5f9;
            }
        }
    </style>
</head>

<body class="antialiased">
    <div id="app" class="page-container">
        <animated-header></animated-header>

        <div class="content-container">
            <animated-contact></animated-contact>
        </div>

        <animated-footer></animated-footer>
    </div>
</body>

</html>