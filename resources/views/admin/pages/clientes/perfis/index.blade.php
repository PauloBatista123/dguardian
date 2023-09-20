@extends('layouts.admin')

@section('content')
@livewire('perfil.index', ['clienteId' => $clienteId] ,key('perfil-index'))
@endsection
