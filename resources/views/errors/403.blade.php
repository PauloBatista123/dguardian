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
    @include('admin.components.navbar')
    <div class="max-w-screen-2xl flex flex-row justify-between items-center mx-auto">
      <img class="h-auto max-w-3xl" src="/403.svg" alt="">
      <div class="flex flex-col items-center">
        <span class="text-4xl text-zinc-700">Você não pode acessar esse recurso:</span>
        <span class="text-3xl text-zinc-500 mt-4">
          {{\App\Models\Role::where('nome', $exception->getMessage())->first()->descricao}}
        </span>
      </div>
    </div>
  </div>
</body>
</html>
