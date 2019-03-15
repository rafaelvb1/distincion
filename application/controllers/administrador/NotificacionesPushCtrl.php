<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class NotificacionesPushCtrl extends CI_Controller {


	private $ctgTiendaTabla      = "ctg_tienda";
	private $usuariosVendedorDb  = "usuario_vendedor";
	private $urlRedireccionUsuarios   = "admin/usuarios-listado";


	function NotificacionesPushCtrl()
	{
		parent::__construct();
		// VALIDACION DE SESION
		if(!validar_sesion()){
			redirect(base_url().LOGIN);
		}		
		$this->usuarioSesion = $this->session->userdata('usuario');
		$this->load->model("Vendedores_model","mVendedores");
		$this->load->model("Sucursal_model"  ,"mSucursal");
		$this->load->model("Reportes_model","mReportes");

	}


	function index(){
		$this->dashboardUsuario();
	}

	function enviar(){

		$data['ubicacion']  = array('Dashboard','Enviar notificaciones');
		$data['titulo']     ='Enviar notificaciones';
		$data['contenido']  ="administrador/notificacionespush/notificacionesenviar.php";
		//JS EXTERNO
        $data['js_externo'] ="administrador/vendedores/js/inicio.php";
        

		// OBTENER LISTADO DE TIENDAS
        $data['listadoTiendas'] = $this->entidad->getModelBase($this->ctgTiendaTabla,'id,nombre,estatus','nombre','ASC',null);
            // OBTENER LISTADO DE SUCURSALES
        $data['listadoSucursales'] = null;    
           
           

		// SE AGREGAN TODOS LOS DATOS A MOSTRAR EN $data
		$this->load->vars($data);
		// CARGA TEMPLATE DEFAULT
		$this->load->view('template');

    }
    function detalleTienda($tiendaId=""){

		if ( $tiendaId == "") {
			redirect($this->$urlRedireccionTienda);
		}else{

			
			$data['tiendaId']   = $tiendaId;

			
			// OBTENER LISTADO DE SUCURSALES
			$data['listadoSucursales'] = $this->mSucursal->obtenerDetalleSucursal( $this->encrypt->decode($tiendaId) );

			// SE AGREGAN TODOS LOS DATOS A MOSTRAR EN $data
			$this->load->vars($data);
			

		}

	}

}