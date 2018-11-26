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
        @include('welcome.menu')
        @yield('content')
        <footer class="my-5 text-center">
            <p class="mb-2"><small>COPYRIGHT © 2017. ALL RIGHTS RESERVED. MOBAPP TEMPLATE BY <a href="https://colorlib.com">COLORLIB</a></small></p>
            <small>
                <a href="#" class="m-2">PRESS</a>
                <a href="#" class="m-2">TERMS</a>
                <a href="#" class="m-2">PRIVACY</a>
            </small>
        </footer>
        <script src="{{asset(mix('js/welcome.js'))}}"></script>
        @yield('script')
    </body>
</html>
