<?php

namespace App\Http\Services;

use App\Http\Services\LdapService;
use App\Models\Perfil;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\Passport;
use Laravel\Passport\TokenRepository;

class UsuarioService {

    public function __construct(
        protected ClientRepository $clientRepository,
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

    public function resetarSenha(string $userId): string
    {
        $user = User::find($userId);

        $returnAD = $this->ldapService->resetPassword($user->email);

        return $returnAD;
    }

    public function clientsForUser(string $userId): Collection
    {
        return Passport::client()
        ->orderBy('name', 'asc')->get();
    }

    public function loadClientsForUser($userId): Collection
    {
        return DB::table('oauth_access_tokens as oat')
            ->join('oauth_clients as oc', 'oat.client_id', '=', 'oc.id')
            ->select('oc.*', 'oat.client_id', 'oat.user_id')
            ->where('oat.user_id', $userId)
            ->groupBy('oat.client_id')
            ->get();
    }

    public function existePerfil(User $usuario, string $perfil)
    {
        return $usuario->perfils->contains('nome', $perfil);
    }

    public function removerPerfil(User $usuario, Perfil $perfil)
    {
        return $usuario->perfils()->detach($perfil);
    }

    public function adicionarPerfil(User $usuario, Perfil $perfil)
    {
        if($this->existePerfil($usuario, $perfil->nome)){
            return;
        }

        return $usuario->perfils()->attach($perfil);
    }

}

