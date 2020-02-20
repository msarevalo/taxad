@extends('autenticacion')

@section('formulario')

@if(session('mensaje'))
        <div class="alert alert-success">
            {{session('mensaje')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(session('mensaje-delete'))
        <div class="alert alert-danger">
            {{session('mensaje-delete')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(session('documento'))
        <div class="alert alert-danger">
            {{session('documento')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="container">
        <a href="{{ route('conductor.crea') }}" class="btn btn-primary">Crear</a>
    </div>
    <h1>Listado Conductores:</h1>


    <table class="table">
        <thead>
        <tr>
            <th scope="col">Categoria</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categorias as $categoria)
        <tr>
            <td>
                <a href="{{route('categoria.detalle', $categoria)}}">
                    {{$categoria->categoria}}
                </a>
            </td>
            <td>
                <a href="{{route('conductor.edita', $categoria)}}" style="text-decoration: none">
                        <button style="width: 30px; height: 30px" class="btn btn-sm"><img src="../../img/edit.png" style="width: 230%" title="Editar"></button>
                    </a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {{ $categorias->links() }}

@endsection