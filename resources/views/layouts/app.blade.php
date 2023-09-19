<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="/faviconDguardian.png">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ 'DGuardian' }}</title>

  {{-- <link rel="stylesheet" href="{{asset('app.css')}}">
  <script src="{{ asset('app2.js') }}"></script> --}}
  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
  <div class="min-h-screen" id="app">
    @yield('content')
  </div>
</body>
</html>
