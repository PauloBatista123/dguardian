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
}
