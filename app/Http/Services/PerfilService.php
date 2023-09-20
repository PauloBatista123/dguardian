<?php

namespace App\Http\Services;

use App\Models\Client;
use App\Models\Perfil;
use Illuminate\Support\Facades\DB;

class PerfilService {

    public function existePermissao($permissao, $perfil): bool
    {
        if (DB::table('perfil_role')->where('role_id', $permissao)->where('perfil_id', $perfil)->count()) return true;

        return false;
    }

    public function salvar(string $nome, string $descricao, Client $cliente)
    {
        $perfil = Perfil::create([
            'nome' => $nome,
            'descricao' => $descricao
        ]);

        $cliente->adicionarPerfil($perfil);
    }

}

