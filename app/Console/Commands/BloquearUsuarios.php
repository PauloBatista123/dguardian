<?php

namespace App\Console\Commands;

use App\Http\Services\UsuarioService;
use App\Interfaces\AusenciaStatus;
use App\Models\Ausencia;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;

class BloquearUsuarios extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dguardian:bloqueio-ausencia';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bloquear usuários com ausência temporária';

    /**
     * Execute the console command.
     */
    public function handle(UsuarioService $usuarioService)
    {

        $ausenciasHoje = Ausencia::where('inicio', '>=', now()->startOfDay())->where('inicio', '<=', now()->endofDay())->get();

        $this->output->title("Iniciando processo!");

        $this->output->info("Encontramos: ". count($ausenciasHoje));

        $bar = $this->output->createProgressBar(count($ausenciasHoje));

        $bar->start();

        foreach($ausenciasHoje as $item){
            try{

                $retorno = $usuarioService->desabilitarUsuario($item->usuario_id);

                $item->update([
                    'descricao' => $retorno,
                    'finished_at' => now(),
                    'status' => AusenciaStatus::PROCESSADO
                ]);

                $bar->advance();
                continue;

            }catch(Exception $error){

                $item->update([
                    'log' => $error->getMessage(),
                    'finished_at' => now(),
                    'status' => AusenciaStatus::ERRO
                ]);

                $bar->advance();
                continue;
            }

        }

        $bar->finish();

        $this->output->success("Operação finalizada com sucesso");
    }



}
