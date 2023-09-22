<?php

namespace App\Http\Controllers;

use App\Http\Services\UsuarioService;
use App\Models\Client;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\ClientRepository;
use stdClass;

class AuthController extends Controller
{

    public function __construct(protected UsuarioService $usuarioService)
    {}

    public function login()
    {
        return view('login');
    }

    public function user(Request $request)
    {
        try {
            $user = Auth()->user();

            if($user->perfils->count() > 0){

                $perfis = $this->usuarioService->perfisUsuario($request);
                $roles = [];

                foreach($perfis as $perfil){
                    foreach($perfil->permissoes as $permissao){
                        $roles = Arr::prepend($roles, $permissao->nome);
                    }
                }

                $user['roles'] = array_unique($roles);
            }else {
                $user['roles'] = [];
            }

            $user['isAdmin'] = (bool) $this->usuarioService->existePerfil($user, 'Master');

            return response()->json($user->makeHidden(['perfils']));

        }catch(Exception $e) {
            return response(['Sso - falha ao carregar informações: '. $e->getMessage()], 404);
        }
    }
}
