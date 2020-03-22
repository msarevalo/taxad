@extends('autenticacion')

<title>Taxad | Socios</title>

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
    <h1>Listado Socios:</h1>


    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Documento</th>
            <th scope="col">Usuario</th>
            <th scope="col">Nombre Completo</th>
            <th scope="col">Estado</th>
            <th scope="col">Fecha Creacion</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($socios as $socio)
        <tr>
            <th scope="row">{{$socio->id}}</th>
            <td>
                <a href="{{route('conductor.detalle', $socio)}}">
                    {{$socio->document}}
                </a>
            </td>
            <td>
                <a href="{{route('conductor.detalle', $socio)}}">
                    {{$socio->username}}
                </a>
            </td>
            <td>
                <a href="{{route('conductor.detalle', $conductor)}}">
                    {{$socio->name . " " .  $socio->lastname . " " . $socio->lastname2}}
                </a>
            </td>
            <td>
                @foreach($perfiles as $perfil)
                    @if($conductor->perfil==$perfil->id)
                        {{$perfil->nombrePerfil}}
                    @endif
                @endforeach
            </td>
            @foreach($estados as $estado)
                @if($conductor->estado==$estado->id)
                    <td>{{$estado->estado}}</td>
                @endif
            @endforeach
            <td>{{$conductor->created_at}}</td>
            <td>
                @if($conductor->estado==2)
                    <a href="{{route('conductor.permitir', $conductor)}}" style="text-decoration: none">
                        <button style="width: 30px; height: 30px" class="btn btn-sm"><img src="../../img/aprobar.png" style="width: 130%; text-decoration: none"></button>
                    </a>
                    <form action="{{route('conductor.negar', $conductor)}}" method="post" class="d-inline">
                        @method('DELETE')
                        @csrf
                        <button style="width: 30px; height: 30px" class="btn btn-sm"><i class="fa fa-user-times" aria-hidden="true" title="Negar"></i></button>
                    </form>
                @else
                    <a href="{{route('conductor.edita', $conductor)}}" style="text-decoration: none">
                        <button style="width: 30px; height: 30px" class="btn btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                    </a>
                @endif
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {{ $conductores->links() }}
@endsection