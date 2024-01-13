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
<div id="app" class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
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
                                        <label for="firstname">Imię<span>*</span></label>
                                        <input required type="text" name="firstname" id="firstname" placeholder="Imię" value="{{ old('firstname') }}">
                                    </div>
                                    <div class="input-field">
                                        <label for="lastname">Nazwisko<span>*</span></label>
                                        <input required type="text" name="lastname" id="lastname" placeholder="Nazwisko" value="{{ old('lastname') }}">
                                    </div>
                                    <div class="input-field">
                                        <label for="customer_email">Email<span>*</span></label>
                                        <input required type="text" name="customer_email" id="customer_email" placeholder="Podaj adres email" value="{{ old('customer_email') }}">
                                    </div>
                                    <div class="input-field">
                                        <label for="customer_telephone">Telefon <span>*</span></label>
                                        <input required type="text" name="customer_telephone" id="customer_telephone" placeholder="Podaj telefon komórkowy (bez kierunkowego)" value="{{ old('customer_telephone') }}">
                                    </div>
                                </div>

                                <div id="step2" class="form-inner lightSpeedIn step-container" data-step-number="2">
                                    <div class="input-field">
                                        <label for="belgian_nip">NIP firmy belgijskiej<span>*</span></label>
                                        <input type="text" id="belgian_nip" name="belgian_nip" placeholder="Podaj nr belgijskiego pracodawcy składający się wyłącznie z cyfr">
                                    </div>
                                    <div class="input-field">
                                        <label for="belgian_company_telephone">Telefon firmy</label>
                                        <input type="text" id="belgian_company_telephone" name="belgian_company_telephone" placeholder="Podaj tel belgijskiego kontrahenta składający się wyłącznie z cyfr">
                                    </div>
                                    <div class="input-field">
                                        <label for="belgian_company_email">Email firmy</label>
                                        <input type="text" id="belgian_company_email" name="belgian_company_email" placeholder="Podaj email belgijskiego kontrahenta">
                                    </div>
                                    <div class="input-field">
                                        <label for="sector">Branża<span>*</span></label>
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
                                <div id="step3" class="form-inner lightSpeedIn step-container" data-step-number="3">
                                        <a><button class="add-new-workplace nip" type="button">
                                            Dodaj nowe miejsce pracy wpisując NIP
                                            <span><i class="fa-solid fa-thumbs-up"></i></span>
                                        </button></a>
                                        <a>
                                            <button class="add-new-workplace site" type="button">
                                                Dodaj nowe miejsce pracy wpisując adres
                                                <span><i class="fa-solid fa-thumbs-up"></i></span>
                                            </button>
                                        </a>
                                    <v-sheet
                                        class="position-relative"
                                        min-height="450"
                                    >
                                        <div class="position-absolute d-flex align-center justify-center w-100 h-100">
                                            <v-btn
                                                size="x-large"
                                                color="deep-purple-darken-2"
                                                @click="dialog = !dialog"
                                            >
                                                Open Dialog
                                            </v-btn>
                                        </div>

                                        <v-fade-transition hide-on-leave>
                                            <v-card
                                                v-if="dialog"
                                                append-icon="$close"
                                                class="mx-auto"
                                                elevation="16"
                                                max-width="500"
                                                title="Send a receipt"
                                            >
                                                <template v-slot:append>
                                                    <v-btn icon="$close" variant="text" @click="dialog = false"></v-btn>
                                                </template>

                                                <v-divider></v-divider>

                                                <div class="py-12 text-center">
                                                    <v-icon
                                                        class="mb-6"
                                                        color="success"
                                                        icon="mdi-check-circle-outline"
                                                        size="128"
                                                    ></v-icon>

                                                    <div class="text-h4 font-weight-bold">This receipt was sent</div>
                                                </div>

                                                <v-divider></v-divider>

                                                <div class="pa-4 text-end">
                                                    <v-btn
                                                        class="text-none"
                                                        color="medium-emphasis"
                                                        min-width="92"
                                                        rounded
                                                        variant="outlined"
                                                        @click="dialog = false"
                                                    >
                                                        Close
                                                    </v-btn>
                                                </div>
                                            </v-card>
                                        </v-fade-transition>
                                    </v-sheet>
                                    @for($i=1; $i < 5; $i++)
                                        <div class="nip-info-group-{{$i}}" style="display:none;">
                                            <div class="input-field">
                                                <label for="nip_place_of_work_{{$i}}">Nip</label>
                                                <input type="text" id="nip_place_of_work_{{$i}}" name="nip_place_of_work[{{$i}}]" placeholder="NIP">
                                            </div>
                                        </div>
                                        <div class="site-info-group-{{$i}}" style="display:none;">
                                            <div class="input-field">
                                                <label for="site_name">Nazwa</label>
                                                <input type="text" id="site_name" name="site_name" placeholder="Nazwa">
                                            </div>

                                            <div class="input-field">
                                                <label for="site_street">Ulica</label>
                                                <input type="text" id="site_street" name="site_street" placeholder="Ulica">
                                            </div>

                                            <div class="input-field">
                                                <label for="site_house_number">Numer domu</label>
                                                <input type="text" id="site_house_number" name="site_house_number" placeholder="Numer domu">
                                            </div>

                                            <div class="input-field">
                                                <label for="site_number">Nr mieszkania</label>
                                                <input type="text" id="site_apartment_number" name="site_apartment_number" placeholder="Numer mieszkania">
                                            </div>

                                            <div class="input-field">
                                                <label for="site_post_code">Kod pocztowy i miasto</label>
                                                <select id="site_post_code" name="site_post_code" class="ui-selectonemenu-items ui-selectonemenu-list ui-widget-content ui-widget ui-corner-all ui-helper-reset" role="listbox" aria-activedescendant="belgianPostalCode_0">
                                                    @foreach($postcodes as $key => $postcode)
                                                        <option class="ui-selectonemenu-item ui-selectonemenu-list-item ui-corner-all ui-noselection-option ui-state-highlight" data-label="{{ $postcode }}" tabindex="-1" role="option" aria-selected="false" id="{{ $key }}">{{ $postcode }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                                <div id="step4" class="form-inner lightSpeedIn step-container" data-step-number="4">
                                    <div class="input-field">
                                        <label for="nip">NIP <span>*</span></label>
                                        <input required type="text" name="nip" id="nip" placeholder="Wpisz NIP składający się z 10 cyfr">
                                    </div>
                                    <div class="input-field">
                                        <label for="pesel">PESEL <span>*</span></label>
                                        <input required type="text" name="pesel" id="pesel" placeholder="Wpisz PESEL składający się z 11 cyfr">
                                    </div>
                                    <div class="input-field">
                                        <label>Ulica <span>*</span></label>
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
                                        <label for="postcode">Kod pocztowy<span>*</span></label>
                                        <input required type="text" id="postcode" name="postcode" placeholder="Wpisz kod pocztowy w formacie 00-000">
                                    </div>
                                    <div class="input-field">
                                        <label for="city">Miasto<span>*</span></label>
                                        <input required type="text" id="city" name="city" placeholder="Wpisz miasto">
                                    </div>
                                </div>
                                <div id="step5" class="form-inner lightSpeedIn step-container" data-step-number="5">
                                    <div class="check-field">
                                        <label>Język wygenerowanej limosy</label>
                                        <div class="row">
                                            <div class="tab-100 col-md-6">
                                                <div class="check-single">
                                                    <input type="checkbox" name="limosalanguage[en]" value="true">
                                                    <label>Angielski</label>
                                                </div>
                                                <div class="check-single">
                                                    <input type="checkbox" name="limosalanguage[fr]" value="true">
                                                    <label>Francuski</label>
                                                </div>
                                                <div class="check-single">
                                                    <input type="checkbox" name="limosalanguage[nl]" value="true">
                                                    <label>Niderlandzki</label>
                                                </div>
                                                <div class="check-single">
                                                    <input type="checkbox" name="limosalanguage[de]" value="true">
                                                    <label>Niemiecki</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="check-field">
                                        <label>Wymagane zgody</label>
                                        <div class="row">
                                            <div class="tab-100 col-md-12">
                                                <div class="check-single">
                                                    <input type="checkbox" name="dataagreement[all]" value="true">
                                                    <label>Zaznacz wszystkie</label>
                                                </div>
                                                <div class="check-single">
                                                    <input type="checkbox" name="dataagreement[rodo]" value="true">
                                                    <label>Zgoda na przetwarzanie danych osobowych do celów wygenerowania limosy<span>*</span></label>
                                                </div>
                                                <div class="check-single">
                                                    <input type="checkbox" name="dataagreement[marketing]" value="true">
                                                    <label>Zgoda na przetwarzanie danych do celów marketingowych</label>
                                                </div>
                                                <div class="check-single">
                                                    <input type="checkbox" name="dataagreement[newsletter]" value="true">
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
