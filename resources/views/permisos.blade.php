@extends('autenticacion')

<title>Taxad | Permisos</title>

@section('formulario')

@if(session('mensaje'))
    <div class="alert alert-success">
        {{session('mensaje')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(session('negar'))
    <div class="alert alert-danger">
        {{session('negar')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="container">
    </div>
    <h1>Permisos:</h1>


    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre Perfil</th>
            <th scope="col">Menus Activos</th>
            <th scope="col">Menus Asignados</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
        	@foreach($listap as $perfil)
        		<tr>
	        		<th>
	        			{{$perfil->id}}
	        		</th>
	        		<td>
	        			{{$perfil->nombrePerfil}}
	        		</td>
	        		<td>
	        			{{$menus}}
	        		</td>
	        		<td>
	        			@foreach($permisos as $permiso)
	        				@if($permiso->perfil==$perfil->id)
	        					{{$permiso->conteo}}
	        				@endif
	        			@endforeach
	        		</td>
	        		<td>
	        			@if($perfil->nombrePerfil!=="Superadmin")
		        			<a href="{{ route('permisos.configura', $perfil->id) }}" style="text-decoration: none">
	                			<button style="width: 30px; height: 30px" class="btn btn-sm"><i class="fa fa-cog" aria-hidden="true" title="Configurar Permisos"></i></button>
	                 		</a>
	                 	@endif
	        		</td>
        		</tr>
        	@endforeach
        </tbody>
    </table>

@endsection