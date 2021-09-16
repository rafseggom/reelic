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

    <div class="h1 text-info text-center mt-5">STATISTICS</div>

    <div class="col-xl-6 mx-auto row px-4 " style="--bs-gutter-x: 0;">

        <!-- TOP RATED -->
        <div class="h2 text-primary text-center my-3 mt-5" >TOP Photos more rated</div>
        <div class="flex flex-col ">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Photo ID
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Title
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Votes
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">View Photo</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($topRatedPhotos as $photo)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{$photo->id}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{$photo->title}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{$photo->topRated}}
                                    </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{route('photos.show', ['id'=> $photo->id])}}" class="text-indigo-600 hover:text-indigo-900">View Photo</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- END TOP RATED -->

        <!-- TOP COMMENTED -->
        <div class="h2 text-primary text-center my-3 mt-5" >TOP Photos with more comments</div>
        <div class="flex flex-col ">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200" style="width: 100%">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Photo ID
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Title
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    # of comments
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">View Photo</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($topCommentedPhotos as $photo)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{$photo->id}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$photo->title}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{$photo->topCommented}}
                                    </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{route('photos.show', ['id'=> $photo->id])}}" class="text-indigo-600 hover:text-indigo-900">View Photo</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- END TOP COMMENTED -->



        <!-- TOP TAGGED -->
        <div class="h2 text-primary text-center my-3 mt-5" >TOP Tags more used</div>
        <div class="flex flex-col ">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200" style="width: 100%">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tag ID
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tag
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    # of photos
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">View Photo</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($topTagged as $tag)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{$tag->id}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{$tag->tag}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{$tag->topTagged}}
                                    </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{route('home', ['search'=>$tag->tag])}}" class="text-indigo-600 hover:text-indigo-900">Search with this tag</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- END TOP TAGGED -->


        <!-- TOP USER BETTER RATED -->
        <div class="h2 text-primary text-center my-3 mt-5" >TOP Users better rated</div>
        <div class="flex flex-col ">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200" style="width: 100%">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    User ID
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    User name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Votes
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">View Profile</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($mostLiked as $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{$user->id}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{$user->name}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{$user->mostLiked}}
                                    </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href={{route('profile', ['id'=> $user->id])}} class="text-indigo-600 hover:text-indigo-900">View Profile</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- END USER BETTER RATED -->

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
