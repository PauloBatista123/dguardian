<?php

namespace App\Http\Controllers;

use App\Http\Services\UsuarioService;
use App\Jobs\ProcessLogoutUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
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
    public function __construct(TokenRepository $tokenRepository, ClientRepository $clientRepository, protected UsuarioService $usuarioService)
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
    public function index(Request $request)
    {
        return view('home', [
            'clientes' => Passport::client()->where('revoked', false)->orderBy('name')->get()
        ]);
    }

    public function usuarios()
    {
        if(!Gate::allows(Auth::user()->perfilDguardian(), 'usuarios.listar')){
            abort(403, 'usuarios.listar');
        }

        return view('admin.pages.usuarios.index');
    }

    public function editar($usuarioId)
    {
        if(!Gate::allows(Auth::user()->perfilDguardian(), 'usuarios.editar')){
            abort(403, 'usuarios.editar');
        }

        return view('admin.pages.usuarios.editar', [ 'usuarioId' => $usuarioId ]);
    }

    public function tokens(int $id)
    {
        if(!Gate::allows(Auth::user()->perfilDguardian(), 'usuarios.tokens')){
            abort(403, 'usuarios.tokens');
        }

        $usuario = User::find($id);
        $tokens = $this->tokenRepository->forUser($usuario->getAuthIdentifier());

        return view('admin.pages.usuarios.tokens', [
            'usuario' => $usuario,
            'tokens' =>  $tokens->load('client')->filter(function ($token) {
                return !$token->client->firstParty() && !$token->revoked;
            })->values()
        ]);
    }

    public function logout(Request $request)
    {
        ProcessLogoutUser::dispatch($request->user());

        $tokens = $this->tokenRepository->forUser(Auth::user()->getAuthIdentifier())->filter(function ($token) {
            return !$token->revoked;
        });

        if(count($tokens)){
           foreach($tokens as $token){
                $token->revoke();
            };
        }

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
