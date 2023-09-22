<?php

namespace App\Livewire\Cliente\Permissao;

use App\Livewire\Cliente\Permissao;
use App\Models\Client;
use App\Models\Perfil;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;

use Livewire\Component;

class Adicionar extends Component
{
    use LivewireAlert;

    public $nome;

    public $descricao;

    public Client $cliente;

    public function render()
    {
        return view('livewire.cliente.permissao.adicionar');
    }

    public function mount(Client $cliente)
    {
        $this->cliente = $cliente;
    }

    public function salvar()
    {
        if(!Gate::allows(Auth::user()->perfilDguardian(), 'clientes.roles.adicionar')) return $this->alert('error', 'Você não possui permissão para executar a ação');

        $validated = Validator::make(
            // Data to validate...
            ['nome' => $this->nome, 'descricao' => $this->descricao],

            // Validation rules to apply...
            ['nome' => 'required|min:3|unique:App\Models\Role,nome', 'descricao' => 'required|min:3'],

            ['nome.unique' => 'A regra já existe no sistema', 'nome.min' => 'Informe ']
         )->validate();

        Role::create([
            'nome' => $this->nome,
            'descricao' => $this->descricao,
            'client_id' => $this->cliente->id
        ]);

        $this->dispatch('render-cliente-permissao')->to(Permissao::class);

        $this->reset(['descricao', 'nome']);

        $this->alert('success', 'Permissão salva com sucesso');

    }
}
