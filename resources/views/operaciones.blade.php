@extends('layouts.principal')

@section('content')
    @guest
        <center><h4>Debe Registrarse para Acceder a esta sección</h4></center>
    @else
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div id="imaginary_container"> 
                <form class="form-horizontal" method="GET" action="{{ url('/usuario/buscarOperaciones') }}">
                <div class="input-group stylish-input-group">
                    <input type="text" class="form-control" autofocus="autofocus" name="buscar" placeholder="Buscar..." >
                    <span class="input-group-addon">
                        <button type="submit">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>  
                    </span>
                </div>
                </form>
            </div>
        </div>
        <div class="col-md-12">
            <h1 class="h1-tabla">Operaciones Concretadas</h1>
            <h5><span class="glyphicon glyphicon-info-sign" alt="Aquí se muestran las Operaciones Concretadas con Fecha de Entrega hasta el día de hoy" title="Aquí se muestran las Operaciones Concretadas con Fecha de Entrega hasta el día de hoy"></span>Aquí se muestran las Operaciones Concretadas con Fecha de Entrega hasta el día de hoy</h5> 
            <h5><span class="glyphicon glyphicon-info-sign" alt="Presione sobre los nombres de las columnas para ordenar según lo requiera" title="Presione sobre los nombres de las columnas para ordenar según lo requiera"></span>Presione sobre los nombres de las columnas para ordenar según lo requiera</h5> 
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Modo</th>
                            <th>Categoría</th>
                            <th>Cantidad</th>
                            <th>Fecha</th>
                            <th>Precio</th>
                            <th>Pago</th>
                            <th>Plazo (días)</th>
                            <th>Puesto en</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($operacioneso as $op)
                            <tr>
                                <td>{{$op->contra->oferta->producto->nombre}} {{$op->contra->oferta->producto->descripcion}} {{$op->contra->oferta->producto->descripcion2}}</td>
                                <td>{{$op->contra->oferta->modo->descripcion}} X {{$op->contra->oferta->peso}} {{$op->contra->oferta->medida->descripcion}}</td>
                                <td>{{$op->contra->oferta->producto->categoria->descripcion}}</td>
                                <td>{{$op->contra->cantidad}}</td>
                                <td>{{$op->fecha}}</td>
                                <td>$ {{$op->contra->precio}}</td>
                                <td>{{$op->contra->cobro->descripcion}}</td>
                                <td>{{$op->contra->plazo}}</td>
                                <td>{{$op->contra->puesto->descripcion}}</td>
                            </tr>
                        @endforeach
                        @foreach($operacionesd as $op)
                            <tr>
                                <td>{{$op->contra->demanda->producto->nombre}} {{$op->contra->demanda->producto->descripcion}} {{$op->contra->demanda->producto->descripcion2}}</td>
                                <td>{{$op->contra->demanda->modo->descripcion}} X {{$op->contra->demanda->peso}} {{$op->contra->demanda->medida->descripcion}}</td>
                                <td>{{$op->contra->demanda->producto->categoria->descripcion}}</td>
                                <td>{{$op->contra->cantidad}}</td>
                                <td>{{$op->fecha}}</td>
                                <td>$ {{$op->contra->precio}}</td>
                                <td>{{$op->contra->cobro->descripcion}}</td>
                                <td>{{$op->contra->plazo}}</td>
                                <td>{{$op->contra->puesto->descripcion}}</td>                           
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <h1 class="h1-tabla">Operaciones Comprometidas</h1>
            <h5><span class="glyphicon glyphicon-info-sign" alt="Aquí se muestran las Operaciones Concretadas con Fecha de Entrega posteriores al día de hoy" title="Aquí se muestran las Operaciones Concretadas con Fecha de Entrega posteriores al día de hoy"></span>Aquí se muestran las Operaciones Concretadas con Fecha de Entrega posteriores al día de hoy</h5> 
            <div class="table-responsive">
                <table class="table">
                    <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Modo</th>
                                <th>Categoría</th>
                                <th>Cantidad</th>
                                <th>Fecha</th>
                                <th>Precio</th>
                                <th>Pago</th>
                                <th>Plazo (días)</th>
                                <th>Puesto en</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($operacionesco as $op)
                                    <tr>
                                        <td>{{$op->contra->oferta->producto->nombre}} {{$op->contra->oferta->producto->descripcion}} {{$op->contra->oferta->producto->descripcion2}}</td>
                                        <td>{{$op->contra->oferta->modo->descripcion}} X {{$op->contra->oferta->peso}} {{$op->contra->oferta->medida->descripcion}}</td>
                                        <td>{{$op->contra->oferta->producto->categoria->descripcion}}</td>
                                        <td>{{$op->contra->cantidad}}</td>
                                        <td>{{$op->contra->oferta->fechaEntrega}}</td>
                                        <td>$ {{$op->contra->precio}}</td>
                                        <td>{{$op->contra->cobro->descripcion}}</td>
                                        <td>{{$op->contra->plazo}}</td>
                                        <td>{{$op->contra->puesto->descripcion}}</td>
                                    </tr>
                                @endforeach
                                @foreach($operacionescd as $op)
                                    <tr>
                                        <td>{{$op->contra->demanda->producto->nombre}} {{$op->contra->demanda->producto->descripcion}} {{$op->contra->demanda->producto->descripcion2}}</td>
                                        <td>{{$op->contra->demanda->modo->descripcion}} X {{$op->contra->demanda->peso}} {{$op->contra->demanda->medida->descripcion}}</td>
                                        <td>{{$op->contra->demanda->producto->categoria->descripcion}}</td>
                                        <td>{{$op->contra->cantidad}}</td>
                                        <td>{{$op->contra->demanda->fechaEntrega}}</td>
                                        <td>$ {{$op->contra->precio}}</td>
                                        <td>{{$op->contra->cobro->descripcion}}</td>
                                        <td>{{$op->contra->plazo}}</td>
                                        <td>{{$op->contra->puesto->descripcion}}</td>                           
                                    </tr>
                                @endforeach
                            </tbody>
                </table>
            </div>
        </div>
    </div>
    @endguest
    <hr>
    <a type="button" href="{{ url('/') }}" class="btn btn-primary admin" title="Volver">Volver</a>
@stop