<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class Deploy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:deploy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deploy automatico no server';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $retorno = shell_exec("php -v");

        $this->output->write($retorno);
    }
}
