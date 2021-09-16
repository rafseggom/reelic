@extends('layouts.common')




@section('navbar-active')
<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a class="nav-link nav-link-3" href={{route('home')}}>Home</a>
        </li>

        @if (Auth::check())
            <li class="nav-item">
                <a class="nav-link nav-link-1"  href={{route('dashboard')}}>Dashboard</a>
            </li>

            <li class="nav-item">
                <a class="nav-link nav-link-2" href={{route('profile', ['id'=> Auth::user()])}}>My Profile</a>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link nav-link-1"  href={{route('login')}}>Log in</a>
            </li>
        @endif


        <li class="nav-item">
            <a class="nav-link nav-link-4 active" aria-current="page" href="#">Contact</a>
        </li>
    </ul>
</div>
@endsection





@section('body-content')
<div class="container-fluid tm-mt-60">
    <div class="row tm-mb-50">

        <div class="col-lg-6 col-12 mb-5">
            <div class="tm-address-col">
                <h2 class="tm-text-primary mb-5">Our information</h2>
                <p class="tm-mb-50">Proyecto de galería de fotos realizado para la asignatura de IISSI-2 por Rafael Segura Gómez, del grupo 2 L5. </p>

                <ul class="tm-contacts">
                    <li>
                        <a href="mailto:rafseggom@alum.us.es" target="_blank" class="tm-text-gray">
                            <i class="fas fa-envelope"></i>
                            Email: rafseggom@alum.us.es
                        </a>
                    </li>

                    <li>
                        <a href="https://github.eii.us.es/rafseggom/Proyecto-curso-IISSI2"
                        target="_blank" class="tm-text-gray">
                            <i class="fab fa-github"></i>
                            URL: https://github.eii.us.es/rafseggom/Proyecto-curso-IISSI2
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-6 col-12">
            <h2 class="tm-text-primary mb-5">Our Location</h2>
            <!-- Map -->
            <div class="mapouter mb-4">
                <div class="gmap-canvas">
                    <iframe width="100%" height="520" id="gmap-canvas"
                        src="https://maps.google.com/maps?q=Escuela%20T%C3%A9cnica%20Superior%20de%20Ingenier%C3%ADa%20Inform%C3%A1tica,%20Universidad%20de%20Sevilla,%2041012%20Sevilla+(Escuela%20T%C3%A9cnica%20Superior%20de%20Ingenier%C3%ADa%20Inform%C3%A1tica)&t=&z=13&ie=UTF8&iwloc=&output=embed"
                        frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection()




@section('scripts')
<script src="js/plugins.js"></script>
        <script>
            $(window).on("load", function () {
                $('body').addClass('loaded');
            });
        </script>
@endsection
