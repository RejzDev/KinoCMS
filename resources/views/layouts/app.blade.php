<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/main.css?v=1222')}}">

    @yield('css')
</head>
<body class="bg-img">

    <div id="app ">

        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">

            <div class="container">

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <header>

            <div class="container">

                <nav class="navbar navbar-expand-lg navbar-light ">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="text-left">
                                <form class="d-flex">
                                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-success" type="submit">Search</button>
                                </form>
                            </div>

                        </div>

                        <ul class="social-icons">
                            <li><a class="social-icon-twitter" href="#" title="..." target="_blank" rel="noopener"></a></li>
                            <li><a class="social-icon-fb" href="#" title="..." target="_blank" rel="noopener"></a></li>
                            <li><a class="social-icon-vk" href="#" title="..." target="_blank" rel="noopener"></a></li>
                            <li><a class="social-icon-telegram" href="#" title="..." target="_blank" rel="noopener"></a></li>
                               </ul>
                        </div>
                </nav>

                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">KinoCMS</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>


                        <div class=" collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="{{route('ongoing.home')}}">Афиша</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('soon.home')}}">Расписание</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('soon.home')}}">Скоро</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('cinema.home')}}">Кинотеатры</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('action.home')}}">Акции</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                       О кинотеатре
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <li><a class="dropdown-item" href="#">Новости</a></li>
                                        <li><a class="dropdown-item" href="#">Реклама</a></li>
                                        <li><a class="dropdown-item" href="#">Кафе</a></li>
                                        <li><a class="dropdown-item" href="#">Мобильное приложение</a></li>
                                        <li><a class="dropdown-item" href="#">Контакти</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        </div>

                </nav>
            </div>
        </header>


        <main class="py-4 ">

            @yield('content')
        </main>




        <!-- Footer -->
        <footer class="text-center text-lg-start bg-light text-muted">
            <!-- Section: Social media -->
            <section
                class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom"
            >


                <!-- Right -->
            </section>
            <!-- Section: Social media -->

            <!-- Section: Links  -->
            <section class="">
                <div class="container text-center text-md-start mt-5">
                    <!-- Grid row -->
                    <div class="row mt-3">
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold mb-4">
                                Афиша
                            </h6>
                            <p>
                                <a href="#!" class="text-reset">Расписание</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset">Скоро в прокате</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset">Кинотеатры</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset">Акции</a>
                            </p>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold mb-4">
                                О-кинотеатре
                            </h6>
                            <p>
                                <a href="#!" class="text-reset">Новости</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset">Реклама</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset">Кафе-Бар</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset">Контакты</a>
                            </p>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                            <!-- Links -->
                            <ul class="social-icons">
                                <li><a class="social-icon-twitter" href="#" title="..." target="_blank" rel="noopener"></a></li>
                                <li><a class="social-icon-fb" href="#" title="..." target="_blank" rel="noopener"></a></li>
                                <li><a class="social-icon-vk" href="#" title="..." target="_blank" rel="noopener"></a></li>
                                <li><a class="social-icon-telegram" href="#" title="..." target="_blank" rel="noopener"></a></li>
                            </ul>
                        </div>
                        <!-- Grid column -->
                    </div>
                    <!-- Grid row -->
                </div>
            </section>
            <!-- Section: Links  -->

            <!-- Copyright -->
            <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
                ©KinoCMS:
            </div>
            <!-- Copyright -->
        </footer>
        <!-- Footer -->
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    @yield('js')
</body>


</html>
