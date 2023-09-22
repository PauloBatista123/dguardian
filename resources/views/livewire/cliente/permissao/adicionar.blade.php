<div>
  <p>{{$this->cliente->name}}</p>
  <form>
    <div class="mb-6">
      <label for="nome" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome</label>
      <input wire:model='nome' type="text" id="nome" class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
      <div>@error('nome') <p class="text-red-600 font-bold text-sm mt-1">{{ $message }}</p> @enderror</div>
    </div>
    <div class="mb-6">
      <label for="descricao" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descrição</label>
      <input wire:model='descricao' type="text" id="descricao" class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
      <div>@error('descricao') <p class="text-red-600 font-bold text-sm mt-1">{{ $message }}</p> @enderror</div>
    </div>
    <a wire:click='salvar' type="button" class="cursor-pointer text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Salvar</a>
  </form>
</div>
