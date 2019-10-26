@extends('autenticacion')

<title>Taxad | Taxis</title>

@section('formulario')
    <div class="container">
        <form action="{{route('marca.crear')}}" method="post">
            @csrf
            <input type="text" name="marca" placeholder="Marca" class="form-control mb-2" required>
            <button class="btn btn-primary btn-block" type="submit">Agregar</button>
        </form>
    </div>
@endsection