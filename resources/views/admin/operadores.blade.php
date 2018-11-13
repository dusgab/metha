@extends('layouts.principal')

@section('content')
    <div class="row">
    <div class="col-sm-6 col-sm-offset-3">
            <div id="imaginary_container"> 
                <form class="form-horizontal" method="GET" action="/admin/operadores">
                <div class="input-group stylish-input-group">
                    <input type="text" class="form-control" autofocus="autofocus" name="buscar" placeholder="Buscar..." >
                    <span class="input-group-addon">
                        <button type="submit">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>  
                    </span>
                </div>
                <div class="checkbox">
                    <ul class="filtro-usu">
                        <label>
                            Filtrar por Tipos de Usuarios    
                        </label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <label>
                            <input type="checkbox" name="usuarios[]" value="1"> Operadores    
                        </label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <label>
                            <input type="checkbox" name="usuarios[]" value="2"> Despachantes    
                        </label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <label> 
                            <input type="checkbox" name="usuarios[]" value="3"> Representantes    
                        </label>
                    </ul>
                </div>
                </form>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
    <h4 class="h4tit">Usuarios Inactivos</h4>
	<div class="col-md-12 admin">
            <div class="table-responsive admin">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Apellido </th>
                            <th>Nombre </th>
                            <th>Razón Social </th>
                            <th>Email </th>
                            <th>CUIT </th>
                            <th>Teléfono </th>
                            <th>Domicilio </th>
                            <th>Ciudad </th>
                            <th>Provincia </th>
                            <th>Tipo de Usuario</th>
                            <th>Registro</th>
                            <th style="cursor:default;"></th>
                        </tr>
                    </thead>
                    @foreach($usersi as $user)
                        <form class="form-horizontal" method="POST" action="/admin/activar/{{$user->id}}">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <tbody>
                                <tr>
                                    <td>{{$user->apellido}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->razonsocial}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->cuit}}</td>
                                    <td>{{$user->telefono}}</td>
                                    <td>{{$user->domicilio}}</td>
                                    <td>{{$user->ciudad->nombre}}</td>
                                    <td>{{$user->provincia->nombre}}</td>
                                    <td>{{$user->tipoUsuario->descripcion}}</td>
                                    <td>{{$user->registro}}</td>
                                    <td><button type="submit" class="btn btn-success" title="Haga click para ACTIVAR éste Operador">Activar</button></td>
                                </tr>
                            </tbody>
                        </form>
                    @endforeach
                </table>
                {!! $usersi->appends(array_except(Request::query(), 'i'))->links() !!}
            </div>
    </div>
    </div>
    <hr>
    <div class="row">
    <h4 class="h4tit">Usuarios Activos</h4>
    <div class="col-md-12 admin">
            <div class="table-responsive admin">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Apellido </th>
                            <th>Nombre </th>
                            <th>Razón Social </th>
                            <th>Email </th>
                            <th>CUIT </th>
                            <th>Teléfono </th>
                            <th>Domicilio </th>
                            <th>Ciudad </th>
                            <th>Provincia </th>
                            <th>Tipo de Usuario</th>
                            <th style="cursor:default;"></th>
                        </tr>
                    </thead>
                    @foreach($usersa as $user)
                        <form class="form-horizontal" method="POST" action="/admin/desactivar/{{$user->id}}">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <tbody>
                                <tr>
                                    <td>{{$user->apellido}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->razonsocial}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->cuit}}</td>
                                    <td>{{$user->telefono}}</td>
                                    <td>{{$user->domicilio}}</td>
                                    <td>{{$user->ciudad->nombre}}</td>
                                    <td>{{$user->provincia->nombre}}</td>
                                    <td>{{$user->tipoUsuario->descripcion}}</td>
                                    <td><button type="submit" class="btn btn-danger" title="Haga click para DESACTIVAR éste Operador">Desactivar</button></a></td>
                                </tr>
                            </tbody>
                        </form>
                    @endforeach
                </table>
                {!! $usersa->appends(array_except(Request::query(), 'a'))->links() !!}
            </div>
    </div>
    </div>
    <hr>
    <a type="button" href="{{ url('/') }}" class="btn btn-primary admin" title="Volver">Volver</a>
@endsection