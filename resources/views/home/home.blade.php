@extends('layouts.common')


@section('navbar-active')
<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a class="nav-link nav-link-3 active" aria-current="page" href="#">Home</a>
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
            <a class="nav-link nav-link-4" href={{route('contact')}}>Contact</a>
        </li>
    </ul>
</div>
@endsection

@section('body-content')
<div class="container-fluid tm-container-content tm-mt-60">


    <div class="mb-4 row justify-content-between" style=" display: flex; justify-content: space-between; ">

        <div class="col-6 mr-2 ml-1">
            <a class="btn btn-primary col-2 tm-text-primary" style="padding: 12px 10px 14px;" href="{{route('home',['orderBy'=>'date','order'=>'desc'])}}">
                Newer
            </a>
            <a class="btn btn-primary col-2 tm-text-primary" style="padding: 12px 10px 14px;" href="{{route('home',['orderBy'=>'date','order'=>'asc'])}}">
                Older
            </a>

            <a class="btn btn-primary col-2 mx-1 tm-text-primary" style="padding: 12px 10px 14px;" href="{{route('home',['filterBy'=>'rating'])}}">
                Rating
            </a>

            <a class="btn btn-primary col-2 tm-text-primary" style="padding: 12px 10px 14px;" href="{{route('home',['filterBy'=>'comment'])}}">
                Comment
            </a>
        </div>

        {{-- <div class="col-4 mx-2">
            <button class="btn btn-primary btn-lg col-3 tm-text-primary" style="padding: 12px 10px 14px;" type="button">
                Last Week
            </button>

            <button class="btn btn-primary col-3 mx-1 tm-text-primary" style="padding: 12px 10px 14px;" type="button">
                Last Month
            </button>

            <button class="btn btn-primary col-3 tm-text-primary" style="padding: 12px 10px 14px;" type="button">
                All Time
            </button>
        </div> --}}

    </div>



    <div class="row tm-mb-90 tm-gallery ">

        @foreach ($photos as $photo)

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img onerror='this.src="https://loremflickr.com/320/240?random={{$photo->id}}"' src="{{ asset("storage/". $photo->path )}}" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2>{{$photo->title}}</h2>
                        <a href="{{route('photos.show', ['id'=> $photo->id])}}">View more</a>
                    </figcaption>                </figure>
                <div class="d-flex justify-content-around tm-text-gray">
                    <span>3124 <i class="bi bi-chat-right-text-fill"></i> </span>
                    <span>4100 <i class="bi bi-suit-heart-fill"></i></span>
                    <span>{{$photo->views}}<i class="fas fa-eye"></i></span>
                    <span><i type="button" class="bi bi-share-fill"></i></span>
                </div>
            </div>
        @endforeach


     {{-- Pagination --}}
    <div class="row tm-mb-90">
        <div class="col-12 d-flex justify-content-between align-items-center tm-paging-col">
            {{$photos->appends($_GET)->links()}}
        </div>
    </div>


</div>

@endsection()

@section('scripts')
<script src="{{ asset('js/plugins.js') }}"></script>
<script>
    $(window).on("load", function() {
        const queryParams = window.location.search;
        $('body').addClass('loaded');
        if (queryParams) {
            const urlParams = new URLSearchParams(queryParams);
            console.log(urlParams);
        }
    });
</script>
<script>
    $('.navbar-collapse a').click(function() {
        $(".navbar-collapse").collapse('hide');
    });
</script>
@endsection
