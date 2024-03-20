<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('parts.head')
<body class="antialiased">
        <nav class="topbar">
            <div class="container">
                <div class="row d-flex align-items-center">
                    <div class="col-6">
                        <h1 class="logo-container">
                            <a class="logo d-flex align-items-center gap-3" href="index.html">
                                <img src="{{ asset('images/logo2.svg') }}" alt="LimosaEu">
                                <span class="logo__text">LimosaEu</span>
                            </a>
                        </h1>
                    </div>
                    <div class="col-6 d-flex align-items-center justify-content-end">
                        <ul class="menu__list">
                            <li class="menu__item"><a class="menu__link" href="#about-limosa">O Limosa</a></li>
                            <li class="menu__item"><a class="menu__link" href="#faq">FAQ</a></li>
                            <li class="menu__item"><a class="menu__link" href="#form-limosa">Uzyskaj Limosa</a></li>
                        </ul>
                        <div class="hamburger d-lg-none">
                            <span class="line line1">&nbsp;</span>
                            <span class="line line2">&nbsp;</span>
                            <span class="line line3">&nbsp;</span>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <section class="hero">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 col-lg-6 d-flex flex-column justify-content-center">
                        <div class="hero__content">
                            <h2 class="section-title">Ułatw sobie pracę w Belgii - bez rejestracji i całkowicie za darmo!</h2>
                            <span class="section-subtitle">Zautomatyzowany proces Limosa dla polskich przedsiębiorców.</span>
                            <div class="button-container">
                                <a class="button" href="#about-limosa">Czym jest Limosa?</a>
                                <a class="button button--blue" href="#form-limosa">Uzyskaj dokument</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-6 text-center">
                        <div class="hero__image">
                            <img src="{{ asset('images/hero-man.webp') }}" alt="Pracownik">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="about-limosa" class="content-column">
            <div class="container">
                <div class="row g-5">
                    <div class="col-md-6 col-lg-7 d-flex align-items-center">
                        <div class="content-column__image image-left">
                            <img src="{{ asset('images/duis.svg') }}" alt="Dokumentacja">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-5 d-flex flex-column justify-content-center">
                        <div class="content-column__content">
                            <h2 class="section-title">O Limosa</h2>
                            <p>Nasza platforma została stworzona <strong>z myślą o polskich przedsiębiorcach, którzy planują rozpocząć lub kontynuować swoją działalność w Belgii</strong>. Zdajemy sobie sprawę z wyzwań związanych z procesem uzyskiwania dokumentu Limosa, który jest niezbędny do legalnej pracy. Dlatego oferujemy rozwiązanie, które upraszcza i przyspiesza ten proces, eliminując konieczność przeglądania skomplikowanych przepisów i długiego oczekiwania na odpowiedź. Nasz serwis jest w pełni zautomatyzowany i zaprojektowany tak, aby dostarczyć dokument Limosa bezpośrednio na Twój adres e-mail, szybko i bez żadnych opłat.</p>
                            <p>Rozumiemy, jak ważne jest dla Ciebie, aby móc skupić się na swojej działalności, a nie na papierkowej robocie. Dlatego zminimalizowaliśmy ilość wymaganych danych do absolutnego minimum. Wystarczy, że odpowiedziesz na kilka prostych pytań dotyczących Twojej działalności, a nasz system wygeneruje wszystkie potrzebne dokumenty. Nie wymagamy rejestracji, co oznacza, że możesz uzyskać swój dokument Limosa natychmiast, bez zbędnych formalności.</p>
                            <p>Co więcej, nasza platforma jest dostępna w języku polskim, co jest ogromnym ułatwieniem dla polskich przedsiębiorców, którzy mogą napotkać barierę językową na innych stronach. Jesteśmy tu, aby zapewnić Ci wsparcie i ułatwić Twój start w Belgii. Nasz zespół jest zawsze gotowy, aby odpowiedzieć na Twoje pytania i rozwiać wątpliwości, co czyni nasz serwis nie tylko narzędziem, ale także partnerem w Twojej karierze zawodowej.</p>
                            Zapraszamy do skorzystania z naszych usług i dołączenia do grona zadowolonych przedsiębiorców, którzy dzięki naszej pomocy mogą bezproblemowo rozwijać swoją działalność w Belgii.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="faq" class="faq">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-title">FAQ</h2>
                    <p>Odpowiedzi na często zadawane pytania:</p>
                </div>
                <div class="accordion" id="faq-accordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Czy korzystanie z waszego serwisu jest naprawdę darmowe?</button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faq-accordion">
                            <div class="accordion-body">
                                <p>Tak, nasze usługi są w pełni darmowe dla wszystkich użytkowników.</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Jak szybko otrzymam dokument Limosa? </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faq-accordion">
                            <div class="accordion-body">
                                <p>Po ukończeniu formularza dokument zostanie wysłany na podany adres email natychmiastowo.</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Czy muszę się rejestrować, aby korzystać z serwisu? </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faq-accordion">
                            <div class="accordion-body">
                                <p>Nie, nasz serwis nie wymaga rejestracji.</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">Jak mogę się z wami skontaktować w razie pytań?</button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faq-accordion">
                            <div class="accordion-body">
                                <p>Jesteśmy dostępni pod adresem email i numerem telefonu podanym na stronie.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <div id="app" class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        <main>
            
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

    <section class="contact-footer">
            <div class="container">
                <div class="row gy-5">
                    <div class="col-md-4 d-flex align-items-center gap-4 justify-content-center">
                        <div class="contact-footer__icon"><img src="{{ asset('images/icon-point.svg') }}" alt="Nasza siedziba"></div>
                        <div class="contact-footer__text">
                            <a class="point-link" href="https://maps.app.goo.gl/MvxHr4tD4WjDhaAQ8" target="_blank">Cukrowa 20C<br>71-441 Szczecin<br></a>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex align-items-center gap-4 justify-content-center">
                        <div class="contact-footer__icon"><img src="{{ asset('images/icon-phone.svg') }}" alt="Nasz nuper telefonu"></div>
                        <div class="contact-footer__text">
                            <a class="phone-link" href="tel:+48918814689">+48 91 881 4689</a>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex align-items-center gap-4 justify-content-center">
                        <div class="contact-footer__icon"><img src="{{ asset('images/icon-mail.svg') }}" alt="Nasz adres mailowy"></div>
                        <div class="contact-footer__text">
                            <a class="mail-link" href="mailto:info@limosa.eu">info@limosa.eu</a>
                        </div>
                    </div>
                </div>
                <div class="row copyright">
                    <div class="col-6 d-flex justify-content-start"><span>Projekt i wdrożenie <a href="https://virtualpeople.pl/" target="_blank" follow="nofollow">VirtualPeople</a></span></div>
                    <div class="col-6 d-flex justify-content-end"><a href="#">Polityka Prywatności</a></div>
                </div>
            </div>
        </section>
</body>
</html>
