<script type="text/javascript">
	
$('#estado').on('change', function() {
    
    $.getJSON( "<?php echo base_url(); ?>admin/localidades-json/"+ this.value, function( data ) {
      var mpo = $("#municipio").empty();
      $.each( data, function( key, val ) {
        	mpo.append($("<option />").val(val.id).text(val.nombre));
      });
        
    });  
});



function verDetalleContacto(sucursalId) {
    $.getJSON( "<?php echo base_url(); ?>admin/tienda-detalle-contacto-json/"+sucursalId, function( data ) {
      $.each( data, function( key, val ) {
            $("#nombre_completo_contacto").html(val.nombre_completo_contacto);
            $("#telefono_contacto").html(val.telefono_contacto);
            $("#correo_contacto").html(val.correo_contacto);
            $("#comentarios_contacto").html(val.comentarios_contacto);
      });
        
    }); 
} 


var FormAltaSucursal = function () {

    // basic validation
    var validarAltaSucursal = function() {
        // for more info visit the official plugin documentation: 
            // http://docs.jquery.com/Plugins/Validation

            var form1 = $('#form_alta_sucursal');
            var error1 = $('.alert-danger', form1);
            var success1 = $('.alert-success', form1);


            form1.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                 rules: {
                    nombre_sucursal: {
                        required: true
                    },
                    codigo: {
                        required: true
                    },
                    estado: {
                        required: true,
                        min:0
                    },
                    municipio: {
                        required: true,
                        min:0
                    },
                    estatus: {
                        required: true,
                        min:0
                    },
                    cp: {
                        required: true,
                        digits: true
                    },
                    nombre_completo_contacto: {
                        required: true
                    },
                    telefono_contacto: {
                        required: true
                    },
                    correo_contacto: {
                        required: true,
                        email: true
                    }
                },
                messages: {
			        nombre_sucursal:    "Ingrese Nombre de la sucursal",
			        codigo:    "Ingrese Código de la tienda",
			        estado:    "Ingrese Estado de la sucursal",
			        municipio: "Ingrese Municipio la sucursal",
			        cp:        "Ingrese Código postal de la sucursal",
			        estatus:   "Ingrese Estatus de la sucursal",
			        nombre_completo_contacto: "Ingrese Nombre completo del gerente o contacto",
			        telefono_contacto:  "Ingrese el número de teléfono",
			        correo_contacto:    "Ingresa un correo válido"
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
            validarAltaSucursal();
        }

    };

}();

jQuery(document).ready(function() {
    FormAltaSucursal.init();
});

</script>


