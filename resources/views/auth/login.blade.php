@extends('layouts.app')

@section('content')
<div class="min-h-screen min-w-full flex justify-center content-center items-center bg-cover bg-no-repeat" style="background-image: url(/fundo.jpg)">
  <div class="min-h-screen flex flex-row items-center justify-center w-full bg-slate-900/70">
    <div class="min-w-[48rem] p-8">
      <div class="bg-gradient-to-tr border from-zinc-100 to-slate-50 rounded-lg p-10 shadow-2xl dark:from-gray-900 dark:to-gray-800 dark:border-gray-700">
        <div class="flex justify-center items-center flex-col gap-4 my-4 pb-3">
          <img width="180" class="object-cover" src="/novalogo.png" alt="">
          <div class="my-3">
            <span class="text-lg text-slate-600 dark:text-turquesa font-bold uppercase">{{ __('Autenticação no ambiente Sicoob Aracoop') }}</span>
          </div>
        </div>
        @if($message = \Session::get('errors'))
        <div class="p-4 w-100 text-red-200 font-bold bg-red-900 rounded-lg text-center flex flex-col">
          Ops! Problema no login...
          <span class="text-sm">{{$message['message']}}</span>
        </div>
        @endif
        <div>
          <form class="w-100 d-flex align-items-center flex-column" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="w-50 my-2">
              <label for="email" class="block mb-2 text-sm font-bold text-gray-900 dark:text-turquesa">Seu email</label>
              <input type="text" name="email" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-cyan-500 dark:focus:border-cyan-500" placeholder="Email" required>
            </div>

            <div class="w-50 my-2">
              <label for="password" class="block mb-2 text-sm font-bold text-gray-900 dark:text-turquesa">Sua senha</label>
              <input type="password" name="password" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-cyan-500 dark:focus:border-cyan-500" placeholder="Senha">
            </div>

            <div class="w-50 mt-4">
              <button type="submit" class="min-w-full relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-roxo to-blue-500 group-hover:from-roxo group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                <span class="min-w-full relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                  {{ __('Entrar') }}
                </span>
              </button>
            </div>
          </form>
          <hr class="border w-100 my-4">
          <div class="w-50 mt-4">
            <button type="button" href="{{route('login.microsoft')}}" class="min-w-full relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-roxo to-blue-500 group-hover:from-roxo group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
              <span class="min-w-full relative px-5 py-2.5 transition-all ease-in duration-75 text-white bg-verdeescuro dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                {{ __('Login com Microsoft Office 365') }}
              </span>
            </button>
          </div>
          {{-- <div class="col-12 d-flex flex-row justify-content-center">

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
</div>
@endsection
