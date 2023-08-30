<?php
namespace App\Http\Services;

use Exception;
use Illuminate\Support\Arr;
use LdapRecord\Auth\BindException;
use LdapRecord\Container;

Class LdapService{

  /**
   * Default Responses.
   *
   * @return void
   */

    public static function connect($user = null, $password = null)
    {
        try {

        $connection = Container::getConnection('default');

        $connection->connect();

        $result = $connection->query()->where('samaccountname', '=', $user)->first();

        if(is_null($result)){
            return null;
        }

        $nameExplode = explode(' ', $result['name'][0]);
        $firtsName = Arr::first($nameExplode);
        $lastName = Arr::last($nameExplode);

        // return ;
        if($connection->auth()->attempt($result['distinguishedname'][0], $password)){
            return [
                'user' => $firtsName.' '.$lastName,
                'connect' => true,
                'description' => $result['description'][0]
            ];
        }else{
            return false;
        }

        } catch (\LdapRecord\Auth\BindException $e) {
            $error = $e->getDetailedError()->getDiagnosticMessage();

            return null;
        }

    }

}
