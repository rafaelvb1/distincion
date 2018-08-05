<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script type="text/javascript">

    google.charts.load('current', {'packages':['corechart']});

    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawChart);
      
    function drawChart() {
        
        var data = google.visualization.arrayToDataTable([
          ['Mueble', 'Visitas'],
          <?php
          
              foreach ($listadoReporte as $key => $valReportes) {
                echo "['".$valReportes['nombre']."', ".$valReportes['cantidad']."],";
              }
          
          ?>
        ]);
    
        var options = {
            width: 900,
            height: 500,
        };
    
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
    
        chart.draw(data, options);
    }
</script>
 
 
<h1>Muebles mas visitados últimos 8 días</h1>
<div id="chart_div" style="width: 900px; height: 500px;"></div>