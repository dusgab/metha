<?php

namespace MOHA\Http\Controllers;

use Illuminate\Http\Request;
use MOHA\Producto;
use MOHA\Categoria;
use MOHA\Medida;
use MOHA\Cobro;
use MOHA\Puesto;
use MOHA\Modo;
use Session;


class ProductoController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeProd(Request $request)
    {
        $prod = new Producto();
        $prod->nombre = ucwords(strtolower($request->nombre));
        $prod->descripcion = ucwords($request->descripcion);
        $prod->descripcion2 = ucwords($request->descripcion2);
        $prod->id_cat = $request->id_cat;
        $prod->save();
        Session::flash('mensaje', 'Producto agregado!');
        return back();
    }

    public function storeCat(Request $request)
    {
        $this->validate($request, [
        'descripcion' => 'required|unique:categorias|max:255',
        ]);

        $cat = new Categoria();
        $cat->descripcion = ucwords(strtolower($request->descripcion));
        $cat->save();
        Session::flash('mensaje', 'Categoría agregada!');
        return back();
    }

    public function storeMed(Request $request)
    {
        $this->validate($request, [
        'descripcion' => 'required|unique:medidas|max:255',
        ]);

        $med = new Medida();
        $med->descripcion = ucwords(strtolower($request->descripcion));
        $med->save();
        Session::flash('mensaje', 'Medida agregada!');
        return back();;
    }

    public function storeCobro(Request $request)
    {
        $this->validate($request, [
        'descripcion' => 'required|unique:cobros|max:255',
        ]);

        $cob = new Cobro();
        $cob->descripcion = ucwords(strtolower($request->descripcion));
        $cob->save();
        Session::flash('cobro', 'Cobro agregado!');
        return back();
    }

    public function storePuesto(Request $request)
    {
        $this->validate($request, [
        'descripcion' => 'required|unique:puestos|max:255',
        ]);

        $pue = new Puesto();
        $pue->descripcion = ucwords(strtolower($request->descripcion));
        $pue->save();
        Session::flash('puesto', 'Puesto agregado!');
        return back();
    }

    public function storeModo(Request $request)
    {
        $this->validate($request, [
        'descripcion' => 'required|unique:modos|max:255',
        ]);

        $mod = new Modo();
        $mod->descripcion = ucwords(strtolower($request->descripcion));
        $mod->save();
        Session::flash('modo', 'Modo agregado!');
        return back();
    }

    public function editar(Request $request)
    {
        $id = $request->idProd;
        $nombre = ucwords(strtolower($request->nombre));
        $descripcion = ucwords(strtolower($request->descripcion));
        $descripcion2 = ucwords(strtolower($request->descripcion2));
        $id_cat = $request->idcat;
        
        $prod = Producto::where('id', '=', $id)->update(['nombre' => $nombre, 'descripcion' => $descripcion, 'descripcion2' => $descripcion2, 'id_cat' => $id_cat]);
        Session::flash('mensaje', 'Producto editado!');
        return back();
    }

    public function editarModo(Request $request)
    {
        $id = $request->idModo;
        $desc = ucwords(strtolower($request->descripcion));
        $mod = Modo::where('id', $id)->update(['descripcion' => $desc]);
        Session::flash('modo', 'Modo editado!');
        return back();
    }

    public function editarPuesto(Request $request)
    {
        $id = $request->idPuesto;
        $desc = ucwords(strtolower($request->descripcion));
        $puesto = Puesto::where('id', $id)->update(['descripcion' => $desc]);
        Session::flash('puesto', 'Puesto editado!');
        return back();
    }

    public function editarCat(Request $request)
    {
        $id = $request->idCat;
        $desc = ucwords(strtolower($request->descripcion));
        $cat = Categoria::where('id', $id)->update(['descripcion' => $desc]);
        Session::flash('mensaje', 'Categoría editada!');
        return back();
    }

    public function editarMedida(Request $request)
    {
        $id = $request->idMed;
        $desc = ucwords(strtolower($request->descripcion));
        $med = Medida::where('id', $id)->update(['descripcion' => $desc]);
        Session::flash('medida', 'Medida editada!');
        return back();
    }

    public function editarCobro(Request $request)
    {
        $id = $request->idCobro;
        $desc = ucwords(strtolower($request->descripcion));
        $cob = Cobro::where('id', $id)->update(['descripcion' => $desc]);
        Session::flash('cobro', 'Cobro editado!');
        return back();
    }
}
