<?php

namespace MOHA\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use MOHA\Oferta;
use MOHA\Producto;
use MOHA\User;
use MOHA\Modo;
use MOHA\Cobro;
use MOHA\Puesto;
use MOHA\Medida;
use MOHA\Contraoferta;
use Session;
use Illuminate\Support\Facades\DB;

class OfertasController extends Controller
{
    public function store(Request $request) {

    	DB::beginTransaction();

        try {

            $oferta = new Oferta;

            $oferta->id_op = Auth::user()->id;
            $oferta->id_prod = $request->id_prod;
            $oferta->id_modo = $request->id_modo;
            $oferta->peso = $request->peso;
            $oferta->id_medida = $request->id_medida;
            $oferta->cantidad = $request->cantidad;
            $oferta->cantidadOriginal = $request->cantidad;
            $oferta->precio = $request->precio;
            $oferta->fechaEntrega = $request->fechae;
            $oferta->id_puesto = $request->puesto;
            $oferta->id_cobro = $request->cobro;
            $oferta->plazo = $request->plazo;

            $oferta->save();
            Session::flash('oferta', 'Su Oferta ha sido publicada con éxito!');
            DB::commit();
            
        } catch (\Trowable $e) {
            
            DB::rollback();
            throw $e;
        }
        
    	return back();
    }

    public function misofertas() {

    	$ofertas = Oferta::where('id_op', '=', (Auth::user()->id))->orderBy('fechaEntrega', 'ASC')->paginate(10, ['*'], 'o');
        $cofertas = Contraoferta::join('ofertas', 'contraofertas.id_oferta', '=', 'ofertas.id')
                                        ->where('contraofertas.id_comprador', '=', (Auth::user()->id))
                                        ->orderBy('ofertas.fechaEntrega', 'ASC')
                                        ->paginate(10, array('contraofertas.*'), 'co');
        
    	$productos = Producto::All();
        $modos = Modo::orderBy('descripcion', 'ASC')->get();
        $cobros = Cobro::orderBy('descripcion', 'ASC')->get();
        $puestos = Puesto::orderBy('descripcion', 'ASC')->get();
        $medidas = Medida::orderBy('descripcion', 'ASC')->get();

    	return view('usuario/ofertas', array('ofertas' => $ofertas, 'productos' => $productos, 'modos' => $modos, 'cobros' => $cobros, 'puestos' => $puestos, 'medidas' => $medidas, 'cofertas' => $cofertas));
    }

    public function buscarOfertas(Request $request) {
        
        $hoy = Date('Y-m-j');
        $buscar = $request->buscar;
        $ofertas = Oferta::leftjoin('productos','ofertas.id_prod','=','productos.id')
                            ->leftjoin('users','ofertas.id_op','=','users.id')
                            ->leftjoin('modos','ofertas.id_modo','=','modos.id')
                            ->leftjoin('cobros','ofertas.id_cobro','=','cobros.id')
                            ->leftjoin('puestos','ofertas.id_puesto','=','puestos.id')
                                     ->where('ofertas.cantidad', '>', 0)
                                     ->where('ofertas.abierta', '=', 0)
                                     ->where(function ($query) use ($buscar){
                                        $query->where('productos.nombre', 'like', '%'.ucwords(strtolower($buscar)).'%')
                                        ->orwhere('users.name', 'like', '%'.ucwords(strtolower($buscar)).'%')
                                        ->orwhere('users.apellido', 'like', '%'.ucwords(strtolower($buscar)).'%')
                                        ->orwhere('users.razonsocial', 'like', '%'.ucwords(strtolower($buscar)).'%')
                                        ->orwhere('modos.descripcion', 'like', '%'.ucwords(strtolower($buscar)).'%')
                                        ->orwhere('cobros.descripcion', 'like', '%'.ucwords(strtolower($buscar)).'%')
                                        ->orwhere('puestos.descripcion', 'like', '%'.ucwords(strtolower($buscar)).'%')
                                        ->orwhere('ofertas.fechaEntrega', 'like', '%'.$buscar.'%');
                                     })
                                     ->orderBy('ofertas.fechaEntrega', 'DESC')
                                     ->paginate(10, array('ofertas.*'), 'o');
        
        $ofertasa = Oferta::leftjoin('productos','ofertas.id_prod','=','productos.id')
                            ->leftjoin('users','ofertas.id_op','=','users.id')
                            ->leftjoin('modos','ofertas.id_modo','=','modos.id')
                            ->leftjoin('cobros','ofertas.id_cobro','=','cobros.id')
                            ->leftjoin('puestos','ofertas.id_puesto','=','puestos.id')
                                    ->where('ofertas.cantidad', '>', 0)
                                    ->where('ofertas.abierta', '=', 1)
                                    ->where(function ($query) use ($buscar){
                                        $query->where('productos.nombre', 'like', '%'.ucwords(strtolower($buscar)).'%')
                                        ->orwhere('users.name', 'like', '%'.ucwords(strtolower($buscar)).'%')
                                        ->orwhere('users.apellido', 'like', '%'.ucwords(strtolower($buscar)).'%')
                                        ->orwhere('users.razonsocial', 'like', '%'.ucwords(strtolower($buscar)).'%')
                                        ->orwhere('modos.descripcion', 'like', '%'.ucwords(strtolower($buscar)).'%')
                                        ->orwhere('cobros.descripcion', 'like', '%'.ucwords(strtolower($buscar)).'%')
                                        ->orwhere('puestos.descripcion', 'like', '%'.ucwords(strtolower($buscar)).'%')
                                        ->orwhere('ofertas.fechaEntrega', 'like', '%'.$buscar.'%');
                                    })
                                    ->orderBy('ofertas.fechaEntrega', 'DESC')
                                    ->paginate(10, array('ofertas.*'), 'oa');

        $cobros = Cobro::orderBy('descripcion', 'ASC')->get();
        $puestos = Puesto::orderBy('descripcion', 'ASC')->get();
        
        return view('ofertas', array('ofertas' => $ofertas, 'ofertasa' => $ofertasa, 'cobros' => $cobros, 'puestos' => $puestos));
    }

    public function eliminar(Request $request) {

        DB::beginTransaction();

        try {
            
            $id = $request->id;
            $oferta = Oferta::FindOrFail($id);
            $oferta->delete();

            Session::flash('oferta', 'Su Oferta ha sido eliminada!');
            DB::commit();

        } catch (\Trowable $e) {
            
            DB::rollback();
            throw $e;
        }
        
    	return back();
    }
}
