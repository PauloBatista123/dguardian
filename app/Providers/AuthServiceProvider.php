<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Client;
use App\Models\Perfil;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        foreach(Client::where('name', 'Dguardian')->first()->perfis as $perfil){
            Gate::define($perfil->nome, function(User $user, string $permissao) use ($perfil){
                $role = Role::where('nome', $permissao)->first();

                if($role) return $user->existePermissao($role->id, $perfil->id);

                return false;
            });
        }

        Passport::tokensExpireIn(Carbon::now()->addDays(2));
        Passport::useClientModel(Client::class);
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));
        Passport::personalAccessTokensExpireIn(Carbon::now()->addMonths(6));
        Passport::cookie('@sso-aracoop-authenticator');

        if(Schema::hasTable('roles')){
            Passport::tokensCan(Role::all()->mapWithKeys(function($item){
                return [$item['nome'] => $item['descricao']];
            })->all());
        }
    }
}
