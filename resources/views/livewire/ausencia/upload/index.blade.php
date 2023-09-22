<div>
  <div class="w-full mt-6">
    <div class="max-w-screen-2xl flex flex-wrap items-center justify-between mx-auto gap-3">
      <div class="w-full border-b-slate-400 shadow-md rounded-md p-6 bg-slate-50">
        <span class=" flex flex-row gap-4 text-2xl font-bold uppercase text-verdeescuro">
          <svg class="w-8 h-8 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 8H2a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h7m2.5-11V4.5a3.5 3.5 0 1 0-7 0V8m10 5.217V14.5l.9.9m3.6-.9a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Z" />
          </svg>
          Importações de Ausências Temporárias
        </span>
      </div>
      <div class="w-full border-b-slate-400 shadow-md rounded-md p-6 bg-slate-50 flex items-center">
        <div class="w-full">
          <label class="block mb-2 text-sm font-medium text-gray-900" for="file_input">Importar Arquivo</label>
          <input wire:model='arquivo' class="block w-full text-sm text-gray-100 border border-gray-300 rounded-lg cursor-pointer bg-gray-400 focus:outline-none " aria-describedby="file_input_help" id="file_input" type="file">
          <p class="mt-1 text-sm text-gray-500 " id="file_input_help">Arquivos XLSX (O arquivo não pode estar criptografado).</p>
          <div class="text-red-800 font-bold text-sm">@error('arquivo') {{ $message }} @enderror</div>
          <div class="text-gray-500 font-bold" wire:loading wire:target="arquivo">Carregando...</div>
        </div>
        @can(Auth::user()->perfilDguardian(), 'ausencias.importacoes.cadastrar')
        <div class="">
          <button wire:click='salvar' type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg class="w-3.5 h-3.5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 21">
              <path d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z" />
            </svg>
            Enviar
          </button>
        </div>
        @endcan
      </div>

      <div class="w-full h-auto border shadow-md rounded-lg mt-6 bg-slate-50">
        @forelse($importacoes as $item)
        <div class="flex border-b hover:bg-gray-200 w-full items-center justify-between">
          <div class="px-6 py-4 w-full flex flex-col">
            <span>{{$item->url}}</span>
            <span>{{$item->nome}}</span>
          </div>
          <div class="px-6 py-4 w-full text-end flex flex-col">
            <span class="text-md text-green-600">{{\Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i:s')}} </span>
            <div>
              @can(Auth::user()->perfilDguardian(), 'ausencias.importacoes.baixar')
              <a href="{{\Storage::url($item->url)}}" target="_blank" type="button" class="text-white bg-cyan-700 hover:bg-cyan-800 focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-cyan-600 dark:hover:bg-cyan-700 dark:focus:ring-cyan-800">
                <svg class="w-3 h-3 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z" />
                  <path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Dowloand</span>
              </a>
              @endcan
            </div>
          </div>
        </div>
        @empty

        @endforelse
      </div>
    </div>
  </div>
</div>
