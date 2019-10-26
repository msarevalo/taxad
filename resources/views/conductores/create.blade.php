@extends('autenticacion')

<title>Taxad | Conductores</title>

@section('formulario')
<div class="container">
    <form action="{{route('conductor.crear')}}" method="post">
        @csrf
        <input type="number" name="documento" placeholder="Documento" class="form-control mb-2" required>
        <input type="text" name="nombres" placeholder="Nombres" class="form-control mb-2" required>
        <input type="text" name="apellidos" placeholder="Apellidos" class="form-control mb-2" required>
        <button class="btn btn-primary btn-block" type="submit">Agregar</button>
    </form>
</div>
@endsection