@extends('layouts.principal')

@section('content')
    @if(Session::has('contrademanda'))
        <div class="alert alert-success alert-dismissible fade in" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Su Orden de Venta a sido registrada. Será notificado si el Demandante la acepta o rechaza.</strong>
        </div>
    @endif
    @guest
        <center><h4>Debe Registrarse para Acceder a esta sección</h4></center>
    @else
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div id="imaginary_container"> 
                <form class="form-horizontal" method="GET" action="{{ url('/usuario/buscarDemandas') }}">
                <div class="input-group stylish-input-group">
                    <input type="text" class="form-control" autofocus="autofocus" name="buscar" placeholder="Buscar..." >
                    <span class="input-group-addon">
                        <button type="submit">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>  
                    </span>
                </div>
                </form>
            </div>
        </div>
        <div class="col-md-12">
            <h1 class="h1-tabla">Demandas sin Tomar</h1>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Modo</th>
                            <th>Categoría</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Fecha Entrega</th>
                            <th>Operador</th>
                            <th>Puesto</th>
                            <th>Cobro</th>
                            <th>Plazo (días)</th>
                            <th></th>
                        </tr>
                    </thead>
                    @foreach($demandas as $dem)
                        <tbody>
                            <tr>
                                <input type="hidden" name="id" value="{{$dem->id}}">
                                <input type="hidden" name="iduser" value="{{$dem->user->id}}">
                                <td>{{$dem->producto->nombre}} {{$dem->producto->descripcion}} {{$dem->producto->descripcion2}}</td>
                                <td>{{$dem->modo->descripcion}} X {{$dem->peso}} {{$dem->medida->descripcion}}</td>
                                <td>{{$dem->producto->categoria->descripcion}}</td>
                                <td name="cantidad">{{$dem->cantidad}}</td>
                                <td name="precio">$ {{$dem->precio}}</td>
                                <td name="fechae">{{$dem->fechaEntrega}}</td>
                                @if($dem->user->razonsocial == '')
                                <td>{{$dem->user->apellido}} {{$dem->user->name}}</td>
                                @else
                                <td>{{$dem->user->razonsocial}}</td>
                                @endif
                                <td>{{$dem->puesto->descripcion}}</td>
                                <td>{{$dem->cobro->descripcion}}</td>
                                <td>{{$dem->plazo}}</td>
                                <td>@if(Auth::user()->activo == 1 && Auth::user()->id != $dem->user->id && Auth::user()->admin == 0)
                                        <button type="button" id="demandar" data-toggle="modal" onclick="demandar({{$dem->id}},{{$dem->cantidad}},{{$dem->precio}},{{$dem->id_puesto}},{{$dem->id_cobro}},'{{$dem->plazo}}')" class="btn btn-success admin tabla">Demandar</button>
                                    @else
                                        <button type="button" id="demandar" data-toggle="modal" data_target="#modalDemandar" disabled class="btn btn-success admin tabla" title="Su Usuario no está ACTIVO o esta Demanda es suya">Demandar</button>
                                    @endif</td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
                {!! $demandas->appends(array_except(Request::query(), 'd'))->links() !!}
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <h1 class="h1-tabla">Demandas Abiertas</h1>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Modo</th>
                            <th>Categoría</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Fecha Entrega</th>
                            <th>Operador</th>
                            <th>Puesto</th>
                            <th>Cobro</th>
                            <th>Plazo (días)</th>
                            <th></th>
                        </tr>
                    </thead>
                    @foreach($demandasa as $dem)
                        <tbody>
                            <tr>
                                <input type="hidden" name="id" value="{{$dem->id}}">
                                <input type="hidden" name="iduser" value="{{$dem->user->id}}">
                                <td>{{$dem->producto->nombre}} {{$dem->producto->descripcion}} {{$dem->producto->descripcion2}}</td>
                                <td>{{$dem->modo->descripcion}} X {{$dem->peso}} {{$dem->medida->descripcion}}</td>
                                <td>{{$dem->producto->categoria->descripcion}}</td>
                                <td name="cantidad">{{$dem->cantidad}}</td>
                                <td name="precio">$ {{$dem->precio}}</td>
                                <td name="fechae">{{$dem->fechaEntrega}}</td>
                                @if($dem->user->razonsocial == '')
                                <td>{{$dem->user->apellido}} {{$dem->user->name}}</td>
                                @else
                                <td>{{$dem->user->razonsocial}}</td>
                                @endif
                                <td>{{$dem->puesto->descripcion}}</td>
                                <td>{{$dem->cobro->descripcion}}</td>
                                <td>{{$dem->plazo}}</td>
                                <td>@if(Auth::user()->activo == 1 && Auth::user()->id != $dem->user->id && Auth::user()->admin == 0)
                                        <button type="button" id="demandar" data-toggle="modal" onclick="demandar({{$dem->id}},{{$dem->cantidad}},{{$dem->precio}},{{$dem->id_puesto}},{{$dem->id_cobro}},'{{$dem->plazo}}')" class="btn btn-success admin tabla">Demandar</button>
                                    @else
                                        <button type="button" id="demandar" data-toggle="modal" data_target="#modalDemandar" disabled class="btn btn-success admin tabla" title="Su Usuario no está ACTIVO o esta Demanda es suya">Demandar</button>
                                    @endif</td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
                {!! $demandasa->appends(array_except(Request::query(), 'da'))->links() !!}
            </div>
        </div>
    </div>

<!-- Modal Demandar -->
<div class="modal fade" id="modalDemandar" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Demandar</h4>
      </div>
      <div class="modal-body ofertar">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form class="form-horizontal" name="formDemandar" id="formDemandar" method="POST" action="{{ url('/usuario/contraDemanda') }}">
                                {{ csrf_field() }}

                                <input type="hidden" id="id_demanda" name="id_demanda" value="">
                                <input type="hidden" id="cantDemanda" name="cantDemanda" value="">
                                <div class="row">
                                    <center><h4>Ingrese la Cantidad que desea vender y Forma de Pago</h4>
                                    <p>Su Orden de Venta sera enviada al Demandante</p>
                                    <p>Éste la analizará y podrá aceptarla o rechazarla</p>
                                    <p>Se le informará sobre la decisión del Demandante</p>
                                    </center>
                                </div>
                                <div class="form-group{{ $errors->has('cantidadCd') ? ' has-error' : '' }}">
                                    <label for="cantidadCd" class="col-md-4 control-label">Cantidad</label>

                                    <div class="col-md-6">
                                        <input id="cantidadCd" placeholder="Ingrese la Cantidad a Comprar" type="number" class="form-control" name="cantidadCd" min="1" value="{{ old('cantidadCd') }}" required autofocus>

                                        @if ($errors->has('cantidadCd'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('cantidadCd') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('precioCd') ? ' has-error' : '' }}">
                                    <label for="precioCd" class="col-md-4 control-label">Precio</label>

                                    <div class="col-md-6">
                                        <input id="precioCd" placeholder="Precio" type="number" class="form-control" name="precioCd" min="1" value="{{ old('precioCd') }}" required autofocus>

                                        @if ($errors->has('precioCd'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('precioCd') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('puestoCd') ? ' has-error' : '' }}">
                                    <label for="puestoCd" class="col-md-4 control-label">Puesto</label>

                                    <div class="col-md-6">
                                    <select class="form-control" id="idPuestoD" name="puestoCd" value="{{ old('puestoCd') }}" required>
                                        <option hidden value=""> -- Producto Puesto en -- </option>
                                        @foreach ($puestos as $puesto)
                                        @if($puesto->id == "this.form.idPuestoD.value")
                                        <option value="{{$puesto->id}}" selected>{{$puesto->descripcion}}</option>
                                        @else
                                        <option value="{{$puesto->id}}">{{$puesto->descripcion}}</option>
                                        @endif
                                        @endforeach
                                    </select>
	                                @if ($errors->has('id_puesto'))
	                                    <span class="help-block">
	                                	    <strong>{{ $errors->first('id_puesto') }}</strong>
	                                        </span>
	                                @endif
	                            	</div>
	                            	<span class="glyphicon glyphicon-info-sign" alt="Indicar donde se colocara el Producto" title="Indicar donde se colocara el Producto"></span>
	                            </div>
                                <div class="form-group{{ $errors->has('cobroCd') ? ' has-error' : '' }}">
                                    <label for="cobroCd" class="col-md-4 control-label">Cobro</label>

                                    <div class="col-md-6">
                                    <select class="form-control" id="idCobroD" name="cobroCd" value="{{ old('cobroCd') }}" required>
                                        <option hidden value=""> -- Forma de Cobro -- </option>
                                        @foreach ($cobros as $cobro)
                                        @if($cobro->id == "this.form.idCobroD.value")
                                        <option value="{{$cobro->id}}" selected>{{$cobro->descripcion}}</option>
                                        @else
                                        <option value="{{$cobro->id}}">{{$cobro->descripcion}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    @if ($errors->has('cobroCd'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('cobroCd') }}</strong>
                                            </span>
                                    @endif
                                    </div>
                                    <span class="glyphicon glyphicon-info-sign" alt="Indicar la forma de Cobro que desea" title="Indicar la forma de Cobro que desea"></span>
                                    <div class="col-md-12">
                                        <div class="checkbox">
                                        <input type="text" id="idPlazoD" hidden value="">
                                        <ul class="filtro-usu">
                                            <label>
                                                <input type="checkbox" id="plazoD1" name="plazoCd" value="Contado" checked=""> Contado    
                                            </label>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <label>
                                                <input type="checkbox" id="plazoD2" name="plazoCd" value="30"> 30 días    
                                            </label>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <label>
                                                <input type="checkbox" id="plazoD3" name="plazoCd" value="60"> 60 días    
                                            </label>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <label> 
                                                <input type="checkbox" id="plazoD4" name="plazoCd" value="90"> 90 días    
                                            </label>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <label> 
                                                <input type="checkbox" id="plazoD5" name="plazoCd" value="Más de 90"> Más de 90 días    
                                            </label>
                                        </ul>
                                        </div>
                                        <hr class="hrblanco">
                                    </div>
                                </div>
                                <div class="row model">
                                    <button type="submit" class="btn btn-primary">Demandar</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                </div>
                            </form>
                        </div>
                </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
    @endguest
    <hr>
    <a type="button" href="{{ url('/') }}" class="btn btn-primary admin" title="Volver">Volver</a>
@stop