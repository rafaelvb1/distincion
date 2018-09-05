<script type="text/javascript">
	


function eliminarFoto(fotoId,productoId){

	$.ajax({
	    url : '<?php echo base_url(); ?>admin/foto-eliminar/'+fotoId,
	    type : 'GET',
	    beforeSend: function(xhr, status) {
	        $("#peticion").html('<i class="fa fa-spin fa-spinner"></i> Procesando Petición!');
	    },
	    success : function(text) {
	    	$("#peticion").html("");
	    },
	    error : function(xhr, status) {
	        $("#peticion").html("");
	    },
	    complete : function(xhr, status) {
	        $("#peticion").html("");
	    }
	});

	window.location.href = '<?php echo base_url(); ?>'+urlDetalleProductos+productoId;

}
function eliminarFotoMecanismo(fotoId,productoId){

$.ajax({
    url : '<?php echo base_url(); ?>admin/foto-mecanismo-eliminar/'+fotoId,
    type : 'GET',
    beforeSend: function(xhr, status) {
        $("#peticion").html('<i class="fa fa-spin fa-spinner"></i> Procesando Petición!');
    },
    success : function(text) {
        $("#peticion").html("");
    },
    error : function(xhr, status) {
        $("#peticion").html("");
    },
    complete : function(xhr, status) {
        $("#peticion").html("");
    }
});

window.location.href = '<?php echo base_url(); ?>'+urlDetalleProductos+productoId;

}
function eliminarFotoMasaje(fotoId,productoId){

$.ajax({
    url : '<?php echo base_url(); ?>admin/foto-masaje-eliminar/'+fotoId,
    type : 'GET',
    beforeSend: function(xhr, status) {
        $("#peticion").html('<i class="fa fa-spin fa-spinner"></i> Procesando Petición!');
    },
    success : function(text) {
        $("#peticion").html("");
    },
    error : function(xhr, status) {
        $("#peticion").html("");
    },
    complete : function(xhr, status) {
        $("#peticion").html("");
    }
});

window.location.href = '<?php echo base_url(); ?>'+urlDetalleProductos+productoId;

}
function eliminarVideo(fotoId,productoId){

$.ajax({
    url : '<?php echo base_url(); ?>admin/video-eliminar/'+fotoId,
    type : 'GET',
    beforeSend: function(xhr, status) {
        $("#peticion").html('<i class="fa fa-spin fa-spinner"></i> Procesando Petición!');
    },
    success : function(text) {
        $("#peticion").html("");
    },
    error : function(xhr, status) {
        $("#peticion").html("");
    },
    complete : function(xhr, status) {
        $("#peticion").html("");
    }
});

window.location.href = '<?php echo base_url(); ?>'+urlDetalleProductos+productoId;

}
function eliminarVideoMecanismo(videoId,productoId){

$.ajax({
    url : '<?php echo base_url(); ?>admin/video-mecanismo-eliminar/'+videoId,
    type : 'GET',
    beforeSend: function(xhr, status) {
        $("#peticion").html('<i class="fa fa-spin fa-spinner"></i> Procesando Petición!');
    },
    success : function(text) {
        $("#peticion").html("");
    },
    error : function(xhr, status) {
        $("#peticion").html("");
    },
    complete : function(xhr, status) {
        $("#peticion").html("");
    }
});

window.location.href = '<?php echo base_url(); ?>'+urlDetalleProductos+productoId;

}
function eliminarVideoMasaje(videoId,productoId){

$.ajax({
    url : '<?php echo base_url(); ?>admin/video-masaje-eliminar/'+videoId,
    type : 'GET',
    beforeSend: function(xhr, status) {
        $("#peticion").html('<i class="fa fa-spin fa-spinner"></i> Procesando Petición!');
    },
    success : function(text) {
        $("#peticion").html("");
    },
    error : function(xhr, status) {
        $("#peticion").html("");
    },
    complete : function(xhr, status) {
        $("#peticion").html("");
    }
});

window.location.href = '<?php echo base_url(); ?>'+urlDetalleProductos+productoId;

}

function marcarComoPrincipal(productoId,fotoId){

	$.ajax({
	    url : '<?php echo base_url(); ?>admin/marcar-foto-principal/'+productoId+"/"+fotoId,
	    type : 'GET',
	    beforeSend: function(xhr, status) {
	        $("#peticion").html();
	    },
	    success : function(text) {
	    	$("#peticion").html("");
	    },
	    error : function(xhr, status) {
	        $("#peticion").html("");
	    },
	    complete : function(xhr, status) {
	        $("#peticion").html("");
	    }
	});

	window.location.href = '<?php echo base_url(); ?>'+urlDetalleProductos+productoId;

}


var FormCrearProducto = function () {

    // basic validation
    var validaCrearProducto = function() {
        // for more info visit the official plugin documentation: 
            // http://docs.jquery.com/Plugins/Validation

            var form1 = $('#salvar-producto');
            var error1 = $('.alert-danger', form1);
            var success1 = $('.alert-success', form1);

            form1.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                 rules: {
                    nombre: {
                        required: true
                    },
                    alto: {
                        required: true,
                        number: true
                    },
                    ancho: {
                        required: true,
                        number: true
                    },
                    profundo: {
                        number: true
                    },
                    categoria_id: {
                        required: true,
                        min:0
                    },
                    color_id: {
                        required: true,
                        min:0
                    },
                    tapiz_id: {
                        required: true,
                        min:0
                    },
                    mecanismo_id: {
                        required: true,
                        min:0
                    },
                    estatus: {
                        required: true,
                        min:0
                    }
                },
                messages: {
			        nombre:    "Ingrese el nombre del producto",
			        alto:      "Ingrese el alto en centímetros",
			        ancho :    "Ingrese el ancho en centímetros",
			        profundo:  "Ingrese el profundo en centímetros",
			        categoria_id: "Ingrese la categoría",
			        color_id:     "Ingrese el color",
			        tapiz_id:     "Ingrese el tapiz",
			        mecanismo_id: "Ingrese el mecanísmo",
			        estatus:   "Ingrese el estatus",
			    },

                invalidHandler: function (event, validator) { //display error alert on form submit              
                    success1.hide();
                    error1.show();
                    App.scrollTo(error1, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); // set success class to the control group
                },

                submitHandler: function (form) {
                    success1.show();
                    error1.hide();
                    form[0].submit(); // submit the form
                }
            });


    }

    return {
        //main function to initiate the module
        init: function () {
            validaCrearProducto();
        }

    };

}();

jQuery(document).ready(function() {
    FormCrearProducto.init();
});


</script>