<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\Passport;

class ClienteController extends Controller
{
    /**
     * The client repository instance.
     *
     * @var \Laravel\Passport\ClientRepository
     */
    protected $clients;

        /**
     * Create a client controller instance.
     *
     * @param  \Laravel\Passport\ClientRepository  $clients
     * @return void
     */
    public function __construct(ClientRepository $clients)
    {
        $this->clients = $clients;
    }

    public function clientes()
    {

        if(!Gate::allows(auth()->user()->perfilDguardian(), 'clientes.listar')){
            abort(403, 'clientes.listar');
        }

        return view('admin.pages.clientes.index');
    }

    public function revogar(int|string $clientId)
    {
        if($this->clients->revoked($clientId));
    }

    public function perfis(string $clientId)
    {
        if(!Gate::allows(auth()->user()->perfilDguardian(), 'clientes.perfil')){
            abort(403, 'clientes.perfil');
        }

        return view('admin.pages.clientes.perfis.index', ['clienteId' => $clientId]);
    }

    public function permissoes(string $perfilId)
    {
        if(!Gate::allows(auth()->user()->perfilDguardian(), 'clientes.perfil.permissoes')){
            abort(403, 'clientes.perfil.permissoes');
        }

        return view('admin.pages.clientes.perfis.permissoes', ['perfilId' => $perfilId]);
    }

    public function roles(string $clientId)
    {
        if(!Gate::allows(auth()->user()->perfilDguardian(), 'clientes.roles')){
            abort(403, 'clientes.roles');
        }

        return view('admin.pages.clientes.permissoes', ['cliente' => Client::findOrFail($clientId)]);
    }
}
