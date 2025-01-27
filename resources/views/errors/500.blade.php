<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('front-title') ~ {{ config('app.name') }}</title>
    @if (!empty($siteSetting->img_favicon))
    <link rel="icon" href="{{ asset('storage/setting') . '/' . $siteSetting->img_favicon }}" type="image/png">
    @endif

    <!-- Bootstrap 5.3.3 CSS  -->
    <link rel="stylesheet" href="{{ asset('frontpanel/assets/css/bootstrap.css') }}">
    <!-- Fontawesome 6.5.2 Css  -->
    <link rel="stylesheet" href="{{ asset('frontpanel/assets/css/all.min.css') }}">
    <!-- Custom Css  -->
    <link rel="stylesheet" href="{{ asset('frontpanel/assets/scss/main.css') }}">
    <style>
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        .error-container {
            max-width: 750px;
            min-height: 400px;
            margin: 20px auto;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 10px;
            transition: 0.6s;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .error-page {
            margin: 20px;
            padding: 5px;
            text-align: center;
        }

        .error-type {
            font-size: 60px;
            font-weight: 750;
            color: #BDBDBD;
        }

        .error-text {
            color: red;
            font-size: 45px;
            font-weight: 750;
        }

        .error-message {
            padding-left: 100px;
            font-weight: 500;
        }

        .suggestion-message {
            padding-left: 100px;
        }

        .contact-us-div {
            margin-top: 75px;
            text-align: center;
        }

        .contact-us-text {
            font-size: 20px;
            color: rgb(236, 232, 227);
            background-color: rgb(17, 123, 189);
            height: 30px;
            padding: 20px;
            border-radius: 50px;
        }
    </style>
    @yield('styles')
</head>

<body>
    <!-- Starts::Header -->
    <header class="header" data-sticky_header="true">
        <div class="container nav1">
            <div class="top_head">
                @if (!empty($siteSetting))
                <div class="top_col_ct">
                    <ul class="col_left">
                        <li class="me-5">
                            <span class="fa_icon_">
                                <i class="fa-solid fa-envelope"></i>
                            </span>
                            <span class="fw_bold me-2 .d-sm-none">
                                Email:
                            </span>
                            {{ $siteSetting->email }}
                        </li>
                        <li>
                            <span class="fa_icon_">
                                <i class="fa-solid fa-phone"></i>
                            </span>
                            <span class="fw_bold me-2">
                                Call Us:
                            </span>
                            +977-{{ $siteSetting->phone_number }}
                        </li>
                    </ul>
                    <ul class="col_right">
                        <li><a href="{{ $siteSetting->link_facebook  }}"><span class="fa_icon_"><i class="fa-brands fa-facebook-f"></i></span></a></li>
                        <li><a href="{{ $siteSetting->link_twitter  }}"><span class="fa_icon_"><i class="fa-brands fa-twitter"></i></span></a></li>
                        <li><a href="{{ $siteSetting->link_instagram  }}"><span class="fa_icon_"><i class="fa-brands fa-instagram"></i></span></a></li>
                    </ul>
                </div>
                @endif
                <h5></h5>
                <h5><span class="fw_normal"></span></h5>
            </div>
        </div>
    </header>
    <!-- Ends::Header -->

    <!-- Starts::NAVIGATION MENU  -->
    <div class="nav_header nav2 nav-down">
        <div class="container">
            <div class="header_main">
                <div class="header_col header_col_left">
                    <!-- <div class="header__element header__element--author-btn">
                                    <button class="hamburger js-toolbar-btn" data-target="#author-offcanvas" type="button"
                                        aria-label="click here to open author offcanvas">
                                        <span></span>
                                    </button>
                                </div> -->
                    <div class="header_logo">
                        <div class="logo">
                            @if (!empty($siteSetting))
                            <a href="{{ route('frontpanel.homepage') }}" class="d-block">
                                @if (!empty($siteSetting->img_logo) && Storage::exists('public/' . $imagePath))
                                <img src="{{ asset('storage/' . $imagePath) }}" alt="">
                                @else
                                <img src="{{ asset('frontpanel/assets/images/logo/demo_logo.png') }}" alt="Logo" />
                                @endif
                                <!-- <img src="{{ asset('frontpanel/assets/images/logo/demo_logo.png') }}" alt="Logo" /> -->
                            </a>
                            @endif
                        </div>
                        <div class="logo_name">
                            <h5>{{ $siteSetting->name ?? ''}}</h5>
                            <h6>{{ $siteSetting->address ?? ''}}</h6>
                        </div>
                    </div>
                </div>
                <div class="header_col header_col_right">
                    <nav class="header_menu sm_md_none">
                        <ul class="mainmenu">
                            <li class="mainmenu_item">
                                <a href="{{ route('frontpanel.homepage') }}" class="mainmenu_link active">
                                    Home
                                </a>
                            </li>
                            <li class="mainmenu_item">
                                <a href="{{ route('frontpanel.aboutus') }}" class="mainmenu_link">
                                    About Us
                                </a>
                            </li>
                            <li class="mainmenu_item">
                                <a href="{{ route('frontpanel.services') }}" class="mainmenu_link">
                                    Services
                                </a>
                            </li>
                            <li class="mainmenu_item">
                                <a href="{{ route('frontpanel.newsandblog') }}" class="mainmenu_link">
                                    News & Blogs
                                </a>
                            </li>
                            <li class="mainmenu_item">
                                <a href="{{ route('frontpanel.events') }}" class="mainmenu_link">
                                    Events
                                </a>
                            </li>
                            <li class="mainmenu_item">
                                <a href="{{ route('frontpanel.download') }}" class="mainmenu_link">
                                    Downloads
                                </a>
                            </li>
                            <li class="mainmenu_item">
                                <a href="{{ route('frontpanel.contact.us') }}" class="mainmenu_link">
                                    Contact
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <div class="balpatrika_btn">
                        <button class="btn_btn btn_light"><img src="{{ asset('frontpanel/assets/images/icons/children.png') }}" alt="Button Icons"><span>बल पत्रीका<span> </button>
                    </div>
                    <div class="header__element header__element--mobile-btn sm_md_block">
                        <button class="hamburger js-toolbar-btn" data-target="#mobile-offcanvas" type="button" aria-label="click here to open menu offcanvas">
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Starts::Mobile OffCanvas Start -->
    <div class="offcanvas" id="mobile-offcanvas">
        <div class="offcanvas__inner from-right">
            <header class="offcanvas__header">
                <div class="offcanvas__header-left">
                    <div class="header_logo">
                        <div class="logo">
                            @if (!empty($siteSetting))
                            <a href="{{ route('frontpanel.homepage') }}" class="d-block">
                                <?php
                                $imagePath = 'setting/' . $siteSetting->img_logo;
                                ?>
                                @if (!empty($siteSetting->img_logo) && Storage::exists('public/' . $imagePath))
                                <img src="{{ asset('storage/' . $imagePath) }}" alt="">
                                @else
                                <img src="{{ asset('frontpanel/assets/images/logo/demo_logo.png') }}" alt="Logo" />
                                @endif
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="offcanvas__header-right">
                    <button class="btn-close" aria-label="Close mobile menu offcanvas">
                        <i data-feather="x-circle"></i>
                    </button>
                </div>
            </header>
            <div class="offcanvas__body">
                <div class="menu-offcanvas">
                    <ul class="mainmenu" id="mobile_menu">
                        <li class="mainmenu_item">
                            <a href="{{ route('frontpanel.homepage') }}" class="mainmenu_link active">
                                Home
                            </a>
                        </li>
                        <li class="mainmenu_item">
                            <a href="{{ route('frontpanel.aboutus') }}" class="mainmenu_link">
                                About Us
                            </a>
                        </li>
                        <li class="mainmenu_item">
                            <a href="{{ route('frontpanel.services') }}" class="mainmenu_link">
                                Services
                            </a>
                        </li>
                        <li class="mainmenu_item">
                            <a href="{{ route('frontpanel.newsandblog') }}" class="mainmenu_link">
                                News & Blogs
                            </a>
                        </li>
                        <li class="mainmenu_item">
                            <a href="{{ route('frontpanel.events') }}" class="mainmenu_link">
                                Events
                            </a>
                        </li>
                        <li class="mainmenu_item">
                            <a href="{{ route('frontpanel.download') }}" class="mainmenu_link">
                                Downloads
                            </a>
                        </li>
                        <li class="mainmenu_item">
                            <a href="{{ route('frontpanel.contact.us') }}" class="mainmenu_link">
                                Contact
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Ends::Mobile OffCanvas  -->
    <!-- Ends::Navigation  -->

    <!-- Starts:: Error section  -->
    <section>
        <div class="error-container">
            <div class="error-page">
                <span class="error-type">500</span>&nbsp;&nbsp; <span class="error-text">Server Error</span>
            </div>
            <div class="error-message">
                <p>Oops, Something went wrong !!!</p>
            </div>
            <div class="suggestion-message">
                <p>Try to refresh this page or feel free to contact us if the problem persists.</p>
            </div>

            <div class="contact-us-div">
                <a href="{{ route('frontpanel.contact.us') }}"><span class="contact-us-text">Contact Us</span></a>
            </div>
        </div>
    </section>
    <!-- Ends:: Error section  -->

    <!-- Footer -->
    <footer id="footer">
        <div class="container">
            <div class="foot_wrapper">
                @if (!empty($siteSetting))
                <div class="foot_flx">
                    <div class="foot_col first_col">
                        <div class="header_logo">
                            <div class="logo">
                                <a href="{{ route('frontpanel.homepage') }}" class="d-block">
                                    @if (!empty($siteSetting->img_logo) && Storage::exists('public/' . $imagePath))
                                    <img src="{{ asset('storage/' . $imagePath) }}" alt="">
                                    @else
                                    <img src="{{ asset('frontpanel/assets/images/logo/demo_logo.png') }}" alt="Logo" />
                                    @endif
                                </a>
                            </div>
                            <div class="logo_name">
                                <h5>{{ $siteSetting->name ?? ''}}</h5>
                            </div>
                        </div>
                        <p>{{ $siteSetting->address ?? ''}}</p>
                        <ul class="social_media">
                            <li><a href="{{ $siteSetting->link_facebook  ?? '' }}"><span class="media_icons"><i class="fa-brands fa-facebook-f"></i></span></a></li>
                            <li><a href="{{ $siteSetting->link_twitter  ?? '' }}"><span class="media_icons"><i class="fa-brands fa-twitter"></i></span></a></li>
                            <li><a href="{{ $siteSetting->link_instagram  ?? '' }}"><span class="media_icons"><i class="fa-brands fa-instagram"></i></span></a></li>
                        </ul>
                    </div>
                    <div class="foot_col">
                        <div class="ft_title">
                            <h4>Useful Links</h4>
                        </div>
                        <ul class="ft_list">
                            <li><a href="{{ route('frontpanel.homepage') }}">Home</a></li>
                            <li><a href="{{ route('frontpanel.aboutus') }}">Introduction</a></li>
                            <li><a href="{{ route('frontpanel.newsandblog') }}">News & Blogs</a></li>
                            <li><a href="{{ route('frontpanel.notices') }}">Notice</a></li>
                            <li><a href="{{ route('frontpanel.gallery') }}">Gallery</a></li>
                        </ul>
                    </div>
                    <div class="foot_col">
                        <div class="ft_title">
                            <h4>Services</h4>
                        </div>
                        <ul class="ft_list">
                            @if ($services->isNotEmpty())
                            @foreach ($services as $service)
                            <li><a href="{{ route('frontpanel.services.innerpage', $service->slug) }}">{{ $service->title }}</a></li>
                            @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="foot_col">
                        <div class="ft_title">
                            <h4>Contact Info</h4>
                        </div>
                        <ul class="ft_list">
                            <li><a href="{{ $siteSetting->link_map ?? ''}}"><span class="mini_icons"><i class="fa-solid fa-location-dot"></i></span>{{ $siteSetting->address ?? ''}}</a></li>
                            <li><a href="tel:+977{{ $siteSetting->phone_number ?? ''}}"><span class="mini_icons"><i class="fa-solid fa-phone"></i></span>+977 {{ $siteSetting->phone_number ?? ''}}</a></li>
                            <li><a href="mailto:{{ $siteSetting->email ?? ''}}"><span class="mini_icons"><i class="fa-solid fa-envelope"></i></span>{{ $siteSetting->email ?? ''}}</a></li>
                        </ul>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </footer>
    <section class="end_footer">
        <div class="container">
            <ul class="end_ft_list">
                <li>&copy;copyright <?php echo date('Y'); ?>. {{ config('app.name') }}</li>
                <li>Powered By <a href="https://cltech.com.np/" target="_blank" class="visit_link">CL Tech</a></li>
            </ul>
        </div>
    </section>
    <!-- Jquery 3.7.1 -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->

    <script src="{{ asset('frontpanel/assets/js/jquery.js') }}"></script>
    <!-- <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.19.3/jquery.validate.min.js"></script> -->
    <script src="{{ asset('frontpanel/assets/js/jquery-validate.js') }}"></script>

    <!-- Bootstrap 5.3.3  -->
    <script src="{{ asset('frontpanel/assets/js/bootstrap.js') }}"></script>
    <!-- Font Awesome 6.5.2  -->
    <script src="{{ asset('frontpanel/assets/js/all.min.js') }}"></script>
    <!-- WOW counter  -->
    <script src="{{ asset('frontpanel/assets/js/counter.js') }}"></script>
    <!-- Custom Script  -->
    <script type="text/javascript" src="{{ asset('frontpanel/assets/js/script.js') }}"></script>
    @yield('scripts')
</body>

</html>