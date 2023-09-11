<?php

namespace App\Jobs;

use App\Http\Services\LdapService;
use App\Http\Services\UsuarioService;
use App\Models\Ausencia;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BloquearUsuarios implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected UsuarioService $usuarioService,
        protected LdapService $ldapService
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

    }
}
