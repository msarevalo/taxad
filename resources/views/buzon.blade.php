@extends('autenticacion')

<title>Taxad | Buzon</title>

@section('formulario')
<meta name="csrf-token" content="{{ csrf_token() }}">
<table class="table col-8">
	<thead>
        <tr>
        	<th scope="col">#</th>
            <th scope="col">Usuario</th>
            <th scope="col">Nombre</th>
            <th scope="col">Fecha</th>
            <th scope="col">Estado</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>

        @foreach($mensajes as $mensaje)
        	<tr>
        		<th>
        			<p>{{$mensaje->id}}</p>
        		</th>
        		<td>
        			<p>{{$mensaje->username}}</p>
        		</td>
        		<td>
        			<p>{{$mensaje->nombre}} {{$mensaje->apellidos}}</p>
        		</td>
        		<td>
        			<p>{{$mensaje->fecha}}</p>
        		</td>
        		<td>
        			@foreach($notificaciones as $notificacion)
        				@if($notificacion->mensaje==$mensaje->id)
        					@if($notificacion->lectores!==NULL)
        						@php($lector=explode('_', $notificacion->lectores))
        						@if(in_array(Auth::user()->username, $lector))
        							<p style="color: green">Leido</p>
        						@else
        							<p style="color: #FACC2E">Pendiente por leer</p>
        						@endif
        					@else
        						<p style="color: #FACC2E">Pendiente por leer</p>
        					@endif
        				@endif
        			@endforeach
        		</td>
        		<td>
					<button type="button" class="btn btn-primary video-btn" data-toggle="modal" onclick="mostar('{{$mensaje->username}}','{{$mensaje->nombre}} {{$mensaje->apellidos}}','{{$mensaje->fecha}}','{{$mensaje->mensaje}}'), leido('{{$mensaje->id}}','{{Auth::user()->username}}')" data-target="#myModal">
						Ver
					</button>
        		</td>
        	</tr>
        @endforeach
    </tbody>
</table>
{{$mensajes->links()}}

<div class="modal fade" id="myModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<div class="panel-heading" id="cabecera">
					<center>
						<h5>Mensaje del conductor</h5>
					</center>
				</div>
				<button type="button" class="close">
					<span onclick="location.reload()">&times;</span>
				</button>        
				<div class="embed-responsive embed-responsive-16by9" id="cont-modal">
  					<div id="video"></div>
				</div>
      		</div>
    	</div>
  	</div>
</div> 

<style type="text/css">
	.modal-dialog {
    	max-width: 500px;
	}

	#video{
		margin-top: -250px;
		margin-left: 30px
	}

	#cabecera{
		background-color: #132644;
		height: 50px;
		color: #FFFFFF;
		padding-top: 10px;
	}

	#cont-modal{
		height: 300px;
	}


	.modal-body {
  		position:relative;
		padding:0px;
	}

	.close {
		cursor: pointer;
		position:absolute;
  		right:5px;
  		top:0;
  		z-index:999;
  		text-transform: none;
  		font-weight: normal;
  		color:#FFFFFF;
  		opacity:1;
	}
</style>
@endsection

@section('scripts')
	<script src="../js/buzon.js"></script>
@endsection