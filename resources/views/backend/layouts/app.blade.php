<!doctype html>
@langrtl
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
@else
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endlangrtl

<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', app_name())</title>
    <meta name="description" content="@yield('meta_description', 'Herald\'s SIM SYSTEM')">
    <meta name="author" content="@yield('meta_author', 'Petrica')">
    @yield('meta')
    <meta name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Example of a Dashboard page built with Architect.">

    <meta name="msapplication-tap-highlight" content="no">

    @stack('before-styles')
    <link href="{{ asset('theme/css/custom.css') }}" rel="stylesheet">
    @stack('after-styles')
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

</head>

<body>
<div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
    @include('backend.includes.header')

    <div class="app-main">
        @include('backend.includes.sidebar')
        <div class="app-main__outer">
            <div class="app-main__inner">
                <div class="app-inner-layout">
                    <div class="app-inner-layout__header-boxed p-0">
                        @include('includes.partials.messages')
                        @yield('content')
                    </div>
                </div>
            </div>
            <div class="app-wrapper-footer">
                <div class="app-footer">
                    <div class="app-footer__inner">

                    </div>
                </div>
            </div></div>
    </div>
</div>

@stack('before-scripts')
<script type="text/javascript" src="{{ asset('theme/scripts/main.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
@stack('after-scripts')

</body>
</html>
