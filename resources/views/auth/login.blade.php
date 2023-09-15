@extends('layouts.app')
@section('content')
<div class="min-h-screen min-w-full flex justify-center content-center items-center bg-no-repeat" style="background-image: url(/fundo.jpg);">
  <div class="w-full h-screen flex">
    {{-- form login --}}
    <div class="min-w-[38em] h-screen flex justify-center bg-gradient-to-tr border from-zinc-100 to-slate-50 rounded-tr-[8px] rounded-br-[8px] p-10 shadow-2xl dark:from-gray-900 dark:to-gray-800 dark:border-gray-700">
      <div>
        <div class="flex justify-center items-center flex-col mb-16">
          <img width="320" class="object-cover" src="/logoDguardian.png" alt="">
        </div>
        @if($message = \Session::get('error'))
        <div class="p-4 w-100 text-red-200 font-bold bg-red-900 rounded-lg text-center flex flex-col">
          Ops! Problema no login...
          <span class="text-sm">{{$message['message']}}</span>
        </div>
        @endif
        <div>
          <form class="w-100 d-flex align-items-center flex-column" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="w-50 my-8">
              <label for="email" class="block mb-2 text-sm font-bold text-gray-900 dark:text-turquesa">Seu usuário</label>
              <input type="text" name="email" class=" bg-gray-50 border border-gray-300 text-gray-900 text-xl rounded-lg  focus:ring-blue-500 focus:border-blue-500 block w-full p-5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-cyan-500 dark:focus:border-cyan-500" placeholder="Usuário" required>
            </div>

            <div class="w-50 my-8">
              <label for="password" class="block mb-2 text-sm font-bold text-gray-900 dark:text-turquesa">Sua senha</label>
              <input type="password" name="password" class=" bg-gray-50 border border-gray-300 text-gray-900 text-xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-cyan-500 dark:focus:border-cyan-500" placeholder="Senha">
            </div>

            <div class="w-50 mt-4">
              <button type="submit" class="min-w-full relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-lg font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-roxo to-blue-500 group-hover:from-roxo group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                <span class="min-w-full relative px-5 py-4 transition-all ease-in duration-75 bg-white rounded-md group-hover:bg-opacity-0">
                  {{ __('Entrar') }}
                </span>
              </button>
            </div>
          </form>
          <hr class="border w-100 my-4">
          <div class="w-50 mt-4">
            <p class="mb-4 text-gray-600">Você também pode acessar através das opções abaixo</p>
            <a type="button" href="{{route('login.microsoft')}}" class="text-center min-w-full relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-roxo to-blue-500 group-hover:from-roxo group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
              <span class="min-w-full relative px-5 py-2.5 transition-all ease-in duration-75 text-white bg-verdeescuro dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                {{ __('Login com Microsoft Office 365') }}
              </span>
            </a>
          </div>
        </div>
      </div>
    </div>
    {{-- slide rigth --}}
    <div class="flex-1">

    </div>
  </div>
</div>
@endsection
