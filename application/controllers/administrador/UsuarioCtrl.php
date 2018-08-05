<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UsuarioCtrl extends CI_Controller {


	private $usuariosAdministradorDb  = "usuario_admin";
	private $urlRedireccionUsuarios   = "admin/usuarios-listado";


	function UsuarioCtrl()
	{
		parent::__construct();
		// VALIDACION DE SESION
		$this->usuarioSesion = $this->session->userdata('usuario');
		$this->load->model("sucursal_model","mSucursal");
		if(!validar_sesion()){
			redirect(base_url().LOGIN);
		}		

	}


	function index(){
		$this->dashboardUsuario();
	}

	function dashboardUsuario(){

		$data['ubicacion']  = array('Dashboard','Usuarios');
		$data['titulo']     ='Usuarios';
		$data['contenido']  ="administrador/usuarios/listado_usuarios.php";
		//JS EXTERNO
		$data['js_externo'] ="administrador/usuarios/js/inicio.php";

		// OBTENER LISTADO DE TIENDAS
		$data['listadoUsuarios'] = $this->entidad->getModelBase($this->usuariosAdministradorDb,'id_usuario,usuario,nombre,apellido_paterno,tipo,email,usuario_creacion,estatus','tipo','ASC',null);

		// SE AGREGAN TODOS LOS DATOS A MOSTRAR EN $data
		$this->load->vars($data);
		// CARGA TEMPLATE DEFAULT
		$this->load->view('template');

	}


	function saveUsuario($tipo){

		$datos = $this->input->post();
		$usuarioExiste = false;
		$respuesta = 0;

		$idUsuario = $datos['id_usuario'];

		// REMOVER DATOS QUE NO VAN EN EL INSERT
		unset($datos["id_usuario"]);	


		if ($tipo == "modificar" ) {
			// # UPDATE
			$datos['fecha_modificacion']   = HOY;
			$datos['usuario_modificacion'] = $this->usuarioSesion;

			$respuesta = $this->entidad->update($this->usuariosAdministradorDb,"id_usuario",$idUsuario,$datos);

		}else{
			// # INSERT
			$datos['fecha_creacion']   = HOY;
			$datos['usuario_creacion'] = $this->usuarioSesion;

			$usuario  = $this->entidad->getModelBase($this->usuariosAdministradorDb,'usuario','usuario','ASC',array('usuario' => $datos['usuario']));
			$email    = $this->entidad->getModelBase($this->usuariosAdministradorDb,'email','email','ASC',array('email' => $datos['email']));

			if ( !empty( $usuario) || !empty($email) ){
				$usuarioExiste = true;
			}else{
				$respuesta = $this->entidad->save($this->usuariosAdministradorDb,$datos);
			}

		}

		if (!$usuarioExiste) {
			if ($respuesta > 0) {
				$mensaje = "El registro fue creado/actualizado con éxito.";
				$tipoFlashData = "exitoso";
			}else{
				$mensaje = "El registro no puedo ser creado/actualizado";
				$tipoFlashData = "error";
			}
		}else{
			$mensaje = "El usuario: ".$datos['usuario']." y/o correo: ".$datos['email']." ya existe";
			$tipoFlashData = "error";
		}

		$this->session->set_flashdata($tipoFlashData,$mensaje);

		redirect($this->urlRedireccionUsuarios);

	}	


	function verUsuarioDetalle( $usuarioId = 0 ){

		$data['detalleUsuario'] = $this->entidad->getModelBase($this->usuariosAdministradorDb,'id_usuario,usuario,nombre,apellido_paterno,tipo,email,usuario_creacion,estatus,password','tipo','ASC',array('id_usuario' => $usuarioId) );
		header('Content-Type: application/json');
    	echo json_encode( $data['detalleUsuario'] );
	}	


	function generaPassword(){
		$this->load->helper('string');
		$data['password'] = random_string('alnum', 12);
		header('Content-Type: application/json');
		echo json_encode( $data['password'] );
	}


	function reenviarPassword($usuarioId){
		
	}
	
	


}