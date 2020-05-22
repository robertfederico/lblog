<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')-{{ config('app.name', ' Blog') }}</title>

	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">

	<!-- Stylesheets -->

	<link href="{{ asset('assets/Frontend/css/bootstrap.css') }}" rel="stylesheet">

	<link href="{{ asset('assets/Frontend/css/swiper.css') }}" rel="stylesheet">

	<link href="{{ asset('assets/Frontend/css/ionicons.css') }}" rel="stylesheet">
    
    @stack('css')

</head>
<body>
    @include('layouts.frontend.partial.header')

    @yield('content')

    @include('layouts.frontend.partial.footer')

	<script src="{{ asset('assets/Frontend/js/jquery-3.1.1.min.js') }}/"></script>

	<script src="{{ asset('assets/Frontend/js/tether.min.js') }}/"></script>

    <script src="{{ asset('assets/Frontend/js/bootstrap.js') }}/"></script>
    <script>
        $('#subsciber-form').on('submit', function(e){
            e.preventDefault();
            email = $('#email').val();
            $.ajax({
                url: "{{ url('subscriber') }}",
                type:"POST",
                data:{
                "_token": "{{ csrf_token() }}",
                    email:email,
                },
                success:function(response){
                    if($.isEmptyObject(response.error)){
                        $('#successMsg').html(response.success);
                        $('#successMsg').removeClass('d-none');
                        $('#successMsg').addClass('alert-success');
                        $('#successMsg').addClass('text-success');
                        $('#successMsg').removeClass('alert-danger');
                        $('#successMsg').removeClass('text-danger');
                        $('#email').val('');
                      
                    }else{
                        $('#successMsg').html(response.error);
                        $('#successMsg').removeClass('d-none');
                        $('#successMsg').addClass('alert-danger');
                        $('#successMsg').addClass('text-danger');
                        $('#successMsg').removeClass('alert-success');
                        $('#successMsg').removeClass('text-success');
                        $('#email').focus();
                    }
                }
              
            })
        })
     
    </script>
    @stack('js')
</body>
</html>
