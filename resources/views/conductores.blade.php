@extends('autenticacion')

<title>Taxad | Conductores</title>

@section('formulario')
    @if(session('mensaje'))
        <div class="alert alert-success">
            {{session('mensaje')}}
        </div>
    @endif
    @if(session('mensaje-delete'))
        <div class="alert alert-danger">
            {{session('mensaje-delete')}}
        </div>
    @endif
    <div class="container">
        <a href="{{ route('conductor.crea') }}" class="btn btn-primary">Crear</a>
    </div>
    <h1>Estos son nuestros conductores:</h1>

    @foreach($conductores as $conductor)
        <!--<a href="{{ route('conductor', $conductor) }}" class="h4 text-danger">{{$conductor}}</a><br>-->
    @endforeach


    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Documento</th>
            <th scope="col">Nombre</th>
            <th scope="col">Estado</th>
            <th scope="col">Fecha Creacion</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($conductores as $conductor)
        <tr>
            <th scope="row">{{$conductor->id}}</th>
            <td>
                <a href="{{route('conductor.detalle', $conductor)}}">
                    {{$conductor->documento}}
                </a>
            </td>
            <td>
                <a href="{{route('conductor.detalle', $conductor)}}">
                    {{$conductor->nombres . " " .  $conductor->apellidos}}
                </a>
            </td>
            @if($conductor->estado==1)
                <td>Activo</td>
            @elseif($conductor->estado==0)
                <td>Inactivo</td>
            @else
                <td>Por Aprobar</td>
            @endif
            <td>{{$conductor->created_at}}</td>
            <td>
                @if($conductor->estado==2)
                    <a href="{{route('conductor.permitir', $conductor)}}" style="text-decoration: none">
                        <button style="width: 30px; height: 30px" class="btn btn-sm"><img src="http://localhost/taxad/resources/img/aprobar.png" style="width: 130%; text-decoration: none"></button>
                    </a>
                    <form action="{{route('conductor.negar', $conductor)}}" method="post" class="d-inline">
                        @method('DELETE')
                        @csrf
                        <button style="width: 30px; height: 30px" class="btn btn-sm"><img src="http://localhost/taxad/resources/img/negar.png" style="width: 150%; text-decoration: none"></button>
                    </form>
                @else
                    <a href="{{route('conductor.edita', $conductor)}}" style="text-decoration: none">
                        <button style="width: 30px; height: 30px" class="btn btn-sm"><img src="http://localhost/taxad/resources/img/edit.png" style="width: 230%"></button>
                    </a>
                @endif
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {{ $conductores->links() }}
@endsection