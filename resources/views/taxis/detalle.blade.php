@extends('autenticacion')

<title>Taxad | Taxi</title>

@section('formulario')
    <a class="btn btn-light"  href="{{ route('taxis') }}">Atras</a>
    <a class="btn btn-info"  href="{{ route('taxi.edita', $taxi->id) }}">Editar</a>
    <a class="btn btn-primary"  href="{{ route('taxi.reporta', $taxi->id) }}">Reportar</a>
    <h3>Detalle del taxi {{$taxi->placa}}:</h3>
    <table class="table col-8">
      <thead>
        <tr>
          <th scope="col">id</th>
          <th scope="col">Placa</th>
          <th scope="col">Marca</th>
          <th scope="col">Modelo</th>
          <th scope="col">Serie</th>
          <th scope="col">Conductores</th>
          <th scope="col">Estado</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{$taxi->id}}</td>
          <td>{{$taxi->placa}}</td>
          <td>
            @foreach($marcas as $marca)
              @if($marca->id==$taxi->marca)
                {{$marca->marca}}
              @endif
            @endforeach
          </td>
          <td>{{$taxi->modelo}}</td>
          <td>{{$taxi->serie}}</td>
          <td>
            @php($contador=0)
            @foreach($conductores as $conductor)
              @if($conductor->idTaxi==$taxi->id)
                <a href="{{route('conductor.detalle', $conductor->id)}}"> {{$conductor->name}} {{$conductor->lastname}}</a> ;
                @php($contador++)
              @endif
            @endforeach
          </td>
          <td>
            @if($taxi->estado==1)
                Activo
            @else
              Inactivo
            @endif
          </td>
        </tr>
      </tbody>
    </table>
    <html>
  <head>
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
      google.charts.load('current', {'packages':['gauge']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['Kilometraje', 0],
          ['Kilometraje', 0],
        ]);

        var options = {
          width: 500, height: 220,
          redFrom: 88000, redTo: 100000,
          yellowFrom:70000, yellowTo: 88000,
          greenFrom: 50000, greenTo: 70000,
          minorTicks: 5,
          animation:{
            duration: 1000,
            easing: 'out'
            },
          max: 100000
        };

        var chart = new google.visualization.Gauge(document.getElementById('chart_div'));
        
        chart.draw(data, options);

        setInterval(function() {
          data.setValue(0, 1, 65000);
          chart.draw(data, options);
        }, 100);
        setInterval(function() {
          data.setValue(1, 1, 20000);
          chart.draw(data, options);
        }, 100);
      }


      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
          ['Semana', 'Producido', 'Gastos', 'Entrada'],
          @php($contador=0)
          @foreach($registros as $registro)
            ['{{$registro->semana}}', {{$registro->producido}}, {{$registro->gastos}}, {{$registro->pago}}],
            @php($contador=$registro->id)
          @endforeach
        ]);

        var options = {
          title : 'Producido vs Gastos - Ultimo Mes',
          vAxis: {title: 'Dinero'},
          hAxis: {title: 'Semana'},
          seriesType: 'bars',
          };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div_barras'));
        @if($contador!=0)
          chart.draw(data, options);
        @endif
        
      }

    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 400px; height: 120px;"></div>

    <div id="chart_div_barras" style="width: 900px; height: 250px; margin-top: 100px"></div>
  </body>
</html>
@endsection