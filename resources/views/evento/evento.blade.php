@extends('autenticacion')

<title>Taxad | Calendario</title>

@section('formulario')
<html>
  <head>
    <title></title>
    <meta content="">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Exo&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
    body{
      font-family: 'Exo', sans-serif;
    }
    .header-col{
      background: #E3E9E5;
      color:#536170;
      text-align: center;
      font-size: 20px;
      font-weight: bold;
    }
    .header-calendar{
      background: #EE192D;color:white;
    }
    .box-day{
      border:1px solid #E3E9E5;
      height:150px;
    }
    .box-dayoff{
      border:1px solid #E3E9E5;
      height:150px;
      background-color: #ccd1ce;
    }
    .right{
      float: right;
    }
    </style>

  </head>
  <body>

    <div class="container">
      <div style="height:50px"></div>
      <a class="btn btn-light"  href="{{ asset('/calendario') }}">Atras</a>
      @php($timezone  = -5)
            @php($fecha=gmdate("Y-m-d", time() + 3600*($timezone+date("I"))))
      @if(Auth::user()->id==$event->propietario && $event->fecha>$fecha && $event->estado==1)
        <div class="right">
          <a href="{{route('calendario.edita', $event->id)}}" style="text-decoration: none;" class="btn btn-info">Editar</a>
          <a href="{{route('calendario.delete', $event->id)}}" style="text-decoration: none;" class="btn btn-danger">Eliminar</a>
        </div>
      @endif
      <h1 style="margin-top: 20px;">{{ $event->titulo }}</h1>
      @if($event->broadcast==0)
        <p style="font-size: 14.5px;">Evento propio</p>
      @else
        <p style="font-size: 14.5px;">Evento de la comunidad</p>
      @endif
      <hr>

      <div class="col-md-6">
        <div class="fomr-group">
            <h5 style="display: inline;">Prioridad:&nbsp;&nbsp;&nbsp;&nbsp; </h5>
            @if($event->prioridad==1)
              Alto
            @elseif($event->prioridad==2)
              Medio
            @else
              Bajo
            @endif
          </div><br><br>
          <div class="fomr-group">
            <h5>Descripcion del Evento</h5>
            {{ $event->descripcion }}
          </div><br><br>
          
          <div class="fomr-group">
            <h5 style="display: inline;">Fecha: &nbsp;&nbsp;&nbsp;&nbsp;</h5>
            {{ $event->fecha[8] }}{{ $event->fecha[9] }}{{ $event->fecha[7] }}{{ $event->fecha[5] }}{{ $event->fecha[6] }}{{ $event->fecha[4] }}{{ $event->fecha[0] }}{{ $event->fecha[1] }}{{ $event->fecha[2] }}{{ $event->fecha[3] }}
          </div>
          <br>
      </div>


      <!-- inicio de semana -->


    </div> <!-- /container -->


  </body>
</html>
@endsection