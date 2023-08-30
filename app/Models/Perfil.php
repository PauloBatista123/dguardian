<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'descricao',
    ];

    protected $with = ['permissoes'];

    public function permissoes(){

        return $this->belongsToMany(Role::class);
    }

    public function adicionarPermissao($permissao){
        return $this->permissoes()->save($permissao);
    }

    public function removerPermissao($permissao){
        return $this->permissoes()->detach($permissao);
    }
}
