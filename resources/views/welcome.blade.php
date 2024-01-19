<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Limosa Registration</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="{{ Vite::asset('resources/css/responsive.css') }}" rel="stylesheet">
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <script src="https://www.google.com/recaptcha/api.js?render=6Ld9RT4pAAAAABCGucbYFiGRY-yElzY884aNMJNY"></script>
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@3.4.11/dist/vuetify.min.css" rel="stylesheet">
</head>
<body class="antialiased">
<div id="app" class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
    <main>
        <div class="logo">
            <div class="logo-icon">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
            </div>
            <div class="logo-text">
                LimosaEu
            </div>
        </div>
        <div role="alert" aria-live="assertive" aria-atomic="true" class="toast">
            <div class="toast-header">
                <strong class="mr-auto">Form error</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                The validation of the form failed
            </div>
        </div>
        <div class="container">
            <div class="wrapper">
                <div class="row">
                    <div class="c-order tab-sm-100 col-md-6">
                        @include('welcome.teaser')
                    </div>
                    <div class="tab-sm-100 offset-md-1 col-md-5">
                        <div class="right">
                            @include('welcome.form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="left-shape">
            <img src="{{ asset('images/top-left.png') }}" alt="Top left">
        </div>
        <div class="right-shape">
            <img src="{{ asset('images/top-right.png') }}" alt="Top left">
        </div>
    </main>

    <div id="error">

    </div>

</div>
</body>
</html>
