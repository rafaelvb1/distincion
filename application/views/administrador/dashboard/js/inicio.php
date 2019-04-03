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