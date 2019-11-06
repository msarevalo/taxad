@extends('autenticacion')

<title>Taxad | Taxis</title>

@section('formulario')
    <div class="container">
        <form action="{{route('taxi.crear')}}" method="post">
            @csrf
            <input type="text" name="placa" placeholder="Placa" class="form-control mb-2" required pattern="[A-Z]{3}\d{3}" title="Recuerde que son 3 letras en mayuscula y 3 numeros. &#10; Ejm: AAA000">
            <select style="text-transform: capitalize" name="marca" class="form-control mb-2">
                <option selected disabled>Seleccione una opcion</option>
                @foreach($marcas as $marca)
                    <option style="text-transform: capitalize" value="{{$marca->id}}">{{$marca->marca}}</option>
                @endforeach
            </select>
            <input type="text" name="modelo" placeholder="Modelo" class="form-control mb-2" required>
            <input type="number" min="2000" name="serie" placeholder="Serie" class="form-control mb-2" required>
            <button class="btn btn-primary btn-block" type="submit">Agregar</button>
        </form>
    </div>
@endsection