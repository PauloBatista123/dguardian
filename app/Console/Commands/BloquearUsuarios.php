<?php

namespace App\Console\Commands;

use App\Models\Ausencia;
use Carbon\Carbon;
use Illuminate\Console\Command;

class BloquearUsuarios extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:bloquear-usuarios';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dataAtual = Carbon::now();

        $ausenciasHoje = Ausencia::where([
           ['inicio', '>=', $dataAtual->startOfDay()],
           ['inicio', '<=', $dataAtual->endOfDay()]
        ])->get();

        dd($ausenciasHoje);
    }
}
