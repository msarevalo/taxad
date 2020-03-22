@extends('autenticacion')

<title>Taxad | Taxis</title>

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
        <a href="{{ route('taxi.crea') }}" class="btn btn-primary">Crear Vehiculo</a>
    </div>
    <h1>Listado de Taxis:</h1>

    <table class="table col-8">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Placa</th>
            <th scope="col">Marca</th>
            <th scope="col">Modelo y Serie</th>
            <th scope="col">Conductores</th>
            <th scope="col">Estado</th>
            <th scope="col">Fecha Creacion</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>

        @foreach($taxdet as $taxi)
            <tr>
                <th scope="row">{{$taxi->id}}</th>
                <td>
                    <a href="{{route('taxi.detalle', $taxi->id)}}">
                        {{$taxi->placa}}
                    </a>
                </td>
                <td>
                    {{$taxi->marca}}
                </td>
                <td>
                    {{$taxi->modelo}} - {{$taxi->serie}}
                </td>
                <td>
                    @php($contador=0)
                    @foreach($conductores as $conductor)
                        @if($conductor->idTaxi==$taxi->id)
                            {{$conductor->name}} {{$conductor->lastname}};     
                            @php($contador++)
                        @endif
                    @endforeach
                    @if($contador==0)
                        Sin Conductores
                    @endif
                </td>
                @if($taxi->estado==1)
                    <td>Activo</td>
                @else($taxi->estado==0)
                    <td>Inactivo</td>
                @endif
                <td>{{$taxi->created_at}}</td>
                <td>                    
                    <a href="{{route('taxi.edita', $taxi->id)}}" style="text-decoration: none">
                        <i class="fa fa-pencil-square-o" aria-hidden="true" style="color: black"></i>
                    </a>
                    
                    @if($taxi->estado==1 && $contador!=0)
                        <a href="{{route('taxi.reporta', $taxi->id)}}" style="text-decoration: none">
                            <img src="../../img/ingresos.png" style="width: 15%" title="Reportar">
                        </a>
                    @endif
                    @if($contador==0)
                        <a href="{{route('taxi.asigna', $taxi->id)}}" style="text-decoration: none">
                            <img src="../../img/asignar.png" style="width: 15%">
                        </a>
                    @endif
                    
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$taxdet->links()}}
@endsection