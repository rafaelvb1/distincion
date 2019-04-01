<script type="text/javascript">
$('#tiendaDashboard').on('change', function() {
// BUSCA SUCURSALES POR TIENDA Y LOCALIDAD
var tienda = jQuery("#tiendaDashboard").val();
console.log("Val:"+this.value+" Tienda: "+tienda+" "+"admin/muebles-mas-visitados-por-tienda-json/"+tienda);

$.getJSON( "<?php echo base_url(); ?>admin/muebles-mas-visitados-por-tienda-json/"+tienda, function( data ) {
console.log(data);

});
});
</script>