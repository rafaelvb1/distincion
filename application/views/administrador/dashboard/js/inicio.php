<link href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.css" rel="stylesheet"/>
<link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.css" rel="stylesheet"/>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.2/moment.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

<script type="text/javascript">
$('#tiendaDashboard').on('change', function() {
// BUSCA SUCURSALES POR TIENDA Y LOCALIDAD
var tienda = jQuery("#tiendaDashboard").val();
console.log("Val:"+this.value+" Tienda: "+tienda+" "+"admin/muebles-mas-visitados-por-tienda-json/"+tienda);

$.getJSON( "<?php echo base_url(); ?>admin/muebles-mas-visitados-por-tienda-json/"+tienda, function( data ) {
console.log(data);

$('#bodyTabla').html("");

for (i = 0; i < data.length; i++) { 
    $('#bodyTabla').append("<tr><td>"+data[i].usuario+"</td><td>"+data[i].detalle+"</td><td>"+data[i].masaje+"</td><td>"+data[i].mecanismo+"</td><td>"+data[i].total+"</td></tr>");
}

});
});
</script>

<script type="text/javascript">
    $(function () {
        $('#datetimepicker1').datetimepicker();
    });
</script>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker2').datetimepicker(
        );
    });
</script>
<script type="text/javascript">
    $('#buscador').click( function(e){
        var fechaInicio= moment(jQuery("#datetimepicker3").val()).format('YYYY-MM-DD');
        var fechaFin= moment(jQuery("#datetimepicker4").val()).format('YYYY-MM-DD');
        var tienda = jQuery("#tiendaDashboard").val();
        console.log("Val:"+this.value+" Tienda: "+tienda+" "+"admin/muebles-mas-visitados-por-tienda-dias-json/"+tienda+"/"+ fechaInicio + "/" + fechaFin);

        $.getJSON( "<?php echo base_url(); ?>admin/muebles-mas-visitados-por-tienda-dias-json/"+tienda+"/"+ fechaInicio + "/" + fechaFin, function( data ) {
            console.log(data);

            $('#bodyTabla').html("");

            for (i = 0; i < data.length; i++) {
                $('#bodyTabla').append("<tr><td>"+data[i].usuario+"</td><td>"+data[i].detalle+"</td><td>"+data[i].masaje+"</td><td>"+data[i].mecanismo+"</td><td>"+data[i].total+"</td></tr>");
            }

        });
    });
</script>


