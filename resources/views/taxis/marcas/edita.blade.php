@extends('autenticacion')

<title>Taxad | Conductores</title>

@section('formulario')
    <div class="container">
        <form action="{{route('marca.editar', $marca->id)}}" method="post">
            @method('PUT')
            @csrf
            <input type="text" name="marca" value="{{$marca->marca}}" class="form-control mb-2" required>
            <select class="form-control mb-2" name="estado" required>
                @if($marca->estado==1)
                    <option selected value="1">Activo</option>
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