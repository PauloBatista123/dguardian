<?php

namespace App\Livewire\Ausencia;

use App\Models\Ausencia;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;

class Editar extends Component
{
    use LivewireAlert;

    public $ausencia;
    public $inicio;
    public $fim;
    public $tipo;
    public $descricao;

    public function mount($ausenciaId)
    {
        $this->ausencia = Ausencia::findOrFail($ausenciaId);
        $this->inicio = Carbon::parse($this->ausencia->inicio)->format('d/m/Y');
        $this->fim = Carbon::parse($this->ausencia->fim)->format('d/m/Y');
        $this->tipo = $this->ausencia->tipo;
        $this->descricao = $this->ausencia->descricao;
    }

    #[Title('Editar Ausência')]
    public function render()
    {
        return view('livewire.ausencia.editar');
    }

    public function salvar()
    {
        $inicio = Carbon::createFromFormat('d/m/Y',$this->inicio);
        $fim = Carbon::createFromFormat('d/m/Y',$this->fim);

        if($inicio > $fim){
            return $this->alert('info', 'A data de início não pode ser maior que a data fim');
        }

        $this->ausencia->update([
            'inicio' => $inicio,
            'fim' => $fim,
            'descricao' => $this->descricao,
            'tipo' => $this->tipo,
        ]);

        $this->alert('success', 'Ausência alterada com sucesso!');
    }
}
