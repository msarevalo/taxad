@extends('autenticacion')

<title>Taxad | Taxis</title>

@section('formulario')
    <div class="container">
        <form action="{{route('taxi.asignar', $taxi->id)}}" method="post">
            @csrf
            <input type="text" name="placa" value="{{$taxi->placa}}" disabled class="form-control mb-2" required>
            <select style="text-transform: capitalize" name="idCond[]" class="form-control mb-2" multiple="multiple">
                <option selected disabled>Seleccione una opcion</option>
                @foreach($conductores as $conductor)
                    <option style="text-transform: capitalize" value="{{$conductor->id}}">{{$conductor->name}} {{$conductor->lastname}}</option>
                @endforeach
            </select>
            <button class="btn btn-primary btn-block" type="submit">Agregar</button>
        </form>
    </div>
@endsection