@extends('layouts.principal')

@section('content')
@if(Session::has('demanda'))
    <div class="alert alert-success alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>{{Session::get('demanda')}}</strong>
    </div>
@endif
<div class="row">
    @if(Auth::user()->activo == 1)
        <button type="button" id="agregarDem" data-toggle="modal" data_target="#agregarDemanda" class="btn btn-success admin">Nueva Demanda</button>
    @else
        <button type="button" id="agregarDem" data-toggle="modal" disabled="" data_target="#agregarDemanda" class="btn btn-success admin">Nueva Demanda</button>
    @endif
    <div class="col-md-12">
        <h1 class="h1-tabla">Mis Demandas</h1>
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
                        <th>Pago</th>
                        <th>Plazo (días)</th>
                        <th style="cursor:default;"></th>
                        <th style="cursor:default;"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($demandas as $dem)
                    <tr>
                        <form class="form-horizontal" name="eliminarDemandas" method="POST" action="{{ url('/usuario/eliminarDemanda') }}">
                        {{ csrf_field() }}
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
                        
                        <td><a type="button" href="/usuario/detalleDemanda/{{$dem->id}}" class="btn btn-info admin tabla" title="Ver Contra-Demandas">Ver Contra Demandas</a></td>
                        @if($dem->cantidad != $dem->cantidadOriginal)
                            <td><button type="submit" class="btn btn-danger admin tabla" title="No puede eliminar esta Demanda porque ya tiene Operaciones Concretadas" disabled>X</button></td>
                        @else
                            <td><button type="submit" class="btn btn-danger admin tabla" title="Eliminar Demanda" onclick="return confirm('¿Seguro que deseas eliminar esta Demanda?')">X</button></td>
                        @endif
                        </form>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! $demandas->appends(array_except(Request::query(), 'd'))->links() !!}
        </div>
    </div>
    <div class="col-md-12">
        <h1 class="h1-tabla">Contra Demandas Realizadas</h1>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Modo</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Fecha Entrega</th>
                        <th>Puesto</th>
                        <th>Cobro</th>
                        <th>Plazo (días)</th>
                        <th>Estado</th>
                        <th style="cursor:default;"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($cdemandas as $cdem)
                    <tr>
                        <form class="form-horizontal" name="eliminarCdemanda" method="POST" action="{{ url('/usuario/eliminarCdemanda') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{$cdem->id}}">
                        <td>{{$cdem->demanda->producto->nombre}} {{$cdem->demanda->producto->descripcion}} {{$cdem->demanda->producto->descripcion2}}</td>
                        <td>{{$cdem->demanda->modo->descripcion}} X {{$cdem->demanda->peso}} {{$cdem->demanda->medida->descripcion}}</td>
                        <td>{{$cdem->cantidad}}</td>
                        <td>$ {{$cdem->precio}}</td>
                        <td>{{$cdem->demanda->fechaEntrega}}</td>
                        <td>{{$cdem->demanda->puesto->descripcion}}</td>
                        <td>{{$cdem->cobro->descripcion}}</td>
                        <td>{{$cdem->plazo}}</td>
                        @if($cdem->estado == 1)
                            <td>ACEPTADA</td>
                            <td><button type="submit" class="btn btn-danger admin tabla" title="No puede Eliminar esta Contra Demanda porque ya fue ACEPTADA" disabled>X</button></td>
                        @elseif($cdem->estado == 2)
                            <td>RECHAZADA</td>
                            <td><button type="submit" class="btn btn-danger admin tabla" title="No puede Eliminar esta Contra Demanda porque ya fue RECHAZADA" disabled>X</button></td>
                        @elseif($cdem->estado == 3)
                            <td>RECIBIDO</td>
                            <td><button type="submit" class="btn btn-danger admin tabla" title="No puede Eliminar esta Contra Demanda porque ya fue RECHAZADA" disabled>X</button></td>
                        @else
                            <td>EN ESPERA</td>
                            <td><button type="submit" class="btn btn-danger admin tabla" title="Eliminar Contra Demanda" onclick="return confirm('¿Seguro que deseas eliminar esta Contra Demanda?')">X</button></td>
                        @endif
                        </form>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! $cdemandas->appends(array_except(Request::query(), 'cd'))->links() !!}
        </div>
    </div>
</div>
<hr>
<a type="button" href="{{ url('/') }}" class="btn btn-primary admin" title="Volver">Volver</a>

<!-- Modal Nueva Demanda -->
<div class="modal fade" id="agregarDemanda" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Nueva Demanda</h4>
      </div>
      <div class="modal-body">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form class="form-horizontal" id="formagregarDemanda" name="formagregarDemanda" method="POST" action="{{ url('/usuario/nuevaDemanda') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('id_prod') ? ' has-error' : '' }}">
                                    <label for="id_prod" class="col-md-4 control-label">Producto</label>

                                    <div class="col-md-6">
                                    <select class="form-control" name="id_prod" value="{{ old('id_prod') }}" required autofocus="true">
                                        <option hidden value=""> -- Seleccione un Producto -- </option>
                                        @foreach($productos as $prod)
                                        <option value="{{$prod->id}}">{{$prod->nombre}} {{$prod->descripcion}} {{$prod->descripcion2}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('id_prod'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('id_prod') }}</strong>
                                            </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('id_modo') ? ' has-error' : '' }}">
                                    <label for="id_modo" class="col-md-2 control-label">Modo</label>

                                    <div class="col-md-4">
                                    <select class="form-control" name="id_modo" value="{{ old('id_modo') }}" required>
                                        <option hidden value=""> -- Modo -- </option>
                                        @foreach ($modos as $modo)
                                        <option value="{{$modo->id}}" >{{$modo->descripcion}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('id_modo'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('id_modo') }}</strong>
                                            </span>
                                    @endif
                                    </div>
                                    <div class="col-md-1 chico">
                                        <p class="texto-plano">X</p>
                                    </div>
                                    <div class="col-md-2">
                                    <input id="peso" placeholder="20" type="number" class="form-control" name="peso" min="1" value="{{ old('peso') }}" required >

                                    @if ($errors->has('peso'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('peso') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                    <div class="col-md-3">
                                        <select class="form-control" id="id_medida" name="id_medida" value="{{ old('id_medida') }}" required>
                                            <option hidden value="">U. Medida</option>
                                            @foreach($medidas as $medida)
                                            <option value="{{$medida->id}}">{{$medida->descripcion}}</option>
                                            
                                            @endforeach
                                        </select>

                                            @if ($errors->has('medida'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('medida') }}</strong>
                                                </span>
                                            @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('cantidad') ? ' has-error' : '' }}">
                                    <label for="cantidad" class="col-md-4 control-label">Cantidad</label>

                                    <div class="col-md-6">
                                        <input id="cantidad" placeholder="Cantidad Demandada" type="number" class="form-control" name="cantidad" min="1" value="{{ old('cantidad') }}" required>

                                        @if ($errors->has('cantidad'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('cantidad') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('precio') ? ' has-error' : '' }}">
                                    <label for="precio" class="col-md-4 control-label">Precio $</label>

                                    <div class="col-md-6">
                                        <input id="precio" placeholder="Precio" type="number" class="form-control" name="precio" min="1" value="{{ old('precio') }}" required>

                                        @if ($errors->has('precio'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('precio') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('fechae') ? ' has-error' : '' }}">
                                    <label for="fechae" class="col-md-4 control-label">Fecha de Entrega</label>

                                    <div class="col-md-6">
                                        <input id="fechae" placeholder="Fecha de Entrega" onfocus="(this.type='date')" type="text" class="form-control" onblur="if(this.value==''){this.type='text'}" name="fechae" min="<?php $hoy=date("Y-m-d"); echo $hoy;?>" value=""  required>

                                        @if ($errors->has('fecha'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('fecha') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('puesto') ? ' has-error' : '' }}">
                                    <label for="puesto" class="col-md-4 control-label">Puesto</label>

                                    <div class="col-md-6">
                                    <select class="form-control" name="puesto" value="{{ old('puesto') }}" required>
                                        <option hidden value=""> -- Producto Puesto en -- </option>
                                        @foreach ($puestos as $puesto)
                                        <option value="{{$puesto->id}}" >{{$puesto->descripcion}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('id_prod'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('id_prod') }}</strong>
                                            </span>
                                    @endif
                                    </div>
                                    <span class="glyphicon glyphicon-info-sign" alt="Indicar donde se colocara el Producto" title="Indicar donde se colocara el Producto"></span>
                                </div>
                                <hr class="hrblanco">
                                <div class="form-group{{ $errors->has('cobro') ? ' has-error' : '' }}">
                                    <label for="cobro" class="col-md-4 control-label">Pago</label>

                                    <div class="col-md-6">
                                    <select class="form-control" name="cobro" value="{{ old('cobro') }}" required>
                                        <option hidden value=""> -- Forma de Pago -- </option>
                                        @foreach ($cobros as $cobro)
                                        <option value="{{$cobro->id}}" >{{$cobro->descripcion}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('cobro'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('cobro') }}</strong>
                                            </span>
                                    @endif
                                    </div>
                                    <span class="glyphicon glyphicon-info-sign" alt="Indicar la forma de Pago que desea" title="Indicar la forma de Pago que desea"></span>

                                    <div class="col-md-12">
                                        <div class="checkbox">
                                        <ul class="filtro-usu">
                                            <label>
                                                <input type="checkbox" name="plazo" value="Contado" checked=""> Contado    
                                            </label>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <label>
                                                <input type="checkbox" name="plazo" value="30"> 30 días    
                                            </label>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <label>
                                                <input type="checkbox" name="plazo" value="60"> 60 días    
                                            </label>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <label> 
                                                <input type="checkbox" name="plazo" value="90"> 90 días    
                                            </label>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <label> 
                                                <input type="checkbox" name="plazo" value="Más de 90"> Más de 90 días    
                                            </label>
                                        </ul>
                                        </div>
                                    </div>
                                </div>
                                <hr class="hrblanco">

                                    <div class="row model">
                                        <button type="submit" class="btn btn-primary">Agregar</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    </div>
                                
                            </form>
                        </div>
                    </div>      
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection