
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')-{{ config('app.name', 'Blog') }}</title>
        <!-- Google Fonts -->
        <link
        href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext"
        rel="stylesheet"
        type="text/css"
      />
      <link
        href="https://fonts.googleapis.com/icon?family=Material+Icons"
        rel="stylesheet"
        type="text/css"
      />
      <!-- Bootstrap Core Css -->
      <link href="{{ asset('assets/Backend/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet" />
      <!-- Waves Effect Css -->
      <link href="{{ asset('assets/Backend/plugins/node-waves/waves.css') }}" rel="stylesheet" />
      <!-- Animation Css -->
      <link href="{{ asset('assets/Backend/plugins/animate-css/animate.css') }}" rel="stylesheet" />
      <!-- Morris Chart Css-->
      <link href="{{ asset('assets/Backend/plugins/morrisjs/morris.css') }}" rel="stylesheet" />
      <!-- Custom Css -->
      <link href="{{ asset('assets/Backend/css/style.css') }}" rel="stylesheet" />
      <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
      <link href="{{ asset('assets/Backend/css/themes/all-themes.css') }}" rel="stylesheet" />

    @stack('css')

</head>
<body class="theme-red">
    @include('layouts.backend.partial.loader')
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>

    @include('layouts.backend.partial.search-bar')
    
    @include('layouts.backend.partial.topbar')
    
    @include('layouts.backend.partial.sidebar')

    @yield('content')

    <!-- Jquery Core Js -->
    <script src="{{ asset('assets/Backend/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap Core Js -->
    <script src="{{ asset('assets/Backend/plugins/bootstrap/js/bootstrap.js') }}"></script>
    <!-- Select Plugin Js -->
    <script src="{{ asset('assets/Backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <!-- Slimscroll Plugin Js -->
    <script src="{{ asset('assets/Backend/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('assets/Backend/plugins/node-waves/waves.js') }}"></script>
   
    <!-- Custom Js -->
    <script src="{{ asset('assets/Backend/js/admin.js') }}"></script>
    <!-- Demo Js -->
    <script src="{{ asset('assets/Backend/js/demo.js') }}"></script>

    @stack('js')
</body>
</html>

