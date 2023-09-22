<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\HasApiTokens;
use stdClass;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'last_login',
        'ip_login',
        'description',
        'isAdmin',
        'status',
        'foto',
        'email_address',
        'cpf'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function logoutSso()
    {
        $access_token = Session::get('acesso')['access_token'];
    }

    public function perfils()
    {
        return $this->belongsToMany(Perfil::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function databaseSession()
    {
        return $this->hasOne(Session::class, 'user_id', 'id');
    }

    public function adicionaPerfil(string $perfil){

        if (is_string($perfil)) {
            return $this->perfils()->save(
                Perfil::where('nome', '=', $perfil)->firstOrFail()

            );
        }
        return $this->perfils()->save(
            Perfil::where('nome', '=', $perfil->nome)->firstOrFail()
        );
    }

    public function removePerfil($perfil){
        if (is_string($perfil)) {
            return $this->perfils()->detach(
                Perfil::where('nome', '=', $perfil)->firstOrFail()

            );
        }
        return $this->perfils()->detach(
            Perfil::where('nome', '=', $perfil->nome)->firstOrFail()
        );
    }

    public static function existePermissao(int|string $permissao, int|string $perfil){

        if (DB::table('perfil_role')->where('role_id', $permissao)->where('perfil_id', $perfil)->count()) {

            return true;

        }else{
            return false;
        }

    }


    public function perfilDguardian(): string
    {
        $perfil = DB::table('client_perfil')
            ->join('oauth_clients', 'client_perfil.client_id', '=', 'oauth_clients.id')
            ->join('perfils', 'client_perfil.perfil_id', '=', 'perfils.id')
            ->join('perfil_user', 'client_perfil.perfil_id', '=', 'perfil_user.perfil_id')
            ->select('oauth_clients.name as cliente', 'perfils.nome as perfil', 'perfil_user.user_id as user')
            ->where('perfil_user.user_id', auth()->user()->id)
            ->where('oauth_clients.name', 'Dguardian')
            ->dd();

        return $perfil->perfil ?? 'vazio';
    }
}
