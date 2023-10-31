@php
    $explode = explode(" ", Auth::user()->name)
@endphp
@extends('layouts.admin')

@section('content')
<div class="w-full mt-6">
  <div class="max-w-screen-2xl mx-auto">
    <div class="flex flex-col w-full bg-gray-50 p-2 mb-2 rounded-lg gap-2 shadow-sm">
        <h2 class="text-2xl">Olá {{$explode[0]}}, bem vindo!</h2>
        <span>Listamos abaixo as aplicações disponíveis</span>
    </div>
    <div class="grid grid-cols-4 gap-2">
      @foreach ($clientes as $item)
        <a href="{{$item->homepage}}" class="w-full max-w-md bg-white rounded-l-2xl rounded-b-md shadow-xl hover:translate-y-1 transition-all">
            <div class="max-w-md bg-white border-l-8 border-l-verdeescuro rounded-l-lg rounded-b-md hover:border-l-turquesa">
                <div class="max-w-md bg-white rounded-l-lg rounded-b-md">
                    <div>
                    <div class="w-full bg-slate-50 p-3 border-t text-center text-verdeescuro uppercase rounded-b-lg shadow-md flex flex-col">
                        <span class="font-bold text-4xl">{{$item->name}}</span>
                        <span class="mt-3">{{$item->description}}</span>
                    </div>
                    </div>
                </div>
            </div>
        </a>
      @endforeach
    </div>
  </div>
</div>
@endsection
