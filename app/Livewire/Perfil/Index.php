<?php

namespace App\Livewire\Perfil;

use App\Models\Client;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

class Index extends Component
{

    public $cliente;

    #[Title('Perfis de Acesso')]
    #[On('render-perfil')]
    public function render()
    {
        return view('livewire.perfil.index', [
            'perfis' => $this->cliente->perfis,
        ]);
    }

    public function mount($clienteId)
    {
        $this->cliente = Client::find($clienteId);
    }

}
