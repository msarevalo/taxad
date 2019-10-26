@extends('autenticacion')

<title>Taxad | Conductores</title>

@section('formulario')
    <div class="container">
        <form action="{{route('conductor.editar', $conductor->id)}}" method="post">
            @method('PUT')
            @csrf
            <input type="number" name="documento" value="{{$conductor->documento}}" disabled class="form-control mb-2" required>
            <input type="text" name="nombres" value="{{$conductor->nombres}}" placeholder="Nombres" class="form-control mb-2" required>
            <input type="text" name="apellidos" value="{{$conductor->apellidos}}" placeholder="Apellidos" class="form-control mb-2" required>
            <select class="form-control mb-2" name="estado" required>
                @if($conductor->estado==1)
                    <option selected value="1">Activo</option>
                    <option value="0">Inactivo</option>
                @elseif($conductor->estado==2)
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                @else
                    <option value="1">Activo</option>
                    <option selected value="0">Inactivo</option>
                @endif
            </select>
            <button class="btn btn-primary btn-block" type="submit">Agregar</button>
        </form>
    </div>
@endsection