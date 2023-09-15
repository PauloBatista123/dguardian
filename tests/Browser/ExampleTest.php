<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     */
    public function testLoginArea(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('https://login.microsoftonline.com/common/oauth2/v2.0/authorize?client_id=4765445b-32c6-49b0-83e6-1d93765276ca&redirect_uri=https%3A%2F%2Fwww.office.com%2Flandingv2&response_type=code%20id_token&scope=openid%20profile%20https%3A%2F%2Fwww.office.com%2Fv2%2FOfficeHome.All&response_mode=form_post&nonce=638303940280156855.ODM4OWY1NjktMzEyNC00NmU3LTllYzctZDQxODEyYzI1MDY0YzRmNjUzNzgtOGVlNy00NjRkLWFiMzQtZmRkM2MyMGQ0NTVj&ui_locales=pt-BR&mkt=pt-BR&state=mxo8p_VlSWt1NLG6Uz7_qZPRiXoSXIGnPMBk4nNYzz4O8EylfT1XHnYnptOEn5zumTfpj9g248Ka30ofGle5rWidlEQTRoqQ59_jcEUIztxSLWYDJ_c9Cdy4WMvXDKM5yr88YLStd67oDozotEMwoDctIzd32tKGQLUbgncsi-FANGgzRtGGFimQgVXYCB8kMV-KDmg7YQQyFSoJve8HBuNUZ-3JdGFL-i-P8auxLSiJSLXKUSEN-hl76mSk39YOBkKo6szvgErPwVmzRqPbEQ&x-client-SKU=ID_NET6_0&x-client-ver=6.30.1.0')
                    ->screenshot('loginVisit')
                    ->waitForTextIn('#lightbox > div:nth-child(3) > div > div > div > div:nth-child(1)', 'Entrar')
                    ->screenshot('login')
                    ->type('loginfmt', 'paulo.habatista@sicoob.com.br')
                    ->screenshot('email')
                    ->assertInputValue('loginfmt', 'paulo.habatista@sicoob.com.br')
                    ->press('#idSIButton9')
                    ->screenshot('insiraSenha')
                    ->waitFor('#loginHeader > div')
                    ->screenshot('aguardandoSenha')
                    ->waitForTextIn('#loginHeader > div', 'Insira sua senha')
                    ->assertInputPresent('passwd');
        });
    }

}
