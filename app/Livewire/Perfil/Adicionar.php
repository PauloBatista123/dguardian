<?php

namespace App\Livewire\Perfil;

use App\Http\Services\PerfilService;
use App\Models\Client;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Adicionar extends Component
{
    use LivewireAlert;

    public $nome;

    public $descricao;

    public Client $cliente;

    private PerfilService $perfilService;

    public function boot(PerfilService $perfilService)
    {
        $this->perfilService = $perfilService;
    }

    public function mount(Client $cliente)
    {
        $this->cliente = $cliente;
    }

    public function render()
    {
        return view('livewire.perfil.adicionar');
    }

    public function salvar()
    {
        $validated = Validator::make(
            // Data to validate...
            ['nome' => $this->nome, 'descricao' => $this->descricao],

            // Validation rules to apply...
            ['nome' => 'required|min:3', 'descricao' => 'required|min:3'],
         )->validate();

        $this->perfilService->salvar($this->nome, $this->descricao, $this->cliente);

        $this->dispatch('render-perfil')->to(Index::class);

        $this->reset(['descricao', 'nome']);

        $this->alert('success', 'Perfil salvo com sucesso');

    }
}
