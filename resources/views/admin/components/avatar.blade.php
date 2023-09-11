@php
$explodeName = explode(" ", auth()->user()->name);
$firstName = $explodeName[0];
$lastName = $explodeName[1];
$iniciais = str_split($firstName)[0].str_split($lastName)[0];
@endphp
<div class="flex items-center space-x-4">
  @if(auth()->user()->foto)
  <img class="w-10 h-10 rounded-full" src="/docs/images/people/profile-picture-5.jpg" alt="">
  @else
  <div class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
    <span class="font-medium text-gray-600 dark:text-gray-300">{{$iniciais}}</span>
  </div>
  @endif
  <div class="font-medium text-white">
    <div>{{auth()->user()->name}}</div>
    <div class="text-sm text-gray-400 dark:text-gray-400">{{auth()->user()->email}}</div>
  </div>
</div>
