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
        var dataMasaje = google.visualization.arrayToDataTable([
          ['Mueble', 'Visitas'],
          <?php
          
              foreach ($listadoMasaje as $key => $valReportes) {
                echo "['".$valReportes['nombre']."', ".$valReportes['cantidad']."],";
              }
          
          ?>
        ]);
        var dataMecanismo = google.visualization.arrayToDataTable([
          ['Mueble', 'Visitas'],
          <?php
          
              foreach ($listadoMecanismo as $key => $valReportes) {
                echo "['".$valReportes['nombre']."', ".$valReportes['cantidad']."],";
              }
          
          ?>
        ]);
        var dataLoginVendedor = google.visualization.arrayToDataTable([
          ['Mueble', 'Visitas'],
          <?php
          
              foreach ($listadoLoginVendedor as $key => $valReportes) {
                echo "['".$valReportes['nombre']."', ".$valReportes['cantidad']."],";
              }
          
          ?>
        ]);
    
        var options = {
            width: 900,
            height: 500,
        };
    
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        var chartMasaje = new google.visualization.PieChart(document.getElementById('chart_div_masaje'));
        var chartMecanismo = new google.visualization.PieChart(document.getElementById('chart_div_mecanismo'));
        var chartLoginVendedor = new google.visualization.PieChart(document.getElementById('chart_div_loginvendedor'));
    
        chart.draw(data, options);
        chartMasaje.draw(dataMasaje,options);
        chartMecanismo.draw(dataMecanismo,options);
        chartLoginVendedor.draw(dataLoginVendedor,options);
    }
</script>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box ">
            <div class="portlet-title blue">
                <div class="col-md-5">
                    <div class="caption font-dark">
                        <i class="fa fa-deviantart font-dark"></i>
                        <span class="caption-subject bold uppercase"> Estadisticas</span>
                    </div>
                </div>    <br><br><br>
                <div class="row">
                    <div class="font-dark col-md-2">
                        <span for="tiendanot">Tienda</span>
                        <select class="form-control" name="tiendaDashboard" id="tiendaDashboard">
                            <option value="-1">Selecciona una tienda</option>
                            <?php foreach ($listadoTiendas  as $key => $valTienda) { ?>
                                <option  value="<?php echo $valTienda['id'] ?>"><?php echo $valTienda['nombre'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="font-dark col-md-4">
                        <span >Desde</span>
                        <div class="form-group">
                            <div class='input-group date' name="datetimepicker1"  id="datetimepicker1">
                                <input type='text' class="form-control"  name="datetimepicker3"  id="datetimepicker3"/>
                                <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                            </div>
                        </div>
                    </div>
                    <div class="font-dark col-md-4">
                        <span >Hasta</span>
                        <div class="form-group">
                            <div class='input-group date' name="datetimepicker2" id="datetimepicker2">
                                <input type='text' class="form-control"  name="datetimepicker4"  id="datetimepicker4"/>
                                <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                            </div>
                        </div>
                    </div>
                    <div class="font-dark col-md-2">
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-">
                                    <br>
                                    <input type="submit" value="Buscar" class="btn btn-default btn-sm"  name="buscador"  id="buscador"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <?php if (!empty($listadoReporteTienda)) { ?>
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                    <thead>
                    <tr>
                        <th> Vendedor </th>
                        <th> Modelo </th>
                        <th> Masaje </th>
                        <th>  Mecanismo </th>
                        <th>  Total </th>
                    </tr>
                    </thead>
                    <tbody id="bodyTabla">
                    <?php  foreach ($listadoReporteTienda as $key => $valProductos) { ?>

                        <tr class="odd gradeX">
                            <td> <?php echo $valProductos['usuario'] ?> </td>
                            <td> <?php echo $valProductos['detalle'] ?> </td>
                            <td> <?php echo $valProductos['masaje'] ?> </td>
                            <td> <?php echo $valProductos['mecanismo'] ?> </td>
                            <td> <?php echo $valProductos['total'] ?> </td>

                        </tr>

                    <?php } echo "</tbody></table>"; } ?>
                    <!-- END EXAMPLE TABLE PORTLET-->
         </div>
    </div>
</div>

<h1>Muebles mas visitados últimos 8 días</h1>
<div id="chart_div" style="width: 900px; height: 500px;"></div>

<h1>Masaje mas visitado últimos 8 días</h1>
<div id="chart_div_masaje" style="width: 900px; height: 500px;"></div>

<h1>Mecanismo mas visitado últimos 8 días</h1>
<div id="chart_div_mecanismo" style="width: 900px; height: 500px;"></div>

<h1>Vendedor con mas login últimos 8 días</h1>
<div id="chart_div_loginvendedor" style="width: 900px; height: 500px;"></div>