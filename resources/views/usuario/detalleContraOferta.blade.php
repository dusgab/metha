@extends('layouts.principal')

@section('content')
@if(Session::has('oferta'))
  <div class="alert alert-success alert-dismissible fade in" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>{{Session::get('oferta')}}</strong>
  </div>
@endif
	<center><h3>Detalle de Contra Oferta</h3></center>
@if(empty($cofertas))
	<center><h4>La Oferta no posee ninguna Orden de Compra</h4></center> 
@else
<div class="row">
	<div class="col-md-12">
        <h1 class="h1-tabla">Mi Oferta</h1>
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
                         <input type="hidden" name="id" value="{{$of->id}}">
                       	<td>{{$of->producto->nombre}} {{$of->producto->descripcion}} {{$of->producto->descripcion2}}</td>
                        <td>{{$of->modo->descripcion}} X {{$of->peso}} {{$of->medida->descripcion}}</td>
                        <td>{{$of->cantidadOriginal}}</td>
                        <td>{{$of->cantidad}}</td>
                       	<td>$ {{$of->precio}}</td>
                       	<td>{{$of->fechaEntrega}}</td>
                       	<td>{{$of->puesto->descripcion}}</td>
                       	<td>{{$of->cobro->descripcion}}</td>
                        <td>{{$of->plazo}}</td>
                       </tr>
                   </tbody>
            </table>
        </div>
	</div>
	</div>
	<hr>
	<div class="row">
    <div class="col-md-6">
        <h1 class="h1-tabla">Ordenes de Compra (Contra Ofertas)</h1>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Comprador</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Cobro</th>
                        <th>Plazo (días)</th>
                        <th style="cursor:default;"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($cofertas as $co)
                    @if($co->estado == 0)
                       <tr> 
                       	@if($co->user->razonsocial === '')
                        <td>{{$co->user->apellido}} {{$co->user->name}}</td>
                        @else
                        <td>{{$co->user->razonsocial}}</td>
                        @endif
                       	<td>{{$co->cantidad}}</td>
                        <td>$ {{$co->precio}}</td>
                        <td>{{$co->cobro->descripcion}}</td>
                        <td>{{$co->plazo}}</td>
                        @if($of->cantidad < $co->cantidad)
                         	<td><a type="button" href="/usuario/aceptarOferta/{{$co->id}}" class="btn btn-success admin tabla" title="La cantidad disponible no es suficiente" disabled>Aceptar</a><br><a type="button" href="/usuario/rechazarOferta/{{$co->id}}" class="btn btn-danger admin tabla" title="Rechazar Contra Oferta">Rechazar</a></td>
                        @else
                          <td><a type="button" href="/usuario/aceptarOferta/{{$co->id}}" class="btn btn-success admin tabla" title="Aceptar Contra Oferta">Aceptar</a><br><a type="button" href="/usuario/rechazarOferta/{{$co->id}}" class="btn btn-danger admin tabla" title="Rechazar Contra Oferta">Rechazar</a></td>
                        @endif
                       </tr>
                    @endif
               @endforeach
            </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-6">
        <h1 class="h1-tabla">Ordenes de Compra Aceptadas</h1>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Comprador</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Cobro</th>
                        <th>Plazo (días)</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($cofertas as $coa)
                    @if($coa->estado == 1 || $coa->estado == 3)
                       <tr> 
                        @if($coa->estado == 3)
                        <td><span class="glyphicon glyphicon-info-sign" alt="El Producto fue RECIBIDO por el Comprador" title="El Producto fue RECIBIDO por el Comprador"></span></td>
                        @else
                        <td></td>
                        @endif
                        @if($coa->user->razonsocial === '')
                        <td> {{$coa->user->apellido}} {{$coa->user->name}}</td>
                        @else
                        <td>{{$coa->user->razonsocial}}</td>
                        @endif
                        <td>{{$coa->cantidad}}</td>
                        <td>$ {{$coa->precio}}</td>
                        <td>{{$coa->cobro->descripcion}}</td>
                        <td>{{$coa->plazo}}</td>                        
                       </tr>
                    @endif
               @endforeach
                </tbody>
            </table>
        </div>
    </div>
 	</div>
  @endif
  <hr>
  <a type="button" href="{{ url('/usuario/ofertas') }}" class="btn btn-primary admin" title="Volver">Volver</a>
@endsection