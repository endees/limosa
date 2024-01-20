<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('parts.head')
<body class="antialiased">
<main class="main thankyou-page">
    <div class="main-wrapper">
        <div class="main-inner">
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
