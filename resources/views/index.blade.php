@extends('layouts.principal')

@section('content')

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
    <div class="row">
            <div class="col-md-12 col-md-offset-0 menu">
              <div class="col-md-6"><a class="btn btn-default menu" role="button" href="{{ url('/ofertas') }}"> OFERTAS </a></div>
              <div class="col-md-6"><a class="btn btn-default menu" role="button" href="{{ url('/demandas') }}">DEMANDAS </a></div>
              <div class="col-md-6"><a class="btn btn-default menu" role="button" href="{{ url('/precios') }}"> PRECIOS</a></div>
              <div class="col-md-6"><a class="btn btn-default menu" role="button" href="{{ url('operaciones') }}">OPERACIONES </a></div>
    </div>
@endsection

