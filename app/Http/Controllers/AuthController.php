<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function user(Request $request)
    {
        try {
            $user = Auth()->user();

            $roles = $user->perfils[0]->permissoes->map(function($permissao){
                return $permissao->nome;
            });

            $user['isAdmin'] = (bool) request()->user()->existeAdmin();
            $user['roles'] = $roles;
            $user['token'] = $user->createToken($user->name, count($roles) === 0 ? ['isadmin'] : $roles->toArray())->accessToken;

            return $user;

        }catch(Exception $e) {
            return response(['Sso - falha ao carregar informações: '. $e->getMessage()], 404);
        }
    }
}
