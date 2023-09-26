<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" type="image/x-icon" href="/faviconDguardian.png">

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  @livewireStyles

  <title>{{ $title ?? 'DGuardian' }}</title>
</head>

<body>
  <div class="min-h-screen bg-gradient-to-t from-slate-100 from-20% via-slate-100 via-40% to-slate-200 to-80% pb-4" id="app">
    @include('admin.components.navbar')
    @yield('content')
  </div>

  @livewireScripts

  <x-livewire-alert::scripts />

</body>
</html>
