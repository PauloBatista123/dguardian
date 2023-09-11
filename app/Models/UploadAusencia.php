<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadAusencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_id', 'url', 'nome', 'registros'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id', 'id');
    }
}
