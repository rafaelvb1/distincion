	<?php
    ini_set("display_errors", "0");
	defined('BASEPATH') OR exit('No direct script access allowed');

	// This can be removed if you use __autoload() in config.php OR use Modular Extensions
	require APPPATH . '/libraries/REST_Controller.php';

	class Catalog extends REST_Controller {


		private $usuarioVendedorDb  = "usuario_vendedor";
		private $usuarioAdminDb     = "usuario_admin";
		private $tiendaDb           = "ctg_tienda";
		private $coloresDb          = "ctg_colores";
		private $masajeDb           = "ctg_masaje";
		private $mecanismoDb        = "ctg_mecanismos";
		private $tapizDb            = "ctg_tapiz";
		private $categoriasDb       = "ctg_categorias";
	//	private $masajeDb           = "ctg_masaje";


		function __construct(){
	        // Construct the parent classobtenerEstadoPorTienda
	        parent::__construct();
					$this->load->model("agentes_model","mAgente");
	    }

		
	    /**
		* Obtener nombres de tienda
		* Get name and ID store
		*/
		function obtenerTiendas_get(){

			$tiendas =$this->entidad->getModelBase($this->tiendaDb,'id,nombre',null,'ASC',array('estatus' => 1 ) );
		    if (!empty($tiendas)) {
			    $response = array("status" => "true", "message" => "success", "data" => $tiendas);
			} else {
			    $response = array("status" => "false", "message" => "Not found");
			}
			$this->response($response, REST_Controller::HTTP_OK);

		}

        /**
		* Obtener estados por tienda
		* Get state by ID store
		*/ 
		function obtenerEstadoPorTienda_get($tiendaId){
			$tiendaId = intval($tiendaId);
			$estados = $this->mAgente->obtenerEstadosPorTienda($tiendaId);

			if (!empty($estados)) {
                $response = array("status" => "true", "message" => "success", "data" => $estados);
            } else {
                $response = array("status" => "false", "message" => "Not found");
            }
            $this->response($response, REST_Controller::HTTP_OK);
		}

        /**
		* Obtener ciudades por tienda
		* Get city by store Id and state Id
		*/
		function obtenerLocalidadesPorTiendaEstado_get($tiendaId,$estadoId){
			$tiendaId = intval($tiendaId);
			$estadoId = intval($estadoId);
			$localidades = $this->mAgente->obtenerLocalidadesPorTiendaEstados($tiendaId,$estadoId);

			if (!empty($localidades)) {
                $response = array("status" => "true", "message" => "success", "data" => $localidades);
            } else {
                $response = array("status" => "false", "message" => "Not found");
            }
            $this->response($response, REST_Controller::HTTP_OK);
		}


        /**
		* Obtener sucursales por tienda y localidad
		* Get branch office by store Id and city Id
		*/
		function obtenerSucursalesPorLocalidad_get($tiendaId,$sucursalId){
			$tiendaId = intval($tiendaId);
			$sucursalId = intval($sucursalId);
			$surcusales= $this->mAgente->obtenerSucursalPorLocalidadTienda($tiendaId,$sucursalId);

			if (!empty($surcusales)) {
                $response = array("status" => "true", "message" => "success", "data" => $surcusales);
            } else {
                $response = array("status" => "false", "message" => "Not found");
            }
            $this->response($response, REST_Controller::HTTP_OK);
		}
		
		
		
        /**
		* Obtener colores 
		* Get colors list
		*/
		function obtenerColores_get(){
			$res =$this->entidad->getModelBase($this->coloresDb,'id,nombre',null,'ASC',array('estatus' => 1 ) );
			if(!empty($res)){
			    $response = array("status" => "true", "message" => "success", "data" => $res);
			} else {
			    $response = array("status" => "false", "message" => "not found"); 
			}
		    $this->response($response, REST_Controller::HTTP_OK);
		}
		
		
        /**
		* Obtener mecanismo de masaje
		* Get massage mechanism
		*/
		function obtenerTipoMasaje_get(){
			$res =$this->entidad->getModelBase($this->masajeDb,'id,nombre',null,'ASC',array('estatus' => 1 ) );
		    $this->response($res, REST_Controller::HTTP_OK);
		}	
		
		
        /**
		* Obtener mecanismos 
		* Get massage mechanism
		*/
		function obtenerTipoMecanismos_get(){
			$res =$this->entidad->getModelBase($this->mecanismoDb,'id,nombre',null,'ASC',array('estatus' => 1 ) );
			if(!empty($res)){
			    $response = array("status" => "true", "message" => "success", "data" => $res);
			} else {
			    $response = array("status" => "false", "message" => "not found"); 
			}
		    $this->response($response, REST_Controller::HTTP_OK);
		}
		
		
        /**
		* Obtener Tapiz 
		* Get furniture skin 
		*/
		function obtenerTipoTapiz_get(){
			$res =$this->entidad->getModelBase($this->tapizDb,'id,nombre',null,'ASC',array('estatus' => 1 ) );
			if(!empty($res)) {
			    $response = array("status" => "true", "message" => "success", "data" => $res);
			} else {
			    $response = array("status" => "false", "message" => "Not Found");
			}
		    $this->response($response, REST_Controller::HTTP_OK);
		}
		
		
        /**
		* Obtener caracteristica
		* Get furniture skin 
		*/
		function obtenerTipoTapizColorEspecial_get(){
			$res =$this->entidad->getModelBase($this->tapizDb,'id,nombre',null,'ASC',array('estatus' => 1 ) );
			$this->mAgente->checkOldPassword2(1,10);
		    $this->response($response, REST_Controller::HTTP_OK);
		}		
		
		
		function getMergeMenu_get(){
		    
		    
		    $color =$this->entidad->getModelBase($this->coloresDb,'id,nombre',null,'ASC',array('estatus' => 1 ) );
		    
		    $mechanism =$this->entidad->getModelBase($this->mecanismoDb,'id,nombre',null,'ASC',array('estatus' => 1 ) );
		    
		    $tapiz =$this->entidad->getModelBase($this->tapizDb,'id,nombre',null,'ASC',array('estatus' => 1 ) );
		    
		    $categorias   = $this->entidad->getModelBase($this->categoriasDb,'id,nombre',null,'ASC',array('estatus' => 1 ) );
		    
		    $masaje = $this->entidad->getModelBase($this->masajeDb,'id,nombre',null,'ASC',array('estatus' => 1 ) );
		    
		    $arr[] = array("menu_name"=> "Tapiz", "name" => "tapiz_id", "menu_data" => $tapiz);
		    $arr[] = array("menu_name"=> "Mecanismo", "name" => "mecanismo_id", "menu_data" => $mechanism);
		    $arr[] = array("menu_name"=> "Color", "name" => "color_id", "menu_data" => $color);
		    $arr[] = array("menu_name"=> "Categories", "name" => "categoria_id", "menu_data" => $categorias);
		    $arr[] = array("menu_name"=> "Masaje", "name" => "masaje_id", "menu_data" => $masaje);
		    $response = array("status" => "true", "data" => $arr);
		    $this->response($response, REST_Controller::HTTP_OK);
		    
		}



	}
