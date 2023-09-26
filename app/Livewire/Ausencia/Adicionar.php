<?php

namespace App\Livewire\Ausencia;

use App\Http\Services\AusenciaService;
use App\Models\Ausencia;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Adicionar extends Component
{
    use LivewireAlert;

    public $usuario;
    public $inicio = '';
    public $fim = '';
    public $descricao = '';
    public $tipo = '';

    private AusenciaService $ausenciaService;

    public function render()
    {
        return view('livewire.ausencia.adicionar', [
            'funcionarios' => User::orderBy('name')->get()
        ]);
    }

    public function boot(AusenciaService $ausenciaService)
    {
        $this->ausenciaService = $ausenciaService;
    }

    public function salvar()
    {
        $this->validate([
            'usuario' => 'required',
            'inicio' =>'required|date|before_or_equal:fim',
            'fim' =>'required|date|after_or_equal:inicio',
            'tipo' => 'required'
        ], [
            'usuario' => 'Selecione o funcionário',
            'inicio.date' => 'Informe uma data válida no formato dd/mm/yyyy',
            'inicio.required' => 'Informe uma data válida',
            'inicio.before_or_equal' => 'A data de início deve ser menor ou igual a data de término',
            'fim.required' => 'Informe uma data válida',
            'fim.after_or_equal' => 'A data de término deve ser maior ou igual a data de início',
        ]);

        if(Ausencia::where([
            ['usuario_id', $this->usuario], ['status', 'agendado'], ['tipo', $this->tipo]
            ])->count()
        ){
            return $this->alert('info', "Já existe uma ausência cadastrada para o usuário do tipo $this->tipo");
        }

        Ausencia::create([
            'inicio' => Carbon::parse($this->inicio),
            'fim' => Carbon::parse($this->fim),
            'tipo' => $this->tipo,
            'usuario_id' => $this->usuario,
            'descricao' => $this->descricao,
        ]);

        $this->dispatch('render-ausencia')->to(Index::class);

        $this->reset();

        $this->alert('success', 'Ausência registrada com sucesso!');
    }
}
