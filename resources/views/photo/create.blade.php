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

<form id="photo" action="{{route('photos.update',['id'=>$photo->id])}}" method="POST">
    @csrf
    {{ method_field('PUT') }}
    <div class="container-fluid tm-container-content tm-mt-60">
        {{-- Title --}}
        <div class="row mb-4">
            <input type="text" id='title-form' name="title" class="col-6 tm-text-primary" placeholder="Insert title here..." value="{{$photo->title}}">
        </div>

        <div class="row tm-mb-90">
            <div class="col-xl-8 col-lg-7 col-md-6 col-sm-12">
                <img src="{{ asset("storage/". $photo->path )}}" alt="Image" class="img-fluid">
            </div>
            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
                <div class="tm-bg-gray tm-video-details">

                   {{--  Description --}}
                    <div class="mb-4">
                        <h3 class="tm-text-gray-dark mb-3">Add description</h3>
                        <textarea class="form-control" name='description' style="background-color: #c7c7c7;" id="description-form-text-area" rows="3">{{$photo->description}}</textarea>
                    </div>





                    <!-- Tags -->
                    <div class="container" style="background-color: #1d1d1b;">

                        {{-- https://laravel.com/docs/8.x/helpers#method-fluent-str-explode
                         $collection = Str::of('foo bar baz')->explode(' '); --}}

                            <label class="tm-text-primary">Insert tags:</label>

                            <input id="form-tags" name="tag" type="text" data-role="tagsinput" value="{{implode(',',$photo->tags)}}">

                    </div>

                    {{-- Is Public --}}
                    {{-- <div class="form-check">
                        <h3 class="mb-3" style="color: burlywood;">Visibility</h3>
                        <input name='isPublic' class="form-check-input position-static" type="checkbox" id="visibility" value="option1">
                    </div> --}}


                    <h3 class="mb-3" style="color: burlywood;">Visibility</h3>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isPublic" id="exampleRadios1" value="1" checked>
                        <label class="form-check-label" style="color: burlywood;" for="exampleRadios1">
                          Public
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="isPublic" id="exampleRadios2" value="0">
                        <label class="form-check-label" style="color: burlywood;" for="exampleRadios2">
                          Private
                        </label>
                      </div>
                    @if (Auth::id() == $photo->user_id)
                        <div class="text-center mb-5 mt-5 d-flex justify-content-around">
                                                {{-- Upload Button --}}
                                                <button type="submit" class="btn btn-primary tm-btn-big">Submit</button>


                                                {{-- Delete Button --}}
                                                <a href="#" onclick="
                                                    var result = confirm('Are you sure you want to delete this photo?');
                                                    if(result){
                                                        event.preventDefault();
                                                        document.getElementById('delete-form').submit();
                                                    }
                                                    " class="btn btn-primary tm-btn-big">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </div>

                    @else

                    @endif


                </div>
            </div>
        </div>
    </div>
</form>
<form method="POST" id="delete-form" action="{{route('photos.destroy', [$photo->id])}}">
    @csrf
    <input type="hidden" name="_method" value="DELETE">
</form>
@endsection()




    @section('scripts')
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script>
        $(window).on("load", function() {
            $('body').addClass('loaded');
        });
    </script>
    <script src="{{ asset('js/bootstrap-tagsinput.min.js') }}"></script>
    <script>

    $('#form-tags').tagsinput({
        trimValue: true
    });



   /*  $('#photo').submit(event=>{
        // event.preventDefault();
        let form = $(event.target);
        let tags = $('#form-tags').tagsinput('items')

        tags.forEach((val, i) => {
            $("<input />").attr("type", "hidden")
              .attr("name", "tag["+ i +"]")
              .attr("value", val)
              .appendTo(form);
        });

      return true; */


        // $.ajax({
        //     url: form.attr('action'),
        //     type: 'PUT',
        //     data:{
        //         title: $('#title-form').text(),
        //         description: $('#description-form-text-area').text(),
        //         isPublic: $('#visibility').is(':checked'),
        //         tag:$('#form-tags').tagsinput('items')
        //     },
        //     success: function(data) {
        //         console.log(data);
        //         window.location.href = '{{route('photos.show', ['id' => $photo->id])}};'
        //     },
        //     error:(e)=>{
        //         console.error(e);
        //     }
        // });
    //})

    </script>
    @endsection
