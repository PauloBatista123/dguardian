<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AusenciaController extends Controller
{
    public function ausencias()
    {
        if(!Gate::allows(Auth::user()->perfilDguardian(), 'ausencias.listar')){
            abort(403, 'ausencias.listar');
        }

        return view('admin.pages.ausencias.index');
    }

    public function editar($id)
    {
        if(!Gate::allows(Auth::user()->perfilDguardian(), 'ausencias.editar')){
            abort(403, 'ausencias.editar');
        }

        return view('admin.pages.ausencias.editar', [ 'id' => $id]);
    }

    public function importacoes()
    {
        if(!Gate::allows(Auth::user()->perfilDguardian(), 'ausencias.importacoes')){
            abort(403, 'ausencias.importacoes');
        }

        return view('admin.pages.uploads.ausencias');
    }

}
