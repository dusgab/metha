<?php

namespace MOHA\Http\Controllers;

use Illuminate\Http\Request;
use MOHA\Demanda;
use MOHA\Contrademanda;
use MOHA\Producto;
use Auth;
use MOHA\User;
use MOHA\Modo;
use MOHA\Cobro;
use MOHA\Puesto;
use MOHA\Medida;
use Session;
use Illuminate\Support\Facades\DB;

class DemandasController extends Controller
{
    public function store(Request $request) {

    	DB::beginTransaction();

        try {

            $demanda = new Demanda;

            $demanda->id_op = Auth::user()->id;
            $demanda->id_prod = $request->id_prod;
            $demanda->id_modo = $request->id_modo;
            $demanda->peso = $request->peso;
            $demanda->id_medida = $request->id_medida;
            $demanda->cantidad = $request->cantidad;
            $demanda->cantidadOriginal = $request->cantidad;
            $demanda->precio = $request->precio;
            $demanda->fechaEntrega = $request->fechae;
            $demanda->id_puesto = $request->puesto;
            $demanda->id_cobro = $request->cobro;
            $demanda->plazo = $request->plazo;

            $demanda->save();
            Session::flash('demanda', 'Su Demanda ha sido publicada con éxito!');
            DB::commit();
            
        } catch (\Trowable $e) {
            
            DB::rollback();
            throw $e;
        }
        
        return back();
    }

    public function misdemandas() {

    	$demandas = Demanda::where('id_op', '=', (Auth::user()->id))->orderBy('fechaEntrega', 'ASC')->paginate(10, array('demandas.*'), 'd');
        $cdemandas = Contrademanda::leftJoin('demandas', 'contrademandas.id_demanda', '=', 'demandas.id')
                                        ->where('contrademandas.id_comprador', '=', (Auth::user()->id))
                                        ->orderBy('demandas.fechaEntrega', 'ASC')
                                        ->paginate(10, array('contrademandas.*'), 'cd');

        $productos = Producto::All();
        $modos = Modo::orderBy('descripcion', 'ASC')->get();
        $cobros = Cobro::orderBy('descripcion', 'ASC')->get();
        $puestos = Puesto::orderBy('descripcion', 'ASC')->get();
        $medidas = Medida::orderBy('descripcion', 'ASC')->get();
        
        return view('usuario/demandas', array('demandas' => $demandas, 'productos' => $productos, 'modos' => $modos, 'cobros' => $cobros, 'puestos' => $puestos, 'medidas' => $medidas, 'cdemandas' => $cdemandas));
    }

    public function buscarDemandas(Request $request) {
        $hoy = Date('Y-m-j');
        $buscar = $request->buscar;
        $demandas = Demanda::leftjoin('productos','demandas.id_prod','=','productos.id')
                            ->leftjoin('users','demandas.id_op','=','users.id')
                            ->leftjoin('modos','demandas.id_modo','=','modos.id')
                            ->leftjoin('cobros','demandas.id_cobro','=','cobros.id')
                            ->leftjoin('puestos','demandas.id_puesto','=','puestos.id')
                                     ->where('demandas.abierta', '=', 0)
                                     ->where('demandas.cantidad', '>', 0)
                                     ->where(function ($query) use ($buscar){
                                        $query->where('productos.nombre', 'like', '%'.ucwords(strtolower($buscar)).'%')
                                        ->orwhere('users.name', 'like', '%'.ucwords(strtolower($buscar)).'%')
                                        ->orwhere('users.apellido', 'like', '%'.ucwords(strtolower($buscar)).'%')
                                        ->orwhere('users.razonsocial', 'like', '%'.ucwords(strtolower($buscar)).'%')
                                        ->orwhere('modos.descripcion', 'like', '%'.ucwords(strtolower($buscar)).'%')
                                        ->orwhere('cobros.descripcion', 'like', '%'.ucwords(strtolower($buscar)).'%')
                                        ->orwhere('puestos.descripcion', 'like', '%'.ucwords(strtolower($buscar)).'%')
                                        ->orwhere('demandas.fechaEntrega', 'like', '%'.$buscar.'%');
                                     })
                                     ->orderBy('demandas.fechaEntrega', 'ASC')
                                     ->paginate(10, array('demandas.*'), 'd');
                                     
        $demandasa = Demanda::leftjoin('productos','demandas.id_prod','=','productos.id')
                            ->leftjoin('users','demandas.id_op','=','users.id')
                            ->leftjoin('modos','demandas.id_modo','=','modos.id')
                            ->leftjoin('cobros','demandas.id_cobro','=','cobros.id')
                            ->leftjoin('puestos','demandas.id_puesto','=','puestos.id')
                                    ->where('demandas.abierta', '=', 1)
                                    ->where('demandas.cantidad', '>', 0)
                                    ->where(function ($query) use ($buscar){
                                        $query->where('productos.nombre', 'like', '%'.ucwords(strtolower($buscar)).'%')
                                        ->orwhere('users.name', 'like', '%'.ucwords(strtolower($buscar)).'%')
                                        ->orwhere('users.apellido', 'like', '%'.ucwords(strtolower($buscar)).'%')
                                        ->orwhere('users.razonsocial', 'like', '%'.ucwords(strtolower($buscar)).'%')
                                        ->orwhere('modos.descripcion', 'like', '%'.ucwords(strtolower($buscar)).'%')
                                        ->orwhere('cobros.descripcion', 'like', '%'.ucwords(strtolower($buscar)).'%')
                                        ->orwhere('puestos.descripcion', 'like', '%'.ucwords(strtolower($buscar)).'%')
                                        ->orwhere('demandas.fechaEntrega', 'like', '%'.$buscar.'%');
                                    })
                                    ->orderBy('demandas.fechaEntrega', 'ASC')
                                    ->paginate(10, array('demandas.*'), 'da');
        
            $cobros = Cobro::orderBy('descripcion', 'ASC')->get();
            $puestos = Puesto::orderBy('descripcion', 'ASC')->get();
        
        return view('demandas', array('demandas' => $demandas, 'demandasa' => $demandasa, 'cobros' => $cobros, 'puestos' => $puestos));
    }

    public function eliminar(Request $request) {

    	$id = $request->id;
        $demanda = Demanda::FindOrFail($id);
        $demanda->delete();

        Session::flash('demanda', 'Su Demanda ha sido eliminada!');
    	return back();
    }
}
