<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ResetPasswordTest extends TestCase
{
    public function testClickReset()
    {
        $this->visit('/login')
                ->see('Olvidó su contraseña?')
                ->click('resetpass')
                ->seePageIs('/password/reset')
                ->see('Correo Electrónico')
                ->see('Enviar el enlace para recuperar la contraseña');
    }

    /*public function testSendReset()
    {
        $this->visit('/password/reset')
                ->see('Correo Electrónico')
                ->type('dgabrielg_06@hotmail.com', 'email')
                ->press('reset')
                ->seePageIs('/password/reset')
                ->see('¡Te hemos enviado por correo el enlace para restablecer tu contraseña!');
    }*/
}
