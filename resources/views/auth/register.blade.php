@extends('layouts.principal')

@section('content')

<div class="container">
    @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>{{Session::get('message')}}</strong>
            </div>
        @endif
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Registrarme</div>

                <div class="panel-body panel-height">
                    <form class="form-horizontal" id="registrarUsuario" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('cuit') ? ' has-error' : '' }}">
                            <label for="cuit" class="col-md-4 control-label">CUIT</label>

                            <div class="col-md-6">
                                <input id="cuit" type="tel" class="form-control" name="cuit" value="{{ old('cuit') }}" required autofocus maxlength="11" minlength="11" inputmode="numeric" pattern="[0-9]{11}" placeholder="Ingrese el CUIT sin güiones" title="Ingrese el CUIT sin güiones">

                                @if ($errors->has('cuit'))
                                    <span class="help-block">
                                        <strong>{{ 'El CUIT ya ha sido registrado. Debe ingresar 11 dígitos. Sin güiones' }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('razonsocial') ? ' has-error' : '' }}">
                            <label for="razonsocial" class="col-md-4 control-label">Razón Social</label>

                            <div class="col-md-6">
                                <input id="razonsocial" type="text" class="form-control" name="razonsocial" value="{{ old('razonsocial') }}" placeholder="Ingrese Razón Social">

                                @if ($errors->has('razonsocial'))
                                    <span class="help-block">
                                        <strong>{{ 'La Razón Social ingresada ya ha sido registrada' }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Nombre" required>

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
                                <input id="apellido" type="text" class="form-control" name="apellido" value="{{ old('apellido') }}" placeholder="Apellido" required>

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
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Correo Electrónico" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
                            <label for="telefono" class="col-md-4 control-label">Teléfono</label>

                            <div class="col-md-6">
                                <input id="telefono" type="tel" class="form-control" name="telefono" value="{{ old('telefono') }}" required minlength="6" maxlength="13" inputmode="numeric" pattern="[0-9]{6,13}" placeholder="Teléfono">

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
                                <input id="domicilio" type="text" class="form-control" name="domicilio" value="{{ old('domicilio') }}" placeholder="Domicilio" required>

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
                            <select class="form-control" id="provincias" name="id_provincia" value="{{ old('id_provincia') }}" required>
                                <option disabled selected hidden> -- Seleccione una Provincia -- </option>
                                @foreach($provincias as $provincia)
                                <option value="{{$provincia->id}}">{{$provincia->nombre}}</option>
                                
                                @endforeach
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
                            <select class="form-control" id="ciudades" name="id_ciudad" value="{{ old('id_ciudad') }}" required>
                                <option disabled selected hidden> -- Seleccione una Ciudad -- </option>
                            </select>

                                @if ($errors->has('id_ciudad'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('id_ciudad') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <hr>
                        
                        <div class="form-group{{ $errors->has('tipo') ? ' has-error' : '' }}" id="tipo_us" >
                            <label for="tipo" class="col-md-4 control-label">Tipo de Usuario</label>

                            <div class="col-md-6">
                            <select class="form-control" name="tipo_us" id="tipo" value="{{ old('tipo') }}" required>
                                <option disabled selected hidden> -- Seleccione un tipo de Usuario -- </option>
                                <option value="1">Independiente</option>
                                <option value="3">Con Representante</option>
                            </select>

                                @if ($errors->has('tipo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tipo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('is_rep') ? ' has-error' : '' }}" id="is_rep" style="display: none;">
                            <div class="alert alert-success" role="alert">
                              <strong>Si desea registrarse como Operador y Representante, por favor seleccione la siguiente opción. De lo contrario se registrará sólo como Operador.</strong>
                            </div>
                            <label for="i_rep" class="col-md-4 control-label">Soy Representante</label>
                            <div class="col-md-6">
                                <input type="checkbox" class="form-control" name="is_rep" id="ch_is_rep" value="true">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('rep') ? ' has-error' : '' }}" id="rep" style="display: none;">
                            <label for="rep" class="col-md-4 control-label">Representantes</label>

                            <div class="col-md-6">
                            <select class="form-control" name="id_rep" id="id_rep" value="{{ old('id_rep') }}" >
                                <option disabled selected hidden> -- Seleccione un Representante -- </option>
                                @forelse($representantes as $rep)
                                    <option value="{{$rep->id}}">{{$rep->user->razonsocial}} - {{$rep->user->cuit}}</option>
                                @empty
                                    <option value="1" >No existe ningún Representante</option>
                                @endforelse
                                
                            </select>

                                @if ($errors->has('rep'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('rep') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <hr>

                        <div class="form-group{{ $errors->has('tipo_reg') ? ' has-error' : '' }}" id="tipo_reg" >
                            <label for="tipo_reg" class="col-md-4 control-label">Tipo de Registro</label>

                            <div class="col-md-6">
                            <select class="form-control" name="tipo_reg" id="tipo_reg" value="{{ old('tipo_reg') }}" required>
                                <option disabled selected hidden> -- Seleccione un Tipo de Registro -- </option>
                                <option value="1">RENSPA</option>
                                <option value="2">MATRICULA</option>
                            </select>

                                @if ($errors->has('registro'))
                                    <span class="help-block">
                                        <strong>{{ 'El número de Registro ya existe.' }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('registro') ? ' has-error' : '' }}" id="renspa" style="display: none;">
                            
                            <label for="registro" class="col-md-4 control-label">Renspa</label>
                               
                            <div class="col-md-6">
                            <input type="text" class="form-control" minlength="17" maxlength="17" name="renspa" id="ren" value="{{ old('registro') }}" placeholder="xx.xxx.x.xxxxx/xx" pattern="[0-9]{2}\.[0-9]{3}\.[0-9]{1}\.[0-9]{5}\/[0-9]{2}" oninvalid="this.setCustomValidity('Debe ingresar un número de Renspa con el siguiente formato xx.xxx.x.xxxxx/xx')"
    oninput="this.setCustomValidity('')" >

                                @if ($errors->has('registro'))
                                    <span class="help-block">
                                        <strong>{{ 'El número de Registro ya existe.' }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('registro') ? ' has-error' : '' }}" id="matricula" style="display: none;">
                            
                            <label for="registro" class="col-md-4 control-label">Matrícula</label>

                            <div class="col-md-6">
                            <input type="numeric" class="form-control" minlength="5" maxlength="6" name="matricula" id="mat" value="{{ old('registro') }}" placeholder="xxxxxx" pattern="[0-9]{5,6}" oninvalid="this.setCustomValidity('Debe ingresar un número de Matrícula con el siguiente formato xxxxxx')"
    oninput="this.setCustomValidity('')" >

                                @if ($errors->has('registro'))
                                    <span class="help-block">
                                        <strong>{{ 'El número de Registro ya existe.' }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <hr>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" placeholder="Contraseña" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Repita Contraseña</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Repita Contraseña" required>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4 reg">
                                <button type="submit" class="btn btn-primary reg">
                                    Registrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
