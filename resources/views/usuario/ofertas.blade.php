@extends('layouts.principal')

@section('content')
    
	@if(Session::has('oferta'))
        <div class="alert alert-success alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>{{Session::get('oferta')}}</strong>
        </div>
    @endif
	<div class="row">
        @if(Auth::user()->activo == 1 && Auth::user()->pendientes == 0)
            <button type="button" id="agregarOfer" data-toggle="modal" data_target="#agregarOferta" class="btn btn-success admin">Nueva Oferta</button>
        @elseif(Auth::user()->pendientes == 1)
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger activo" role="alert">
                    <strong>Su cuenta no está Habilitada para realizar Nuevas Ofertas debido a que posee Contra Ofertas sin contestar.</strong><br>
                    <strong>Por favor regularice su situación Aceptando o Rechazando las Contra Ofertas que tenga pendiente.</strong>
                    </div>
                </div>
            </div>
            <button type="button" id="agregarOfer" data-toggle="modal" disabled="" data_target="#agregarOferta" class="btn btn-success admin">Nueva Oferta</button>
        @else
            <button type="button" id="agregarOfer" data-toggle="modal" disabled="" data_target="#agregarOferta" class="btn btn-success admin">Nueva Oferta</button>
        @endif
            <div class="col-md-12">
                <h1 class="h1-tabla">Mis Ofertas</h1>
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
                                <th style="cursor:default;"></th>
                                <th style="cursor:default;"></th>
                            </tr>
                        </thead>
                        @foreach($ofertas as $of)
	                        <tbody>
	                            <tr>
	                            	<form class="form-horizontal" name="eliminarOferta" method="POST" action="{{ url('/usuario/eliminarOferta') }}">
                                    {{ csrf_field() }}
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
                                    <td><a type="button" href="/usuario/detalleOferta/{{$of->id}}" class="btn btn-info admin tabla" title="Ver Contra Ofertas">Ver Contra Ofertas</a></td>
	                            	@if($of->cantidad != $of->cantidadOriginal)
                                        <td><button type="submit" class="btn btn-danger admin tabla" title="No puede eliminar esta Oferta porque ya tiene Operaciones Concretadas" disabled>X</button></td>
                                    @else
                                        <td><button type="submit" class="btn btn-danger admin tabla" title="Eliminar Oferta" onclick="return confirm('¿Seguro que deseas eliminar esta Oferta?')">X</button></td>
                                    @endif

	                            	</form>
	                            </tr>
	                        </tbody>
	                    @endforeach
                    </table>
                    {!! $ofertas->appends(array_except(Request::query(), 'o'))->links() !!}
                </div>
            </div>
        <hr>
        <div class="col-md-12">
            <h1 class="h1-tabla">Contra Ofertas Realizadas</h1>
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
                            <th>Recibido</th>
                            <th>Estado</th>
                            <th style="cursor:default;"></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($cofertas as $cof)
                        <tr>
                            <form class="form-horizontal" id="eliminarCoferta" name="eliminarCoferta" method="GET" action="">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{$cof->id}}">
                            <td>{{$cof->oferta->producto->nombre}} {{$cof->oferta->producto->descripcion}} {{$cof->oferta->producto->descripcion2}}</td>
                            <td>{{$cof->oferta->modo->descripcion}} X {{$cof->oferta->peso}} {{$cof->oferta->medida->descripcion}}</td>
                            <td>{{$cof->cantidad}}</td>
                            <td>$ {{$cof->precio}}</td>
                            <td>{{$cof->oferta->fechaEntrega}}</td>
                            <td>{{$cof->oferta->puesto->descripcion}}</td>
                            <td>{{$cof->cobro->descripcion}}</td>
                            <td>{{$cof->plazo}}</td>                            
                            @if($cof->estado == 1)
                                <td><input type="checkbox" name="recibido" value="3" onclick="confirmarOf('/usuario/editarCoferta/{{$cof->id}}', 0)" title="Seleccione cuando haya recibido la mercaderia"></td>
                                <td style="color: #00b100; font-weight: bold;">ACEPTADA</td>
                                <td><button href="" type="submit" class="btn btn-danger admin tabla" title="No puede Eliminar esta Contra Oferta porque ya fue ACEPTADA" disabled>X</button></td>
                            @elseif($cof->estado == 2)
                                <td><input type="checkbox" name="recibido" value="3" title="Seleccione cuando haya recibido los Productos" disabled></td>
                                <td style="color: #c12e2a; font-weight: bold;">RECHAZADA</td>
                                <td><button type="submit" class="btn btn-danger admin tabla" title="No puede Eliminar esta Contra Oferta porque ya fue RECHAZADA" disabled>X</button></td>
                            @elseif($cof->estado == 3)
                                <td><input type="checkbox" name="recibido" value="3" title="Productos Recibidos" checked disabled></td>
                                <td style="color: #0e68af; font-weight: bold;">RECIBIDO</td>
                                <td><button type="submit" class="btn btn-danger admin tabla" title="No puede Eliminar esta Contra Oferta porque ya fue RECIBIDA" disabled>X</button></td>
                            @else
                                @if($cof->oferta->cantidad < $cof->cantidad)
                                    <td><input type="checkbox" disabled name="recibido" value="3" title="La cantidad solicitada es mayor a la disponible" onclick="confirmarOf('/usuario/editarCoferta/{{$cof->id}}', 0)"> <span class="glyphicon glyphicon-info-sign" alt="La cantidad solicitada es mayor a la disponible" title="La cantidad solicitada es mayor a la disponible"></span></td>
                                    <td style="color: gold; font-weight: bold;">EN ESPERA</td>
                                    <td><button type="submit" class="btn btn-danger admin tabla" title="Eliminar Contra Oferta" onclick="confirmarOf('/usuario/eliminarCoferta/{{$cof->id}}', 1)">X</button></td>
                                @else
                                    <td><input type="checkbox" name="recibido" value="3" title="Seleccione cuando haya recibido los Productos" onclick="confirmarOf('/usuario/editarCoferta/{{$cof->id}}', 0)"></td>
                                    <td style="color: gold; font-weight: bold;">EN ESPERA</td>
                                    <td><button type="submit" class="btn btn-danger admin tabla" title="Eliminar Contra Oferta" onclick="confirmarOf('/usuario/eliminarCoferta/{{$cof->id}}', 1)">X</button></td>
                                @endif
                            @endif
                            </form>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $cofertas->appends(array_except(Request::query(), 'co'))->links() !!}
            </div>
        </div>
    </div>
    <hr>
    <a type="button" href="{{ url('/') }}" class="btn btn-primary admin" title="Volver">Volver</a>
        
    <!-- Modal Nueva Oferta -->
<div class="modal fade" id="agregarOferta" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Nueva Oferta</h4>
      </div>
      <div class="modal-body">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form class="form-horizontal" id="formagregarOferta" name="formagregarOferta" method="POST" action="{{ url('/usuario/nuevaOferta') }}">
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
                                        <input id="cantidad" placeholder="Cantidad Ofrecida" type="number" class="form-control" name="cantidad" min="1" value="{{ old('cantidad') }}" required>

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
                                    <label for="cobro" class="col-md-4 control-label">Cobro</label>

                                    <div class="col-md-6">
	                                <select class="form-control" name="cobro" value="{{ old('cobro') }}" required>
	                                    <option hidden value=""> -- Forma de Cobro -- </option>
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
	                            	<span class="glyphicon glyphicon-info-sign" alt="Indicar la forma de Cobro que desea" title="Indicar la forma de Cobro que desea"></span>

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