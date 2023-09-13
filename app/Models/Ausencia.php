<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ausencia extends Model
{
    use HasFactory;

    protected $table = 'ausencias';

    protected $fillable = [
        'inicio', 'fim', 'usuario_id', 'tipo', 'descricao', 'log', 'status', 'finished_at'
    ];

    public static function tipoAusencias(): array
    {
        return [
            'atestado' => 'Atestado Médico',
            'ferias' => 'Férias',
            'gala' => 'Licença Gala',
            'maternidade' => 'Licença Maternidade',
            'paternidade' => 'Licença Paternidade',
            'treinamento' => 'Treinamento',
            'outros' => 'Outros',
        ];
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id', 'id');
    }
}
