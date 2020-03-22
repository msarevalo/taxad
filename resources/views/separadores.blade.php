@extends('autenticacion')

<title>Taxad | Separadores</title>

@section('formulario')
<div class="container">
        <a href="{{ route('separador.crea') }}" class="btn btn-primary">Crear</a>
    </div>
    <h1>Listado Separadores:</h1>


    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Menu Posterior</th>
            <th scope="col">Estado</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
        	@foreach($separadores as $separador)
        	<tr>
        		<th scope="row">{{$separador->id}}</th>
        		<td>
        			{{$separador->nombre}}
        		</td>
        		<td>
        			@foreach($menu as $men)
        				@if($separador->menu_posterior==$men->id)
        					{{$men->nombre}}
        				@endif
        			@endforeach
        		</td>
        		<td>
        			@if($separador->estado==1)
        				Activo
        			@else
        				Inactivo
        			@endif
        		</td>
        		<td>
        			<a href="{{ route('separador.edita', $separador->id) }}" style="text-decoration: none">
                	<button style="width: 30px; height: 30px" class="btn btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                 </a>
        		</td>
        	</tr>
        	@endforeach
        </tbody>
    </table>
@endsection