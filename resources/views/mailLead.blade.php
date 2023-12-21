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
                    Zarejestrowano nowe żądanie wygenerowania limosy
                </div>
            </div>
            <article>
                <h1><span>Dane delegowanego</span></h1>
                <p>Imię: {{ $firstname }}</p>
                <p>Nazwisko: {{ $lastname }}</p>
                <p>Email: {{ $email }}</p>
                <p>Telefon: {{ $telephone }}</p>
            </article>
            <article>
                <h1><span>Dane firmy</span></h1>
                <p>Nazwa: {{ $company_name }}</p>
                <p>NIP: {{ $company_vat }}</p>
                <p>Email: {{ $company_email }}</p>
                <p>Telefon: {{ $company_telephone }}</p>
            </article>
        </div>
    </div>
</main>
</body>
</html>
