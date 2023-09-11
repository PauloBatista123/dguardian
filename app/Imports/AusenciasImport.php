<?php

namespace App\Imports;

use App\Models\Ausencia;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Imtigger\LaravelJobStatus\Trackable;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Events\BeforeImport;
use Maatwebsite\Excel\Events\ImportFailed;

class AusenciasImport implements ToCollection, WithHeadingRow, ShouldQueue, WithChunkReading, WithEvents
{
    use Importable, InteractsWithQueue, Queueable, SerializesModels, Trackable;

    public $log = [];
    protected $user;

    public function __construct(
        $user,
    )
    {
        $this->prepareStatus();
        $this->setInput(['status' => 'progress']);
        $this->user = $user;
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row){
            $this->incrementProgress();

            $validations = [
                'id' => $row['id'],
                'usuario' => $row['usuario'],
                'inicio' => $row['inicio'],
                'fim' => $row['fim'],
                'tipo' => $row['tipo_de_ausencia']
            ];

            $validator = Validator::make($validations, [
                'id' => 'required',
                'usuario' => 'required|exists:App\Models\User,email',
                'inicio' => 'required',
                'fim' => 'required',
                'tipo' => 'required'
            ]);

            if($validator->fails()){
                array_push($this->log, ['id' => $row['id'], 'status' => 'Processado com erros:'.implode(',', $validator->errors()->all())]);
                continue;
            }

            Ausencia::updateOrCreate([
                'usuario_id' => User::where('email', $row['usuario'])->first()->id,
                'inicio' => Carbon::createFromFormat('d/m/Y H:i', $row['inicio']),
                'fim' => Carbon::createFromFormat('d/m/Y H:i', $row['fim']),
                'tipo' => $row['tipo_de_ausencia']
            ], [
                'descricao' => $row['descricao']
            ]);

            //array para setar no output do job
            array_push($this->log, ['usuario' => $row['usuario'], 'status' => 'Registro Processado']);
        }

        $this->setOutput(['registros' => $this->log, 'error' => false]);
        $this->setInput(["status" => "finished"]);
    }

    public function registerEvents(): array
    {
        return [
            BeforeImport::class => function (BeforeImport $event) {
                $rows = $event->getReader()->getTotalRows()["Plan1"];
                 $this->setProgressMax((int) $rows);
            },
            ImportFailed::class => function(ImportFailed $event) {
                $this->setOutput(['registros' => $this->log, 'error' => $event->getException()->getMessage()]);
                $this->setInput(["status" => "error"]);
            },
        ];
    }

    public function chunkSize(): int
    {
        return 1000000;
    }
}
