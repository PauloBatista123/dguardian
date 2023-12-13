<?php
namespace App\Http\Services;

use Error;
use Exception;
use Illuminate\Support\Arr;
use LdapRecord\Auth\BindException;
use LdapRecord\Container;
use LdapRecord\LdapRecordException;
use LdapRecord\Models\ActiveDirectory\User;
use LdapRecord\Models\Attributes\AccountControl;

Class LdapService{

  /**
   * Default Responses.
   *
   * @return void
   */

   private $connection;

   public function __construct()
   {
        $connection = Container::getConnection('default');

        try{
            $connection->connect();
        }catch(Exception $e){
            abort(500, 'Não conseguimos conectar ao LDAP, contate o administrador');
        }

        $this->connection = $connection;
   }

    public function connect($user = null, $password = null)
    {
        try {

        $result = $this->getUserObject($user);

        if(is_null($result)){
            return null;
        }

        $this->validatePropertiesUser($result);

        $nameExplode = explode(' ', $result['name'][0]);
        $firtsName = Arr::first($nameExplode);
        $lastName = Arr::last($nameExplode);
        $mail = $result['mail'][0];
        $cpf = $result['physicaldeliveryofficename'][0];

        // return ;
        if($this->connection->auth()->attempt($result['distinguishedname'][0], $password)){
            return [
                'user' => $firtsName.' '.$lastName,
                'connect' => true,
                'description' => $result['description'][0],
                'email' => $mail,
                'cpf' => $cpf
            ];
        }else{
            return false;
        }

        } catch (\LdapRecord\Auth\BindException $e) {
            $error = $e->getDetailedError()->getDiagnosticMessage();

            return $error;
        }

    }

    public function validatePropertiesUser($result)
    {
        if(!array_key_exists('mail', $result)){
            throw new Error('O usuário não possui email cadastrado no LDAP (mail)');
        }

        if(!array_key_exists('physicaldeliveryofficename', $result)){
            throw new Error('O usuário não possui CPF cadastrado no LDAP (physicaldeliveryofficename)');
        }

        if(!array_key_exists('name', $result)){
            throw new Error('O usuário não possui Nome cadastrado no LDAP (name)');
        }

        if(!array_key_exists('description', $result)){
            throw new Error('O usuário não possui Função cadastrado no LDAP (description)');
        }
    }

    public function getUserObject(string $user)
    {
        return $this->connection->query()->where('samaccountname', '=', $user)->first();
    }

    public function disableAccount(string $user): string
    {
        try{
            $result = $this->getUserObject($user);

            $userAd = User::find($result['distinguishedname'][0]);


            if($userAd->isEnabled()){
                $acc = new AccountControl();

                $acc->setAccountIsDisabled();
                $acc->setAccountIsNormal();

                $userAd->userAccountControl = $acc;

                $userAd->save();

                return 'Desabilitado com sucesso';
            }

            return 'Não concluido!';

        }catch (\LdapRecord\LdapRecordException $ex) {
            // Failed changing password. Get the last LDAP
            // error to determine the cause of failure.
            $error = $ex->getDetailedError();

            return $error->getErrorMessage();
        }

    }

    public function enableAccount(string $user): string
    {
        try{
            $result = $this->getUserObject($user);

            $userAd = User::find($result['distinguishedname'][0]);


            if($userAd->isDisabled()){
                $acc = new AccountControl();

                $acc->setAccountIsNormal();

                $userAd->userAccountControl = $acc;

                $userAd->save();

                return 'Habilitado com sucesso';
            }

            return 'Não concluido!';

        }catch (\LdapRecord\LdapRecordException $ex) {
            // Failed changing password. Get the last LDAP
            // error to determine the cause of failure.
            $error = $ex->getDetailedError();

            return $error->getErrorMessage();
        }

    }

    public function resetPassword(string $user): string
    {

        $result = $this->getUserObject($user);

        $userAd = User::find($result['distinguishedname'][0]);

        if($userAd->isEnabled()){
            $userAd->unicodepwd = 'Sicoob@aracoop01';

            try{
                $userAd->save();

                return 'Resetado com sucesso';

            } catch (LdapRecordException $ex) {
                // The currently bound LDAP user does not
                // have permission to reset passwords.
                $error = $ex->getDetailedError();

                return $error->getErrorMessage();

            }catch (Exception $ex) {

                dd($ex);
            }

        }

        return 'Usuário não pode estar Bloqueado!';

    }

}
