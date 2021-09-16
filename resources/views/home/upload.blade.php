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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">

   <link rel="stylesheet/less" type="text/css" href="{{ asset('/less/upload.less') }}" />
    <script src="//cdn.jsdelivr.net/npm/less@3.13"></script>
</head>

<body class="color-primary-0">
    <!-- Page Loader -->
    <div id="loader-wrapper">
        <div id="loader"></div>

        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>

    </div>


    <!-- Body - MC  -->

    <div class="container-fluid tm-container-content tm-mt-60">
        <div class="mb-4 row justify-content-between" style=" display: flex; justify-content: space-between;">


            <div class="zone" style="
            /* display: flex; */
            /* justify-content: center; */
            /* align-content: center; */
            margin-top: 10%;
            margin-bottom: 10%;
        ">

                <!-- Quit button -->
                <div id="iconArea" class="iconArea">
                    <a href={{route('home')}}>
                        <div id="icon" class="Icon">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                </div>



                <div id="dropZ">
                    <form id="photo" action="{{route('photos.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <i class="fa fa-cloud-upload"></i>
                    <div>Drag and drop your file here</div>
                    <span>OR</span>
                    <div class="selectFile">
                        <label for="file">Select file</label>
                        <input type="file" name="file" id="file">
                    </div>


                        <button class="btn" type="submit">
                                <i class="fas fa-paper-plane" style="
                        font-size: 30px;
                        margin-top: 5%;"></i></button>


                    </form>


                    <p>Send</p>
                </div>

            </div>
        </div>
    </div>
</body>


<!-- Footer  -->
<footer class="tm-bg-gray pt-3 pb-0 tm-text-gray tm-footer">
    <div class="container-fluid tm-container-small">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-12 px-5 mb-5">
                <p>Reelic is project made for the subject IISSI-2. Not intended for comercial use. </p>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12 px-1 mb-1">
                <ul class="tm-social-links d-flex justify-content-end pl-0 mb-1">
                    <li class="mb-2"><a href="https://github.eii.us.es/rafseggom/Proyecto-curso-IISSI2"
                            target="_blank"><i class="fab fa-github"></i></a></li>
                    <li class="mb-2"><a href="mailto:rafseggom@alum.us.es" target="_blank"><i
                                class="fas fa-envelope"></i></a></li>
                    <li class="mb-2"><a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" target="_blank"><i
                                class="fab fa-youtube"></i></a></li>
                </ul>

            </div>
        </div>

    </div>
</footer>

<script src="js/plugins.js"></script>
<script>
    $(window).on("load", function () {
        $('body').addClass('loaded');
    });
</script>
<script>
    $('.navbar-collapse a').click(function () {
        $(".navbar-collapse").collapse('hide');
    });
</script>
<script src="js/upload.js"></script>
<script src="js/backbutton.js"></script>

</body>

</html>
