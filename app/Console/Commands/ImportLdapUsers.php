<?php

namespace App\Console\Commands;

use App\Models\User as ModelsUser;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use LdapRecord\Container;
use LdapRecord\Models\ActiveDirectory\User;
use LdapRecord\Query\Collection;

class ImportLdapUsers extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dguardian:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importar ususarios do LDAP';

    /**
   * Default Responses.
   *
   * @return void
   */

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::get();
        $this->info("########## IMPORTAÇÃO DE USUÁRIOS #########");
        $this->info(">>>>>>> Encontramos ". $users->count() . " registros <<<<<<<<<<<<<<");

        $bar = $this->output->createProgressBar(count($users));

        $bar->start();

        foreach($users as $item){
            $user = ModelsUser::where('email', $item['samaccountname'][0])->first();

            if($user){
                $user->update([
                    'name' => isset($item['name'][0]) ? $item['name'][0] : $item['displayname'][0],
                    'last_login' => now(),
                    'ip_login' => '127.0.0.1',
                    'description' => isset($item['description'][0]) ? $item['description'][0] : '',
                    'email_address' => isset($item['mail'][0]) ? $item['mail'][0]: '',
                    'cpf' => isset($item['physicaldeliveryofficename'][0]) ? $item['physicaldeliveryofficename'][0] : '',
                ]);
            }else {
                ModelsUser::create([
                    'email' => $item['samaccountname'][0],
                    'name' => isset($item['name'][0]) ? $item['name'][0] : $item['displayname'][0],
                    'last_login' => now(),
                    'ip_login' => '127.0.0.1',
                    'description' => isset($item['description'][0]) ? $item['description'][0] : '',
                    'email_address' => isset($item['mail'][0]) ? $item['mail'][0]: '',
                    'cpf' => isset($item['physicaldeliveryofficename'][0]) ? $item['physicaldeliveryofficename'][0] : '',
                ]);

            }

            $bar->advance();
        }

        $bar->finish();
        $this->info('Importação finalizada com sucesso!');
    }
}
