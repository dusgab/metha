<?php

namespace MOHA\Http\Controllers;

use Illuminate\Http\Request;
use MOHA\User;
use Illuminate\Support\Facades\Auth;
use MOHA\Producto;
use MOHA\Categoria;
use MOHA\Medida;
use \Chumper\Zipper\Zipper;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activar($id)
    {
        try {

            $user = User::FindOrFail($id);
            $user->activo = 1;
            $user->save();
            
        } catch (\Trowable $e) {
            
            throw $e;
            
        }
        
        return redirect('admin/operadores');

    }

    /**
     * Desactivar usuarios.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function desactivar($id)
    {
        try {

            $user = User::FindOrFail($id);
            $user->activo = 0;
            $user->save();
            
        } catch (\Trowable $e) {
            
            throw $e;
            
        }

        return redirect('admin/operadores');

    }

    public function productos(){
    	
        $productos = Producto::orderBy('nombre', 'ASC')->paginate(15, array('productos.*'), 'p');
        $categorias = Categoria::orderBy('descripcion', 'ASC')->paginate(5, array('categorias.*'), 'c');
        $medidas = Medida::orderBy('descripcion', 'ASC')->paginate(5, array('medidas.*'), 'm');

    	return view('admin/productos', array('productos' => $productos, 'categorias' => $categorias, 'medidas' => $medidas));
    }

    public function nuevoOperador() {
        return view('admin/nuevoOperador');
    }

    public function enviarMail() {
       $this->call('GET','email/nuevoOperador');
        return View('email/nuevoOperador');
    }

    public function pendientes() {

        $hoy = Date('Y-m-j');

        $users = User::leftJoin('ofertas', 'ofertas.id_op', '=', 'users.id')
                            ->join('contraofertas', 'ofertas.id', '=', 'contraofertas.id_oferta')
                            ->where('contraofertas.estado', '=', '0')
                            ->whereDate('ofertas.fechaEntrega', '<', $hoy)
                            ->where('users.pendientes', '=', 0)
                            ->groupBy('users.id')
                            ->groupBy('users.apellido')
                            ->groupBy('users.razonsocial')
                            ->groupBy('users.name')
                            ->groupBy('users.cuit')
                            ->groupBy('users.domicilio')
                            ->groupBy('users.id_ciudad')
                            ->groupBy('users.id_provincia')
                            ->groupBy('users.tipo_us')
                            ->groupBy('users.email')
                            ->groupBy('users.activo')
                            ->groupBy('users.pendientes')
                            ->groupBy('users.password')
                            ->groupBy('users.telefono') 
                            ->groupBy('users.admin')
                            ->groupBy('users.remember_token')
                            ->groupBy('users.created_at')
                            ->groupBy('users.updated_at')
                            ->orderBy('users.apellido', 'users.razonsocial', 'ASC')
                            ->paginate(10, array('users.*'), 'u');
        
        $usersd = User::leftJoin('ofertas', 'ofertas.id_op', '=', 'users.id')
                            ->join('contraofertas', 'ofertas.id', '=', 'contraofertas.id_oferta')
                            ->where('contraofertas.estado', '!=', '0')
                            ->whereDate('ofertas.fechaEntrega', '<', $hoy)
                            ->where('users.pendientes', '=', 1)
                            ->groupBy('users.id')
                            ->groupBy('users.apellido')
                            ->groupBy('users.razonsocial')
                            ->groupBy('users.name')
                            ->groupBy('users.cuit')
                            ->groupBy('users.domicilio')
                            ->groupBy('users.id_ciudad')
                            ->groupBy('users.id_provincia')
                            ->groupBy('users.tipo_us')
                            ->groupBy('users.email')
                            ->groupBy('users.activo')
                            ->groupBy('users.pendientes')
                            ->groupBy('users.password')
                            ->groupBy('users.telefono') 
                            ->groupBy('users.admin')
                            ->groupBy('users.remember_token')
                            ->groupBy('users.created_at')
                            ->groupBy('users.updated_at')
                            ->orderBy('users.apellido', 'users.razonsocial', 'ASC')
                            ->paginate(10, array('users.*'), 'ud');

        return view('admin/pendientes', array('users' => $users, 'usersd' => $usersd));

    }
    
    public function pendientesActivar($id) {

        $row = User::where('id', '=', $id)->Update(['pendientes' => 0]);

        return back();
    }

    public function pendientesDesactivar($id) {
        
        $row = User::where('id', '=', $id)->Update(['pendientes' => 1]);

        return back();
    }
}
