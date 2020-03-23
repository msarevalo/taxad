@extends('autenticacion')

<title>Taxad | Permisos</title>

@section('formulario')

<div class="container">
</div>

<h1>Permisos {{$nombre->nombrePerfil}}:</h1>
{{$perfil}}<br><br>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre Menú</th>
            <th scope="col">Permisos</th>
        </tr>
    </thead>
    <tbody>
		@foreach($menus as $menu)
			<tr>
				<th>
					{{$menu->id}}
				</th>
				<td>
					{{$menu->nombre}}
				</td>
				<td>
					@foreach($perfil as $per)
						@if($per->menu==$menu->id)
						<select style="text-transform: capitalize" name="{{$menu->nombre}}[]" class="form-control mb-2" multiple="multiple" required>
							@if($per->permisos_menu==1)
								<option style="text-transform: capitalize" value="verm-{{$menu->id}}" selected>Ver Menu</option>
							@else
								<option style="text-transform: capitalize" value="verm-{{$menu->id}}">Ver Menu</option>
							@endif
							@if($per->ver==1)
		                    	<option style="text-transform: capitalize" value="ver-{{$menu->id}}" selected>Ver</option>
		                    @else
		                    	<option style="text-transform: capitalize" value="ver-{{$menu->id}}">Ver</option>
		                    @endif
		                    @if($per->crear==1)
		                    	<option style="text-transform: capitalize" value="crear-{{$menu->id}}" selected>Crear</option>
		                    @else
		                    	<option style="text-transform: capitalize" value="crear-{{$menu->id}}">Crear</option>
		                    @endif
		                    @if($per->editar==1)
		                    	<option style="text-transform: capitalize" value="editar-{{$menu->id}}" selected>Editar</option>
		                    @else
		                    	<option style="text-transform: capitalize" value="editar-{{$menu->id}}">Editar</option>
		                    @endif
		                    @if($per->eliminar==1)
		                    	<option style="text-transform: capitalize" value="eliminar-{{$menu->id}}" selected>Eliminar</option>
		                    @else
		                    	<option style="text-transform: capitalize" value="eliminar-{{$menu->id}}">Eliminar</option>
		                    @endif
							</select>
		            	@endif
		            @endforeach
				</td>
			</tr>
		@endforeach
	</tbody>
@endsection