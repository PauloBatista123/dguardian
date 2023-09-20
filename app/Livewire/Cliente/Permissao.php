<?php

namespace App\Livewire\Cliente;

use App\Models\Client;
use App\Models\Role;
use Livewire\Component;

class Permissao extends Component
{
    public Client $cliente;


    public function render()
    {
        return view('livewire.cliente.permissao', [
            'permissoes' => Role::where('client_id', $this->cliente->id)->get()
        ]);
    }

    public function mount(Client $cliente)
    {
        $this->cliente = $cliente;
    }
}
