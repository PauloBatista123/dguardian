@extends('layouts.app')
@section('content')
{{-- <div class="min-h-screen min-w-full flex justify-center content-center items-center bg-no-repeat" style="background-image: url(/fundo.jpg);"> --}}
<div class="min-h-screen min-w-full flex justify-center content-center items-center bg-gradient-to-r from-[#0E3642] from-50% via-[#0E3642] to-[#0E3642]">
  <div class="w-full h-screen flex">
    {{-- form login --}}
    <div class="lg:min-w-[38em] min-w-full min-h-screen flex flex-col justify-between bg-gradient-to-tr border-r-2 border-r-white from-zinc-100 to-slate-50 rounded-tr-[8px] rounded-br-[8px]  shadow-lg shadow-white dark:from-gray-900 dark:to-gray-800 dark:border-gray-700">
      <div class="p-10">
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
            <a type="button" href="{{route('login.microsoft')}}" class="min-w-full text-verdeescuro bg-white hover:bg-slate-50 focus:ring-4 focus:outline-none focus:ring-slate-300 font-medium rounded-lg text-sm px-5 py-5 text-center inline-flex items-center mr-2 border-2 justify-center">
              <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="48px" height="48px">
                <path fill="#ff5722" d="M6 6H22V22H6z" transform="rotate(-180 14 14)" />
                <path fill="#4caf50" d="M26 6H42V22H26z" transform="rotate(-180 34 14)" />
                <path fill="#ffc107" d="M26 26H42V42H26z" transform="rotate(-180 34 34)" />
                <path fill="#03a9f4" d="M6 26H22V42H6z" transform="rotate(-180 14 34)" /></svg>
              {{ __('Login com Microsoft Office 365') }}
            </a>
          </div>
        </div>
      </div>
      <div class="h-10 flex justify-end items-end">
        <div class="flex flex-col w-full justify-center items-center border-t border-t-slate-200 py-4">
          <span class="font-bold text-lg text-slate-800">
            Unidade de Tecnologia e Inovação
          </span>
          <span class="text-slate-500">Centro de Inteligência Sicoob Aracoop</span>
        </div>
      </div>
    </div>
    {{-- slide rigth --}}
    <div class="flex flex-1 bg-cover bg-no-repeat p-6" style="background-image: url(/background-dark.svg)">
      <div class="flex flex-1 items-center justify-center bg-verdeescuro/80">
        <div class="grid grid-cols-1 xl:grid-cols-2 2xl:w-[48rem] w-full 2xl:gap-32 gap-16 items-start">
          <div class="flex flex-col justify-center gap-4">
            <span class="text-4xl text-verdeclaro font-bold uppercase border-b-2 border-b-verdeclaro pb-2">PROPÓSITO</span>
            <p class="text-white text-lg">Conectar pessoas e promover a justiça financeira e prosperidade</p>
          </div>
          <div class="flex flex-col justify-center gap-4">
            <span class="text-4xl text-turquesa font-bold uppercase border-b-2 border-b-turquesa pb-2">VISÃO</span>
            <p class="text-white text-lg">Ser referência em cooperativismo, promovendo o desenvolvimento econômico e social das pessoas e comunidades.</p>
          </div>
          <div class="flex flex-col justify-center gap-4">
            <span class="text-4xl text-roxo font-bold uppercase border-b-2 border-b-roxo pb-2">MISSÃO</span>
            <p class="text-white text-lg">Promover soluções e experiências inovadoras e sustentáveis por meio da cooperação.</p>
          </div>
          <div class="flex flex-col justify-center gap-4">
            <span class="text-4xl text-verdemedio font-bold uppercase border-b-2 border-b-verdemedio pb-2">VALORES</span>
            <p class="text-white text-lg">Respeito e Valorização das Pessoas, Cooperativismo e Sustentabilidade, Ética e Integridade, Excelência e Eficiência, Liderança Inspiradora, Inovação e Simplicidade </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
