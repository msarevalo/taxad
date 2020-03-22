@extends('autenticacion')

<title>Taxad | Menus</title>

@section('formulario')

<div class="container">
    </div>
    <h1>Listado Perfiles:</h1>


    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($perfiles as $perfil)
        	<tr>
        		<th>
        			{{$perfil->id}}
        		</th>
        		<td>
        			{{$perfil->nombrePerfil}}
        		</td>
        		<td>
        			<a href="#" style="text-decoration: none">
                		<button style="width: 30px; height: 30px" class="btn btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                 	</a>
        		</td>
        	</tr>
        @endforeach

@endsection