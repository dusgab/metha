@extends('layouts.principal')

@section('content')
    @if($user->id == Auth::user()->id)
    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible fade in" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>{{Session::get('message')}}</strong>
        </div>
    @endif
    <div class="container datos">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Mis Datos</div>

                <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{ url('/usuario/editarPerfil') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('razonsocial') ? ' has-error' : '' }}">
                            <label for="razonsocial" class="col-md-4 control-label">Razón Social</label>

                            <div class="col-md-6">
                                <input disabled id="razonsocial" type="text" class="form-control" name="razonsocial" value="{{ $user->razonsocial }}" >

                                @if ($errors->has('razonsocial'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('razonsocial') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('cuit') ? ' has-error' : '' }}">
                            <label for="cuit" class="col-md-4 control-label">CUIT</label>

                            <div class="col-md-6">
                                <input disabled id="cuit" type="text" class="form-control" name="cuit" value="{{ $user->cuit }}"  maxlength="11" minlength="8" inputmode="numeric">

                                @if ($errors->has('cuit'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cuit') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required disabled>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('apellido') ? ' has-error' : '' }}">
                            <label for="apellido" class="col-md-4 control-label">Apellido</label>

                            <div class="col-md-6">
                                <input id="apellido" type="text" class="form-control" name="apellido" value="{{ $user->apellido }}" required disabled>

                                @if ($errors->has('apellido'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('apellido') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Correo Electrónico</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required disabled>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" value="{{ $user->password }}" required disabled>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
                            <label for="telefono" class="col-md-4 control-label">Teléfono</label>

                            <div class="col-md-6">
                                <input id="telefono" type="text" class="form-control" name="telefono" value="{{ $user->telefono }}"  maxlength="13" inputmode="numeric" required disabled>

                                @if ($errors->has('telefono'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('telefono') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('domicilio') ? ' has-error' : '' }}">
                            <label for="domicilio" class="col-md-4 control-label">Domicilio</label>

                            <div class="col-md-6">
                                <input id="domicilio" type="text" class="form-control" name="domicilio" value="{{ $user->domicilio }}" required disabled>

                                @if ($errors->has('domicilio'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('domicilio') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('id_provincia') ? ' has-error' : '' }}">
                            <label for="id_provincia" class="col-md-4 control-label">Provincia</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" value="{{$user->provincia->nombre}}" required disabled>
                            </select>

                                @if ($errors->has('id_provincia'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('id_provincia') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('id_ciudad') ? ' has-error' : '' }}">
                            <label for="id_ciudad" class="col-md-4 control-label">Ciudad</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" value="{{$user->ciudad->nombre}}" required disabled>

                                @if ($errors->has('id_ciudad'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('id_ciudad') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('tipo_us') ? ' has-error' : '' }}">
                            <label for="tipo_us" class="col-md-4 control-label">Tipo de Usuario</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" value="{{$user->tipoUsuario->descripcion}}" required disabled>

                                @if ($errors->has('tipo_us'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tipo_us') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('registro') ? ' has-error' : '' }}">
                            <label for="registro" class="col-md-4 control-label">Registro</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" value="{{$user->registro}}" required disabled>

                                @if ($errors->has('registro'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('registro') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <hr>

                        <div class="form-group">
                            <div class="col-md-12 center">
                                <button type="submit" class="btn btn-primary" disabled>Actualizar</button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
        </div>
        </div>
    </div>

     </div> 
     @else
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger activo" role="alert">
                <strong>No tiene autorización para ingresar en este Perfil</strong>
                </div>
            </div>
        </div>
     @endif 
     <hr>
     <a type="button" href="{{ url('/') }}" class="btn btn-primary admin" title="Volver">Volver</a> 
@endsection