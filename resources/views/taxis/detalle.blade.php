@extends('autenticacion')

<title>Taxad | Taxi</title>

@section('formulario')
    <h1>Detalle del taxi {{$taxi->placa}}:</h1>
    <table class="table col-8">
      <thead>
        <tr>
          <th scope="col">id</th>
          <th scope="col">Placa</th>
          <th scope="col">Marca</th>
          <th scope="col">Modelo</th>
          <th scope="col">Serie</th>
          <th scope="col">Estado</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{$taxi->id}}</td>
          <td>{{$taxi->placa}}</td>
          <td>
            {{$taxi->marca}}
          </td>
          <td>{{$taxi->modelo}}</td>
          <td>{{$taxi->serie}}</td>
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
          ['Month', 'Bolivia', 'Ecuador', 'Madagascar', 'Papua New Guinea', 'Rwanda', 'Average'],
          ['2004/05',  165,      938,         522,             998,           450,      614.6],
          ['2005/06',  135,      1120,        599,             1268,          288,      682],
          ['2006/07',  157,      1167,        587,             807,           397,      623],
          ['2007/08',  139,      1110,        615,             968,           215,      609.4],
          ['2008/09',  136,      691,         629,             1026,          366,      569.6]
        ]);

        var options = {
          title : 'Producido vs Gastos - Ultimos 2 Mes',
          vAxis: {title: 'Cups'},
          hAxis: {title: 'Month'},
          seriesType: 'bars',
          series: {5: {type: 'line'}}        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div_barras'));
        chart.draw(data, options);
      }

    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 400px; height: 120px;"></div>

    <div id="chart_div_barras" style="width: 900px; height: 500px; margin-top: 100px"></div>
  </body>
</html>
@endsection