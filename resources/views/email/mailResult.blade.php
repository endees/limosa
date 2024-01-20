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
                <h1><span>Limosa</span> Wygenerowana pomyślnie</h1>
                <span>Znajduje się on w załączeniu</span>
            </article>
        </div>
    </div>
</main>
</body>
</html>
