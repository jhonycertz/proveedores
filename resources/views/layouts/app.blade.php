<!DOCTYPE html>
<html>
    <head>
        <title>Administracion de documentos </title>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="dns-prefetch" href="//fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet">
        <link rel="stylesheet" href="{{asset(mix('css/welcome.css'))}}">
    </head>
    <body data-spy="scroll" data-target="#navbar" data-offset="30">
        @include('layouts.menu')
        @yield('content')
        <footer class="my-5 text-center">
            <p class="mb-2"><small> 4boot </small></p>
        </footer>
        <script src="{{asset(mix('js/welcome.js'))}}"></script>
        @yield('script')
    </body>
</html>
