<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Limosa Registration</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="{{ Vite::asset('resources/css/responsive.css') }}" rel="stylesheet">
    @vite(['resources/js/app.js', 'resources/css/app.css'])
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
                                        <label for="firstname"><i class="fa-regular fa-user"></i>Full Name <span>*</span></label>
                                        <input required type="text" name="firstname" id="firstname" placeholder="Type Firstname" value="{{ old('firstname') }}">
                                    </div>
                                    <div class="input-field">
                                        <label for="lastname"><i class="fa-regular fa-user"></i>Last Name <span>*</span></label>
                                        <input required type="text" name="lastname" id="lastname" placeholder="Type Lastname" value="{{ old('lastname') }}">
                                    </div>
                                    <div class="input-field">
                                        <label for="customer_email"><i class="fa-regular fa-envelope"></i>Email Address <span>*</span></label>
                                        <input required type="text" name="customer_email" id="customer_email" placeholder="Type email address" value="{{ old('customer_email') }}">
                                    </div>
                                    <div class="input-field">
                                        <label for="customer_telephone"><i class="fa-regular fa-envelope"></i>Telephone <span>*</span></label>
                                        <input required type="text" name="customer_telephone" id="customer_telephone" placeholder="Type telephone" value="{{ old('customer_telephone') }}">
                                    </div>
                                    <!-- step Button -->
                                    <div class="submit">
                                        <button class="next-step-btn">Go next<span><i class="fa-solid fa-thumbs-up"></i></span></button>
                                    </div>
                                </div>
                                <div id="step2" class="form-inner lightSpeedIn step-container" data-step-number="2">
                                    <div class="input-field">
                                        <label for="nip"><i class="fa-regular fa-envelope"></i>NIP <span>*</span></label>
                                        <input required type="text" name="nip" id="nip" placeholder="Type nip">
                                    </div>
                                    <div class="input-field">
                                        <label for="pesel"><i class="fa-regular fa-envelope"></i>PESEL <span>*</span></label>
                                        <input required type="text" name="pesel" id="pesel" placeholder="Type pesel">
                                    </div>
                                    <div class="input-field">
                                        <label><i class="fa-regular fa-envelope"></i>Street <span>*</span></label>
                                        <input required type="text" name="street" id="street" placeholder="Type street">
                                    </div>
                                    <div class="input-field">
                                        <label for="house_number">House Number <span>*</span></label>
                                        <input required type="text" id="street" name="house_number">
                                    </div>
                                    <div class="input-field">
                                        <label for="flat_number">Flat Number</label>
                                        <input type="text" id="flat_number" name="flat_number">
                                    </div>
                                    <div class="input-field">
                                        <label for="city">City <span>*</span></label>
                                        <input required type="text" id="city" name="city">
                                    </div>
                                    <div class="input-field">
                                        <label for="postcode">Postcode <span>*</span></label>
                                        <input required type="text" id="postcode" name="postcode">
                                    </div>
                                    <div class="submit">
                                        <button class="next-step-btn">Go next<span><i class="fa-solid fa-thumbs-up"></i></span></button>
                                    </div>
                                </div>
                                <div id="step3" class="form-inner lightSpeedIn step-container" data-step-number="3">
                                    <div class="input-field">
                                        <label for="business_name">Business Name</label>
                                        <input type="text" id="business_name" name="business_name">
                                    </div>
                                    <div class="input-field">
                                        <label for="start_date">Start Date</label>
                                        <input type="date" id="start_date" name="start_date" required>
                                    </div>
                                    <div class="input-field">
                                        <label for="end_date">End Date</label>
                                        <input type="date" id="end_date" name="end_date" required>
                                    </div>
                                    <!-- step Button -->
                                    <div class="submit">
                                        <button type="submit" id="sub">Send Message<span><i class="fa-solid fa-thumbs-up"></i></span></button>
                                    </div>
                                </div>
                            </form>
                            <form method="POST" action="{{ route('mail.create') }}">
                                @csrf
                                <div class="submit">
                                    <button type="submit">
                                        Test limosa create<span><i class="fa-solid fa-thumbs-up"></i></span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="left-shape">
            <img src="assets/images/top-left.png" alt="">
        </div>
        <div class="right-shape">
            <img src="assets/images/top-right.png" alt="">
        </div>

    </main>

    <div id="error">

    </div>

</div>
</body>
</html>
