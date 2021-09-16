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
                <a class="nav-link nav-link-2 active" aria-current="page" href={{route('profile', ['id'=> Auth::user()])}}>My Profile</a>
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

{{-- Alert --}}
@if ($uploadWarning==1)
<div class="alert alert-danger alert-dismissible fade show d-flex justify-content-center" role="alert">
    <strong class="mr-4">Upload Limit reached!</strong> Total of 50 photo uploads per user.
    <button type="button" class="close btn btn-danger my-0 py-0 ml-4 rounded-pill" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div>
@else

@endif



<div class="row py-5 px-4" style="--bs-gutter-x: 0;">
    <div class="col-xl-4 col-md-6 col-sm-10 mx-auto">

        <!-- Profile widget -->
        <div class="bg-white shadow rounded overflow-hidden">
            <div class="px-4 pt-0 pb-4 bg-dark">
                <div class="media align-items-end profile-header">
                    <div class="profile mr-3">
                        <div class="text-center">
                            <img src="https://i.pravatar.cc/150?img={{$user->id}}" alt="..." width="130" class=" rounded mb-2 img-thumbnail" style="
                            margin-top: 5%;">
                        </div>
                        <div class="media-body mb-5 text-white">
                            <h4 class="mt-0 mb-0">{{$user->name}}</h4>
                            <p class="small mb-4"> <i class="far fa-envelope mr-2"></i>{{$user->email}}</p>
                        </div>
                        @if (Auth::id() == $user->id)
                            <a href="{{route('dashboard')}}" class="btn btn-dark btn-sm btn-block">Edit profile</a>
                        @else
                            <a href="#" class="btn btn-dark btn-sm btn-block">Follow</a>
                        @endif

                    </div>

                </div>
            </div>

            <div class="bg-light p-4 d-flex justify-content-end text-center">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <h5 class="font-weight-bold mb-0 d-block">{{$totalPhotos}}</h5><small class="text-muted"> <i class="fas fa-image"></i>Photos</small>
                    </li>
                    <li class="list-inline-item">
                        <h5 class="font-weight-bold mb-0 d-block">84K</h5><small class="text-muted"> <i class="fas fa-users"></i>Followers</small>
                    </li>
                </ul>
            </div>

            <div class="py-4 px-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="mb-0">Recent photos</h5>
                </div>
                <div class="row">


                    @foreach($photos as $photo)
                        <div class="col-lg-6 mb-2 pr-lg-1">
                            <figure class="effect-ming tm-video-item">
                                <img onerror='this.src="https://loremflickr.com/320/240?random={{$photo->id}}"' src="{{ asset("storage/". $photo->path )}}" alt="Image" class="img-fluid">
                                <figcaption class="d-flex align-items-center justify-content-center">
                                    <h2>{{$photo->title}}</h2>
                                    <a href="{{route('photos.show', ['id'=> $photo->id])}}">View more</a>
                                </figcaption>
                            </figure>
                        </div>
                    @endforeach





                    {{-- Pagination --}}
                    <div class="row tm-mb-90">
                        <div class="col-12 d-flex justify-content-between align-items-center tm-paging-col">
                            {{$photos->appends($_GET)->links()}}
                        </div>
                    </div>




                </div>
            </div>
        </div>

    </div>
</div>
@endsection()




@section('scripts')

<script src="{{ asset('js/plugins.js')}}"></script>
<script>
    $(window).on("load", function() {
        $('body').addClass('loaded');
    });
</script>
<script>
    $('.navbar-collapse a').click(function() {
        $(".navbar-collapse").collapse('hide');
    });
</script>
@endsection
