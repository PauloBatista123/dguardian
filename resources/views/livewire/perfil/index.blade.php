<div>
  <div class="w-full mt-6">
    <div class="max-w-screen-2xl flex flex-wrap items-center justify-between mx-auto">
      <div class="w-full border-b-slate-400 shadow-md rounded-md p-6 bg-slate-50 flex justify-between">
        <span class=" flex flex-row items-center gap-4 text-2xl font-bold uppercase text-verdeescuro">
          <img class="w-20 h-10 rounded bg-contain border p-1" src="{{\Storage::url($this->cliente->logo)}}" alt="{{$this->cliente->name}}">
          <span>{{$this->cliente->name}}</span>
        </span>
        <div class="inline-flex rounded-md shadow-sm" role="group">
          <button data-modal-target="defaultModal" data-modal-toggle="defaultModal" type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
            <svg class="w-3 h-3 mr-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m2.133 2.6 5.856 6.9L8 14l4 3 .011-7.5 5.856-6.9a1 1 0 0 0-.804-1.6H2.937a1 1 0 0 0-.804 1.6Z" />
            </svg>
            Adicionar
          </button>
        </div>
      </div>
      <div class="w-full h-auto border shadow-md rounded-lg mt-6 bg-slate-50">
        @forelse ($perfis as $item)
        <div class="flex flex-row border-b p-4 justify-between">
          <div class="flex flex-col">
            <span class="text-2xl text-verdeescuro text-uppercase">{{$item->nome}}</span>
            <span class="text-lg text-verdemedio">{{$item->descricao}}</span>
            <div>
              <span class="text-md font-bold">{{\Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i:s')}}</span>
            </div>
          </div>
          <div class="flex flex-col align-content-end">
            <div class="py-1 text-end">
              @can(Auth::user()->perfilDguardian(), 'clientes.perfil.permissoes')
              <a data-tooltip-target="tooltip-permissoes" href="{{route('clientes.perfis.permissoes', $item->id)}}" type="button" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2">
                <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6.072 10.072 2 2 6-4m3.586 4.314.9-.9a2 2 0 0 0 0-2.828l-.9-.9a2 2 0 0 1-.586-1.414V5.072a2 2 0 0 0-2-2H13.8a2 2 0 0 1-1.414-.586l-.9-.9a2 2 0 0 0-2.828 0l-.9.9a2 2 0 0 1-1.414.586H5.072a2 2 0 0 0-2 2v1.272a2 2 0 0 1-.586 1.414l-.9.9a2 2 0 0 0 0 2.828l.9.9a2 2 0 0 1 .586 1.414v1.272a2 2 0 0 0 2 2h1.272a2 2 0 0 1 1.414.586l.9.9a2 2 0 0 0 2.828 0l.9-.9a2 2 0 0 1 1.414-.586h1.272a2 2 0 0 0 2-2V13.8a2 2 0 0 1 .586-1.414Z" />
                </svg>
                <span class="sr-only">Acessos</span>
              </a>
              @endcan
              @can(Auth::user()->perfilDguardian(), 'clientes.perfil.deletar')
              <button data-tooltip-target="tooltip-excluir" wire:click="deletar('{{$item->id}}')" type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2">
                <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m13 7-6 6m0-6 6 6m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <span class="sr-only">Excluir</span>
              </button>
              @endcan
            </div>
          </div>
        </div>
        @empty

        @endforelse
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
              Adicionar novo perfil
            </h3>
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
          @livewire('perfil.adicionar', ['cliente' => $this->cliente ], key('perfil.adicionar'))
        </div>
        <!-- Modal footer -->
      </div>
    </div>
  </div>

  {{-- tooltips --}}
  <div id="tooltip-excluir" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
    Excluir Perfil
    <div class="tooltip-arrow" data-popper-arrow></div>
  </div>
  <div id="tooltip-permissoes" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
    Permissões do Perfil
    <div class="tooltip-arrow" data-popper-arrow></div>
  </div>
</div>
