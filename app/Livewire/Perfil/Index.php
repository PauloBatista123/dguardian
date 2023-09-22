<?php

namespace App\Livewire\Perfil;

use App\Models\Client;
use App\Models\Perfil;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

class Index extends Component
{
    use LivewireAlert;

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

    public function deletar($perfilId)
    {
        if(!Gate::allows(Auth::user()->perfilDguardian(), 'clientes.perfil.deletar')) return $this->alert('error', 'Você não possui permissão para executar a ação');

        $perfil = Perfil::find($perfilId);

        if($perfil->usuarios->count() > 0) return $this->alert('error', "O perfil está vinculada a ".$perfil->usuarios->count()." usuário(s)");

        $perfil->cliente()->detach();
        $perfil->delete();

        $this->render();

        return $this->alert('success', 'Perfil excluido com sucesso!');
    }

}
