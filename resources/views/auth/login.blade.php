@extends('layouts.app')

@section('content')
<div class="min-h-screen min-w-full flex justify-center content-center items-center">
  <div class="min-w-[48rem]">
    <div class="bg-gradient-to-tr border from-zinc-100 to-slate-50 rounded-lg p-10 shadow-2xl dark:from-gray-900 dark:to-gray-800 dark:border-gray-700">
      <div class="flex justify-center items-center flex-col gap-4 my-4 pb-3">
        <img class="object-cover" src="{{asset('novalogo.png')}}" alt="">
        <div class="my-3">
          <span class="text-lg text-slate-600 dark:text-cyan-600 font-bold uppercase">{{ __('Autenticação no ambiente Sicoob Aracoop') }}</span>
        </div>
      </div>
      @if(\Session::has('errors'))
      <div class="p-4 w-100 text-red-200 font-bold bg-red-900 rounded-lg text-center">
        Verifique os dados informados e tente novamente!
      </div>
      @endif
      <div>
        <form class="w-100 d-flex align-items-center flex-column" method="POST" action="{{ route('login') }}">
          @csrf
          <div class="w-50 my-2">
            <label for="email" class="block mb-2 text-sm font-bold text-gray-900 dark:text-cyan-600">Seu email</label>
            <input type="text" name="email" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-cyan-500 dark:focus:border-cyan-500" placeholder="Email" required>
            @error('email')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
            @enderror
          </div>

          <div class="w-50 my-2">
            <label for="password" class="block mb-2 text-sm font-bold text-gray-900 dark:text-cyan-600">Sua senha</label>
            <input type="password" name="password" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg @error('password') is-invalid @enderror focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-cyan-500 dark:focus:border-cyan-500" placeholder="Senha">
            @error('password')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
            @enderror
          </div>

          <div class="w-50 mt-4">
            <button type="submit" class="min-w-full relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
              <span class="min-w-full relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                {{ __('Login') }}
              </span>
            </button>
          </div>
        </form>
        {{-- <hr class="border w-100 my-4">
        <div class="col-12 d-flex flex-row justify-content-center">
          <div class="row col-8 mb-0">
            <a type="button" class="btn btn-block btn-primary" href="{{route('login.microsoft')}}">
        {{ __('Login com Microsoft') }}
        </a>
      </div>
    </div> --}}
  </div>
</div>
</div>
</div>
@endsection
