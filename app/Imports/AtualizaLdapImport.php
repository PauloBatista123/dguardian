<?php

namespace App\Imports;

use App\Models\User as ModelsUser;
use Illuminate\Support\Collection;
use LdapRecord\Container;
use LdapRecord\Models\ActiveDirectory\User;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class AtualizaLdapImport implements ToModel, WithProgressBar, WithHeadingRow
{
    use Importable;


    public function model(array $row)
    {
        $user = User::where('samaccountname', '=', $row["email"])->first();

        if($user->hasAttribute('physicaldeliveryofficename')){
            $user->physicaldeliveryofficename = $row["cpf"] ?? 'N/C';
        }else{
            $user->addAttributeValue('physicaldeliveryofficename', $row["cpf"]);
        }

        $user->mail = $row["email_address"];

        $user->save();

        return ModelsUser::where('email', '=', $row["email"])->first();
    }


}
