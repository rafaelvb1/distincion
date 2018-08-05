<script type="text/javascript">


function editarUsuario(usuarioId) {
    $.getJSON( "<?php echo base_url(); ?>admin/usuarios-detalle-json/"+usuarioId, function( data ) {
      $.each( data, function( key, val ) {
            $("#usuario").val(val.usuario);
            $("#password").val(val.password);
            $("#nombre").val(val.nombre);
            $("#apellido_paterno").val(val.apellido_paterno);
            $("#email").val(val.email);
            $("#tipo").val(val.tipo);
            $("#estatus").val(val.estatus);
            $("#idUsuario").val(val.id_usuario);
      });
        
    }); 
} 


function generaPassword() {
    $.getJSON( "<?php echo base_url(); ?>admin/usuarios-genera-password-json", function( data ) {
        $("#password_crear").val(data);
        
    }); 
} 


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


