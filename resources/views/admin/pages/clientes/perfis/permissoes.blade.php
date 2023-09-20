@extends('layouts.admin')

@section('content')
@livewire('permissao.index', ['perfilId' => $perfilId] ,key('permissao-index'))
@endsection
