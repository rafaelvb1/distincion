<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('validar_sesion'))
{
    function validar_sesion()
    {
        $ci=&get_instance();

		if ($ci->session->userdata('id_usuario')) {
			return true;
		}else{
			return false;
		}

    }   
}