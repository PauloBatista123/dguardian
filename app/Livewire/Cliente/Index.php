<?php

namespace App\Livewire\Cliente;

use Laravel\Passport\ClientRepository;
use Laravel\Passport\Passport;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use LivewireAlert;

    /**
     * The client repository instance.
     *
     * @var \Laravel\Passport\ClientRepository
     */
    private ClientRepository $clienteRepository;

    public function boot(
        ClientRepository $clients
    ){
        $this->clienteRepository = $clients;
    }

    public function render()
    {
        return view('livewire.cliente.index', [
            'clientes' => Passport::client()->all()
        ]);
    }

    public function revogar($clienteId)
    {

        $cliente = $this->clienteRepository->find($clienteId);

        $this->clienteRepository->delete($cliente);

        $this->alert('success', 'Token revogado com sucesso!');
        $this->render();
    }
}
