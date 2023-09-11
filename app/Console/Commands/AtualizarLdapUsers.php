<?php

namespace App\Console\Commands;

use App\Imports\AtualizaLdapImport;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;

class AtualizarLdapUsers extends Command implements PromptsForMissingInput
{
    /**
    * The name and signature of the console command.
    *
    * @var string
    */
   protected $signature = 'dguardian:atualizar';

   /**
    * The console command description.
    *
    * @var string
    */
   protected $description = 'Atualizar ususarios do LDAP';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->output->title('Iniciando processo de atualização do LDAP');

        $path = $this->ask('Qual o caminho completo do arquivo? Ex: public/teste.xlsx');

        if(!Storage::fileExists($path)){
            $this->error('O arquivo não foi encontrado');
        }

        $arquivo = Storage::get($path);

        (new AtualizaLdapImport)->withOutput($this->output)->import($path);

        $this->output->success("O arquivo foi processado");
    }

    /**
     * Prompt for missing input arguments using the returned questions.
     *
     * @return array
     */
    protected function promptForMissingArgumentsUsing()
    {
        return [
            'path' => 'Informe o path do arquivo para atualização dos dados',
        ];
    }
}
