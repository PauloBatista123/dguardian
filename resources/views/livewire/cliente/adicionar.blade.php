<div>
  <form>
    <div class="mb-6">
      <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome</label>
      <input wire:model='name' type="text" id="name" class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
      <div>@error('name') <p class="text-red-600 font-bold text-sm mt-1">{{ $message }}</p> @enderror</div>
    </div>
    <div class="mb-6">
      <label for="redirecUri" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">URL Redirecionamento</label>
      <input wire:model='redirectUri' type="text" id="redirecUri" class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
      <div>@error('redirectUri') <p class="text-red-600 font-bold text-sm mt-1">{{ $message }}</p> @enderror</div>
    </div>
    <div class="mb-6">
      <label for="redirecUri" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">URL Homepage</label>
      <input wire:model='homepage' type="text" id="redirecUri" class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
      <div>@error('homepage') <p class="text-red-600 font-bold text-sm mt-1">{{ $message }}</p> @enderror</div>
    </div>
    <div class="mb-6">
      <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="logo">Logo</label>
      <input wire:model='logo' class="block w-full text-lg text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="large_size" type="file">
      <div>@error('logo') <p class="text-red-600 font-bold text-sm mt-1">{{ $message }}</p> @enderror</div>
    </div>
    <div class="mb-6">
      <label for="redirecUri" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descrição</label>
      <input wire:model='description' type="text" id="redirecUri" class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
      <div>@error('description') <p class="text-red-600 font-bold text-sm mt-1">{{ $message }}</p> @enderror</div>
    </div>
    <a wire:click='salvar' type="button" class="cursor-pointer text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Salvar</a>
  </form>
</div>
