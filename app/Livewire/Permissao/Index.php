<?php

namespace App\Livewire\Permissao;

use App\Http\Services\PerfilService;
use App\Models\Perfil;
use App\Models\Role;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;

class Index extends Component
{
    use LivewireAlert;

    public $perfil;

    private PerfilService $perfilService;

    #[Title('Permissão do Perfil')]
    public function render()
    {
        return view('livewire.permissao.index', [
            'permissoesAtribuidas' => $this->perfil->permissoes,
            'permissoes' => Role::where('client_id', $this->perfil->cliente[0]->id)->get()
        ]);
    }

    public function boot(PerfilService $perfilService)
    {
        $this->perfilService = $perfilService;
    }

    public function mount($perfilId)
    {
        $this->perfil = Perfil::find($perfilId);
    }

    public function alterarPermissao($permissaoId)
    {
        $permissao = Role::find($permissaoId);

        if($this->perfilService->existePermissao($permissaoId, $this->perfil->id)){
            $this->perfil->removerPermissao($permissaoId);

            $this->alert('success', 'Permissão removida com sucesso!');
        }

        $this->perfil->adicionarPermissao($permissao);
        $this->alert('success', 'Permissão adicionada com sucesso!');
    }
}
