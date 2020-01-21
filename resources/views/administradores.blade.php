@extends('autenticacion')

<title>Taxad | Administradores</title>

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
        <a href="{{ route('admin.crea') }}" class="btn btn-primary">Crear</a>
    </div>
    <h1>Listado Administradores:</h1>


    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Documento</th>
            <th scope="col">Usuario</th>
            <th scope="col">Nombre Completo</th>
            <th scope="col">Perfil</th>
            <th scope="col">Estado</th>
            <th scope="col">Fecha Creacion</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($administradores as $administrador)
        <tr>
            <th scope="row">{{$administrador->id}}</th>
            <td>
                <a href="{{route('admin.detalle', $administrador)}}">
                    {{$administrador->document}}
                </a>
            </td>
            <td>
                <a href="{{route('admin.detalle', $administrador)}}">
                    {{$administrador->username}}
                </a>
            </td>
            <td>
                <a href="{{route('admin.detalle', $administrador)}}">
                    {{$administrador->name . " " .  $administrador->lastname . " " . $administrador->lastname2}}
                </a>
            </td>
            <td>
                @foreach($perfiles as $perfil)
                    @if($administrador->perfil==$perfil->id)
                        {{$perfil->nombrePerfil}}
                    @endif
                @endforeach
            </td>
            @foreach($estados as $estado)
                @if($administrador->estado==$estado->id)
                    <td>{{$estado->estado}}</td>
                @endif
            @endforeach
            <td>{{$administrador->created_at}}</td>
            <td>
                    <a href="{{route('admin.edita', $administrador)}}" style="text-decoration: none">
                        <button style="width: 30px; height: 30px" class="btn btn-sm"><img src="../../img/edit.png" style="width: 230%" title="Editar"></button>
                    </a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {{ $administradores->links() }}
@endsection