<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('parts.head')
<body class="antialiased">
<main class="main thankyou-page">
    <div class="main-wrapper">
        <div class="main-inner">
            <div class="logo">
                <div class="logo-icon">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo">
                </div>
                <div class="logo-text">
                    LimosaEu
                </div>
            </div>
            <article>
                <h1><span>Formularz wysłany</span></h1>
                <span>Państwa zgłoszenie jest przetwarzane</span>
                <p>
                    W ciągu kilku minut dokument Limosa zostanie przesłana na podany przez Państwa adres email
                </p>
            </article>
{{--            <div class="social-media">--}}
{{--                <a href="#"><i class="fa-brands fa-google"></i>Google</a>--}}
{{--                <a href="#"><i class="fa-brands fa-apple"></i>Apple ID</a>--}}
{{--                <a href="#"><i class="fa-brands fa-facebook"></i>Facebook</a>--}}
{{--            </div>--}}
            <div class="mb-4 back-home">
                <a href="/">Powrót</a>
            </div>
        </div>
    </div>
</main>
</body>
</html>
