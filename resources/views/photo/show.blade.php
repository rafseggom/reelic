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
            <a class="nav-link nav-link-4" href={{route('contact')}}>Contact</a>
        </li>
    </ul>
</div>
@endsection





@section('body-content')
<!-- Main Photo - MC -->
<div class="container-fluid tm-container-content tm-mt-60">
        <div class="row mb-4">
            <h2 class="col-12 tm-text-primary">{{$photos->title}}</h2>
        </div>
        <div class="row tm-mb-90">

            <div id="vertical-navbar" class="col-1">
                @csrf
                @if (Auth::check())
                <div class="button-container-ver">
                    <a class="ver-navbar-but-col" id="post-btn-upvote">
                        <i class="fas fa-arrow-circle-up"></i>
                    </a>
                    <span class="text-ver-navbar" id="totalRating">
                        {{$photos->getSumRating()}}
                    </span>
                    <a class="ver-navbar-but-col" id="post-btn-downvote">
                        <i class="fas fa-arrow-circle-down"></i>
                    </a>
                </div>
                @else
                <div class="button-container-ver">
                    <a class="ver-navbar-but-col" href={{route('login')}}>
                        <i class="fas fa-arrow-circle-up"></i>
                    </a>
                    <span class="text-ver-navbar">
                        {{$photos->getSumRating()}}
                    </span>
                    <a class="ver-navbar-but-col" href={{route('login')}}>
                        <i class="fas fa-arrow-circle-down"></i>
                    </a>
                </div>
                @endif

                <div class="button-container-ver">
                    <button class="ver-navbar-but-col">
                        <i class="fas fa-comment-dots"></i>
                    </button>
                    <span class="text-ver-navbar">
                        69
                    </span>
                </div>


            </div>


            <div class="col-xl-7 col-lg-6 col-md-6 col-sm-12">
                <img src="{{ asset("storage/". $photos->path )}}" alt="Image" class="img-fluid">
            </div>
            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
                <div class="tm-bg-gray tm-video-details">
                    <div class="text-center mb-5 d-flex justify-content-around">

                        <a href="{{ asset('storage/'. $photos->path) }}" download="photo.{{ explode('.', $photos->path)[1] }}" class="btn btn-primary tm-btn-big" style="padding: 12px 10% 14px;">Download</a>
                        @if (Auth::check() && Auth::id()==$photos->user->id)
                            <a href="{{route('photos.edit', ['id' => $photos->id])}}" class="btn btn-primary tm-btn-big" style="padding: 12px 10% 14px;"><i class="fas fa-edit"></i></a>
                        @else

                        @endif

                    </div>
                    <div class="mb-4 d-flex flex-wrap">
                        <div class="mr-4 mb-2">
                            <span class="tm-text-gray-dark">Uploaded by: </span>
                            <a class="tm-text-primary" href={{route('profile', ['id'=> $photos->user->id])}}>{{$photos->user->name}}</a>
                            <br>
                            <span class="tm-text-gray-dark">Upload date: </span>
                            <span class="tm-text-primary">{{$photos->created_at}}</span>
                        </div>
                    </div>
                    <div class="mb-4">
                        <h3 class="tm-text-gray-dark mb-3">Description</h3>
                        <p>{{$photos->description}}</p>
                    </div>
                    <div>
                        <h3 class="tm-text-gray-dark mb-3">Tags</h3>

                        @foreach ($photos->tags as $tag)
                            <a href="#" class="tm-text-primary mr-4 mb-2 d-inline-block">{{$tag}}</a>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>


        <!-- Comments -->
        <div class="container justify-content-center mt-5 border-left border-right">

            {{-- Comments input --}}
            @if (Auth::check())
            <form id="commentForm" action="{{route('api.comment.post')}}" method="POST">
                @csrf
            <div class="d-flex justify-content-center pt-3 pb-2"> <input type="text" name="comment" id="comment"
                    placeholder="Add a comment..." class="form-control addtxt">
            <button class="btn" type="submit" id='submitBtn'>

                <i class="fas fa-paper-plane" style="font-size: 23px; margin-top: 5%;"></i>
            </button>
            </div>
            </form>
            @else
                <div class="d-flex justify-content-center pt-3 pb-2"> <input type="text" name="comment" id="comment"
                    placeholder="Please, log in first --------->" class="form-control addtxt">
                    <a class="btn" href={{route('login')}}>

                        <i class="fas fa-paper-plane" style="font-size: 23px; margin-top: 5%;"></i>
                    </a>
                </div>
            @endif

            {{-- {{Profanity::blocker($comment->comment)->filter() --}}

            <div id="parentBlock">
                <div id="comments-block">
                    @if ($photos->comments)
                    @foreach ($photos->comments as $comment)
                        <div class="d-flex justify-content-center py-2" >
                            <div class="second py-2 px-2"> <span class="text1">{{Profanity::blocker($comment->comment)->filter()}}</span>
                                <div class="d-flex justify-content-between py-1 pt-2">
                                    {{-- <div> --}}
                                        <span class="text2"><i class="far fa-user mx-1 "></i> {{$comment->user->name}}</span>
                                    {{-- </div> --}}

                                </div>
                            </div>
                        </div>
                    @endforeach
                    @else

                    @endif
                </div>
            </div>


        </div>




        <!-- Related Photos -->
        <div class="row mb-4 mt-4">
            <h2 class="col-12 tm-text-primary">
                Related Photos
            </h2>
        </div>
        <div class="row mb-3 tm-gallery">


            {{-- @foreach ($photos as $photo)
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img onerror='this.src="https://loremflickr.com/320/240?random={{$photo->id}}"' src="{{ asset("storage/". $photo->path )}}" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2>{{$photo->title}}</h2>
                        <a href="{{route('photos.show', ['id'=> $photo->id])}}">View more</a>
                    </figcaption>
                </figure>


            </div>
            @endforeach --}}

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="{{ asset('imgs/img-01.jpg')}}" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2>Hangers</h2>
                        <a href="#">View more</a>
                    </figcaption>
                </figure>
                <div class="d-flex justify-content-around tm-text-gray">
                    <span>3124 <i class="bi bi-chat-right-text-fill"></i> </span>
                    <span>4100 <i class="bi bi-suit-heart-fill"></i></span>
                    <span>9,906 <i class="fas fa-eye"></i></span>
                    <span><i type="button" class="bi bi-share-fill"></i></span>
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="{{ asset('imgs/img-02.jpg')}}" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2>Perfumes</h2>
                        <a href="#">View more</a>
                    </figcaption>
                </figure>
                <div class="d-flex justify-content-around tm-text-gray">
                    <span>3124 <i class="bi bi-chat-right-text-fill"></i> </span>
                    <span>4100 <i class="bi bi-suit-heart-fill"></i></span>
                    <span>9,906 <i class="fas fa-eye"></i></span>
                    <span><i type="button" class="bi bi-share-fill"></i></span>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="{{ asset('imgs/img-03.jpg')}}" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2>Clocks</h2>
                        <a href="#">View more</a>
                    </figcaption>
                </figure>
                <div class="d-flex justify-content-around tm-text-gray">
                    <span>3124 <i class="bi bi-chat-right-text-fill"></i> </span>
                    <span>4100 <i class="bi bi-suit-heart-fill"></i></span>
                    <span>9,906 <i class="fas fa-eye"></i></span>
                    <span><i type="button" class="bi bi-share-fill"></i></span>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="{{ asset('imgs/img-04.jpg')}}" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2>Plants</h2>
                        <a href="#">View more</a>
                    </figcaption>
                </figure>
                <div class="d-flex justify-content-around tm-text-gray">
                    <span>3124 <i class="bi bi-chat-right-text-fill"></i> </span>
                    <span>4100 <i class="bi bi-suit-heart-fill"></i></span>
                    <span>9,906 <i class="fas fa-eye"></i></span>
                    <span><i type="button" class="bi bi-share-fill"></i></span>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="{{ asset('imgs/img-05.jpg')}}" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2>Morning</h2>
                        <a href="#">View more</a>
                    </figcaption>
                </figure>
                <div class="d-flex justify-content-around tm-text-gray">
                    <span>3124 <i class="bi bi-chat-right-text-fill"></i> </span>
                    <span>4100 <i class="bi bi-suit-heart-fill"></i></span>
                    <span>9,906 <i class="fas fa-eye"></i></span>
                    <span><i type="button" class="bi bi-share-fill"></i></span>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="{{ asset('imgs/img-06.jpg')}}" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2>Pinky</h2>
                        <a href="#">View more</a>
                    </figcaption>
                </figure>
                <div class="d-flex justify-content-around tm-text-gray">
                    <span>3124 <i class="bi bi-chat-right-text-fill"></i> </span>
                    <span>4100 <i class="bi bi-suit-heart-fill"></i></span>
                    <span>9,906 <i class="fas fa-eye"></i></span>
                    <span><i type="button" class="bi bi-share-fill"></i></span>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="{{ asset('imgs/img-07.jpg')}}" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2>Bus</h2>
                        <a href="#">View more</a>
                    </figcaption>
                </figure>
                <div class="d-flex justify-content-around tm-text-gray">
                    <span>3124 <i class="bi bi-chat-right-text-fill"></i> </span>
                    <span>4100 <i class="bi bi-suit-heart-fill"></i></span>
                    <span>9,906 <i class="fas fa-eye"></i></span>
                    <span><i type="button" class="bi bi-share-fill"></i></span>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="{{ asset('imgs/img-08.jpg')}}" alt="Image" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2>New York</h2>
                        <a href="#">View more</a>
                    </figcaption>
                </figure>
                <div class="d-flex justify-content-around tm-text-gray">
                    <span>3124 <i class="bi bi-chat-right-text-fill"></i> </span>
                    <span>4100 <i class="bi bi-suit-heart-fill"></i></span>
                    <span>9,906 <i class="fas fa-eye"></i></span>
                    <span><i type="button" class="bi bi-share-fill"></i></span>
                </div>
            </div>
        </div>
    </div>
@endsection()




@section('scripts')
<script src="{{ asset('js/plugins.js') }}"></script>
    <script>
        $(window).on("load", function () {
            $('body').addClass('loaded');
        });
</script>

    {{-- Vote script --}}
<script>

    const upvote = document.getElementById('post-btn-upvote');
    const downvote = document.getElementById('post-btn-downvote');
    //const comment = document.getElementById('comment-post');

    upvote.addEventListener('click', ()=>vote('upvote'));
    downvote.addEventListener('click', ()=>vote('downvote'));




    function commentTemplate(comment) {

        return (
            '<div class="d-flex justify-content-center py-2">'+
            '<div class="second py-2 px-2">'+
               ' <span class="text1">'+comment+'</span>'+
                '<div class="d-flex justify-content-between py-1 pt-2">'+
                    '<span class="text2">'+
                        '<i class="far fa-user mx-1 "></i>'+
                        '{{Auth::user()->name??''}}'+
                    '</span>'+
                '</div>'+
            '</div>'+
            '</div>'
        );
    }



    document.getElementById('commentForm').addEventListener('submit',(e)=>{
        document.getElementById("submitBtn").disabled = true;
        let comment = document.getElementById('comment').value;
        let parentNode = document.getElementById('parentBlock').parentNode;
        e.preventDefault()
        $.ajax({
                type: "POST",
                url: '{{route('api.comment.post')}}',
                data:{
                    "comment": comment,
                    "photo_id": '{{$photos->id}}'
                },
                success: (e)=>{

                    $(document.getElementById('comments-block')).prepend(commentTemplate(comment))
                    document.getElementById("submitBtn").disabled = false;

                },
                dataType: 'JSON'
            });
    });



    function vote(rating){
        $.ajax({
                type: "POST",
                url: '{{route('api.rating.post')}}',
                data:{
                    "rating": rating,
                    "photo_id": '{{$photos->id}}'
                },
                success: (e)=>document.getElementById('totalRating').innerText=e,
                error:(e)=>alert(e.responseJSON.message),
                dataType: 'JSON'
        });
    }





</script>




@endsection
