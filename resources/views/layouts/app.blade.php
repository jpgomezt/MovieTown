<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title', __("layout.page_title") )</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('/img/faviconMovieTown.png') }}" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet"
        type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('/css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('/css/custom-styles.css') }}" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger"
                href="{{ route('home.index') }}">{{ __('layout.brand_name') }}</a>
            <button
                class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded"
                type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive"
                aria-expanded="false" aria-label="Toggle navigation">
                {{ __('layout.navbar_responsive_title') }}
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    @guest
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                                href="{{ route('movie.list') }}">{{ __('layout.movies_link') }} <i
                                    class="fas fa-ticket-alt"></i>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                                href="{{ route('login') }}">{{ __('Login') }} <i class="fas fa-sign-in-alt"></i></a>
                        </li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                                href="{{ route('register') }}">{{ __('Register') }} <i
                                    class="fas fa-cash-register"></i></a></li>
                    @else
                        @if (Auth::user()->getIsStaff())
                            <li class="nav-item mx-0 mx-lg-1"><a
                                    class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                                    href="{{ route('admin.movie.list') }}">{{ __('layout.movies_link') }} <i
                                        class="fas fa-ticket-alt"></i>
                            <li class="nav-item mx-0 mx-lg-1"><a
                                    class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                                    href="{{ route('admin.review.list') }}">{{ __('layout.reviews_link') }} <i
                                        class="far fa-comment"></i></a>
                            </li>
                            <li class="nav-item mx-0 mx-lg-1"><a
                                    class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                                    href="{{ route('admin.order.list') }}">{{ __('layout.orders_link') }} <i
                                        class="fas fa-luggage-cart"></i></a></li>
                            <li class="nav-item mx-0 mx-lg-1"><a
                                    class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                                    href="{{ route('admin.watchlist.list') }}">{{ __('layout.watchlists_link') }} <i
                                        class="fas fa-layer-group"></i></a>
                            </li>
                            <li class="nav-item mx-0 mx-lg-1"><a
                                    class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                                    href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}
                                    <i class="fas fa-sign-out-alt"></i></a></li>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @else
                            <li class="nav-item mx-0 mx-lg-1"><a
                                    class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                                    href="{{ route('movie.list') }}">{{ __('layout.movies_link') }} <i
                                        class="fas fa-ticket-alt"></i>
                            <li class="nav-item mx-0 mx-lg-1"><a
                                    class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                                    href="{{ route('cart.show') }}">{{ __('layout.cart_link') }} <i
                                        class="fas fa-shopping-cart"></i>
                            <li class="nav-item mx-0 mx-lg-1"><a
                                    class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                                    href="{{ route('review.list') }}">{{ __('layout.reviews_link') }} <i
                                        class="far fa-comment"></i></a></li>
                            <li class="nav-item mx-0 mx-lg-1"><a
                                    class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                                    href="{{ route('order.list') }}">{{ __('layout.orders_link') }} <i
                                        class="fas fa-luggage-cart"></i></a></li>
                            <li class="nav-item mx-0 mx-lg-1"><a
                                    class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                                    href="{{ route('watchlist.list') }}">{{ __('layout.watchlists_link') }} <i
                                        class="fas fa-layer-group"></i></a>
                            </li>
                            <li class="nav-item mx-0 mx-lg-1"><a
                                    class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                                    href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}
                                    <i class="fas fa-sign-out-alt"></i></a></li>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @endif
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="" style=" margin: 100px">

    </header>

    @yield('content')

    <!-- Footer-->
    <footer class="footer text-center ">
        <div class="container">
            <div class="row">
                <!-- Footer Location-->
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h4 class="text-uppercase mb-4">{{ __('layout.location_title') }}</h4>
                    <p class="lead mb-0">
                        {{ __('layout.location_address') }}
                        <br />
                        {{ __('layout.location_city') }} / {{ __('layout.location_state') }}
                        <br />
                        {{ __('layout.location_country') }}
                    </p>
                </div>
                <!-- Footer Social Icons-->
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h4 class="text-uppercase mb-4">{{ __('layout.footer_social_title') }}</h4>
                    <a class="btn btn-outline-light btn-social mx-1"><i class="fab fa-instagram"></i></a>
                    <a class="btn btn-outline-light btn-social mx-1"><i class="fab fa-fw fa-facebook-f"></i></a>
                    <a class="btn btn-outline-light btn-social mx-1"><i class="fab fa-fw fa-twitter"></i></a>
                    <a class="btn btn-outline-light btn-social mx-1"><i class="fab fa-youtube"></i></a>
                </div>
                <!-- Footer Contact Text-->
                <div class="col-lg-4">
                    <h4 class="text-uppercase mb-4">{{ __('layout.footer_contact_title') }}</h4>
                    <p class="lead mb-0">
                        <i class="fas fa-envelope"></i> {{ __('layout.footer_contact_mail') }}
                        <br />
                        <i class="fas fa-phone"></i> {{ __('layout.footer_contact_phone') }}
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
    <!-- Third party plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('/js/scripts.js') }}"></script>
</body>

</html>
