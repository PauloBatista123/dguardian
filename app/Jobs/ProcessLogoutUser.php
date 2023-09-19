<?php

namespace App\Jobs;

use App\Http\Services\UsuarioService;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\WebhookServer\WebhookCall;

class ProcessLogoutUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public User $user)
    {}

    /**
     * Execute the job.
     */
    public function handle(UsuarioService $usuarioService): void
    {
        if(count($usuarioService->loadClientsForUser($this->user->id))){
            foreach($usuarioService->loadClientsForUser($this->user->id) as $client){
                if(!$client->web_hook_logout) continue;

                WebhookCall::create()->doNotVerifySsl()->payload([
                    'login' => $this->user->email,
                    'email' => $this->user->email_address
                ])->url($client->web_hook_logout)->useSecret($client->secret)->dispatch();
            }
        }
    }
}
