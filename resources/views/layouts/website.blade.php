<?php
use App\AdminSettings;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @if (auth()->check())
            <meta name="api-token" content="{{ auth()->user()->api_token }}">
        @endif        
        <link href="https://fonts.googleapis.com/css2?family=Red+Rose&family=Roboto&family=Lato" rel="stylesheet">
        <link href="/css/app.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ url('/css/core.css') }}" />
        <script src="https://use.fontawesome.com/09c7aba1ed.js"></script>
        <script src="{{ asset('js/global.js')}}"></script>
    </head>
    <body>
        <header id="nav_bar">
            @include('core.partials.header', ['settings'=>new AdminSettings])
            @include('core.partials.mobile-header', ['settings'=>new AdminSettings])
        </header>
        <div class="page-wrap" id="app">
            @yield('content')
        </div>
        <script type="text/javascript" charset="utf-8" src="{{ asset('js/app.js')}}"></script>
        <script type="text/javascript" charset="utf-8" src="/js/header.js"></script>    
        @stack('scripts')    
    </body>
</html>