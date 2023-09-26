<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class SessoesController extends Controller
{
    public function sessoes()
    {
        if(!Gate::allows(Auth::user()->perfilDguardian(), 'sessoes.listar')){
            abort(403, 'sessoes.listar');
        }

        return view('admin.pages.sessoes.index');
    }
}
