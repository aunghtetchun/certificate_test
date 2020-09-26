<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{--    <title>{{ \App\Custom::$info['short_name'] }} Chat Bot</title>--}}

    {{--    <link rel="icon" href="{{ asset(\App\Custom::$info['c-logo']) }}">--}}
    {{--    <link rel="stylesheet" href="{{ asset(\App\Custom::$info['main_css']) }}">--}}
    <link rel="stylesheet" href="{{asset('theme/vendor/feather-icons-web/feather.css')}}">
    <link rel="stylesheet" href="{{asset('theme/vendor/font-awesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('theme/vendor/animate_it/animate.css')}}">
    <link rel="stylesheet" href="{{ asset('theme/css/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendor/data_table/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/style.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    @yield('head')
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!--        aside left start -->
        <div class="col-12 col-md-6 col-lg-3 col-xl-2 vh-100 aside-menu p-0">
            @include('layouts.nav')
        </div>
        <!--        aside left end -->
        <div class="col-12 col-md-12 col-lg-9 col-xl-10 vh-100 content">
            <div class="container-fluid">
                <div class="row">


                    <!-- content start-->
                    <div class="col-12 px-0">
                        {{--                            @include('layouts.header')--}}
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 loader">
                                    <div class="d-flex justify-content-center align-items-center vh-100 ">
                                        <div class="spinner-grow text-primary" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 px-0 py-3 bg-light min-vh-100 page-content" style="display: none">
                                    <!--                                    card area start-->
                                @yield('content')
                                <!--                                    card area end-->
                                </div>


                            </div>
                        </div>
                    </div>
                    <!--content end                    -->

                </div>
            </div>
        </div>
    </div>theme
</div>

@include('layouts.toast')
<!-- Scripts -->
<script src="{{ asset('theme/js/jquery.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="{{ asset('theme/js/bootstrap.js') }}"></script>
<script src="{{ asset('theme/vendor/data_table/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('theme/vendor/data_table/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('theme/js/app.js') }}"></script>

@yield('foot')
</body>
</html>
