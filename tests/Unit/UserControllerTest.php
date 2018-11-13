<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testEditarPerfil()
    {
        $this->visit('/usuario/show/2')
        			->see('Actualizar')
        			->see('Volver');
    }
}
