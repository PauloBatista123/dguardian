<div>
  <div class="w-full mt-6">
    <div class="max-w-screen-2xl flex flex-wrap items-center justify-between mx-auto">
      <div class="w-full border-b-slate-400 shadow-md rounded-md p-6 bg-slate-50">
        <span class=" flex flex-row gap-4 text-2xl font-bold uppercase text-verdeescuro">
          <svg class="w-8 h-8 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 19">
            <path d="M7.324 9.917A2.479 2.479 0 0 1 7.99 7.7l.71-.71a2.484 2.484 0 0 1 2.222-.688 4.538 4.538 0 1 0-3.6 3.615h.002ZM7.99 18.3a2.5 2.5 0 0 1-.6-2.564A2.5 2.5 0 0 1 6 13.5v-1c.005-.544.19-1.072.526-1.5H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h7.687l-.697-.7ZM19.5 12h-1.12a4.441 4.441 0 0 0-.579-1.387l.8-.795a.5.5 0 0 0 0-.707l-.707-.707a.5.5 0 0 0-.707 0l-.795.8A4.443 4.443 0 0 0 15 8.62V7.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.12c-.492.113-.96.309-1.387.579l-.795-.795a.5.5 0 0 0-.707 0l-.707.707a.5.5 0 0 0 0 .707l.8.8c-.272.424-.47.891-.584 1.382H8.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1.12c.113.492.309.96.579 1.387l-.795.795a.5.5 0 0 0 0 .707l.707.707a.5.5 0 0 0 .707 0l.8-.8c.424.272.892.47 1.382.584v1.12a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1.12c.492-.113.96-.309 1.387-.579l.795.8a.5.5 0 0 0 .707 0l.707-.707a.5.5 0 0 0 0-.707l-.8-.795c.273-.427.47-.898.584-1.392h1.12a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5ZM14 15.5a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5Z" />
          </svg>
          Clientes
        </span>
      </div>
      <div class="w-full h-auto border shadow-md rounded-lg mt-6 bg-slate-50">
        @foreach ($clientes as $item)
        <div class="flex flex-row border-b p-4 justify-between">
          <div class="flex flex-col">
            <span class="text-2xl text-verdeescuro text-uppercase">{{$item->name}}</span>
            <span class="text-lg text-verdemedio">Callback: {{$item->redirect}}</span>
            <div>
              <span class="text-md font-bold">{{\Carbon\Carbon::parse($item->last_login)->format('d/m/Y H:i:s')}}</span>
              @if($item->revoked)
              <span class="bg-red-900 text-red-300 text-sm font-medium mr-2 px-2.5 py-0.5 rounded text-center">Revogado</span>
              @else
              <span class="bg-blue-900 text-blue-300 text-sm font-medium mr-2 px-2.5 py-0.5 rounded text-center">Ativo</span>
              @endif
            </div>
          </div>
          <div class="flex flex-col align-content-end">
            @if(!$item->revoked)
            <div class="py-1 text-end">
              <button wire:click="revogar('{{$item->id}}')" type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2">
                <svg class="w-3 h-3 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m13 7-6 6m0-6 6 6m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <span class="sr-only">Revogar</span>
              </button>
            </div>
            @endif
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
