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
					<select style="text-transform: capitalize" name="{{$menu->nombre}}[]" class="form-control mb-2" multiple="multiple" required>
						<option style="text-transform: capitalize" value="verm-{{$menu->id}}">Ver Menu</option>
		                <option style="text-transform: capitalize" value="ver-{{$menu->id}}">Ver</option>
		                <option style="text-transform: capitalize" value="crear-{{$menu->id}}">Crear</option>
		                <option style="text-transform: capitalize" value="editar-{{$menu->id}}">Editar</option>
		                <option style="text-transform: capitalize" value="eliminar-{{$menu->id}}">Eliminar</option>
		            </select>
				</td>
			</tr>
		@endforeach
	</tbody>
@endsection