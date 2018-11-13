<?php

namespace MOHA\Http\Controllers;

use Illuminate\Http\Request;
use MOHA\User;
use MOHA\Modo;
use MOHA\Cobro;
use MOHA\Puesto;
use Auth;

class PaginasController extends Controller
{
    public function index () {
		return view('index');
	}

	public function cobros () {
		
		$cobros = Cobro::orderBy('descripcion', 'ASC')->paginate(5, array('cobros.*'), 'c');

		return view('admin/datos/cobros', array('cobros' => $cobros));
	}

	public function modos () {

		$modos = Modo::orderBy('descripcion', 'ASC')->paginate(5, array('modos.*'), 'm');

		return view('admin/datos/modos', array('modos' => $modos));
	}

	public function puestos () {

		$puestos = Puesto::orderBy('descripcion', 'ASC')->paginate(5, array('puestos.*'), 'p');

		return view('admin/datos/puestos', array('puestos' => $puestos));
	}
}

