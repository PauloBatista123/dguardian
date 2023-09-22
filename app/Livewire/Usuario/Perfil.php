<?php

namespace App\Livewire\Usuario;

use App\Http\Services\UsuarioService;
use App\Models\Client;
use App\Models\Perfil as ModelsPerfil;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Perfil extends Component
{
    use LivewireAlert;

    public User $usuario;

    private UsuarioService $usuarioService;

    public function render()
    {
        return view('livewire.usuario.perfil', [
            'clientes' => Client::all()
        ]);
    }

    public function boot(UsuarioService $usuarioService)
    {
        $this->usuarioService = $usuarioService;
    }

    public function mount(User $usuario)
    {
        $this->usuario = $usuario;
    }

    public function salvar($perfilId)
    {
        if(!Gate::allows(Auth::user()->perfilDguardian(), 'usuarios.permissao.editar')) return $this->alert('error', 'Você não possui permissão para executar a ação');

        $perfil = ModelsPerfil::find($perfilId);

        if($this->usuarioService->existePerfil($this->usuario, $perfil->nome)){
            $this->usuarioService->removerPerfil($this->usuario, $perfil);

            return $this->alert('info', 'Perfil removido com sucesso');
        }

        $this->usuarioService->adicionarPerfil($this->usuario, $perfil);

        return $this->alert('success', 'Perfil adicionado com sucesso');
    }
}
