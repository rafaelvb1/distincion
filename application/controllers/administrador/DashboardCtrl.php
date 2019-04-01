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
		$data['listadoReporteTienda'] = $this->mReportes->obtenerMueblesMasVisitadosPorNumeroDiasAndTienda(8);
		
		$data['listadoAgrupado'] = $this->mReportes->obtenerMueblesMasVisitadosPorNumeroDiasAndTienda2(8);

		$idTemporal=0;
		$idTemporalAnterior=0;
		$registroTemporal=array();
		$registroTemporalAnterior=array();
		$listadoTabla=array();


		foreach ($data['listadoAgrupado']   as $registro) {
			
			echo 	$registro['id_vendedor']; 
			
			if($idTemporal==0){
				$idTemporal=$registro['id_vendedor'];

				$registroTemporal["usuario"] = $registro['usuario'];
				$registroTemporal["tienda"] = $registro['id_tienda'];
				$registroTemporal["detalle"] = 0;
				$registroTemporal["total"] = 0;
				$registroTemporal["masaje"] = 0;
				$registroTemporal["mecanismo"] = 0;
			}else{
				$idTemporal=$registro['id_vendedor'];
				if($idTemporalAnterior!=$idTemporal){
					$registroTemporalAnterior["total"] = $registroTemporalAnterior["total"] +$registroTemporalAnterior["detalle"]+$registroTemporalAnterior["masaje"]+$registroTemporalAnterior["mecanismo"];
					array_push(	$listadoTabla,$registroTemporalAnterior);	
					$registroTemporal=array();
					$registroTemporal["usuario"] = $registro['usuario'];
					$registroTemporal["tienda"] = $registro['id_tienda'];
					$registroTemporal["detalle"] = 0;
					$registroTemporal["total"] = 0;
					$registroTemporal["masaje"] = 0;
					$registroTemporal["mecanismo"] = 0;
				}

			}

			
			$registroTemporalAnterior=$registroTemporal;

			if($registro['tipo_visita']=='detalle')
				$registroTemporal["detalle"] = $registro['count(*)'];
			if($registro['tipo_visita']=='login')
				$registroTemporal["login"] = $registro['count(*)'];
			if($registro['tipo_visita']=='masaje')
				$registroTemporal["masaje"] = $registro['count(*)'];
			if($registro['tipo_visita']=='mecanismo')
				$registroTemporal["mecanismo"] = $registro['count(*)'];

            
		
			$idTemporalAnterior=$registro['id_vendedor'];
		
		}
		array_push(	$listadoTabla,$registroTemporalAnterior);	
		$data['listadoReporteTienda']=$listadoTabla;
        //$data['listadoMasajeTienda'] = $this->mReportes->obtenerMasajeMasVisitadosPorNumeroDiasAndTienda(8);
        //$data['listadoMecanismoTienda'] = $this->mReportes->obtenerMecamismoMasVisitadosPorNumeroDiasAndTienda(8);
        //$data['listadoLoginVendedorTienda'] = $this->mReportes->obtenerLoginVendedorPorNumeroDiasAndTienda(8);

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
        $data['listadoReporteTienda'] = $this->mReportes->obtenerMueblesMasVisitadosPorNumeroDiasAndTienda(8);
        // SE AGREGAN TODOS LOS DATOS A MOSTRAR EN $data
        $this->load->vars($data);

    }


	
}