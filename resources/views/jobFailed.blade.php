<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="{{ Vite::asset('resources/css/responsive.css') }}" rel="stylesheet">
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>
<body class="antialiased">
<main class="main thankyou-page">
    <div class="main-wrapper">
        <div class="main-inner">
            <div class="logo">
                <div class="logo-icon">
                    <img src="assets/images/logo.png" alt="">
                </div>
                <div class="logo-text">
                    Zadanie w kolejce zakończone błędem
                </div>
            </div>
            <article>
                <h1><span>Szczegóły</span></h1>
                <p>ID zadania: {{ $jobId }}</p>
                <p>Tytuł błędu: {{ $exception }}</p>
            </article>
        </div>
    </div>
</main>
</body>
</html>
