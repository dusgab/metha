@extends('layouts.principal')

@section('content')
    @if(Session::has('modo'))
        <div class="alert alert-success alert-dismissible fade in" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>{{Session::get('modo')}}</strong>
        </div>
    @endif
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Este Modo ya existe!</strong>
    </div>
    @endif
    <div class="row">
        <div class="col-md-3 admin prod">    
        <h4 class="h4tit">Modos</h4>
        <a type="button" id="agregarMod" data-toggle="modal" data_target="#agregarModo" class="btn btn-success admin">Agregar Modo</a>
        <br>
                <table class="table chica prod">
                    <thead>
                        <tr>
                            <th>Descripción</th>
                            <th></th>
                        </tr>
                    </thead>
                    @foreach($modos as $modo)        
                            <tbody>
                                <tr>
                                    <input type="hidden" name="id" value="{{$modo->id}}">
                                    <td>{{$modo->descripcion}}</td>
                                    <td class="col-chica"><button type="button" class="btn btn-danger admin tabla" title="Editar Modo" onclick="editarMod({{$modo->id}},'{{$modo->descripcion}}')">Editar</button></td>
                                </tr>
                            </tbody>
                    @endforeach
                </table>
                {!! $modos->appends(array_except(Request::query(), 'm'))->links() !!}
    	</div>
    </div>

    <!-- Modal Cobros -->
    <div class="modal fade" id="agregarModo" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Agregar Modo</h4>
          </div>
          <div class="modal-body">
             <div class="panel panel-default">
                            <div class="panel-body">
                                <form class="form-horizontal" id="formagregarModo" name="agregarModo" method="POST" action="{{ url('admin/modo/store') }}">
                                    {{ csrf_field() }}

                                    <div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
                                        <label for="descripcion" class="col-md-4 control-label">Descripción</label>

                                        <div class="col-md-6">
                                            <input id="descripcion" type="text" class="form-control" name="descripcion" value="{{ old('descripcion') }}" required autofocus>

                                            @if ($errors->has('descripcion'))
                                                <span class="help-block">
                                                    <strong>Este Modo ya existe</strong>
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

    <!-- Modal Cobros -->
    <div class="modal fade" id="editarModo" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Editar Modo</h4>
                </div>
                <div class="modal-body">
                   <div class="panel panel-default">
                        <div class="panel-body">
                            <form class="form-horizontal" id="formeditarModo" name="editarModo" method="POST" action="{{ url('admin/modo/editar') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
                                    <label for="descripcion" class="col-md-4 control-label">Descripción</label>

                                    <div class="col-md-6">
                                        <input type="hidden" id="idModo" name="idModo" value="">
                                        <input id="desModo" type="text" class="form-control" name="descripcion" value="{{ old('descripcion') }}" required autofocus>

                                        @if ($errors->has('descripcion'))
                                            <span class="help-block">
                                                <strong>Este Modo ya existe</strong>
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