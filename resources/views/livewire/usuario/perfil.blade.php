<div>
  @inject('usuarioService', 'App\Http\Services\UsuarioService')
  @forelse($clientes as $cliente)
  <div class="border-b first:mb-4">
    <div class="flex flex-col mb-2 items-start">
      <span class="font-bold text-lg mb-1">{{$cliente->name}}</span>
    </div>
    @forelse ($cliente->perfis as $item)
    <div class="flex items-center pl-4 border border-gray-200 rounded ">
      <input @if($usuarioService->existePerfil($this->usuario, $item->nome)) checked @endif wire:click='salvar({{$item->id}})' id="checkbox-{{$item->id}}" type="checkbox" value="{{$item->id}}" name="checkbox-{{$item->id}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
      <label for="checkbox-{{$item->id}}" class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$item->nome}}</label>
    </div>
    @empty
    <p>Não possui perfis</p>
    @endforelse
  </div>
  @empty

  @endforelse
</div>
