@extends('layouts.admin')

@section('content')
<div class="w-full mt-6">
  <div class="max-w-screen-2xl mx-auto">
    <div class="grid grid-cols-4 gap-2">
      @foreach ($clientes as $item)
        <a href="{{$item->homepage}}" class="w-full max-w-md bg-white border-l-8 border-l-verdemedio rounded-l-2xl rounded-b-md shadow-xl">
            <div class="max-w-md bg-white border-l-4 border-l-verdeclaro rounded-l-lg rounded-b-md">
                <div class="max-w-md bg-white border-l-2 border-l-verdeescuro/70 rounded-l-lg rounded-b-md">
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
