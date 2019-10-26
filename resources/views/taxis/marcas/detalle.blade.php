@extends('autenticacion')

<title>Taxad | Taxi</title>

@section('formulario')
    <h1>Detalle de la Marca {{$marca->marca}}:</h1>
    <h4>id: {{$marca->id}}</h4>
    <h4>Marca: {{$marca->marca}}</h4>
    @if($marca->estado)
        <h4>Estado: Activo</h4>
    @else
        <h4>Estado: Inactivo</h4>
    @endif
@endsection