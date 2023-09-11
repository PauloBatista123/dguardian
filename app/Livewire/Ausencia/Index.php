<?php

namespace App\Livewire\Ausencia;

use App\Http\Services\AusenciaService;
use App\Models\Ausencia;
use Jantinnerezo\LivewireAlert\LivewireAlert;
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

    public function boot(
        AusenciaService $ausenciaService,

    ){
        $this->ausenciaService = $ausenciaService;
    }

    public function render()
    {
        return view('livewire.ausencia.index', [
            'ausencias' => $this->ausenciaService->listar()
        ]);
    }
}
