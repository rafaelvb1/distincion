<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Correo{

	private $CI =& get_instance();
	private $correoDb = "correos";



	public function __construct(){
    	$this->CI->load->model('entidad');
    }


    public function obteberDatosCorreo($tabla,$parametros,$campoOrder,$arrayWhere){
    	// OBTENER TODOS LOS DATOS ASOCIADOS 
    	$datos = $this->entidad->getModelBase($tabla,$parametros,$campoOrder,"DESC",$arrayWhere);
    	$update = array();

    	// CAMBIAR A ESTATUS EN PROCESO EL CORREO
    	if ( !empty( $datos) ) {
    		foreach ($datos as $key => $valDatos) {
    			$update[] = array('id_correo'=>$valDatos[$campoOrder]);
    		}
    	}
    }


    public function saveCorreo($data){
    	$this->entidad->save->($this->correoDb,$data);
    }



}  

?>