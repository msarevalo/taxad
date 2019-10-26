@extends('autenticacion')

<title>Taxad | Conductor</title>

@section('formulario')
    <h1>Detalle del conductor {{$conductor->nombres}}:</h1>
    <h4>id: {{$conductor->id}}</h4>
    <h4>Documento: {{$conductor->documento}}</h4>
    <h4>Nombres: {{$conductor->nombres}}</h4>
    <h4>Apellidos: {{$conductor->apellidos}}</h4>
    @if($conductor->estado)
        <h4>Estado: Activo</h4>
    @else
        <h4>Estado: Inactivo</h4>
    @endif
@endsection