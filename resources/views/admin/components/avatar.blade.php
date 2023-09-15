@php
$explodeName = explode(" ", auth()->user()->name);
$firstName = $explodeName[0];
$lastName = $explodeName[1];
$iniciais = str_split($firstName)[0].str_split($lastName)[0];
@endphp
<div data-popover-target="popover-usuario" data-popover-placement="bottom" class="flex items-center space-x-4">
  @if(auth()->user()->foto)
  <img class="w-10 h-10 rounded-full" src="/docs/images/people/profile-picture-5.jpg" alt="">
  @else
  <div class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
    <span class="font-medium text-gray-600 dark:text-gray-300">{{$iniciais}}</span>
  </div>
  @endif
  <div class="font-medium text-white">
    <div>{{$firstName." ".$lastName}}</div>
    <div class="text-sm text-gray-400 dark:text-gray-400">{{auth()->user()->email}}</div>
  </div>
</div>
<div data-popover id="popover-usuario" role="tooltip" class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
  <div class="border-b border-b-gray-200 px-3 py-2">
    <span class="font-bold">Meus dados</span>
  </div>
  <div class="px-3 py-2 border-b border-b-gray-200">
    <span class="text-sm font-bold text-gray-600">{{auth()->user()->name}}</span>
    <span>{{auth()->user()->cpf}}</span>
    <span>{{auth()->user()->email_address}}</span>

  </div>
  <div class="px-3 py-2 flex flex-col border-b border-b-gray-200">
    <span>Último login {{\Carbon\Carbon::parse(auth()->user()->last_login)->diffForHumans()}}</span>
    <span>{{auth()->user()->ip_login}}</span>
  </div>
  <div class="px-3 py-2 flex flex-col">
    <div>
      <a href="{{route('usuarios.logout')}}" type="button" class="text-red-700 border border-red-700 hover:bg-red-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:focus:ring-red-800 dark:hover:bg-red-500">
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 16">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h11m0 0-4-4m4 4-4 4m-5 3H3a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h3" />
        </svg>
        <span class="sr-only">Sair</span>
      </a>
    </div>
  </div>
  <div data-popper-arrow></div>
</div>
