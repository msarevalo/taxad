@extends('autenticacion')

<title>Taxad | Taxis</title>

@section('formulario')
    <div class="container">
        <form action="{{route('taxi.editar', $taxi->id)}}" method="post">
            @method('PUT')
            @csrf
            <input type="text" name="placa" value="{{$taxi->placa}}" disabled class="form-control mb-2" required>
            <select style="text-transform: capitalize" name="marca" class="form-control mb-2">
                <option selected disabled>Seleccione una opcion</option>
                @foreach($marcas as $marca)
                    @if($marca->marca==$taxi->marca)
                        <option style="text-transform: capitalize" value="{{$marca->marca}}" selected>{{$marca->marca}}</option>
                    @else
                        <option style="text-transform: capitalize" value="{{$marca->marca}}">{{$marca->marca}}</option>
                    @endif
                @endforeach
            </select>
            <input type="text" name="modelo" placeholder="Modelo" value="{{$taxi->modelo}}" class="form-control mb-2" required>
            <input type="number" min="2000" name="serie" placeholder="Serie" value="{{$taxi->serie}}" class="form-control mb-2" required>
            <select style="text-transform: capitalize" name="estado" class="form-control mb-2">
                @if($taxi->estado==1)
                    <option selected value="1">Activo</option>
                    <option value="0">Inactivo</option>
                @else
                    <option value="1">Activo</option>
                    <option value="0" selected>Inactivo</option>
                @endif
            </select>
            <button class="btn btn-primary btn-block" type="submit">Agregar</button>
        </form>
    </div>
@endsection