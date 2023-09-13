<?php

namespace App\Interfaces;

interface AusenciaStatus {

    const AGENDADO = 'agendado';
    const PROCESSADO = 'processado';
    const DESBLOQUEADO = 'desbloqueado';
    const ERRO = 'erro';

}
