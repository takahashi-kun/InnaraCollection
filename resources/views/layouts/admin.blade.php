<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>
    <title>Innara Collection || @yield('title')</title>
    <meta charset="utf-8">
    <meta name="author" content="themesflat.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('build/assets/admin2/css/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('build/assets/admin2/css/animation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('build/assets/admin2/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('build/assets/admin2/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('build/assets/admin2/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/admin2/font/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/admin2/icon/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('build/assets/admin/images/cropped_circle_image_ico.ico') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('build/assets/admin/images/cropped_circle_image_ico.ico') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('build/assets/admin2/css/sweetalert.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('build/assets/admin2/css/custom.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
</head>

<body class="body">
    <div id="wrapper">
        <div id="page" class="">
            <div class="layout-wrap">

                <div class="section-menu-left">
                    <div class="box-logo">
                        <a href="{{ route('admin.dashboard') }}" id="site-logo-inner">
                            <img class="" id="logo_header" alt=""
                                src="{{ asset('images/logopersegi.png') }}"
                                data-light="images/logo/logo.png" data-dark="images/logo/logo.png">
                        </a>
                        <div class="button-show-hide">
                            <i class="icon-menu-left"></i>
                        </div>
                    </div>
                    <div class="center">
                        <div class="center-item">
                            <div class="center-heading">Main Home</div>
                            <ul class="menu-list">
                                <li class="menu-item">
                                    <a href="{{ route('admin.dashboard') }}">
                                        <div class="icon"><i class="icon-grid"></i></div>
                                        <div class="text">Dashboard</div>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="center-item">
                            <ul class="menu-list">
                                {{-- PRODUCTS --}}
                                <li class="menu-item has-children">
                                    <a href="javascript:void(0);" class="menu-item-button">
                                        <div class="icon"><i class="icon-shopping-cart"></i></div>
                                        <div class="text">Products</div>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="sub-menu-item">
                                            <a href="{{ route('admin.product') }}">
                                                <div class="text">Daftar Produk</div>
                                            </a>
                                        </li>
                                        <li class="sub-menu-item">
                                            <a href="{{ route('admin.product.kastemisasi') }}">
                                                <div class="text">Olah Produk Kostumisasi</div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                {{-- KOMPONEN --}}
                                <li class="menu-item has-children">
                                    <a href="javascript:void(0);" class="menu-item-button">
                                        <div class="icon"><i class="icon-layers"></i></div>
                                        <div class="text">Komponen</div>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="sub-menu-item">
                                            <a href="{{ route('admin.komponen.komponenBarang') }}">
                                                <div class="text">Atur Komponen</div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                {{-- JASA --}}
                                <li class="menu-item has-children">
                                    <a href="javascript:void(0);" class="menu-item-button">
                                        <div class="icon"><i class="icon-briefcase"></i></div>
                                        <div class="text">Jasa</div>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="sub-menu-item">
                                            <a href="{{ route('admin.jasa.index') }}">
                                                <div class="text">Atur Jasa</div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                {{-- ORDER --}}
                                <li class="menu-item has-children">
                                    <a href="javascript:void(0);" class="menu-item-button">
                                        <div class="icon"><i class="icon-file-plus"></i></div>
                                        <div class="text">Order</div>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="sub-menu-item">
                                            <a href="{{ route('admin.order.index') }}">
                                                <div class="text">Orders</div>
                                            </a>
                                        </li>
                                        {{-- <li class="sub-menu-item">
                                            <a href="{{ route('admin.order-tracking') }}">
                                                <div class="text">Order Tracking</div>
                                            </a>
                                        </li> --}}
                                    </ul>
                                </li>

                                {{-- LAPORAN --}}
                                <li class="menu-item has-children">
                                    <a href="javascript:void(0);" class="menu-item-button">
                                        <div class="icon"><i class="icon-printer"></i></div>
                                        <div class="text">Laporan</div>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="sub-menu-item">
                                            <a href="{{ route('admin.laporan') }}">
                                                <div class="text">Cetak Laporan</div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                {{-- USER --}}
                                {{-- <li class="menu-item">
                                    <a href="{{ route('admin.user') }}">
                                        <div class="icon"><i class="icon-user"></i></div>
                                        <div class="text">User</div>
                                    </a>
                                </li> --}}

                                {{-- SETTINGS --}}
                                <li class="menu-item">
                                    <a href="{{ route('admin.setting') }}">
                                        <div class="icon"><i class="icon-settings"></i></div>
                                        <div class="text">Settings</div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="section-content-right">

                    <div class="header-dashboard">
                        <div class="wrap">
                            <div class="header-left">
                                <a href="{{ route('admin.dashboard') }}">
                                    <img class="" id="logo_header_mobile" alt=""
                                        src="{{ asset('images/logopersegi.png') }}"
                                        data-light="images/logo/logo.png" data-dark="images/logo/logo.png"
                                        data-width="154px" data-height="52px" data-retina="images/logo/logo.png">
                                </a>
                                <div class="button-show-hide">
                                    <i class="icon-menu-left"></i>
                                </div>


                                <form class="form-search flex-grow">
                                    <fieldset class="name">
                                        <input type="text" placeholder="Search here..." class="show-search"
                                            name="name" tabindex="2" value="" aria-required="true"
                                            required="">
                                    </fieldset>
                                    <div class="button-submit">
                                        <button class="" type="submit"><i class="icon-search"></i></button>
                                    </div>
                                </form>
                            </div>
                            <div class="header-grid">

                                <div class="popup-wrap message type-header">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="header-item">
                                                <span class="text-tiny">1</span>
                                                <i class="icon-bell"></i>
                                            </span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end has-content"
                                            aria-labelledby="dropdownMenuButton2">
                                            <li>
                                                <h6>Notifications</h6>
                                            </li>
                                            <li>
                                                <div class="message-item item-1">
                                                    <div class="image">
                                                        <i class="icon-noti-1"></i>
                                                    </div>
                                                    <div>
                                                        <div class="body-title-2">Discount available</div>
                                                        <div class="text-tiny">Morbi sapien massa, ultricies at rhoncus
                                                            at, ullamcorper nec diam</div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="message-item item-2">
                                                    <div class="image">
                                                        <i class="icon-noti-2"></i>
                                                    </div>
                                                    <div>
                                                        <div class="body-title-2">Account has been verified</div>
                                                        <div class="text-tiny">Mauris libero ex, iaculis vitae rhoncus
                                                            et</div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="message-item item-3">
                                                    <div class="image">
                                                        <i class="icon-noti-3"></i>
                                                    </div>
                                                    <div>
                                                        <div class="body-title-2">Order shipped successfully</div>
                                                        <div class="text-tiny">Integer aliquam eros nec sollicitudin
                                                            sollicitudin</div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="message-item item-4">
                                                    <div class="image">
                                                        <i class="icon-noti-4"></i>
                                                    </div>
                                                    <div>
                                                        <div class="body-title-2">Order pending: <span>ID 305830</span>
                                                        </div>
                                                        <div class="text-tiny">Ultricies at rhoncus at ullamcorper
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li><a href="{{ asset('build/admin/assets/#') }}"
                                                    class="tf-button w-full">View all</a></li>
                                        </ul>
                                    </div>
                                </div>


                                <div class="popup-wrap user type-header">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="header-user wg-user">
                                                <span class="image">
                                                    <img src="{{ asset('images/avatar/user-1.png') }}"
                                                        alt="">
                                                </span>
                                                <span class="flex flex-column">
                                                    <span class="body-title mb-2">Kristin Watson</span>
                                                    <span class="text-tiny">Admin</span>
                                                </span>
                                            </span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end has-content"
                                            aria-labelledby="dropdownMenuButton3">
                                            <li>
                                                <a href="{{ route('account-detail') }}" class="user-item">
                                                    <div class="icon">
                                                        <i class="icon-user"></i>
                                                    </div>
                                                    <div class="body-title-2">Account</div>
                                                </a>
                                            </li>
                                            <li>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                    style="display: none;">
                                                    {{ csrf_field() }}
                                                </form>
                                                <a href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
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
        </div>
    </div>

    @yield('script')
</body>

</html>
