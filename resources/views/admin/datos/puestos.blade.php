@extends('layouts.principal')

@section('content')
    @if(Session::has('puesto'))
        <div class="alert alert-success alert-dismissible fade in" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>{{Session::get('puesto')}}</strong>
        </div>
    @endif
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Este puesto ya existe!</strong>
    </div>
    @endif
    
	<div class="row">
        <div class="col-md-3 admin prod">    
        <h4 class="h4tit">Puestos</h4>
        <a type="button" id="agregarPue" data-toggle="modal" data_target="#agregarPuesto" class="btn btn-success admin">Agregar Puesto</a>
        <br>
            <table class="table chica prod">
                <thead>
                    <tr>
                        <th>Descripción</th>
                        <th></th>
                    </tr>
                </thead>
                @foreach($puestos as $puesto)        
                    <tbody>
                        <tr>
                            <input type="hidden" name="id" value="{{$puesto->id}}">
                            <td>{{$puesto->descripcion}}</td>
                            <td class="col-chica"><button type="submit" class="btn btn-danger admin tabla" title="Editar Puesto" onclick="editarPues({{$puesto->id}},'{{$puesto->descripcion}}')">Editar</button></td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
            {!! $puestos->appends(array_except(Request::query(), 'p'))->links() !!}
    	</div>
    </div>

    <!-- Modal Puestos -->
    <div class="modal fade" id="agregarPuesto" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Agregar Puesto</h4>
                </div>
                <div class="modal-body">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form class="form-horizontal" id="formagregarPuesto" name="agregarPuesto" method="POST" action="{{ url('admin/puesto/store') }}">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
                                    <label for="descripcion" class="col-md-4 control-label">Descripción</label>
                                    <div class="col-md-6">
                                        <input id="descripcion" type="text" class="form-control" name="descripcion" value="{{ old('descripcion') }}" required autofocus>
                                         @if ($errors->has('descripcion'))
                                            <span class="help-block">
                                                <strong>Este puesto ya existe</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
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
    
    <!-- Modal Editar Puestos -->
    <div class="modal fade" id="editarPuesto" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Editar Puesto</h4>
                    </div>
                    <div class="modal-body">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <form class="form-horizontal" id="formeditarPuesto" name="editarPuesto" method="POST" action="{{ url('admin/puesto/editar') }}">
                                    {{ csrf_field() }}
                                    <div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
                                        <label for="descripcion" class="col-md-4 control-label">Descripción</label>
                                        <div class="col-md-6">
                                            <input type="hidden" id="idPuesto" name="idPuesto" value="">
                                            <input id="desPuesto" type="text" class="form-control" name="descripcion" value="{{ old('descripcion') }}" required autofocus>
                                             @if ($errors->has('descripcion'))
                                                <span class="help-block">
                                                    <strong>Este puesto ya existe</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row model">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    </div> 
                                </form>
                            </div>
                        </div>                        
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->    
        </div><!-- /.modal -->  
    <hr>
    <a type="button" href="{{ url('/') }}" class="btn btn-primary admin" title="Volver">Volver</a>
@endsection