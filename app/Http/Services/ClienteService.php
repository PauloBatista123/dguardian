<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\Passport;

class ClienteService {

    public function __construct(
        protected ClientRepository $clients,
    )
    {
    }

    /**
     * Store a new client.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Passport\Client|array
     */
    public function salvar(string $name, string $redirect, ?string $logo, ?string $description, ?string $homepage)
    {
        $client = $this->clients->create(
            Auth()->user()->getAuthIdentifier(), $name, $redirect,
            null, false, false, true, $logo, $homepage, $description
        );

        if (Passport::$hashesClientSecrets) {
            return ['plainSecret' => $client->plainSecret] + $client->toArray();
        }

        return $client->makeVisible('secret');
    }

}
