@extends('layouts.principal')

@section('content')
    @if(Session::has('cobro'))
        <div class="alert alert-success alert-dismissible fade in" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>{{Session::get('cobro')}}</strong>
        </div>
    @endif
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Este tipo de Cobro ya existe!</strong>
    </div>
    @endif
    <div class="row">
        <div class="col-md-3 admin prod">    
        <h4 class="h4tit">Formas de Cobros y Pagos</h4>
        <a type="button" id="agregarCob" data-toggle="modal" data_target="#agregarCobro" class="btn btn-success admin">Agregar forma de Cobro</a>
        <br>
                <table class="table chica prod">
                    <thead>
                        <tr>
                            <th>Descripción</th>
                            <th></th>
                        </tr>
                    </thead>
                    @foreach($cobros as $cobro)        
                            <tbody>
                                <tr>
                                    <input type="hidden" name="id" value="{{$cobro->id}}">
                                    <td>{{$cobro->descripcion}}</td>
                                    <td class="col-chica"><button type="button" class="btn btn-danger admin tabla" title="Editar Cobro" onclick="editarCob({{$cobro->id}},'{{$cobro->descripcion}}')">Editar</button></td>                                    </form>
                                </tr>
                            </tbody>
                    @endforeach
                </table>
                {!! $cobros->appends(array_except(Request::query(), 'c'))->links() !!}
    	</div>
    </div>

    <!-- Modal Cobros -->
    <div class="modal fade" id="agregarCobro" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Agregar forma de Cobro</h4>
                </div>
                <div class="modal-body">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <form class="form-horizontal" id="formagregarCobro" name="agregarCobro" method="POST" action="{{ url('admin/cobro/store') }}">
                                    {{ csrf_field() }}
                                    <div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
                                        <label for="descripcion" class="col-md-4 control-label">Descripción</label>

                                        <div class="col-md-6">
                                            <input id="descripcion" type="text" class="form-control" name="descripcion" value="{{ old('descripcion') }}" required autofocus>

                                            @if ($errors->has('descripcion'))
                                                <span class="help-block">
                                                    <strong>Este tipo de Cobro ya existe</strong>
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

    <!-- Modal Editar Cobros -->
    <div class="modal fade" id="editarCobro" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Editar forma de Cobro</h4>
                    </div>
                    <div class="modal-body">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <form class="form-horizontal" id="formeditarCobro" name="editarCobro" method="POST" action="{{ url('admin/cobro/editar') }}">
                                        {{ csrf_field() }}
                                        <div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
                                            <label for="descripcion" class="col-md-4 control-label">Descripción</label>
    
                                            <div class="col-md-6">
                                                <input type="hidden" id="idCobro" name="idCobro" value="">
                                                <input id="desCobro" type="text" class="form-control" name="descripcion" value="{{ old('descripcion') }}" required autofocus>
    
                                                @if ($errors->has('descripcion'))
                                                    <span class="help-block">
                                                        <strong>Este tipo de Cobro ya existe</strong>
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