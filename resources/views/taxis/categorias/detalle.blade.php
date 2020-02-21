@extends('autenticacion')

@section('formulario')

<a class="btn btn-light"  href="#">Atras</a>
    <a class="btn btn-info"  href="#">Editar</a>
    <a class="btn btn-primary"  href="#">Reportar</a>
    <h3>Descripciones de la categoria {{ $categoria->categoria }}:</h3>
    <table class="table col-8">
      <thead>
        <tr>
       		<th scope="col">Descripcion</th>
        	<th scope="col">Estado</th>
        	<th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
      	@foreach($descripciones as $descripcion)
      		<tr>
      			<td>
      				{{$descripcion->descripcion}}
      			</td>
      			<td>
      				@if($descripcion->estado==1)
      					Activo
      				@else
      					Inactivo
      				@endif
      			</td>
      			<td>
      				<a href="#" style="text-decoration: none">
                        <button style="width: 30px; height: 30px" class="btn btn-sm"><img src="../../img/edit.png" style="width: 230%" title="Editar"></button>
                    </a>
      			</td>
      		</tr>
      	@endforeach
      </tbody>
@endsection