<?php

namespace App\Livewire\Ausencia;

use App\Http\Services\AusenciaService;
use App\Interfaces\AusenciaStatus;
use App\Models\Ausencia;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use LivewireAlert, WithPagination;

    /**
     * Service inject.
     *
     */
    private AusenciaService $ausenciaService;

    public $status;
    public $nome;
    public $inicio;
    public $fim;

    public $onDeleteId;

    public function boot(
        AusenciaService $ausenciaService,

    ){
        $this->ausenciaService = $ausenciaService;
    }

    #[On('render-ausencia')]
    public function render()
    {
        return view('livewire.ausencia.index', [
            'ausencias' => Ausencia::whereRelation('usuario', 'name', 'like', '%'.$this->nome.'%')
            ->when($this->status, function($query){
                $query->where('status', $this->status);
            })
            ->when($this->inicio, function($query){
                $query->where('inicio', Carbon::createFromFormat('d/m/Y', $this->inicio)->format('Y-m-d'));
            })
            ->when($this->fim, function($query){
                $query->where('fim', Carbon::createFromFormat('d/m/Y', $this->fim)->format('Y-m-d'));
            })
            ->orderBy('inicio', 'desc')->paginate(10)
        ]);
    }

    public function confirmDeletar($id)
    {
        $this->onDeleteId = $id;

        $this->alert('warning', 'Atenção!', [
            'showCancelButton' => true,
            'cancelButtonText' => 'Cancelar',
            'showConfirmButton' => true,
            'confirmButtonText' => 'Deletar',
            'confirmButtonColor' => '',
            'onConfirmed' => 'deletarAusencia',
            'toast' => false,
            'position' => 'center',
            'text' => 'Após a confirmação não será possível reverter a ação..',
            'timer' => null,
        ]);
    }

    #[On('deletarAusencia')]
    public function deletarAusencia()
    {
        $ausencia = $this->ausenciaService->getByid($this->onDeleteId);

        if($ausencia->status === AusenciaStatus::AGENDADO){
            $ausencia->delete();

            $this->alert('success', 'Registro deletado com sucesso!');
            return $this->render();
        }

        $this->alert('info', "O registro não pode ser alterado com status $ausencia->status!");
    }

}
