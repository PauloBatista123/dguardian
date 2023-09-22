<?php

namespace App\Livewire\Cliente;

use App\Models\Client;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class Permissao extends Component
{
    use LivewireAlert;

    public Client $cliente;

    #[On('render-cliente-permissao')]
    public function render()
    {
        return view('livewire.cliente.permissao', [
            'permissoes' => Role::where('client_id', $this->cliente->id)->orderBy('nome')->get()
        ]);
    }

    public function mount(Client $cliente)
    {
        $this->cliente = $cliente;
    }

    public function deletar($roleId)
    {
        if(!Gate::allows(Auth::user()->perfilDguardian(), 'clientes.roles.deletar')) return $this->alert('error', 'Você não possui permissão para executar a ação');

        $role = Role::find($roleId);

        if(count($role->papeis) > 0) return $this->alert('error', 'A permissão está vinculada a um perfil de acesso');

        $role->delete();

        $this->render();

        return $this->alert('success', 'Permissão excluida com sucesso!');
    }
}
