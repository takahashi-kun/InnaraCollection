<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>
    <title>Innara Collection || @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="surfside media" />
    <link rel="shortcut icon" href="{{ asset('build/assets/images/favicon.ico') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Allura&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('build/assets/css/plugins/swiper.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('build/assets/css/style.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('build/assets/css/custom.css') }}" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
        
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
        }

        main.pt-5 {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .footer.footer_type_2 {
            margin-top: auto !important;
            width: 100%;
        }
    </style>

    @yield('style')

</head>

<body class="gradient-bg">

    <x-svg-icons />

    <div class="header-mobile header_sticky">
        <div class="container d-flex align-items-center h-100">
            <a class="mobile-nav-activator d-block position-relative" href="#">
                <svg class="nav-icon" width="25" height="18" viewBox="0 0 25 18"
                    xmlns="http://www.w3.org/2000/svg">
                    <use href="#icon_nav" />
                </svg>
                <button class="btn-close-lg position-absolute top-0 start-0 w-100"></button>
            </a>

            <div class="logo">
                <a href="{{ route('account-dashboard') }}">
                    <img src="{{ asset('build/assets/images/cropped_circle_image_png.png') }}" alt="Uomo"
                        class="logo__image d-block" />
                </a>
            </div>

            <a href="#" class="header-tools__item header-tools__cart js-open-aside" data-aside="cartDrawer">
                <svg class="d-block" width="20" height="20" viewBox="0 0 20 20" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <use href="#icon_cart" />
                </svg>
                <span class="cart-amount d-block position-absolute js-cart-items-count">3</span>
            </a>
        </div>

        <nav
            class="header-mobile__navigation navigation d-flex flex-column w-100 position-absolute top-100 bg-body overflow-auto">
            <div class="container">
                <form action="#" method="GET" class="search-field position-relative mt-4 mb-3">
                    <div class="position-relative">
                        <input class="search-field__input w-100 border rounded-1" type="text"
                            name="search-keyword" placeholder="Search products" />
                        <button class="btn-icon search-popup__submit pb-0 me-2" type="submit">
                            <svg class="d-block" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_search" />
                            </svg>
                        </button>
                        <button class="btn-icon btn-close-lg search-popup__reset pb-0 me-2" type="reset"></button>
                    </div>

                    <div class="position-absolute start-0 top-100 m-0 w-100">
                        <div class="search-result"></div>
                    </div>
                </form>
            </div>

            <div class="container">
                <div class="overflow-hidden">
                    <ul class="navigation__list list-unstyled position-relative">
                        <li class="navigation__item">
                            <a href="index.html" class="navigation__link">Home</a>
                        </li>
                        <li class="navigation__item">
                            <a href="shop.html" class="navigation__link">Shop</a>
                        </li>
                        <li class="navigation__item">
                            <a href="cart.html" class="navigation__link">Cart</a>
                        </li>
                        <li class="navigation__item">
                            <a href="about.html" class="navigation__link">About</a>
                        </li>
                        <li class="navigation__item">
                            <a href="contact.html" class="navigation__link">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-top mt-auto pb-2">
                <div class="customer-links container mt-4 mb-2 pb-1">
                    <svg class="d-inline-block align-middle" width="20" height="20" viewBox="0 0 20 20"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_user" />
                    </svg>
                    <span class="d-inline-block ms-2 text-uppercase align-middle fw-medium">My Account</span>
                </div>



                <ul class="container social-links list-unstyled d-flex flex-wrap mb-0">
                    <li>
                        <a href="#" class="footer__social-link d-block ps-0">
                            <svg class="svg-icon svg-icon_facebook" width="9" height="15" viewBox="0 0 9 15"
                                xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_facebook" />
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="footer__social-link d-block">
                            <svg class="svg-icon svg-icon_twitter" width="14" height="13" viewBox="0 0 14 13"
                                xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_twitter" />
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="footer__social-link d-block">
                            <svg class="svg-icon svg-icon_instagram" width="14" height="13"
                                viewBox="0 0 14 13" xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_instagram" />
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="footer__social-link d-block">
                            <svg class="svg-icon svg-icon_youtube" width="16" height="11" viewBox="0 0 16 11"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M15.0117 1.8584C14.8477 1.20215 14.3281 0.682617 13.6992 0.518555C12.5234 0.19043 7.875 0.19043 7.875 0.19043C7.875 0.19043 3.19922 0.19043 2.02344 0.518555C1.39453 0.682617 0.875 1.20215 0.710938 1.8584C0.382812 3.00684 0.382812 5.46777 0.382812 5.46777C0.382812 5.46777 0.382812 7.90137 0.710938 9.07715C0.875 9.7334 1.39453 10.2256 2.02344 10.3896C3.19922 10.6904 7.875 10.6904 7.875 10.6904C7.875 10.6904 12.5234 10.6904 13.6992 10.3896C14.3281 10.2256 14.8477 9.7334 15.0117 9.07715C15.3398 7.90137 15.3398 5.46777 15.3398 5.46777C15.3398 5.46777 15.3398 3.00684 15.0117 1.8584ZM6.34375 7.68262V3.25293L10.2266 5.46777L6.34375 7.68262Z" />
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="footer__social-link d-block">
                            <svg class="svg-icon svg-icon_pinterest" width="14" height="15"
                                viewBox="0 0 14 15" xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_pinterest" />
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <x-header />

    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="my-account container">
            <h2 class="page-title">@yield('page_title', 'Account Details')</h2>

            <div class="row">
                <div class="col-lg-3">
                    <ul class="account-nav">
                        <li>
                            <a href="{{ route('account-dashboard') }}" class="menu-link menu-link_us-s {{ Request::routeIs('account-dashboard') ? 'active' : '' }}">Dashboard</a>
                        </li>
                        <li>
                            <a href="{{ route('account-orders') }}" class="menu-link menu-link_us-s {{ Request::routeIs('account-orders') || Request::routeIs('account-order-detail') ? 'active' : '' }}">Orders</a>
                        </li>
                        <li>
                            <a href="{{ route('account-address') }}" class="menu-link menu-link_us-s {{ Request::routeIs('account-address') || Request::routeIs('account-add-address') ? 'active' : '' }}">Addresses</a>
                        </li>
                        <li>
                            <a href="{{ route('account-detail') }}" class="menu-link menu-link_us-s {{ Request::routeIs('account-detail') ? 'active' : '' }}">Account Details</a>
                        </li>
                        <li>
                            <a href="{{ route('account-riview') }}" class="menu-link menu-link_us-s {{ Request::routeIs('account-riview') ? 'active' : '' }}">Account Riview</a>
                        </li>
                        <li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a href="#" class="menu-link menu-link_us-s"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-9">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @yield('content')
                </div>
            </div>
        </section>
        <div class="mb-5 pb-xl-5"></div>
    </main>

    <hr class="mt-5 text-secondary" />

    <x-footer />

    <div id="scrollTop" class="visually-hidden end-0"></div>
    <div class="page-overlay"></div>

    @yield('script')

</body>

</html>
