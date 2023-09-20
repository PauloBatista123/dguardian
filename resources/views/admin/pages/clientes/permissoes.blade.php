@extends('layouts.admin')

@section('content')
@livewire('cliente.permissao', ['cliente' => $cliente] ,key('cliente-permissao'))
@endsection
