<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{env('SITE_TITLE')}} @yield('title')</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="{{url('/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <!--Page specific css-->
    @yield('page_css')
            <!--/-->

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    @include('partials.header')

    @yield('content')

    <!-- JavaScripts -->
    <script src="{{url('/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{url('/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

    <!--ajax csrf token set-->
<script>
    var js_base_url = "<?php echo URL::to('/') ?>";
    var csrf_token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<!--/ajax csrf token set-->

<!--page specific scripts-->
@yield('page_js')
<!--/page specific scripts-->

<!--page manipulatin scripts-->
@yield('custom_script')
<!--/page manipulatin scripts-->
</body>
</html>
