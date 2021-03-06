@extends('autenticacion')

<title>Taxad | Conductor</title>

@section('formulario')
    <h1>Detalle del conductor {{$conductor->name}}:</h1>
    <h4>id: {{$conductor->id}}</h4>
    <h4>Documento: {{$conductor->document}}</h4>
    <h4>Nombres: {{$conductor->name}}</h4>
    <h4>Apellidos: {{$conductor->lastname}}</h4>
    @if($conductor->estado)
        <h4>Estado: Activo</h4>
    @else
        <h4>Estado: Inactivo</h4>
    @endif
@endsection