<?php

namespace App\Livewire\Usuario;

use App\Http\Services\LdapService;
use App\Http\Services\UsuarioService;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\TokenRepository;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use LivewireAlert, WithPagination;

    /**
     * Service inject.
     *
     */
    private UsuarioService $usuarioService;

    public $nome;

    public function boot(
        UsuarioService $usuarioService,

    ){
        $this->usuarioService = $usuarioService;
    }

    public function render()
    {
        return view('livewire.usuario.index', [
            'usuarios' => User::when($this->nome, function($query){
                $query->where('name', 'like', '%'.$this->nome.'%');
            })->orderBy('name')->paginate(10)
        ]);
    }

    public function bloquear($usuarioId)
    {
        $returnAd = $this->usuarioService->desabilitarUsuario($usuarioId);

        $this->alert('success', 'Usuário bloqueado e tokens revogados', [
            'text' => 'Retorno do AD: '.$returnAd
        ]);
    }

    public function desbloquear($userId)
    {
        $returnAd = $this->usuarioService->habilitarUsuario($userId);

        $this->alert('success', 'Usuário desbloqueado', [
            'text' => 'Retorno do AD: '.$returnAd
        ]);
    }

    public function resetarSenha($userId)
    {
        $returnAd = $this->usuarioService->resetarSenha($userId);

        $this->alert('success', 'Senha resetada', [
            'text' => 'Retorno do AD: '.$returnAd
        ]);
    }
}
