<?php

namespace App\Http\Services;

use App\Models\Ausencia;
use Illuminate\Pagination\LengthAwarePaginator;

class AusenciaService {

    public function __construct(
    )
    {
    }

    public function listar(): LengthAwarePaginator
    {
        return Ausencia::paginate(10);
    }

}
