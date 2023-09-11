@extends('layouts.admin')

@section('content')
<div class="w-full mt-2">
  <div class="max-w-screen-2xl flex flex-wrap items-center justify-between mx-auto">
    <div class="w-full border-b-slate-400 shadow-md rounded-md p-6 bg-slate-50">
      <span class=" flex flex-row gap-4 text-2xl font-bold uppercase text-verdeescuro">
        <svg class="w-8 h-8 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 19">
          <path d="M7.324 9.917A2.479 2.479 0 0 1 7.99 7.7l.71-.71a2.484 2.484 0 0 1 2.222-.688 4.538 4.538 0 1 0-3.6 3.615h.002ZM7.99 18.3a2.5 2.5 0 0 1-.6-2.564A2.5 2.5 0 0 1 6 13.5v-1c.005-.544.19-1.072.526-1.5H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h7.687l-.697-.7ZM19.5 12h-1.12a4.441 4.441 0 0 0-.579-1.387l.8-.795a.5.5 0 0 0 0-.707l-.707-.707a.5.5 0 0 0-.707 0l-.795.8A4.443 4.443 0 0 0 15 8.62V7.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.12c-.492.113-.96.309-1.387.579l-.795-.795a.5.5 0 0 0-.707 0l-.707.707a.5.5 0 0 0 0 .707l.8.8c-.272.424-.47.891-.584 1.382H8.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1.12c.113.492.309.96.579 1.387l-.795.795a.5.5 0 0 0 0 .707l.707.707a.5.5 0 0 0 .707 0l.8-.8c.424.272.892.47 1.382.584v1.12a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1.12c.492-.113.96-.309 1.387-.579l.795.8a.5.5 0 0 0 .707 0l.707-.707a.5.5 0 0 0 0-.707l-.8-.795c.273-.427.47-.898.584-1.392h1.12a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5ZM14 15.5a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5Z" />
        </svg>
        Tokens de {{$usuario->name}}
      </span>
    </div>
    <div class="w-full h-auto border shadow-md rounded-lg mt-6 bg-slate-50">
      @foreach ($tokens as $item)
      <div class="border-b hover:bg-gray-100 flex flex-row justify-between">
        <div class="px-6 py-4">
          <div class="mb-2 flex flex-col">
            <span class="text-2xl text-bold uppercase">{{$item->client->name}}</span>
            <span>{{$item->id}}</span>
          </div>
          <div class="flex flex-col items-start">
            <span class="text-md font-bold">{{\Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i:s')}}</span>
            <span class="text-sm text-red-700">Vencimento: {{\Carbon\Carbon::parse($item->expires_at)->diffForHumans(now(), [
                'syntax' => \Carbon\CarbonInterface::DIFF_RELATIVE_TO_NOW,
                'options' => \Carbon\Carbon::JUST_NOW | Carbon\Carbon::ONE_DAY_WORDS | Carbon\Carbon::TWO_DAY_WORDS,
            ])}}
              <small class="text-red-400">{{\Carbon\Carbon::parse($item->expires_at)->format('d/m/Y H:i:s')}}</small>
            </span>
          </div>
        </div>
        <div class="px-6 py-4">
          <ul class="text-center">
            @forelse($item->scopes as $key => $value)
            <li>{{$value}}</li>
            @empty
            <span>Sem permissão</span>
            @endforelse
          </ul>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection
