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
                    Tribma.
                </div>
            </div>
            <article>
                <h1><span>Thank You</span> For Your Order!</h1>
                <span>Your submission has been received</span>
                <p>
                    Tation argumentum et usu, dicit viderer evertitur te has. Eu dictas concludaturque
                    usu, facete detracto patrioque an per, lucilius pertinacia eu vel.
                </p>
            </article>

            <div class="social-media">
                <a href="#"><i class="fa-brands fa-google"></i>Google</a>
                <a href="#"><i class="fa-brands fa-apple"></i>Apple ID</a>
                <a href="#"><i class="fa-brands fa-facebook"></i>Facebook</a>
            </div>
            <div class="mb-5 back-home">
                <a href="/">Back to Home</a>
            </div>
        </div>
    </div>
</main>
</body>
</html>
