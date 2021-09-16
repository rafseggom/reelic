<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('/favicon.ico') }}">
    <title>Reelic - Photo Gallery</title>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    @yield('styles')

</head>

<body class="color-primary-0">
    <!-- Page Loader -->
    <div id="loader-wrapper">
        <div id="loader"></div>

        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>

    </div>

    <!-- Banner -->
    <div class="tm-hero d-flex " data-parallax="scroll" data-image-src="{{ asset('imgs/hero.jpg') }}">

        <div class="container-fluid d-flex justify-content-between align-items-center font-weight-bold" style="
        text-shadow: 1px 2px #ffffff;">
            <a class="navbar-brand" href={{route('home')}}>
                <img src="{{ asset('/imgs/logo.svg') }}" class="fas navbar-logo mr-2 "></img>
                Reelic
            </a>
            <a class="glow-on-hover" type="button" href="{{route('upload')}}"></i><i class="fas fa-cloud-upload-alt" style="
                display: flex;
                justify-content: center;
                align-content: center;
                margin-top: 10%;
                text-shadow: 0px 0px #000000;
            "></i></a>

            {{-- Search bar --}}
            <form class="d-flex tm-search-form" method="GET" action="{{route('home')}}">
                @csrf
                <input class="form-control tm-search-input" type="search" name="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success tm-search-btn" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>


            <nav class="navbar navbar-expand-lg">

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>



                @yield('navbar-active')



        </div>
        </nav>
    </div>

    <!-- Body - MC  -->

    @yield('body-content')


    <!-- Footer  -->


    <footer class="tm-bg-gray pt-3 pb-0 tm-text-gray tm-footer">
        <div class="container-fluid tm-container-small">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12 px-5 mb-5">
                    <p>Reelic is project made for the subject IISSI-2. Not intended for comercial use. </p>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12 px-1 mb-1">
                    <ul class="tm-social-links d-flex justify-content-end pl-0 mb-1">
                        <li class="mb-2"><a href="https://github.eii.us.es/rafseggom/Proyecto-curso-IISSI2" target="_blank"><i class="fab fa-github"></i></a></li>
                        <li class="mb-2"><a href="mailto:rafseggom@alum.us.es" target="_blank"><i class="fas fa-envelope"></i></a></li>
                        <li class="mb-2"><a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" target="_blank"><i class="fab fa-youtube"></i></a></li>
                        <li class="mb-2"><a href="{{route('stats')}}"><i class="fas fa-chart-bar"></i></a></li>
                    </ul>

                </div>
            </div>

        </div>
    </footer>


    <!-- Scripts  -->

    @yield('scripts')

</body>

</html>
