<!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ getSetting('site_meta_description') }}">
    <meta name="keywords" content="{{ getSetting('site_meta_keywords') }}">
   <title>{{ getSetting('site_name') }} - @yield('page_title', '')</title>

    <!-- For favicon png -->
    <link rel="shortcut icon" type="image/icon" href="{{ getSetting('site_favicon') }}"/>
    <link rel="icon" href="{{ getSetting('site_favicon') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <!--font-awesome.min.css-->
    <link rel="stylesheet" href="{{ asset('assets/front/css/font-awesome.min.css') }}">

    <!--linear icon css-->
    <link rel="stylesheet" href="{{ asset('assets/front/css/linearicons.css') }}">

    <!--animate.css-->
    <link rel="stylesheet" href="{{ asset('assets/front/css/animate.css') }}">

    <!--flaticon.css-->
    <link rel="stylesheet" href="{{ asset('assets/front/css/flaticon.css') }}">

    <!--slick.css-->
    <link rel="stylesheet" href="{{ asset('assets/front/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/slick-theme.css') }}">
    
    <!--bootstrap.min.css-->
    
    @if(LaravelLocalization::getCurrentLocale() == 'ar')
    <link rel="stylesheet" href="{{ asset('assets/front/css/bootstrap.rtl.min.css') }}">
    <!--style.css-->
    <link rel="stylesheet" href="{{ asset('assets/front/css/style-rtl.css') }}">
    @else
    <link rel="stylesheet" href="{{ asset('assets/front/css/bootstrap.min.css') }}">
    <!--style.css-->
    <link rel="stylesheet" href="{{ asset('assets/front/css/style.css') }}">
    @endif
    
    <!--responsive.css-->
    <link rel="stylesheet" href="{{ asset('assets/front/css/responsive.css') }}">
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    @yield('styles')
    @livewireStyles
<body>

{{--<div id="preloader">--}}
    {{--<div class="loader"></div>--}}
{{--</div>--}}
    <div class="Notificate">
        @if(getSetting('site_status') == 'closed')
        <div class="siteClosed">
            <div class="container">
                <h3>{{ __('front/common.notification') }}</h3><p>{{ __('front/common.notification_closed') }}</p>
            </div>
        </div>
        @endif
        @if(auth()->guard('admin')->user())
            <div class="adminBar">
                <div class="container">
                    <nav class="admin-nav-bar">
                        <p>{{ __('front/common.notification_logas').' '.auth()->guard('admin')->user()->name.' ' }}</p>
                        <a href="{{ route('admin.dashboard') }}">{{ __('front/common.dashboard') }}</a>
                    </nav>
                </div>
            </div>
        @endif
    </div>
    @include('front.partials.header')

    @include('front.partials.flash')
    {{ $slot }}

    @include('front.partials.footer')

    <!-- Include all js compiled plugins (below), or include individual files as needed -->

    <script src="{{ asset('assets/front/js/jquery.js') }}"></script>
    
    <!--modernizr.min.js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    
    <!--bootstrap.min.js-->
    <script src="{{ asset('assets/front/js/bootstrap.min.js') }}"></script>
    

    <!--feather.min.js-->
    <script  src="{{ asset('assets/front/js/feather.min.js') }}"></script>

    <!-- counter js -->
    <script src="{{ asset('assets/front/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/waypoints.min.js') }}"></script>

    <!--slick.min.js-->
    <script src="{{ asset('assets/front/js/slick.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
            
    <!--Custom JS-->
    <script src="{{ asset('assets/front/js/custom.js') }}"></script>
    
    @if(LaravelLocalization::getCurrentLocale() == 'ar')
    @else
    @endif

    <script type="text/javascript">
        $(document).ready(function() {

            /******************/
            setTimeout(function(){
                $('.alert').remove();
            },5000);
            $('.alert .close-btn').click(function () {
                $('.alert').remove();
            });
            /******************/
            
        });
    </script>
    @yield('scripts')
    @livewireScripts
    {!! getSetting('tawk_code') !!}

    </body>
</html>
