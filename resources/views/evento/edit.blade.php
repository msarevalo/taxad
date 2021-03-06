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
    </style>

  </head>
  <body>

    <div class="container">
      <h3>Evento</h3>
      <a class="btn btn-light"  href="{{ asset('calendario') }}">Atras</a>
      <hr>

      @if (count($errors) > 0)
        <div class="alert alert-danger">
         <button type="button" class="close" data-dismiss="alert">×</button>
         <ul>
          @foreach ($errors->all() as $error)
           <li>{{ $error }}</li>
          @endforeach
         </ul>
        </div>
       @endif
       @if ($message = Session::get('success'))
       <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>{{ $message }}</strong>
       </div>
       @endif


      <div class="col-md-6">
        <form action="{{route('calendario.editar', $event->id)}}" method="post">
          @method('PUT')
          @csrf
          <div class="fomr-group">
            <label>Titulo</label>
            <input type="text" class="form-control" name="titulo" maxlength="16" placeholder="Titulo" value="{{$event->titulo}}">
          </div>
          <div class="fomr-group">
            <label>Descripcion del Evento</label>
            <textarea type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripcion del evento" rows="4" style="resize: none;" maxlength="190" onpaste="contarcaracteres();" onkeyup="contarcaracteres();">{{$event->descripcion}}</textarea>
            <label id="res" style="color: #bbbbbb;">{{strlen($event->descripcion)}} / 190</label>
          </div>
          <div class="fomr-group">
            <label>Propietario</label><br>
            @if($event->broadcast==0)
              <input type="radio" name="usuario" value="{{  Auth::user()->id  }}" checked="checked">Evento para mi<br>
              <input type="radio" name="usuario" value="0">Evento para la comunidad<br><br>
            @else
              <input type="radio" name="usuario" value="{{  Auth::user()->id  }}">Evento para mi<br>
              <input type="radio" name="usuario" value="0" checked="checked">Evento para la comunidad<br><br>
            @endif
          </div>
          <div class="fomr-group">
            <label>Prioridad</label>
            <select name="prioridad" id="prioridad" class="form-control" required>
              <option disabled>Seleccione la prioridad</option>
              @if($event->prioridad==3)
                <option value="3" selected>Bajo</option>
                <option value="2">Medio</option>
                <option value="1">Alta</option>
              @elseif($event->prioridad==2)
                <option value="3">Bajo</option>
                <option value="2" selected>Medio</option>
                <option value="1">Alta</option>
              @else
                <option value="3">Bajo</option>
                <option value="2">Medio</option>
                <option value="1" selected>Alta</option>
              @endif
            </select>
          </div>
          <div class="fomr-group">
            <label>Fecha</label>
            @php($timezone  = -5)
            @php($fecha=gmdate("Y-m-d", time() + 3600*($timezone+date("I"))))
            <input type="date" class="form-control" name="fecha" min="{{$fecha}}" value="{{$event->fecha}}">
          </div>
          <br>
          <input type="submit" class="btn btn-info" value="Guardar">
        </form>
      </div>


      <!-- inicio de semana -->


    </div> <!-- /container -->

    <!-- Footer -->

  </body>
</html>
@endsection

@section('scripts')
  <script src="../../js/evento.js"></script>
@endsection