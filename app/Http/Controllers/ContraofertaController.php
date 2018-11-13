<?php

namespace MOHA\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use MOHA\User;
use MOHA\Contraoferta;
use MOHA\Oferta;
use MOHA\Operacionoferta;
use Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use MOHA\Mail\OfertaAceptada;
use MOHA\Mail\OfertaRechazada;
use MOHA\Mail\ContraOfertaMail;
use MOHA\Mail\ProductosRecibidosMail;


class ContraofertaController extends Controller
{
    public function store(Request $request) {

    	DB::beginTransaction();

        try {
            
            $co = new Contraoferta;

            $co->id_comprador = Auth::user()->id;
            $co->id_oferta = $request->id_oferta;
            $co->cantidad = $request->cantidadCo;
            $co->precio = $request->precioCo;
            $co->id_cobro = $request->cobroCo;
            $co->plazo = $request->plazoCo;
            $co->id_puesto = $request->puestoCo;
            $co->save();

            Mail::to($co->oferta->user->email)->send(new ContraOfertaMail($co));
            Session::flash('contraoferta');

            DB::commit();

        } catch (\Trowable $e) {
            
            DB::rollback();
            throw $e;
        }

        
    	return back();
    }

    public function detalleOferta($id)  {

    	 $cofertas = Contraoferta::where('id_oferta', $id)->get();
    	 $of = Oferta::Find($id);

    	 return view('/usuario/detalleContraOferta', array('cofertas' => $cofertas, 'of' => $of));
    }

    public function aceptarOferta ($id) {

        DB::beginTransaction();

        try {

            $co = Contraoferta::Find($id);
            $of = Oferta::Find($co->id_oferta);

            $cant = $of->cantidad - $co->cantidad;

            $this->actualizarOferta($cant, $co);            
            $this->generarOperacion($co);
            $row = Contraoferta::where('id', $co->id)->update(['estado' => '1']);

            Session::flash('oferta', 'La Oferta ha sido aceptada');
            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();
            throw $e;
        }

        return back();
    }

    public function actualizarOferta($cant, Contraoferta $co) {

        if ($cant >= 0) {
            $rows = Oferta::where('id', $co->id_oferta)->update(['cantidad' => $cant, 'abierta' => true]);            
        }

        return true;
    }

    public function generarOperacion(Contraoferta $co) {
        
        $op = new Operacionoferta;

        $op->id_contra = $co->id;
        $op->fecha = Date('Y-m-j');

        $op->save();

        $user = Auth::user();
        Mail::to($co->user->email)->send(new OfertaAceptada($user, $co));

        return true;
    }

    public function rechazarOferta ($id) {

        DB::beginTransaction();

        try {

            $co = Contraoferta::Find($id);
            $row = Contraoferta::where('id', $co->id)->update(['estado' => '2']);

            Mail::to($co->user->email)->send(new OfertaRechazada($co));
            Session::flash('oferta', 'La Oferta ha sido rechazada');
            DB::commit();
            
        } catch (\Throwable $e) {
            
            DB::rollback();
            throw $e;
        }

        return back();
    }

    public function eliminar($id) {

        try {

            $co = Contraoferta::FindOrFail($id);
            $co->delete();

            Session::flash('oferta', 'Su Contra Oferta ha sido eliminada!');
        } catch (\Throwable $e) {
            
            throw $e;
        }

        return back();
    }

    public function editarCoferta($id) {

        DB::beginTransaction();

        try {

            $co = Contraoferta::Find($id);
            $of = Oferta::Find($co->id_oferta);

            if($co->estado == 1) {
                $row = Contraoferta::where('id', '=', $co->id)->update(['estado' => '3']);
            } else {
                $cant = $of->cantidad - $co->cantidad;

                $this->actualizarOferta($cant, $co);            
                $this->generarOperacion($co);

                $row = Contraoferta::where('id', '=', $co->id)->update(['estado' => '3']);
            }
            
            $user = Auth::user();
           Mail::to($co->oferta->user->email)->send(new ProductosRecibidosMail($co, $user));
            DB::commit();
            
        } catch (\Throwable $e) {
            
            DB::rollback();
            throw $e;
        }

        return back();
    }
}
