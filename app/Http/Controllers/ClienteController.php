<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
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
        return view('admin.pages.clientes.index');
    }

    public function revogar(int|string $clientId)
    {
        if($this->clients->revoked($clientId));
    }

    public function perfis(string $clientId)
    {
        return view('admin.pages.clientes.perfis.index', ['clienteId' => $clientId]);
    }

    public function permissoes(string $perfilId)
    {
        return view('admin.pages.clientes.perfis.permissoes', ['perfilId' => $perfilId]);
    }

    public function roles(string $clientId)
    {
        return view('admin.pages.clientes.permissoes', ['cliente' => Client::findOrFail($clientId)]);
    }
}
