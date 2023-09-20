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
  <div class="min-h-screen bg-gradient-to-r from-zinc-100 from-20% via-zinc-200 via-40% to-zinc-3000 to-80% pb-4" id="app">
    <div class="max-w-screen-2xl flex flex-col flex-wrap items-center mx-auto min-h-screen">
      <img class="h-auto max-w-5xl" src="/erroserver.svg" alt="">
      <span class="text-4xl text-zinc-700">Ops! Parece que algo inesperado aconteceu...</span>
      <span class="text-3xl text-zinc-600 mt-4">
        {{$exception->getMessage()}}
      </span>
    </div>
  </div>
</body>
</html>
