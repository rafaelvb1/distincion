<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('showMessage'))
{
    function showMessage()
    {
        $ci=&get_instance();

		if($ci->session->flashdata('exitoso')){

            echo "<div class='alert alert-success fade in'>".
                 " <button data-dismiss='alert' class='close' type='button'>×</button> ".
                 " <strong>Listo! </strong>".$ci->session->flashdata('exitoso').".</div>";

        }elseif($ci->session->flashdata('error')){
            echo "<div class='alert alert-danger  fade in'>
                  <button data-dismiss='alert' class='close' type='button'>×</button>
                 <strong>Error! </strong>".$ci->session->flashdata('error').".</div>";
        }
		
    }   
}