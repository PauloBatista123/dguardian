<div>
  @php
  $explodeName = explode(" ", $this->name);
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
              <div class="text-base font-semibold">{{$this->name}}</div>
              <div class="font-normal text-gray-500">{{$this->email}}</div>
            </div>
          </div>
        </span>
      </div>
      <div class="flex flex-row gap-2 w-full">
        <div class="w-full">
          <div class="w-full h-auto border shadow-md rounded-lg mt-6 bg-slate-50 p-8">
            <form>
              <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div class="relative z-0">
                  <input wire:model='name' type="text" id="floating_standard" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-verdeescuro peer" placeholder=" " />
                  <label for="floating_standard" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-verdeescuro peer-focus:dark:text-verdeescuro peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nome</label>
                </div>
                <div class="relative z-0">
                  <input wire:model='email' type="text" id="floating_standard" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-verdeescuro peer" placeholder=" " />
                  <label for="floating_standard" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-verdeescuro peer-focus:dark:text-verdeescuro peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Usuário</label>
                </div>
              </div>
              <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div class="relative z-0">
                  <input wire:model='physicaldeliveryofficename' type="text" id="floating_standard" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-verdeescuro peer" placeholder=" " />
                  <label for="floating_standard" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-verdeescuro peer-focus:dark:text-verdeescuro peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">CPF</label>
                </div>
                <div class="relative z-0">
                  <input wire:model='email_address' type="text" id="floating_standard" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-verdeescuro peer" placeholder=" " />
                  <label for="floating_standard" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-verdeescuro peer-focus:dark:text-verdeescuro peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email</label>
                </div>
              </div>
            </form>
          </div>
          <div class="w-full flex-1 h-auto border shadow-md rounded-lg mt-2 bg-slate-50 p-8">
            <p>Membro de:</p>
            @forelse ($memberOf as $item)
            <span>{{$item}}</span>
            @empty
            @endforelse
          </div>
        </div>
        <div class="w-full h-auto border shadow-md rounded-lg mt-6 bg-slate-50 p-8">
          @livewire('usuario.perfil', ['usuario' => $this->usuario], key($this->usuario->id))
        </div>
      </div>
    </div>
  </div>
</div>
