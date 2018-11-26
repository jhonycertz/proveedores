<!doctype html>
<html lang="en">
  <head>
    <title>Luxo-@yield('title') </title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

   <link rel="stylesheet" href="{{asset(mix('css/admin.css'))}}">
   <link rel="stylesheet" href="{{asset(mix('css/animate.min.css'))}}">

  </head>

  <body>

    @yield('content')

    <!-- Plugins JS -->
    <script src="{{ asset(mix('js/admin.js')) }}" type="text/javascript"></script>
    @yield('scripts')
  </body>
</html>
