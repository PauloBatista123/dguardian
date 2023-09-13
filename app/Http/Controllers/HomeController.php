<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\Passport;
use Laravel\Passport\TokenRepository;

class HomeController extends Controller
{
        /**
     * The token repository implementation.
     *
     * @var \Laravel\Passport\TokenRepository
     */
    protected $tokenRepository;


        /**
     * The token repository implementation.
     *
     * @var \Laravel\Passport\ClientRepository
     */
    protected $clientRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Laravel\Passport\TokenRepository  $tokenRepository
     * @return void
     */
    public function __construct(TokenRepository $tokenRepository, ClientRepository $clientRepository)
    {
        $this->middleware('auth');
        $this->tokenRepository = $tokenRepository;
        $this->clientRepository = $clientRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            'clientes' => Passport::client()->where('revoked', false)->orderBy('name')->get()
        ]);
    }

    public function usuarios()
    {
        return view('admin.pages.usuarios.index');
    }

    public function editar($usuarioId)
    {
        return view('admin.pages.usuarios.editar', [ 'usuarioId' => $usuarioId ]);
    }

    public function tokens(int $id)
    {
        $usuario = User::find($id);
        $tokens = $this->tokenRepository->forUser($usuario->getAuthIdentifier());

        return view('admin.pages.usuarios.tokens', [
            'usuario' => $usuario,
            'tokens' =>  $tokens->load('client')->filter(function ($token) {
                return !$token->client->firstParty() && !$token->revoked;
            })->values()
        ]);
    }
}
