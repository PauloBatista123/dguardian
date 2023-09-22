<?php

namespace App\Livewire\Permissao;

use App\Http\Services\PerfilService;
use App\Models\Perfil;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;

class Index extends Component
{
    use LivewireAlert;

    public Perfil $perfil;

    private PerfilService $perfilService;

    #[Title('Permissão do Perfil')]
    public function render()
    {
        return view('livewire.permissao.index', [
            'permissoesAtribuidas' => $this->perfil->permissoes,
            'permissoes' => Role::where('client_id', $this->perfil->cliente[0]->id)->orderBy('nome')->get()
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
        if(!Gate::allows(Auth::user()->perfilDguardian(), 'clientes.perfil.permissoes.editar')) return $this->alert('error', 'Você não possui permissão para executar a ação');

        $permissao = Role::find($permissaoId);

        if($this->perfilService->existePermissao($permissaoId, $this->perfil->id)){
            $this->perfil->removerPermissao($permissaoId);

            $this->alert('success', 'Permissão removida com sucesso!');
        }

        $this->perfil->adicionarPermissao($permissao);
        $this->alert('success', 'Permissão adicionada com sucesso!');
    }

    public function permitirTodas()
    {
        if(!Gate::allows(Auth::user()->perfilDguardian(), 'clientes.perfil.permissoes.editar')) return $this->alert('error', 'Você não possui permissão para executar a ação');

        $permissoes = Role::where('client_id', $this->perfil->cliente[0]->id)->get();

        foreach($permissoes as $permissao){
            if($this->perfilService->existePermissao($permissao->id, $this->perfil->id)) continue;

            $this->perfil->adicionarPermissao($permissao);
        }

        $this->render();

        $this->alert('success', 'Permissões adicionadas com sucesso!');
    }

    public function excluirTodas()
    {
        if(!Gate::allows(Auth::user()->perfilDguardian(), 'clientes.perfil.permissoes.editar')) return $this->alert('error', 'Você não possui permissão para executar a ação');

        $permissoes = Role::where('client_id', $this->perfil->cliente[0]->id)->get();

        foreach($permissoes as $permissao){
            if($this->perfilService->existePermissao($permissao->id, $this->perfil->id)){
                $this->perfil->removerPermissao($permissao->id);
            }
        }

        $this->render();

        $this->alert('success', 'Permissões excluidas com sucesso!');
    }
}
