@extends('layouts.principal')

@section('content')

@if(Session::has('demanda'))
  <div class="alert alert-success alert-dismissible fade in" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>{{Session::get('demanda')}}</strong>
  </div>
@endif
	<center><h3>Detalle de Contra Demanda</h3></center>
@if(empty($cdemandas))
	<center><h4>La Demanda no posee ninguna Orden de Venta</h4></center> 
@else
<div class="row">
	<div class="col-md-12">
        <h1 class="h1-tabla">Mi Demanda</h1>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Modo</th>
                        <th>Cant. Original</th>
                        <th>Cant. Disponible</th>
                        <th>Precio</th>
                        <th>Fecha Entrega</th>
                        <th>Puesto</th>
                        <th>Cobro</th>
                        <th>Plazo (días)</th>
                    </tr>
                </thead>
                   <tbody>
                       <tr>
                         <input type="hidden" name="id" value="{{$dem->id}}">
                       	<td>{{$dem->producto->nombre}} {{$dem->producto->descripcion}} {{$dem->producto->descripcion2}}</td>
                        <td>{{$dem->modo->descripcion}} X {{$dem->peso}} {{$dem->medida->descripcion}}</td>
                        <td>{{$dem->cantidadOriginal}}</td>
                        <td>{{$dem->cantidad}}</td>
                       	<td>$ {{$dem->precio}}</td>
                       	<td>{{$dem->fechaEntrega}}</td>
                       	<td>{{$dem->puesto->descripcion}}</td>
                       	<td>{{$dem->cobro->descripcion}}</td>
                        <td>{{$dem->plazo}}</td>
                       </tr>
                   </tbody>
            </table>
        </div>
	</div>
	</div>
	<hr>
	<div class="row">
    <div class="col-md-6">
        <h1 class="h1-tabla">Ordenes de Ventas (Contra Demandas)</h1>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Vendedor</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Cobro</th>
                        <th>Plazo (días)</th>
                        <th style="cursor:default;"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($cdemandas as $cd)
                   <tr> 
                   	@if($cd->user->razonsocial == '')
                    <td>{{$cd->user->apellido}} {{$cd->user->name}}</td>
                    @else
                    <td>{{$cd->user->razonsocial}}</td>
                    @endif
                   	<td>{{$cd->cantidad}}</td>
                    <td>$ {{$cd->precio}}</td>
                    <td>{{$cd->cobro->descripcion}}</td>
                    <td>{{$cd->plazo}}</td>
                    @if($dem->cantidad < $cd->cantidad)
                     	<td><a type="button" href="/usuario/aceptarDemanda/{{$cd->id}}" class="btn btn-success admin tabla" title="La cantidad disponible no es suficiente" disabled>Aceptar</a><br><a type="button" href="/usuario/rechazarDemanda/{{$cd->id}}" class="btn btn-danger admin tabla" title="Rechazar Contra Demanda">Rechazar</a></td>
                    @else
                      <td><a type="button" href="/usuario/aceptarDemanda/{{$cd->id}}" class="btn btn-success admin tabla" title="Aceptar Contra Demanda">Aceptar</a><br><a type="button" href="/usuario/rechazarDemanda/{{$cd->id}}" class="btn btn-danger admin tabla" title="Rechazar Contra Demanda">Rechazar</a></td>
                    @endif
                   </tr>
               @endforeach
               </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-6">
        <h1 class="h1-tabla">Ordenes de Ventas Aceptadas</h1>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                      <th>Recibido</th>
                      <th>Vendedor</th>
                      <th>Cantidad</th>
                      <th>Precio</th>
                      <th>Cobro</th>
                      <th>Plazo (días)</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($cdacep as $cda)
                     <tr>
                      <form class="form-horizontal" id="editarCdemanda" name="editarCdemanda" method="GET" action="">
                      {{ csrf_field() }}
                      <input type="hidden" name="id" value="{{$cda->id}}">
                      @if($cda->estado == 1)
                        <td><input type="checkbox" name="recibido" value="3" onclick="confirmarDem('/usuario/editarCdemanda/{{$cda->id}}')" title="Seleccione cuando haya recibido los Productos"></td>
                      @elseif($cda->estado == 3)
                        <td><input type="checkbox" name="recibido" value="3" title="Los Productos ya fueron recibidos" checked disabled></td>
                      @endif
                      </form>
                      @if($cda->user->razonsocial == '')
                      <td>{{$cda->user->apellido}} {{$cda->user->name}}</td>
                      @else
                      <td>{{$cda->user->razonsocial}}</td>
                      @endif
                      <td>{{$cda->cantidad}}</td>
                      <td>$ {{$cda->precio}}</td>
                      <td>{{$cda->cobro->descripcion}}</td>
                      <td>{{$cda->plazo}}</td>
                     </tr>
               @endforeach
               </tbody>
            </table>
        </div>
    </div>
 	</div>
  @endif
  <hr>
  <a type="button" href="/usuario/demandas" class="btn btn-primary admin" title="Volver">Volver</a>
@endsection