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
					<select style="text-transform: capitalize" name="{{$menu->nombre}}[]" class="custom-select" multiple="multiple" required style="">
					@foreach($perfil as $per)
						@if($per->menu==$menu->id)
							@if($per->ver==1)
								<option style="text-transform: capitalize" value="verm-{{$menu->id}}" selected>Ver</option>
							@endif
						@endif
			        @endforeach
		            </select>
				</td>
			</tr>
		@endforeach
	</tbody>
	{{$menus->links()}}
@endsection