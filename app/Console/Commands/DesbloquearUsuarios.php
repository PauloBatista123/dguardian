<?php

namespace App\Console\Commands;

use App\Http\Services\UsuarioService;
use App\Interfaces\AusenciaStatus;
use App\Models\Ausencia;
use Exception;
use Illuminate\Console\Command;

class DesbloquearUsuarios extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dguardian:desbloquear-usuarios';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para desbloquear usuários com ausencia';

    /**
     * Execute the console command.
     */
    public function handle(UsuarioService $usuarioService)
    {
        if(now()->dayOfWeek === 1){
            $data = now()->subDays(3);
        }else{
            $data = now()->subDay();
        }

        $usuariosVoltaHoje = Ausencia::where('fim', '>=', $data->startOfDay())->where('fim', '<=', $data->endOfDay())->get();

        $this->output->title("Iniciando processo!");

        $this->output->info("Encontramos: ". count($usuariosVoltaHoje));

        $bar = $this->output->createProgressBar(count($usuariosVoltaHoje));

        $bar->start();

        foreach($usuariosVoltaHoje as $item){
            try{

                $retorno = $usuarioService->habilitarUsuario($item->usuario_id);

                $item->update([
                    'descricao' => $retorno,
                    'finished_at' => now(),
                    'status' => AusenciaStatus::DESBLOQUEADO
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
