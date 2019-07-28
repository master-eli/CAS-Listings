<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome-free-5.1.1-web/css/all.css') }}" rel="stylesheet">
</head>
<body>
    <div class="row" style="margin: 0;">
        <div class="col-lg-12"  style="padding: 0">     
        @include('inc.login')
        @include('inc.register')
        @include('inc.top-nav')
        </div>
    </div>
    <div class="row" style="margin: 0">
        @guest
        @else
        <div class="col-md-2 d-print-none" style="padding: 0">
            @include('inc.side-nav')
        </div>
        @endguest
        <div class="main container-fluid col-md-10" style="padding: 0">
            
            @include('inc.messages')
            <div id="my-alert" class="alert-top"></div>
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>

    
    <script src="{{asset('js/Chart.js') }}"></script>
    <script src="{{asset('js/popper.js') }}"></script>
    <script src="{{asset('js/app.js') }}"></script>
    <script src="{{asset('js/jquery.printPage.js') }}"></script>
    <script src="{{asset('js/ajax.js') }}"></script>
    <script src="{{asset('js/compute.js') }}"></script>
    <script>
        $('.alert').fadeOut(5200);

        $('[data-toggle="tooltip"]').tooltip();

        $('.btnprn').on('click', function(){
            window.print();
        });
    </script>
    
</body>
</html>
