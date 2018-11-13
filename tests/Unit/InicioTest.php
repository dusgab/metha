<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Auth;

class InicioTest extends TestCase
{

    public function testLoginIncorrect()
    {
	    $this->visit('/login')
            ->type('dgabrielg_06@hotmail.com', 'email')
            ->type('123456789', 'password')
            ->press('ingresar')
            ->seePageIs('/login')
            ->see('Los datos ingresados no son correctos.');
	}

	public function testLoginCorrecto()
	{

    	$this->visit('/login')
            ->type('dgabrielg_06@hotmail.com', 'email')
            ->type('123456', 'password')
            ->press('ingresar')
            ->seePageIs('/index')
            ->see(Auth::user()->name);
	}

	public function testLoginCorrectoAdmin()
	{

    	$this->visit('/login')
	        ->type('admin@admin.com', 'email')
	        ->type('admin', 'password')
	        ->press('ingresar')            
	        ->see('Administrador');
	}
}
