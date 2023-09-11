<?php

namespace App\Http\Services;

use App\Http\Services\LdapService;
use App\Models\User;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\TokenRepository;

class UsuarioService {

    public function __construct(
        protected ClientRepository $clients,
        protected TokenRepository $tokenRepository,
        protected LdapService $ldapService,
    )
    {
    }

    public function desabilitarUsuario(string $userId): string
    {
        $user = User::find($userId);

        $returnAD = $this->ldapService->disableAccount($user->email);

        $user->update([
            'status' => 'bloqueado'
        ]);

        foreach($this->tokenRepository->forUser($userId)->where('revoked', false)->all() as $token) {
            $this->tokenRepository->revokeAccessToken($token->id);
        };

        return $returnAD;
    }

    public function habilitarUsuario(string $userId): string
    {
        $user = User::find($userId);

        $returnAD = $this->ldapService->enableAccount($user->email);

        $user->update([
            'status' => 'ativo'
        ]);

        return $returnAD;
    }

}
