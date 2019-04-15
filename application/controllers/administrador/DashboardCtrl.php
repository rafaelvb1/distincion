<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DashboardCtrl extends CI_Controller {
    private $ctgTiendaTabla      = "ctg_tienda";


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
		//estadisticas por tienda dashboard
        $listadoReporteTienda["usuario"] = 0;

		$data['listadoReporteTienda']=$listadoReporteTienda;

        // OBTENER LISTADO DE TIENDAS
        $data['listadoTiendas'] = $this->entidad->getModelBase($this->ctgTiendaTabla,'id,nombre,estatus','nombre','ASC',null);

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

    function getJsonMueblesMasVisitadosPorTienda($id = 0 ){
        $data['listadoReporteTienda'] = $this->mReportes->obtenerMueblesMasVisitadosPorNumeroDiasAndTienda($id);
        // SE AGREGAN TODOS LOS DATOS A MOSTRAR EN $data
		$this->load->vars($data);
		header('Content-Type: application/json');
    	echo json_encode( $data['listadoReporteTienda'] );

    }

    function getJsonMueblesMasVisitadosPorTienda2($id = 0, $fechaInicio, $fechaFin ){
        $data['listadoReporteTienda'] = $this->mReportes->obtenerMueblesMasVisitadosPorNumeroDiasAndTienda2($id, $fechaInicio, $fechaFin);
        // SE AGREGAN TODOS LOS DATOS A MOSTRAR EN $data
        $this->load->vars($data);
        header('Content-Type: application/json');
        echo json_encode( $data['listadoReporteTienda'] );

    }


	
}