@extends('autenticacion')

<title>Taxad | Taxi</title>

@section('formulario')
    <h1>Detalle del taxi {{$taxi->placa}}:</h1>
    <h4>id: {{$taxi->id}}</h4>
    <h4>Placa: {{$taxi->placa}}</h4>
    <h4>Marca: {{$taxi->marca}}</h4>
    <h4>Modelo: {{$taxi->modelo}}</h4>
    <h4>Serie: {{$taxi->serie}}</h4>
    @if($taxi->estado)
        <h4>Estado: Activo</h4>
    @else
        <h4>Estado: Inactivo</h4>
    @endif
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
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 400px; height: 120px;"></div>
  </body>
</html>
@endsection