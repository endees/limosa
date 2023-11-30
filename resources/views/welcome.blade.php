<!DOCTYPE html>
<html>
<head>
    <title>Limosa Registration</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="{{ Vite::asset('resources/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ Vite::asset('resources/css/style.css') }}" rel="stylesheet">
    <link href="{{ Vite::asset('resources/css/responsive.css') }}" rel="stylesheet">

    <script type="text/javascript" src="{{ Vite::asset('resources/js/twitter/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ Vite::asset('resources/js/custom.js') }}"></script>
    <script type="text/javascript" src="{{ Vite::asset('resources/js/jquery-3.6.1.min.js') }}"></script>
{{--    @vite(['resources/css/bootstrap.css', 'resources/js/bootstrap.js'])--}}
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
                                <li><a href="#">Trems of Service</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Insurance Licenses</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-sm-100 offset-md-1 col-md-5">
                        <div class="right">
                            <form id="steps" method="post" enctype="multipart/form-data" action="{{ route('form.register') }}">
                                <!-- step 1 -->
                                @csrf



                                {{--                <div class="input-field">--}}
                                {{--                    <label for="business_name">Business Name (if applicable)</label>--}}
                                {{--                    <input type="text" id="business_name" name="business_name">--}}
                                {{--                </div>--}}
                                {{--                <div class="input-field">--}}
                                {{--                    <label for="business_contact">Business Contact Information</label>--}}
                                {{--                    <input type="text" id="business_contact" name="business_contact">--}}
                                {{--                </div>--}}
                                {{--                <div class="input-field">--}}
                                {{--                    <label for="purpose_of_stay">Purpose of Stay</label>--}}
                                {{--                    <select id="purpose_of_stay" name="purpose_of_stay" required>--}}
                                {{--                        <option value="work">Work</option>--}}
                                {{--                        <option value="self-employment">Self-Employment</option>--}}
                                {{--                    </select>--}}
                                {{--                </div>--}}
                                {{--                <div class="input-field">--}}
                                {{--                    <label for="start_date">Start Date</label>--}}
                                {{--                    <input type="date" id="start_date" name="start_date" required>--}}
                                {{--                </div>--}}
                                {{--                <div class="input-field">--}}
                                {{--                    <label for="end_date">End Date</label>--}}
                                {{--                    <input type="date" id="end_date" name="end_date" required>--}}
                                {{--                </div>--}}
                                {{--                <div class="input-field">--}}
                                {{--                    <label for="social_security">Social Security Information</label>--}}
                                {{--                    <input type="text" id="social_security" name="social_security" required>--}}
                                {{--                </div>--}}
                                {{--                <div class="input-field">--}}
                                {{--                    <label for="bank_account">Bank Account Details</label>--}}
                                {{--                    <input type="text" id="bank_account" name="bank_account" required>--}}
                                {{--                </div>--}}
                                {{--                <div class="input-field">--}}
                                {{--                    <label for="contract_name">Contract Name</label>--}}
                                {{--                    <input type="text" id="contract_name" name="contract_name" required>--}}
                                {{--                </div>--}}
                                {{--                <div class="input-field">--}}
                                {{--                    <label for="work_description">Work Description</label>--}}
                                {{--                    <textarea id="work_description" name="work_description" required></textarea>--}}
                                {{--                </div>--}}
                                {{--                <div class="input-field">--}}
                                {{--                    <label for="contract_duration">Contract Duration</label>--}}
                                {{--                    <input type="text" id="contract_duration" name="contract_duration" required>--}}
                                {{--                </div>--}}


                                <div id="step1" class="form-inner lightSpeedIn">
                                    <div class="input-field">
                                        <label><i class="fa-regular fa-user"></i>Full Name <span>*</span></label>
                                        <input required type="text" name="firstname" id="firstname" placeholder="Type Name">
                                        <span></span>
                                    </div>
                                    <div class="input-field">
                                        <label><i class="fa-regular fa-user"></i>Last Name <span>*</span></label>
                                        <input required type="text" name="lastname" id="firstname" placeholder="Type Name">
                                        <span></span>
                                    </div>
                                    <div class="input-field">
                                        <label for="company"><i class="fa-regular fa-paper-plane"></i>Date of Birth<span>*</span></label>
                                        <input required type="text" name="date_of_birth" id="date_of_birth" placeholder="Type company name">
                                        <span></span>
                                    </div>
                                    <div class="input-field">
                                        <label for="phone"><i class="fa-solid fa-phone"></i>Nationality <span>*</span></label>
                                        <input type="text" name="nationality" id="nationality" placeholder="Type Phone Number">
                                        <span></span>
                                    </div>
                                    <div class="input-field">
                                        <label><i class="fa-regular fa-envelope"></i>Email Address <span>*</span></label>
                                        <input required type="text" name="email" id="email" placeholder="Type email address">
                                        <span></span>
                                    </div>
                                    <div class="input-field">
                                        <label><i class="fa-regular fa-envelope"></i>PESEL <span>*</span></label>
                                        <input required type="text" name="pesel" id="pesel" placeholder="Type pesel">
                                        <span></span>
                                    </div>
                                    <div class="input-field">
                                        <label><i class="fa-regular fa-envelope"></i>Street <span>*</span></label>
                                        <input required type="text" name="street" id="street" placeholder="Type street">
                                        <span></span>
                                    </div>
                                    <div class="input-field">
                                        <label for="house_number">House Number</label>
                                        <input type="text" id="street" name="house_number">
                                    </div>
                                    <div class="input-field">
                                        <label for="flat_number">Flat Number</label>
                                        <input type="text" id="street" name="flat_number">
                                    </div>
                                    <div class="input-field">
                                        <label for="city">City</label>
                                        <input type="text" id="street" name="city">
                                    </div>
                                    <div class="input-field">
                                        <label for="postcode">Postcode</label>
                                        <input type="text" id="postcode" name="postcode">
                                    </div>
                                    <div class="input-field">
                                        <label for="message"><i class="fa-solid fa-message"></i>How can we help <span>*</span></label>
                                        <input type="text" name="message" id="message" placeholder="A brief Description here">
                                        <span></span>
                                    </div>
                                    <div class="check-field">
                                        <label><i class="fa-regular fa-user"></i>Services <span>*</span></label>
                                        <div class="row">
                                            <div class="tab-100 col-md-6">
                                                <div class="check-single">
                                                    <input type="checkbox" name="service" value="paid media" checked>
                                                    <label>Paid Media</label>
                                                </div>
                                                <div class="check-single">
                                                    <input type="checkbox" name="service" value="Digital experience">
                                                    <label>Digital experience</label>
                                                </div>
                                                <div class="check-single">
                                                    <input type="checkbox" name="service" value="Email">
                                                    <label>Email</label>
                                                </div>
                                            </div>
                                            <div class="tab-100 col-md-6">
                                                <div class="check-single">
                                                    <input type="checkbox" name="service" value="Content Creation">
                                                    <label>Content Creation</label>
                                                </div>
                                                <div class="check-single">
                                                    <input type="checkbox" name="service" value="Strategy & Consulting">
                                                    <label>Strategy & Consulting</label>
                                                </div>
                                                <div class="check-single">
                                                    <input type="checkbox" name="service" value="Other">
                                                    <label>Other</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- step Button -->
                                <div class="submit">
                                    <button type="submit"  id="sub">Send Message<span><i class="fa-solid fa-thumbs-up"></i></span></button>
                                </div>
                            </form>
                            <form method="POST" action="{{ route('mail.create') }}">
                                @csrf
                                <button type="submit">Fake mail create</button>
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
