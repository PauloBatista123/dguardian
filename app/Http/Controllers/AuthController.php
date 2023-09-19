<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;

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

            if(count($user->perfils)){
                $roles = $user->perfils[0]->permissoes->map(function($permissao){
                    return $permissao->nome;
                });

                $user['roles'] = $roles;
            }else {
                $user['roles'] = [];
            }

            $user['isAdmin'] = (bool) request()->user()->existeAdmin();

            return $user;

        }catch(Exception $e) {
            return response(['Sso - falha ao carregar informações: '. $e->getMessage()], 404);
        }
    }
}
