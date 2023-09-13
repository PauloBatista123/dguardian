<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AusenciaController extends Controller
{
    public function ausencias()
    {
        return view('admin.pages.ausencias.index');
    }

    public function editar($id)
    {
        return view('admin.pages.ausencias.editar', [ 'id' => $id]);
    }

    public function importacoes()
    {
        return view('admin.pages.uploads.ausencias');
    }

}
