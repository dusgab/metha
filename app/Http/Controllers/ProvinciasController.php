<?php

namespace MOHA\Http\Controllers;

use Illuminate\Http\Request;
use MOHA\Provincia;
use MOHA\Ciudad;

class ProvinciasController extends Controller
{
    
    public function getCiudades(Request $request, $id) {

    	if($request->ajax()) {
    		$ciudades = Ciudad::getCiudades($id);
    		return response()->json($ciudades);
    	}
    }
}
