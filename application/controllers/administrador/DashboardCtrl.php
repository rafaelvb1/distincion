<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DashboardCtrl extends CI_Controller {


	function DashboardCtrl()
	{
		parent::__construct();
		// VALIDACION DE SESION
		if(!validar_sesion()){
			redirect(base_url().LOGIN);
		}
		$this->load->model("Reportes_model","mReportes");

	}


	function index(){
		$this->dashboardAdministrador();
	}

	function dashboardAdministrador(){

		$data['ubicacion']  = array('Dashboard');
		$data['titulo']     ='Bienvenido';
		$data['contenido']  ="administrador/dashboard/bienvenida.php";
		//JS EXTERNO
		$data['js_externo'] ="administrador/dashboard/js/inicio.php";
		
		$data['listadoReporte'] = $this->mReportes->obtenerMueblesMasVisitadosPorNumeroDias(8);
		$data['listadoMasaje'] = $this->mReportes->obtenerMasajeMasVisitadosPorNumeroDias(8);
		$data['listadoMecanismo'] = $this->mReportes->obtenerMecamismoMasVisitadosPorNumeroDias(8);
		$data['listadoLoginVendedor'] = $this->mReportes->obtenerLoginVendedorPorNumeroDias(8);

		// SE AGREGAN TODOS LOS DATOS A MOSTRAR EN $data
		$this->load->vars($data);
		// CARGA TEMPLATE DEFAULT
		$this->load->view('template');

	}
	
	
	function getJsonMueblesMasVisitadoss(){
	    $listaMuebles = $this->mReportes->obtenerMueblesMasVisitadosPorNumeroDias(8);
	   
	    
	    header('Content-Type: application/json');
    	echo json_encode( $data['reportes'] );
	}


	
}