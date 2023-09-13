<?php

namespace App\Http\Services;

use App\Models\Ausencia;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class AusenciaService {

    public function __construct(
    )
    {
    }

    public function listar(?string $nome, ?string $status, ?string $dataInicio): LengthAwarePaginator
    {
        return Ausencia::whereRelation('usuario', 'name', 'like', '%'.$nome.'%')
        ->when($status, function($query) use ($status){
            $query->where('status', $status);
        })
        ->orderBy('inicio', 'desc')->paginate(10);
    }

    public function getByid(string $id): Ausencia
    {
        return Ausencia::findOrFail($id);
    }
}
