<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=0.86, maximum-scale=3.0, minimum-scale=0.86">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Welcome to | @yield('title')</title>

    <link rel="icon" href="{{ URL::asset('/favicon.ico') }}" type="image/x-icon" />

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/swiper.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.dataTables.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/newDisBoardStyle.css') }}" rel="stylesheet">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <style>
        /*.no-js #loader { display: none;  }*/
        /*.js #loader { display: block; position: absolute; left: 100px; top: 0; }*/
        /*.se-pre-con {*/
            /*position: fixed;*/
            /*left: 0px;*/
            /*top: 0px;*/
            /*width: 100%;*/
            /*height: 100%;*/
            /*z-index: 9999;*/
            /*background: url(https://techoryze.com/public/126.gif) center no-repeat #fff;*/
        /*}*/

    </style>

    <!-- Latest compiled and minified JavaScript -->
    {{--<script src="{{ asset('js/app.js') }}" defer></script>--}}
</head>

<body>

    <main>
        @yield('content')

        {{--LOADER--}}
        <div id="loader" class="bookMain" style="display: block;">
            <div class="bookInner">
                <div class="book">
                    <div class="inner">
                        <div class="left"></div>
                        <div class="middle"></div>
                        <div class="right"></div>
                    </div>
                    <ul>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                </div>
            </div>
        </div>

    </main>

    {{--
    <script src="{{ asset('js/slim.min.js') }}"></script>--}}

    <script src="{{ asset('js/jquery.js') }}"></script>
    <script>
        // $( document ).ready(function() {
        //     $(".bookMain").fadeIn();
        // });
        $(window).load(function() {
            $(".bookMain").fadeOut("slow");

        });


    </script>
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
    <script src="https://cdn.tiny.cloud/1/yyuqjlmx1qjh0c9i6j3e3xc3xxhjkwaxtaill8edown538w0/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>


    <script src="{{ asset('js/swiper.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/adminD.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/web.js') }}"></script>
    <script src="{{ asset('js/newFile.js') }}"></script>
    <script src="{{ asset('js/details.js') }}"></script>

    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
    <script src="{{ asset('js/fakedata.js') }}"></script>

    <script>
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 2,
            spaceBetween: 30,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    @yield('style') @yield('script')
</body>

</html>
