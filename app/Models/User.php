<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Laravel\Passport\HasApiTokens;

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

    protected $with = ['perfils'];

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

    public function existeAdmin()
    {
        return $this->existePerfil('Master');
    }
}
