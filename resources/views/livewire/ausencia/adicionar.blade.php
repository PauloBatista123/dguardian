<div>
  <form>
    <div class="mb-6">
      <label for="usuario" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Funcionário</label>
      <select wire:model.lazy='usuario' id="large" class="block w-full px-4 py-3 text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <option value="" selected>Selecione</option>
        @foreach ($funcionarios as $item)
        <option value="{{$item->id}}">{{$item->name}}</option>
        @endforeach
      </select>
      <div>@error('usuario') <p class="text-red-600 font-bold text-sm mt-1">{{ $message }}</p> @enderror</div>
    </div>
    <div class="mb-6">
      <label for="large-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data de Início</label>
      <input wire:model='inicio' type="date" class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
      <div>@error('inicio') <p class="text-red-600 font-bold text-sm mt-1">{{ $message }}</p> @enderror</div>
    </div>
    <div class="mb-6">
      <label for="large-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data de Término</label>
      <input wire:model='fim' type="date" class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
      <div>@error('fim') <p class="text-red-600 font-bold text-sm mt-1">{{ $message }}</p> @enderror</div>
    </div>
    <div class="mb-6">
      <label for="large-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descrição</label>
      <input wire:model.lazy='descricao' type="text" class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
      <div>@error('descricao') <p class="text-red-600 font-bold text-sm mt-1">{{ $message }}</p> @enderror</div>
    </div>
    <div class="mb-6">
      <label for="large" class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Tipo de Ausência</label>
      <select wire:model.lazy='tipo' id="large" class="block w-full px-4 py-3 text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <option value="" selected>Selecione</option>
        <option value="ferias">Férias</option>
        <option value="atestado">Atestado Médico</option>
        <option value="gala">Licença gala</option>
        <option value="maternidade">Licença Maternidade</option>
        <option value="paternidade">Licença Paternidade</option>
        <option value="treinamento">Treinamento</option>
        <option value="outros">Outros</option>
      </select>
      <div>@error('tipo') <p class="text-red-600 font-bold text-sm mt-1">{{ $message }}</p> @enderror</div>

    </div>
    <a wire:click='salvar' type="button" class="cursor-pointer text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Salvar</a>
  </form>
</div>
