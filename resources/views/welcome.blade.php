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
</head>
<body class="antialiased">
<div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
    <main>
        <div class="logo">
            <div class="logo-icon">
                <img src="assets/images/logo.png" alt="BeRifma">
            </div>
            <div class="logo-text">
                Trimba
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
                        <!-- side -->
                        <div class="left">
                            <article class="side-text">
                                <h2>Limosa Registration</h2>
                                <p>Get a <span>start@userthemes.com</span></p>
                            </article>
                            <div class="left-img">
                                <img src="assets/images/left-bg.gif" alt="BeRifma">
                            </div>
                            <ul class="links">
                                <li><a href="#">Terms of Service</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Insurance Licenses</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-sm-100 offset-md-1 col-md-5">
                        <div class="right">
                            <form id="steps" method="POST" enctype="multipart/form-data" action="{{ route('form.register') }}">
                                <!-- step 1 -->
                                @csrf
                                <div id="step1" class="form-inner lightSpeedIn step-container" data-step-number="1">
                                    <div class="input-field">
                                        <label for="firstname"><i class="fa-regular fa-user"></i>Imię<span>*</span></label>
                                        <input required type="text" name="firstname" id="firstname" placeholder="Imię" value="{{ old('firstname') }}">
                                    </div>
                                    <div class="input-field">
                                        <label for="lastname"><i class="fa-regular fa-user"></i>Nazwisko<span>*</span></label>
                                        <input required type="text" name="lastname" id="lastname" placeholder="Nazwisko" value="{{ old('lastname') }}">
                                    </div>
                                    <div class="input-field">
                                        <label for="customer_email"><i class="fa-regular fa-envelope"></i>Email<span>*</span></label>
                                        <input required type="text" name="customer_email" id="customer_email" placeholder="Podaj adres email" value="{{ old('customer_email') }}">
                                    </div>
                                    <div class="input-field">
                                        <label for="customer_telephone"><i class="fa-regular fa-envelope"></i>Telefon <span>*</span></label>
                                        <input required type="text" name="customer_telephone" id="customer_telephone" placeholder="Podaj telefon komórkowy (bez kierunkowego)" value="{{ old('customer_telephone') }}">
                                    </div>
                                </div>
                                <div id="step2" class="form-inner lightSpeedIn step-container" data-step-number="2">
                                    <div class="input-field">
                                        <label for="nip"><i class="fa-regular fa-envelope"></i>NIP <span>*</span></label>
                                        <input required type="text" name="nip" id="nip" placeholder="Wpisz NIP składający się z 10 cyfr">
                                    </div>
                                    <div class="input-field">
                                        <label for="pesel"><i class="fa-regular fa-envelope"></i>PESEL <span>*</span></label>
                                        <input required type="text" name="pesel" id="pesel" placeholder="Wpisz PESEL składający się z 11 cyfr">
                                    </div>
                                    <div class="input-field">
                                        <label><i class="fa-regular fa-envelope"></i>Street <span>*</span></label>
                                        <input required type="text" name="street" id="street" placeholder="Wpisz ulicę">
                                    </div>
                                    <div class="input-field">
                                        <label for="house_number">Nr domu <span>*</span></label>
                                        <input required type="text" id="house_number" name="house_number" placeholder="Wpisz nr domu">
                                    </div>
                                    <div class="input-field">
                                        <label for="flat_number">Nr mieszkania</label>
                                        <input type="text" id="flat_number" name="flat_number" placeholder="Wpisz nr mieszkania">
                                    </div>
                                    <div class="input-field">
                                        <label for="city">Miasto<span>*</span></label>
                                        <input required type="text" id="city" name="city" placeholder="Wpisz miasto">
                                    </div>
                                    <div class="input-field">
                                        <label for="postcode">Kod pocztowy<span>*</span></label>
                                        <input required type="text" id="postcode" name="postcode" placeholder="Wpisz kod pocztowy w formacie 00-000">
                                    </div>
                                </div>
                                <div id="step3" class="form-inner lightSpeedIn step-container" data-step-number="3">
                                    <div class="input-field">
                                        <label for="belgian_nip">NIP firmy belgijskiej</label>
                                        <input type="text" id="belgian_nip" name="belgian_nip" placeholder="Podaj nr belgijskiego pracodawcy składający się wyłącznie z cyfr">
                                    </div>
                                    <div class="input-field">
                                        <label for="sector">Branża</label>
                                        <select type="text" id="sector" name="sector">
                                            <option value="">Wybierz branżę</option>
                                            <option value="meat">Mięso</option>
                                            <option value="construction">Budownictwo</option>
                                            <option value="cleaning">Sprzątanie</option>
                                            <option value="other">Inny</option>
                                        </select>
                                    </div>
                                    <div class="input-field">
                                        <label for="start_date">Start Date</label>
                                        <input type="date" id="start_date" name="start_date" required>
                                    </div>
                                    <div class="input-field">
                                        <label for="end_date">End Date</label>
                                        <input type="date" id="end_date" name="end_date" required>
                                    </div>
                                </div>
                                <div id="step4" class="form-inner lightSpeedIn step-container" data-step-number="4">
                                    <div class="check-field">
                                        <label><i class="fa-regular fa-user"></i>Wymagane zgody</label>
                                        <div class="row">
                                            <div class="tab-100 col-md-6">
                                                <div class="check-single">
                                                    <input type="checkbox" name="all" value="all">
                                                    <label>Zaznacz wszystkie<span>*</span></label>
                                                </div>
                                                <div class="check-single">
                                                    <input type="checkbox" name="dataprocessing" value="data-processing">
                                                    <label>Zgoda na przetwarzanie danych osobowych do celów wygenerowania limosy<span>*</span></label>
                                                </div>
                                                <div class="check-single">
                                                    <input type="checkbox" name="marketingprocessing" value="marketing-processing">
                                                    <label>Zgoda na przetwarzanie danych do celóœ marketingowych</label>
                                                </div>
                                                <div class="check-single">
                                                    <input type="checkbox" name="newsletterprocessing" value="newsletter-processing">
                                                    <label>Newsletter</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div><span>*</span> Zgoda wymagana</div>
                                </div>
                                <div class="submit">
                                    <button class="next-step-btn">
                                        <img class='loader' src='images/loading.gif' style="display: none">
                                        Dalej
                                        <span><i class="fa-solid fa-thumbs-up"></i></span>
                                    </button>
                                    <button type="submit" id="sub" style="display:none;">
                                        <img class='loader' src='images/loading.gif' style="display: none">
                                        Generuj Limosę
                                        <span><i class="fa-solid fa-thumbs-up"></i></span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="left-shape">
            <img src="images/top-left.png" alt="">
        </div>
        <div class="right-shape">
            <img src="images/top-right.png" alt="">
        </div>

    </main>

    <div id="error">

    </div>

</div>
</body>
</html>
