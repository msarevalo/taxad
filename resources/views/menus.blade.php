@extends('autenticacion')

<title>Taxad | Menus</title>

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
    <h1>Listado Menus:</h1>


    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Ruta</th>
            <th scope="col">Submenu</th>
            <th scope="col">Menu Padre</th>
            <th scope="col">Logo</th>
            <th scope="col">Orden</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($menus as $menu)
        <tr>
            <th scope="row">{{$menu->id}}</th>
            <td>
                <a href="#">
                    {{$menu->nombre}}
                </a>
            </td>
            <td>
                @if($menu->ruta==NULL)
                   	Menú Padre
                @elseif($menu->nombre=="Cerrar Sesión")
                	Cerrar Sesión
                @else
                  	<a href="{{$menu->ruta}}">
                  		{{$menu->ruta}}
                   	</a>
                @endif
            </td>
            <td>
                @if($menu->submenu==0)
                	No
                @else
                	Si
                @endif
            </td>
            <td>
            	@if($menu->submenu==1)
	                @foreach($padres as $padre)
	                    @if($padre->id==$menu->menu_padre)
	                        {{$padre->nombre}}
	                    @endif
	                @endforeach
                @else
                	-
                @endif
            </td>
            <td>
            	<span class="fa fa-fw mr-3"><i class="{{$menu->class}}" aria-hidden="true"></i></span>
            </td>
            <td>{{$menu->orden}}</td>
            <td>
            	@if($menu->nombre=="Perfil")
            	@elseif($menu->nombre=="Menús")
            	@elseif($menu->nombre=="Cerrar Sesión")
            	@else
            	<a href="{{ route('menu.edita', $menu->id) }}" style="text-decoration: none">
                	<button style="width: 30px; height: 30px" class="btn btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                 </a>
                @endif
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {{ $menus->links() }}

@endsection