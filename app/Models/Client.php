<?php

namespace App\Models;

use Laravel\Passport\Client as PassportClient;

class Client extends PassportClient
{

    protected $fillable = [
        'user_id',
        'name',
        'secret',
        'provider',
        'redirect',
        'personal_access_client',
        'password_client',
        'revoked',
        'logo',
        'description',
        'homepage',
        'web_hook_logout'
    ];

    public function skipsAuthorization()
    {
        return true;
    }

    public function perfis()
    {
        return $this->belongsToMany(Perfil::class);
    }

    public function adicionarPerfil($perfil)
    {
        $this->perfis()->save($perfil);
    }

    public function permissoes()
    {
        return $this->belongsTo(Role::class, 'client_id', 'id');
    }
}
