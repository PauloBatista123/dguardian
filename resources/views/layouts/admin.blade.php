<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>
<body>
  <div class="min-h-screen bg-gradient-to-t from-sky-900 from-20% via-sky-900 via-40% to-sky-800 to-80% dark:from-gray-700 dark:via-gray-700 dark:to-gray-700" id="app">
    @include('admin.components.navbar')
    @yield('content')
  </div>
</body>
</html>