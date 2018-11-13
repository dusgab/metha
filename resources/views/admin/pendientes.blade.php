@extends('layouts.principal')

@section('content')
    @guest
        <center><h4>Debe Registrarse para Acceder a esta sección</h4></center>
    @else
    <div class="row">
    <h4 class="h4tit">Usuarios que tienen Contra Ofertas sin contestar (EN ESPERA), de Ofertas publicadas con Fecha de Entrega anterior al día de hoy</h4>
    <h4 class="h4tit">Al DESACTIVAR un Usuario, este no podrá realizar Nuevas Ofertas hasta que regularice su situación y lo vuelva a ACTIVAR </h4>
    <hr>
    <h4 class="h4tit">Usuarios Habilitados</h4>
	<div class="col-md-12">
            <div class="table-responsive">
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
                    @foreach($users as $user)
                    <form class="form-horizontal" method="GET" action="/admin/pendientes/desactivar/{{$user->id}}">
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
                                <td><button type="submit" class="btn btn-danger" title="Haga click para informar al Usuario que no puede realizar Nuevas Operaciones hasta regularizar las Pendientes">Desactivar</button></td>
                            </tr>
                        </tbody>
                    </form>
                    @endforeach
                </table>
                {!! $users->appends(array_except(Request::query(), 'u'))->links() !!}
            </div>
        </div>
    </div>
    <hr>
    <h4 class="h4tit">Usuarios Inhabilitados</h4>
    <div class="col-md-12">
        <div class="table-responsive">
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
                @foreach($usersd as $user)
            <form class="form-horizontal" method="GET" action="/admin/pendientes/activar/{{$user->id}}">
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
                            <td><button type="submit" class="btn btn-success" title="Haga click para informar al Usuario que no puede realizar Nuevas Operaciones hasta regularizar las Pendientes">Activar</button></td>
                        </tr>
                    </tbody>
                </form>
                @endforeach
            </table>
            {!! $usersd->appends(array_except(Request::query(), 'ud'))->links() !!}
        </div>
    </div>
</div>
<hr>
    @endguest
    <a type="button" href="{{ url('/') }}" class="btn btn-primary admin" title="Volver">Volver</a>
@endsection