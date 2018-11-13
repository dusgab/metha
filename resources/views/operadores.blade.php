@extends('layouts.principal')

@section('content')
    @guest
        <center><h4>Debe Registrarse para Acceder a esta sección</h4></center>
    @else
	<div class="col-md-12">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Apellido </th>
                            <th>Nombre </th>
                            <th>Email </th>
                            <th>CUIT </th>
                            <th>Telefono </th>
                            <th>Domicilio </th>
                            <th>Ciudad </th>
                            <th>Provincia </th>
                            <th>Despachante </th>
                            <th>Representante </th>
                        </tr>
                    </thead>
                    @foreach($users as $user)
                    <tbody>
                        <tr>
                            <td>{{$user->apellido}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->cuit}}</td>
                            <td>{{$user->telefono}}</td>
                            <td>{{$user->domicilio}}</td>
                            <td>{{$user->ciudad->nombre}}</td>
                            <td>{{$user->provincia->nombre}}</td>
                            <td>{{$user->despachante->apellido}} {{$user->despachante->nombre}}</td>
                            <td>{{$user->representante->apellido}} {{$user->representante->nombre}}</td>
                        </tr>
                        
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    @endguest
    <a type="button" href="{{ url('/') }}" class="btn btn-primary admin" title="Volver">Volver</a>
@endsection