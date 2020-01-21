@extends('autenticacion')

<title>Taxad | Marcas</title>

@section('formulario')
    @if(session('mensaje'))
        <div class="alert alert-success">
            {{session('mensaje')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{session('error')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="container">
        <a href="{{ route('marca.crea') }}" class="btn btn-primary">Crear Marca</a>
    </div>
    <h1>Listado de Marcas de Taxis:</h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Marca</th>
            <th scope="col">Estado</th>
            <th scope="col">Fecha Creacion</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($marcas as $marca)
            <tr>
                <th scope="row">{{$marca->id}}</th>
                <td>
                    <a href="{{route('marca.detalle', $marca)}}">
                        {{$marca->marca}}
                    </a>
                </td>
                @if($marca->estado==1)
                    <td>Activo</td>
                @else($marca->estado==0)
                    <td>Inactivo</td>
                @endif
                <td>{{$marca->created_at}}</td>
                <td>
                    <a href="{{route('marca.edita', $marca)}}">
                        <img src="../../img/edit.png" style="width: 5%" title="Editar">
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection