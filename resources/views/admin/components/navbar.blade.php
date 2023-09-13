<nav class="bg-verdeescuro w-full border-b border-verdeescuro shadow-sm shadow-verdeescuro">
  <div class="max-w-screen-2xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a class="flex items-center">
      <img src="/logoVazada.png" class="h-8 mr-3" alt="Aracoop Logo">
    </a>
    <div class="flex md:order-2">
      @include('admin.components.avatar')
      <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm rounded-lg md:hidden focus:outline-none focus:ring-2 text-gray-400 hover:bg-gray-700 focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
        </svg>
      </button>
    </div>
    <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
      <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border rounded-lg md:flex-row md:space-x-8 md:mt-0 md:border-0 bg-verdeescuro md:bg-verdeescuro border-verdeescuro">
        <li>
          <a href="{{route('home')}}" class="@if(\URL::current() == \URL::route('home')) md:text-verdeclaro @else md:text-white @endif block py-2 pl-3 pr-4 rounded md:p-0 md:hover:text-verdeclaro hover:bg-gray-700 hover:text-white md:hover:bg-transparent border-gray-700">Home</a>
        </li>
        <li>
          <a href="{{route('usuarios.listar')}}" class="@if(\URL::current() == \URL::route('usuarios.listar')) md:text-verdeclaro @else md:text-white @endif block py-2 pl-3 pr-4 rounded md:p-0 md:hover:text-verdeclaro hover:bg-gray-700 hover:text-white md:hover:bg-transparent border-gray-700">Usuários</a>
        </li>
        <li>
          <a href="{{route('clientes.listar')}}" class="@if(\URL::current() == \URL::route('clientes.listar')) md:text-verdeclaro @else md:text-white @endif block py-2 pl-3 pr-4 rounded md:p-0 md:hover:text-verdeclaro text-white hover:bg-gray-700 hover:text-white md:hover:bg-transparent border-gray-700">Clientes</a>
        </li>
        <li>
          <a href="{{route('ausencias.listar')}}" class="@if(\URL::current() == \URL::route('ausencias.listar')) md:text-verdeclaro @else md:text-white @endif block py-2 pl-3 pr-4 rounded md:p-0 md:hover:text-verdeclaro text-white hover:bg-gray-700 hover:text-white md:hover:bg-transparent border-gray-700">Ausências</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
