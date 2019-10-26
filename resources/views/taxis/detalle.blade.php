@extends('autenticacion')

<title>Taxad | Taxi</title>

@section('formulario')
    <h1>Detalle del taxi {{$taxi->placa}}:</h1>
    <h4>id: {{$taxi->id}}</h4>
    <h4>Placa: {{$taxi->placa}}</h4>
    <h4>Marca: {{$taxi->marca}}</h4>
    <h4>Modelo: {{$taxi->modelo}}</h4>
    <h4>Serie: {{$taxi->serie}}</h4>
    @if($taxi->estado)
        <h4>Estado: Activo</h4>
    @else
        <h4>Estado: Inactivo</h4>
    @endif
@endsection