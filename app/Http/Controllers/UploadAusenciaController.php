<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadAusenciaController extends Controller
{
    public function ausencias()
    {
        return view('admin.pages.uploads.ausencias');
    }
}
