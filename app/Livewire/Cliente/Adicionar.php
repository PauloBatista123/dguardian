<?php

namespace App\Livewire\Cliente;

use App\Http\Services\ClienteService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Laravel\Passport\Http\Rules\RedirectRule;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Adicionar extends Component
{
    use LivewireAlert, WithFileUploads;

        /**
     * The redirect validation rule.
     *
     * @var \Laravel\Passport\Http\Rules\RedirectRule
     */
    private $redirectRule;

    public $name;

    public $redirectUri;

    public $logo;

    public $homepage;

    public $description;

    private $clienteService;

    public function boot(ClienteService $clienteService)
    {
        $this->clienteService = $clienteService;
    }

    public function render()
    {
        return view('livewire.cliente.adicionar');
    }

    public function salvar()
    {
        if(!Gate::allows(Auth::user()->perfilDguardian(), 'clientes.adicionar')) return $this->alert('error', 'Você não possui permissão para executar a ação');

        $validated = Validator::make(
            // Data to validate...
            ['name' => $this->name, 'redirectUri' => $this->redirectUri, 'logo' => $this->logo, 'homepage' => $this->homepage, 'description' => $this->description],

            // Validation rules to apply...
            ['name' => 'required|min:3', 'redirectUri' => ['required', $this->redirectRule], 'logo' => 'required', 'description' => 'required', 'homepage' => ['required', $this->redirectRule]],
         )->validate();

        $path = Storage::putFile('public', $this->logo);

        $this->clienteService->salvar($this->name, $this->redirectUri, $path, $this->homepage, $this->description);

        $this->dispatch('render-cliente')->to(Index::class);

        $this->reset(['redirectUri', 'name']);

        $this->alert('success', 'Cliente salvo com sucesso');

    }
}
