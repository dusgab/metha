@extends('layouts.principal')

@section('content')
    
    @guest
        <center><h4>Debe Registrarse para Acceder a esta sección</h4></center>
    @else
    <div class="page-header">
            <h1 class="text-center">Precios <small>Referencia de los distintos precios ofrecidos, demandados y de otros mercados</small></h1></div>
        <div class="row precios">
            <div class="col-md-6">
                <h1 class="h1-tabla">Precios Ofrecidos</h1>
                <h5 class="text-center">Seleccione un intervalo de fechas para filtrar los Precios de los Productos</h5>
                <div class="row">
                <div id="imaginary_container"> 
                    <form class="form-horizontal" method="GET" action="{{ url('/precios') }}">
                        <div class="col-md-6 fecha">
                        <input type="text" class="form-control fecha" name="buscar" placeholder="Buscar Producto" onfocus="this.placeholder=''" onblur="this.placeholder='Buscar Producto'">
                        <input placeholder="Desde" onfocus="(this.type='date')" type="text" class="form-control fecha" onblur="if(this.value==''){this.type='text'}" id="fechai" name="fechai" value="">                        
                        <input placeholder="Hasta" onfocus="(this.type='date')" type="text" class="form-control fecha" onblur="if(this.value==''){this.type='text'}" id="fechaf" name="fechaf" value="" disabled="true">
                        <button type="submit" class="lupa" id="lupa">
                            <span class="glyphicon glyphicon-search lupa"></span>
                        </button>
                        </div>
                    </form>
                </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Producto </th>
                                <th>Min </th>
                                <th>Medio </th>
                                <th>Max </th>
                                <th style="cursor:default;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <form id="graficarPrecios" class="form-horizontal" method="GET" action="{{ url('/precios') }}">
                                <input type="hidden" id="fechaDesde" name="fechaDesde" value="{{$fechaDes}}">
                                <input type="hidden" id="fechaHasta" name="fechaHasta" value="{{$fechaHas}}">
                            @foreach($precioso as $pr)
                            <tr>
                                <input type="hidden" id="prod_id" name="prod_id" value="{{$pr->id}}">
                                <td>{{$pr->nombre}} </td>
                                <td>$ {{$pr->min}} </td>
                                <td>$ {{$pr->prom}} </td>
                                <td>$ {{$pr->max}} </td>
                            <td><a type="button" id="btnGraf" onclick="graficar({{$pr->id}},'{{$pr->nombre}}','{{$fechaDes}}','{{$fechaHas}}')"><img class="icono-grafico" src="{{url('recursos/images/graficos24.png')}}"/a></td>
                            </tr>
                            @endforeach
                            </form>
                        </tbody>
                    </table>
                    {!! $precioso->appends(array_except(Request::query(), 'po'))->links() !!}
                </div>
            </div>
            <div class="col-md-6">
                <h1 class="h1-tabla">Precios del Día</h1>
                <h5 class="text-center">Seleccione un día para ver los precios de cada Producto</h5>
                <div class="row">
                <div id="imaginary_container"> 
                    <form class="form-horizontal" method="GET" action="{{ url('/precios') }}">
                        <div class="col-md-6 fecha">
                        <input type="text" class="form-control fecha" name="buscar" placeholder="Buscar Producto" onfocus="this.placeholder=''" onblur="this.placeholder='Buscar Producto'">
                        <input placeholder="Seleccione un Día" onfocus="(this.type='date')" class="form-control fecha" type="text" class="form-control precioDia" onblur="if(this.value==''){this.type='text'}" name="precioDia" value="">
                        <button type="submit" class="lupa" id="lupa">
                            <span type"submit" class="glyphicon glyphicon-search lupa"></span>
                        </button>
                        </div>
                    </form>
                </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Producto </th>
                                <th>Min </th>
                                <th>Medio </th>
                                <th>Max </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($preciosd as $pr)
                            <tr>
                                <td>{{$pr->nombre}} </td>
                                <td>$ {{$pr->min}} </td>
                                <td>$ {{$pr->prom}} </td>
                                <td>$ {{$pr->max}} </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $preciosd->appends(array_except(Request::query(), 'pd'))->links() !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h1 class="h1-tabla">Principales Mercados</h1>
                <h5 class="text-center">Enlaces a los Sitios de los Principales Mercados de Argentina y la Región</h5>
                <div class="table-responsive admin">
                    <table class="table enlaces">
                        <thead>
                            <tr>
                                <th class="enlaces"><a href="http://www.mercadocentral.gob.ar/servicios/precios-y-volumenes/precios-mayoristas" class="links"> Mercado de Buenos Aires </a></th>
                            </tr>
                            <tr>
                                <th class="enlaces"><a href="https://mercacordoba.es/mercado-de-frutas-y-verduras">Mercado de Córdoba </a></th>
                            </tr>
                            <tr>
                                <th class="enlaces"><a href="http://www.mprosario.com.ar/">Mercado de Rosario</a></th>
                            </tr>
                            <tr>
                                <th class="enlaces"><a href="http://www.cooperativah.com.ar/">Cooperativa de Horticultores de Bahía Blanca</a></th>
                            </tr>
                            <tr>
                                <th class="enlaces"><a href="http://mercadoproductoressantafe.com/">Mercado de Santa Fé</a></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <h1 class="h1-tabla">Tendencias de Precios</h1>
                <h5 class="text-center">Precios de Productos en base a Mercado destino Buenos Aires</h5>
                <div class="row">
                <div id="imaginary_container"> 
                    <form class="form-horizontal" method="GET" action="{{ url('/precios') }}">
                        <div class="col-md-6 fecha">
                        <input type="text" class="form-control fecha" name="buscar" placeholder="Buscar Producto" onfocus="this.placeholder=''" onblur="this.placeholder='Buscar Producto'">
                        <input placeholder="Seleccione un Día" onfocus="(this.type='date')" class="form-control fecha" type="text" class="form-control precioDia" onblur="if(this.value==''){this.type='text'}" name="preciot" value="">
                        <button type="submit" class="lupa" id="lupa">
                            <span class="glyphicon glyphicon-search lupa"></span>
                        </button>
                        </div>
                    </form>
                </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Producto </th>
                                <th>Min </th>
                                <th>Medio </th>
                                <th>Max </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($preciost as $pr)
                            <tr>
                                <td>{{$pr->nombre}} </td>
                                <td>$ {{$pr->min}} </td>
                                <td>$ {{$pr->prom}} </td>
                                <td>$ {{$pr->max}} </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $preciost->appends(array_except(Request::query(), 'tp'))->links() !!}
                </div>
            </div>
        </div>
    </div>
    @endguest
    <hr>
<a type="button" href="{{ url('/') }}" class="btn btn-primary admin" title="Volver">Volver</a>
@stop