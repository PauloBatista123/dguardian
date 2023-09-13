<?php

namespace App\Livewire\Usuario;

use App\Http\Services\LdapService;
use App\Models\User;
use LdapRecord\Models\ActiveDirectory\User as ActiveDirectoryUser;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Editar extends Component
{
    public $name;
    public $description;
    public $physicaldeliveryofficename;
    public $email;
    public $email_address;
    public $samaccountname;
    public $memberOf = [];

    public function mount($usuarioId)
    {
        $usuario = User::findOrFail($usuarioId);

        $user = ActiveDirectoryUser::where('samaccountname', '=', $usuario->email)->first();

        $this->name = isset($user->name[0]) ? $user->name[0] : '';
        $this->description = isset($user->description[0]) ? $user->description[0] : '';
        $this->physicaldeliveryofficename = isset($user->physicaldeliveryofficename[0]) ? $user->physicaldeliveryofficename[0]: '';
        $this->email_address = isset($user->mail[0]) ? $user->mail[0] : '';
        $this->email = isset($user->samaccountname[0]) ? $user->samaccountname[0] : '';
        $this->memberOf = isset($user->memberof) ? $user->memberof : [];
    }

    #[Title('Editar Usuário')]
    public function render()
    {
        return view('livewire.usuario.editar');
    }
}
