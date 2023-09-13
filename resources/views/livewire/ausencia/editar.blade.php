<div>
  @php
  $explodeName = explode(" ", $this->ausencia->usuario->name);
  $firstName = head($explodeName);
  $lastName = last($explodeName);
  $iniciais = str_split($firstName)[0].str_split($lastName)[0];
  @endphp
  <div class="w-full mt-6">
    <div class="max-w-screen-2xl flex flex-wrap items-center justify-between mx-auto">
      <div class="w-full border-b-slate-400 shadow-md rounded-md p-6 bg-slate-50 flex justify-between">
        <span class=" flex flex-row gap-4 text-2xl font-bold uppercase text-verdeescuro">
          <div class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap">
            <div class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-800 rounded-full">
              <span class="font-medium text-white">{{$iniciais}}</span>
            </div>
            <div class="pl-3">
              <div class="text-base font-semibold">{{$this->ausencia->usuario->name}}</div>
              <div class="font-normal text-gray-500">{{$this->ausencia->usuario->email}}</div>
            </div>
          </div>
        </span>
        <div class="flex flex-col items-end gap-1">
          <span class="bg-purple-100 text-purple-800 text-lg font-medium mr-2 px-2.5 py-0.5 rounded-md uppercase">Situação: {{$this->ausencia->status}}</span>
          <span class="text-sm text-gray-500">Criando em {{\Carbon\Carbon::parse($this->ausencia->created_at)->format('d/m/Y H:i:s')}}</span>
          <span class="text-sm text-gray-500">Alterado em {{\Carbon\Carbon::parse($this->ausencia->updated)->format('d/m/Y H:i:s')}}</span>
        </div>
      </div>
      <div class="w-full h-auto border shadow-md rounded-lg mt-6 bg-slate-50 p-8">
        <form>
          <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div class="relative z-0">
              <input wire:model='inicio' type="text" id="inicio" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-verdeescuro peer" placeholder=" " />
              <label for="inicio" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-verdeescuro peer-focus:dark:text-verdeescuro peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Início</label>
            </div>
            <div class="relative z-0">
              <input wire:model='fim' type="text" id="fim" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-verdeescuro peer" placeholder=" " />
              <label for="fim" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-verdeescuro peer-focus:dark:text-verdeescuro peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Fim</label>
            </div>
            <div class="relative z-0">
              <label for="tipo" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-verdeescuro peer-focus:dark:text-verdeescuro peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Status</label>
              <select wire:model.lazy='tipo' id="tipo" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-verdeescuro peer">
                <option value="ferias">FÉRIAS</option>
                <option value="maternidade">LINCENÇA MATERNIDADE</option>
                <option value="atestado">ATESTAD MÉDICO</option>
                <option value="gala">LICENÇA GALA</option>
                <option value="paternidade">LICENÇA PATERNIDADE</option>
                <option value="treinamento">TREINAMENTO</option>
                <option value="outros">OUTROS</option>
              </select>
            </div>
            <div class="relative z-0">
              <input wire:model='descricao' type="text" id="fim" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-verdeescuro peer" placeholder=" " />
              <label for="descricao" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-verdeescuro peer-focus:dark:text-verdeescuro peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Descrição</label>
            </div>
          </div>
          <div>
            <button wire:click='salvar' type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
              <svg class="w-3.5 h-3.5 mr-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 10 2 2 4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
              </svg>
              Salvar
            </button>
          </div>
        </form>
      </div>
      @if($this->ausencia->status != 'agendado')
      <div class="w-full h-auto border shadow-md rounded-lg mt-6 bg-slate-50 p-8 flex flex-col">

        <span>Log do sistema: {{$this->ausencia->log}}</span>
        <span>Finalizado em: {{\Carbon\Carbon::parse($this->ausencia->finished_at)->format('d/m/Y H:i:s')}}</span>
      </div>
      @endif
    </div>
  </div>
</div>
