	<?php
    ini_set("display_errors", "0");
	defined('BASEPATH') OR exit('No direct script access allowed');

	// This can be removed if you use __autoload() in config.php OR use Modular Extensions
	require APPPATH . '/libraries/REST_Controller.php';

	class Agente extends REST_Controller {


		private $usuarioVendedorDb  = "usuario_vendedor";
		private $usuarioAdminDb     = "usuario_admin";
		private $tiendaDb           = "ctg_tienda";


		function __construct(){
	        // Construct the parent class
	        parent::__construct();
					$this->load->model("Agentes_model","mAgente");
		}

			/**
			* Valida los accesos del agente
			*/
	    function validarCredencialesAgente_post(){

			$accesos =$this->entidad->getModelBase('usuario_admin','usuario,id_usuario,nombre,apellido_paterno,tipo','id_usuario','ASC',
															array('usuario'=>strtolower(trim($this->input->post('usuario',TRUE))),
																  'password'=>trim($this->input->post('password',TRUE)),
																   'estatus'=> 1 )
															);
			if( !empty($accesos) ){
				$this->response($accesos, REST_Controller::HTTP_OK);
			}else{
			  $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
			}

		}

		/**
		* Procesa solicitud de alta de Vendedor
		*/
		function procesarSolicitudVendedor_post(){

		}

		/**
		* Reiniciar password vendedor
		*/
		function enviarPasswordVendedor_post(){

				$vendedorId = intval( $this->input->post('vendedorId',TRUE) );

				if ($vendedorId > 0) {
					 // BUSCAR VENDEDOR EN BASE DE DATOS
					 $usuario =
										 $this->entidad->getModelBase(
																								 $this->$usuarioVendedorDb,'id_usuario,correo',null,'ASC',
																								 array('id_usuario'=>$vendedorId ));

					if( !empty($usuario) ){
							$nuevaContrasenia = random_string('alnum', 12);
							$email = $usuario[0]['correo'];

							$respuesta = $this->entidad->update($this->$usuarioVendedorDb,"id_vendedor",$vendedorId, array('estatus'=>5,'password' => $nuevaContrasenia));

							if( $respuesta > 0 ){
								$estatus = 1;
								$mensaje = 'Se notificó por correo al vendedor la nueva contraseña';
							}else{
								$estatus = -1;
								$mensaje = 'Error, la contraseña ya fue modificada, solicite al vendedor revisar la bandeja de correo.';
							}

					}else{
						$estatus = -1;
						$mensaje = 'Error, usuario no existe';
					}
				}else{
					$estatus = -1;
					$mensaje = 'Error, Id no válido';
				}

				$this->set_response([
						'status' => $estatus,
						'message'=> $mensaje
				],REST_Controller::HTTP_OK);
		}


		function obtenerTiendas_get(){

			$tiendas =
 							 $this->entidad->getModelBase(
 																					 $this->tiendaDb,'id,nombre',null,'ASC',array('estatus' => 1 ) );

		 $this->response($tiendas, REST_Controller::HTTP_OK);

		}


		function obtenerEstadoPorTienda_get($tiendaId){
			$tiendaId = intval($tiendaId);
			$estados = $this->mAgente->obtenerEstadosPorTienda($tiendaId);

			$this->response($estados, REST_Controller::HTTP_OK);
		}


		function obtenerLocalidadesPorTiendaEstado_get($tiendaId,$estadoId){
			$tiendaId = intval($tiendaId);
			$estadoId = intval($estadoId);
			$localidades = $this->mAgente->obtenerLocalidadesPorTiendaEstados($tiendaId,$estadoId);

			$this->response($localidades, REST_Controller::HTTP_OK);
		}


		function obtenerSucursalesPorLocalidad_get($tiendaId,$sucursalId){
			$tiendaId = intval($tiendaId);
			$sucursalId = intval($sucursalId);
			$surcusales= $this->mAgente->obtenerSucursalPorLocalidadTienda($tiendaId,$sucursalId);

			$this->response($surcusales, REST_Controller::HTTP_OK);
		}
		
	 function changePassword_post(){
	
		$data = json_decode(file_get_contents("php://input"));
        $userId = $data->userId;
        $oldpassword = $data->oldpassword;
        $password = $data->password;
        $confirmPass = $data->confirmPass;
        
			
			if($userId > 0){
			    
				$checkPassData = array('password' => $oldpassword, 'id_vendedor' => $userId);
		        $checkOldPassword = $this->mAgente->checkOldPassword('usuario_vendedor', $checkPassData);
				if(!$checkOldPassword){
					$response = array("status" => "false", "message" => "Old password not matched");
				}elseif($password != $confirmPass){
					$response = array("status" => "false", "message" => "New password and confirm password not matched!");
				}else{
					$updateData = array('password' => $password);
					$isUpdate = $this->mAgente->userchangepassword('usuario_vendedor', array('id_vendedor' => $userId), $updateData);
					if($isUpdate){
					    $response = array("status" => "success", "message" => "password changed");
					}else{
					    $response = array("status" => "false", "message" => "Password not changed!");
					}
				}
			}else{
			     $response = array("status" => "false", "message" => "User id not found!");
			}
            $this->response($response, REST_Controller::HTTP_OK);
		}




	}
