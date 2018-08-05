<script type="text/javascript">


$('#estado').on('change', function() {
    
    $.getJSON( "<?php echo base_url(); ?>admin/localidades-json/"+ this.value, function( data ) {
      var mpo = $("#municipio").empty();
      mpo.append($("<option />").val("1").text("-"));
      $.each( data, function( key, val ) {
            mpo.append($("<option />").val(val.id).text(val.nombre));
      });
        
    });  
});


$('#municipio').on('change', function() {
    // BUSCA SUCURSALES POR TIENDA Y LOCALIDAD
    var tienda = jQuery("#tienda").val();
    console.log("Val:"+this.value+" Tienda: "+tienda+" "+"admin/sucursales-listado-localidad-json/"+tienda+"/"+this.value);

    $.getJSON( "<?php echo base_url(); ?>admin/sucursales-listado-localidad-json/"+tienda+"/"+this.value, function( data ) {
        console.log(data);
        var su = $("#sucursal_id").empty();
        su.append($("<option />").val("1").text("-"));

        $.each( data, function( key, val ) {
            su.append($("<option />").val(val.id_sucursal).text(val.nombre_sucursal));
        });
        
    });  
});




var FormCrearUsuario = function () {

    // basic validation
    var validarCrearUsuario = function() {
        // for more info visit the official plugin documentation: 
            // http://docs.jquery.com/Plugins/Validation

            var form1 = $('#usuario-crear-form');
            var error1 = $('.alert-danger', form1);
            var success1 = $('.alert-success', form1);

            form1.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                 rules: {
                    usuario: {
                        required: true
                    },
                    nombre: {
                        required: true
                    },
                    apellido_paterno: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    }
                },
                messages: {
			        usuario: "Ingrese el usuario",
			        nombre:  "Ingrese el nombre del usuario",
			        apellido_paterno: "Ingrese el apellido paterno",
			        email:            "Ingrese un email válido"
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
            validarCrearUsuario();
        }

    };

}();

jQuery(document).ready(function() {
    FormCrearUsuario.init();
});

</script>


