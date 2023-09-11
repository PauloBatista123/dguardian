<div>
  <div class="w-full mt-6">
    <div class="max-w-screen-2xl flex flex-wrap items-center justify-between mx-auto">
      <div class="w-full border-b-slate-400 shadow-md rounded-md p-6 bg-slate-50 flex justify-between">
        <span class=" flex flex-row gap-4 text-2xl font-bold uppercase text-verdeescuro">
          <svg class="w-8 h-8 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 8H2a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h7m2.5-11V4.5a3.5 3.5 0 1 0-7 0V8m10 5.217V14.5l.9.9m3.6-.9a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Z" />
          </svg>

          Ausências temporárias
        </span>

        <a href="{{route('ausencias.importacoes.listar')}}" type="button" class="cursor-pointer px-3 py-2 gap-1 text-xs font-medium text-center inline-flex items-center text-white bg-gray-800 rounded-lg hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 ">
          Importações
          <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5v11a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1H1Zm0 0V2a1 1 0 0 1 1-1h5.443a1 1 0 0 1 .8.4l2.7 3.6H1Zm10 4 2 2-2 2m1.5-2H4.781" />
          </svg>
        </a>
      </div>
      <div class="w-full h-auto border shadow-md rounded-lg mt-6 bg-slate-50">
        @foreach ($ausencias as $item)
        @php
        $explodeName = explode(" ", $item->usuario->name);
        $firstName = $explodeName[0];
        $lastName = $explodeName[1];
        $iniciais = str_split($firstName)[0].str_split($lastName)[0];
        @endphp
        <div class="flex border-b hover:bg-gray-200 w-full items-center">
          <div class="flex px-6 py-4 text-gray-900 whitespace-nowrap w-full">
            @if(auth()->user()->foto)
            <img class="w-10 h-10 rounded-full" src="/docs/images/people/profile-picture-5.jpg" alt="">
            @else
            <div class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-800 rounded-full">
              <span class="font-medium text-white">{{$iniciais}}</span>
            </div>
            @endif
            <div class="pl-3">
              <div class="text-base font-semibold">{{$item->usuario->name}}</div>
              <div class="font-normal text-gray-500">{{$item->usuario->email}}</div>
            </div>
          </div>
          <div class="px-6 py-4 w-full">
            <span>{{$item->descricao}}</span>
          </div>
          <div class="px-6 py-4 w-full">
            <span class="text-md text-red-600">{{\Carbon\Carbon::parse($item->inicio)->format('d/m/Y H:i:s')}} até </span>
            <span class="text-md text-red-700 font-bold">{{\Carbon\Carbon::parse($item->fim)->format('d/m/Y H:i:s')}}</span>
          </div>
          <div class="flex px-6 py-4 gap-2 w-full justify-center">
            <a href="{{route('usuarios.tokens', $item->id)}}" type="button" class="px-3 py-2 gap-1 text-xs font-medium text-center inline-flex items-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
              <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z" />
              </svg>
            </a>
          </div>
        </div>

        @endforeach
      </div>
    </div>
  </div>
</div>
