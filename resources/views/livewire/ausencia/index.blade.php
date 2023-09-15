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
        <div class="inline-flex rounded-md shadow-sm" role="group">
          <a href="{{route('ausencias.importacoes.listar')}}" data-modal-target="defaultModal" data-modal-toggle="defaultModal" type="a" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
            <svg class="w-3 h-3 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z" />
              <path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
            </svg>
            Importações
          </a>
          <button data-modal-target="defaultModal" data-modal-toggle="defaultModal" type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
            <svg class="w-3 h-3 mr-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m2.133 2.6 5.856 6.9L8 14l4 3 .011-7.5 5.856-6.9a1 1 0 0 0-.804-1.6H2.937a1 1 0 0 0-.804 1.6Z" />
            </svg>
            Filtrar
          </button>
        </div>
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
              <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">{{$item->status}}</span>
            </div>
          </div>
          <div class="px-6 py-4 w-full">
            <span>{{$item->descricao}}</span>
          </div>
          <div class="px-6 py-4 w-full">
            <div>
              <span class="text-md text-green-600">{{\Carbon\Carbon::parse($item->inicio)->format('d/m/Y')}} até </span>
              <span class="text-md text-green-700 font-bold">{{\Carbon\Carbon::parse($item->fim)->format('d/m/Y')}}</span>
            </div>
            <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-blue-300">{{$item->tipo}}</span>

          </div>
          <div class="flex px-6 py-4 gap-2 w-full justify-center">
            <div class="inline-flex rounded-md shadow-sm" role="group">
              <button data-tooltip-target="tooltip-deletar" wire:click='confirmDeletar({{$item->id}})' type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium text-red-800 bg-transparent border border-red-900 rounded-l-lg hover:bg-red-800 hover:text-white focus:z-10 focus:ring-2 focus:ring-red-500 focus:bg-red-800 focus:text-white ">
                <svg class="w-3.5 h-3.5 mr-2 text-white-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z" />
                </svg>
              </button>
              <a data-tooltip-target="tooltip-editar" href="{{route('ausencias.editar', $item->id)}}" type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium text-blue-800 bg-transparent border border-blue-800 rounded-r-md hover:bg-blue-800 hover:text-white focus:z-10 focus:ring-2 focus:ring-blue-800 focus:bg-blue-800 focus:text-white">
                <svg class="w-3.5 h-3.5 text-white-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7.418 17.861 1 20l2.139-6.418m4.279 4.279 10.7-10.7a3.027 3.027 0 0 0-2.14-5.165c-.802 0-1.571.319-2.139.886l-10.7 10.7m4.279 4.279-4.279-4.279m2.139 2.14 7.844-7.844m-1.426-2.853 4.279 4.279" />
                </svg>
              </a>
            </div>
          </div>
        </div>

        @endforeach
      </div>
      <div class="w-full h-auto rounded-lg mt-6">
        {{$ausencias->links()}}
      </div>
    </div>
  </div>

  <!-- Main modal -->
  <div wire:ignore id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
      <!-- Modal content -->
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <!-- Modal header -->
        <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
          <div>
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
              Filtro de Ausências
            </h3>
            <span>Para realizar os filtros, digite a informação no campo e pressione "TAB"</span>
          </div>
          <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <!-- Modal body -->
        <div class="p-6 space-y-6">
          <div class="mb-6">
            <label for="large-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome Usuário</label>
            <input wire:model.lazy='nome' type="text" id="large-input" class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
          </div>
          <div class="mb-6">
            <label for="large-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data de Início</label>
            <input wire:model.lazy='inicio' type="text" id="large-input" class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
          </div>
          <div class="mb-6">
            <label for="large-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data de Término</label>
            <input wire:model.lazy='fim' type="text" id="large-input" class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
          </div>
          <div class="mb-6">
            <label for="large" class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Status</label>
            <select wire:model.lazy='status' id="large" class="block w-full px-4 py-3 text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
              <option value="" selected>Todas</option>
              <option value="agendado">Agendado</option>
              <option value="processado">Processado</option>
              <option value="desbloqueado">Desbloqueado</option>
              <option value="erro">Erro</option>
            </select>
          </div>
        </div>
        <!-- Modal footer -->
        <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
          <button data-modal-hide="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Fechar</button>
        </div>
      </div>
    </div>
  </div>

  {{-- tooltips --}}
  <div id="tooltip-editar" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
    Editar Ausência
    <div class="tooltip-arrow" data-popper-arrow></div>
  </div>
  <div id="tooltip-deletar" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
    Deletar Ausência
    <div class="tooltip-arrow" data-popper-arrow></div>
  </div>
</div>
