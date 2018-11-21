<?php

namespace MOHA\Http\Controllers;

use Illuminate\Http\Request;
use MOHA\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('usuario/perfil', array('user' => $user));
    }

    public function buscarOperadores(Request $request) {
        $buscar = $request->buscar;
        $buscar2 = $request->usuarios;

        if (!empty($buscar2)) {
            $usersa = User::where('id', '!=', Auth::id())->where('id', '!=', 2)->where('activo', '=', 1)
                            ->where(function($q) use ($buscar) {
                                $q->where('apellido', 'like', '%'.ucwords(strtolower($buscar)).'%')
                                ->orwhere('email', 'like', '%'.$buscar.'%')
                                ->orwhere('cuit', 'like', '%'.$buscar.'%')
                                ->orwhere('email', 'like', '%'.$buscar.'%')
                                ->orwhere('telefono', 'like', '%'.$buscar.'%')
                                ->orwhere('razonsocial', 'like', '%'.$buscar.'%')
                                ->orwhere('domicilio', 'like', '%'.$buscar.'%')
                                ->orwhere('registro', 'like', '%'.$buscar.'%')
                                ->orwhere('name', 'like', '%'.ucwords(strtolower($buscar)).'%')->get();
                            })
                            ->where(function($q) use ($buscar2) {
                            $q->whereIn('tipo_us', $buscar2)->get();
                            })
                            ->orderBy('apellido', 'razonsocial', 'ASC')->paginate(10, array('users.*'), 'a');
            
            $usersi = User::where('id', '!=', Auth::id())->where('id', '!=', 2)->where('activo', '=', 0)
                            ->where(function($q) use ($buscar) {
                                $q->where('apellido', 'like', '%'.ucwords(strtolower($buscar)).'%')
                                ->orwhere('email', 'like', '%'.$buscar.'%')
                                ->orwhere('cuit', 'like', '%'.$buscar.'%')
                                ->orwhere('email', 'like', '%'.$buscar.'%')
                                ->orwhere('telefono', 'like', '%'.$buscar.'%')
                                ->orwhere('razonsocial', 'like', '%'.$buscar.'%')
                                ->orwhere('domicilio', 'like', '%'.$buscar.'%')
                                ->orwhere('registro', 'like', '%'.$buscar.'%')
                                ->orwhere('name', 'like', '%'.ucwords(strtolower($buscar)).'%')->get();
                            })
                            ->where(function($q) use ($buscar2) {
                            $q->whereIn('tipo_us', $buscar2)->get();
                            })
                            ->orderBy('apellido', 'razonsocial', 'ASC')->paginate(10, array('users.*'), 'i');
        }
        else {
            $usersa = User::where('id', '!=', Auth::id())->where('id', '!=', 2)->where('activo', '=', 1)
                            ->where(function($q) use ($buscar) {
                                $q->where('apellido', 'like', '%'.ucwords(strtolower($buscar)).'%')
                                ->orwhere('email', 'like', '%'.$buscar.'%')
                                ->orwhere('cuit', 'like', '%'.$buscar.'%')
                                ->orwhere('email', 'like', '%'.$buscar.'%')
                                ->orwhere('telefono', 'like', '%'.$buscar.'%')
                                ->orwhere('razonsocial', 'like', '%'.$buscar.'%')
                                ->orwhere('domicilio', 'like', '%'.$buscar.'%')
                                ->orwhere('registro', 'like', '%'.$buscar.'%')
                                ->orwhere('name', 'like', '%'.ucwords(strtolower($buscar)).'%')->get();
                            })
                            ->orderBy('apellido', 'razonsocial', 'ASC')->paginate(10, array('users.*'), 'a');

            $usersi = User::where('id', '!=', Auth::id())->where('id', '!=', 2)->where('activo', '=', 0)
                            ->where(function($q) use ($buscar) {
                                $q->where('apellido', 'like', '%'.ucwords(strtolower($buscar)).'%')
                                ->orwhere('email', 'like', '%'.$buscar.'%')
                                ->orwhere('cuit', 'like', '%'.$buscar.'%')
                                ->orwhere('email', 'like', '%'.$buscar.'%')
                                ->orwhere('telefono', 'like', '%'.$buscar.'%')
                                ->orwhere('razonsocial', 'like', '%'.$buscar.'%')
                                ->orwhere('domicilio', 'like', '%'.$buscar.'%')
                                ->orwhere('registro', 'like', '%'.$buscar.'%')
                                ->orwhere('name', 'like', '%'.ucwords(strtolower($buscar)).'%')->get();
                            })
                            ->orderBy('apellido', 'razonsocial', 'ASC')->paginate(10, array('users.*'), 'i');
        }
        return view('/admin/operadores', array('usersa' => $usersa, 'usersi' => $usersi));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editarPerfil(Request $request)
    {
        $user = User::FindOrFail(Auth::user()->id);
        $user->name = $request->name;
        $user->apellido = $request->apellido;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->domicilio = $request->domicilio;
        $user->telefono = $request->telefono;

        $user->save();

        Session::flash('message','Datos actualizados correctamente.');

        return redirect('/usuario/show/{Auth::user()->id}');
    }

}
