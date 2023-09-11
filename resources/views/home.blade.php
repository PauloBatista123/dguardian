@extends('layouts.admin')

@section('content')
@foreach ($clientes as $item)
{{$item->name}}
@endforeach
@endsection
