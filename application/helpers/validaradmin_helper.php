<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('isAdministrador'))
{
    function isAdministrador()
    {
        $ci=&get_instance();
		if (!$ci->session->userdata('isAdmin')) {
		    $ci->session->set_flashdata('no_administrador', MSN_ISADMINISTRADOR);
			redirect(DASHBOARD, 'refresh');
		}

    }   
}